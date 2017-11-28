<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ResidentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('birthday', null, array(
                'label' => 'Gimimo metai'
            ))
            ->add('birthcountry', null, array(
                'label' => 'Gimimo vieta'
            ))
            ->add('sex', ChoiceType::class, array(
                'choices' => array(
                    'Vyras' => 'V',
                    'Moteris' => 'M',
                ),
                'label' => 'Lytis'
            ))
            ->add('maritalStatus', ChoiceType::class, array(
                'choices' => array(
                    '' => '',
                    'V' => 'V',
                    'I' => 'I',
                    'N' => 'N'
                ),
                'label' => 'Šeimos padėtis'
            ))
            ->add('children', null, array(
                'label' => 'Vaikų skaičius'
            ))
            ->add('street', null, array(
                'attr'  => array(
                    'class' => 'selectpicker',
                    'data-live-search' => 'true'
                ),
                'label' => 'Gatvė'
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Resident'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_resident';
    }


}
