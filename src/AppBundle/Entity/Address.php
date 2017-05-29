<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @author Javier Gil Pereda <javier@gilpereda.com>
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\NotBlank()
     */
    private $city;

    /**
     * @var string
     * @ORM\Column(type="string", length=10, nullable=false)
     * @Assert\NotBlank()
     */
    private $zipCode;

    /**
     * @var string
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\NotBlank()
     */
    private $country;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     * @return Address
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Address
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     * @return Address
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Returns the full address
     *
     * @return string
     */
    public function getFullAddress()
    {
        $fullAddress = '';
        $fullAddress .= $this->getAddress() ? $this->getAddress() : '';
        $fullAddress .= $this->getZipCode() ? ', '.$this->getZipCode() : '';
        $fullAddress .= $this->getCity() ? ', '.$this->getCity(): '';
        return trim($fullAddress);
    }

    public function __toString()
    {
        return $this->getFullAddress();
    }
}