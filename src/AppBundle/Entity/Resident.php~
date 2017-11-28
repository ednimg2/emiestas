<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resident
 *
 * @ORM\Table(name="resident")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResidentRepository")
 */
class Resident
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="birthday", type="string", length=20)
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="birthcountry", type="string", length=10)
     */
    private $birthcountry;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=2)
     */
    private $sex;

    /**
     * @var string
     *
     * @ORM\Column(name="marital_status", type="string", length=2)
     */
    private $maritalStatus;

    /**
     * @var int
     *
     * @ORM\Column(name="children", type="integer")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Street")
     * @ORM\JoinColumn(name="street_id", referencedColumnName="id")
     */
    private $street;

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
     * Set birthday
     *
     * @param string $birthday
     *
     * @return Resident
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set birthcountry
     *
     * @param string $birthcountry
     *
     * @return Resident
     */
    public function setBirthcountry($birthcountry)
    {
        $this->birthcountry = $birthcountry;

        return $this;
    }

    /**
     * Get birthcountry
     *
     * @return string
     */
    public function getBirthcountry()
    {
        return $this->birthcountry;
    }

    /**
     * Set sex
     *
     * @param string $sex
     *
     * @return Resident
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set maritalStatus
     *
     * @param string $maritalStatus
     *
     * @return Resident
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    /**
     * Get maritalStatus
     *
     * @return string
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * Set children
     *
     * @param integer $children
     *
     * @return Resident
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Get children
     *
     * @return int
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set streetId
     *
     * @param integer $streetId
     *
     * @return Resident
     */
    public function setStreetId($streetId)
    {
        $this->street_id = $streetId;

        return $this;
    }

    /**
     * Get streetId
     *
     * @return integer
     */
    public function getStreetId()
    {
        return $this->street_id;
    }

    /**
     * Set street
     *
     * @param \AppBundle\Entity\Street $street
     *
     * @return Resident
     */
    public function setStreet(\AppBundle\Entity\Street $street = null)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return \AppBundle\Entity\Street
     */
    public function getStreet()
    {
        return $this->street;
    }
}
