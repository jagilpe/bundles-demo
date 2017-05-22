<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Jagilpe\EncryptionBundle\Annotation\EncryptedEntity;
use Jagilpe\EncryptionBundle\Annotation\EncryptedField;
use Jagilpe\EncryptionBundle\Entity\SystemEncryptableEntity;
use Jagilpe\EncryptionBundle\Entity\Traits\SystemEncryptableEntityTrait;

/**
 * Example entity for the configuration of system wide encryption with a yaml file
 *
 * @author Javier Gil Pereda <javier@gilpereda.com>
 *
 * @ORM\Entity
 */
class SystemEncryptableEntityYaml implements SystemEncryptableEntity
{
    use SystemEncryptableEntityTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $clearField;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $encryptedStringField;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $encryptedTextField;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $encryptedBooleanField;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    protected $encryptedIntegerField;

    /**
     * @var array
     * @ORM\Column(type="simple_array")
     */
    protected $encryptedSimpleArrayField;

    /**
     * @var array
     * @ORM\Column(type="json_array")
     */
    protected $encryptedJsonArrayField;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $encryptedDateTimeField;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getClearField()
    {
        return $this->clearField;
    }

    /**
     * @param string $clearField
     * @return SystemEncryptableEntityAnnotation
     */
    public function setClearField($clearField)
    {
        $this->clearField = $clearField;
        return $this;
    }

    /**
     * @return string
     */
    public function getEncryptedStringField()
    {
        return $this->encryptedStringField;
    }

    /**
     * @param string $encryptedStringField
     * @return SystemEncryptableEntityAnnotation
     */
    public function setEncryptedStringField($encryptedStringField)
    {
        $this->encryptedStringField = $encryptedStringField;
        return $this;
    }

    /**
     * @return string
     */
    public function getEncryptedTextField()
    {
        return $this->encryptedTextField;
    }

    /**
     * @param string $encryptedTextField
     * @return SystemEncryptableEntityAnnotation
     */
    public function setEncryptedTextField($encryptedTextField)
    {
        $this->encryptedTextField = $encryptedTextField;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEncryptedBooleanField()
    {
        return $this->encryptedBooleanField;
    }

    /**
     * @param bool $encryptedBooleanField
     * @return SystemEncryptableEntityAnnotation
     */
    public function setEncryptedBooleanField(bool $encryptedBooleanField)
    {
        $this->encryptedBooleanField = $encryptedBooleanField;
        return $this;
    }

    /**
     * @return int
     */
    public function getEncryptedIntegerField()
    {
        return $this->encryptedIntegerField;
    }

    /**
     * @param int $encryptedIntegerField
     * @return SystemEncryptableEntityAnnotation
     */
    public function setEncryptedIntegerField($encryptedIntegerField)
    {
        $this->encryptedIntegerField = $encryptedIntegerField;
        return $this;
    }

    /**
     * @return array
     */
    public function getEncryptedSimpleArrayField()
    {
        return $this->encryptedSimpleArrayField;
    }

    /**
     * @param array $encryptedSimpleArrayField
     * @return SystemEncryptableEntityAnnotation
     */
    public function setEncryptedSimpleArrayField(array $encryptedSimpleArrayField)
    {
        $this->encryptedSimpleArrayField = $encryptedSimpleArrayField;
        return $this;
    }

    /**
     * @return array
     */
    public function getEncryptedJsonArrayField()
    {
        return $this->encryptedJsonArrayField;
    }

    /**
     * @param array $encryptedJsonArrayField
     * @return SystemEncryptableEntityAnnotation
     */
    public function setEncryptedJsonArrayField(array $encryptedJsonArrayField)
    {
        $this->encryptedJsonArrayField = $encryptedJsonArrayField;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEncryptedDateTimeField()
    {
        return $this->encryptedDateTimeField;
    }

    /**
     * @param \DateTime $encryptedDateTimeField
     * @return SystemEncryptableEntityAnnotation
     */
    public function setEncryptedDateTimeField(\DateTime $encryptedDateTimeField)
    {
        $this->encryptedDateTimeField = $encryptedDateTimeField;
        return $this;
    }
}