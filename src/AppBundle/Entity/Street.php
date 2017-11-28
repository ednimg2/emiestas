<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Street
 *
 * @ORM\Table(name="street")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StreetRepository")
 */
class Street
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="district", type="string", length=100)
     */
    private $district;

    /**
     * @var string
     *
     * @ORM\Column(name="district_number", type="string", length=20)
     */
    private $districtNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="ter_rej_code", type="string", length=20)
     */
    private $terRejCode;

    /**
     * @var int
     *
     * @ORM\Column(name="street_code", type="integer")
     */
    private $streetCode;


    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Id
     *
     * @param int $id
     *
     * @return Id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Street
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set district
     *
     * @param string $district
     *
     * @return Street
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set districtNumber
     *
     * @param string $districtNumber
     *
     * @return Street
     */
    public function setDistrictNumber($districtNumber)
    {
        $this->districtNumber = $districtNumber;

        return $this;
    }

    /**
     * Get districtNumber
     *
     * @return string
     */
    public function getDistrictNumber()
    {
        return $this->districtNumber;
    }

    /**
     * Set terRejCode
     *
     * @param string $terRejCode
     *
     * @return Street
     */
    public function setTerRejCode($terRejCode)
    {
        $this->terRejCode = $terRejCode;

        return $this;
    }

    /**
     * Get terRejCode
     *
     * @return string
     */
    public function getTerRejCode()
    {
        return $this->terRejCode;
    }

    /**
     * Set streetCode
     *
     * @param string $streetCode
     *
     * @return Street
     */
    public function setStreetCode($streetCode)
    {
        $this->streetCode = $streetCode;

        return $this;
    }

    /**
     * Get streetCode
     *
     * @return string
     */
    public function getStreetCode()
    {
        return $this->streetCode;
    }
    
}
