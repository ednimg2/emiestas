<?php

namespace AppBundle\Command;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use AppBundle\Entity\Resident;
use AppBundle\Entity\Street;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use League\Csv\Reader;

class ImportCommand extends Command
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setName('import:csv')
            ->setDescription('Import residents from CSV file');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);
        $io = new SymfonyStyle($input, $output);
        $io->title('Start import');

        $reader = Reader::createFromPath('%kernel.root_dir%/../web/registered_people_n_streets.csv', 'r');
        //$reader = Reader::createFromPath('https://raw.githubusercontent.com/vilnius/gyventojai/master/registered_people_n_streets.csv', 'r');
        //$reader->setOffset(1);

        $input_bom = $reader->getInputBOM();

        if ($input_bom === Reader::BOM_UTF16_LE || $input_bom === Reader::BOM_UTF16_BE) {
            $reader->appendStreamFilter('convert.iconv.UTF-16/UTF-8');
        }

        $results = $reader->fetchAssoc();

        $io->progressStart(iterator_count($results));

        $batchSize = 1000;
        $i = 1;

        foreach ($results as $row) {

            if((isset($row['GATVE']) && $row['GATVE'] != '') || (isset($row['SENIUNIJA']) && $row['GATVE'] != '')) {
                $resident = (new Resident())
                    ->setBirthday($row['GIMIMO_METAI'])
                    ->setBirthcountry($row['GIMIMO_VALSTYBE'])
                    ->setSex($row['LYTIS'])
                    ->setMaritalStatus($row['SEIMOS_PADETIS'])
                    ->setChildren($row['KIEK_TURI_VAIKU']);

                $this->em->persist($resident);

                $street = $this->em->getRepository('AppBundle:Street')
                    ->findOneBy([
                        'id' => $row['GAT_ID']
                    ]);

                if ($street === null) {
                    $street = (new Street())
                        ->setId(trim($row['GAT_ID'], "\t\n\r\0\x0B\xC2\xA0"))
                        ->setName($row['GATVE'])
                        ->setDistrict($row['SENIUNIJA'])
                        ->setDistrictNumber($row['SENIUNNR'])
                        ->setTerRejCode($row['TER_REJ_KODAS'])
                        ->setStreetCode($row['GATV_K']);

                    $this->em->persist($street);
                    $this->em->flush($street);
                }

                $resident->setStreet($street);
            }

            if (($i % $batchSize) === 0) {
                $this->em->flush();
                $this->em->clear();

                $io->progressAdvance($batchSize);
                $i = 1;
            }
            $i++;
        }

        $this->em->flush();
        $this->em->clear();

        $io->progressFinish();

        $io->success('Import done');
    }
}
