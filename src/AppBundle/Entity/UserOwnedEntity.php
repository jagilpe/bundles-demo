<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Jagilpe\EncryptionBundle\Annotation\EncryptedEntity;
use Jagilpe\EncryptionBundle\Annotation\EncryptedField;
use Jagilpe\EncryptionBundle\Entity\PerUserEncryptableEntity;
use Jagilpe\EncryptionBundle\Entity\Traits\PerUserEncryptableEntityTrait;

/**
 * Example Entity for per user encryption
 *
 * @author Javier Gil Pereda <javier@gilpereda.com>
 *
 * @ORM\Entity
 * @EncryptedEntity(enabled=true, mode="PER_USER_SHAREABLE")
 */
class UserOwnedEntity implements PerUserEncryptableEntity
{
    use PerUserEncryptableEntityTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $clearField;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @EncryptedField
     */
    protected $encryptedField;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return UserOwnedEntity
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
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
     * @return UserOwnedEntity
     */
    public function setClearField($clearField)
    {
        $this->clearField = $clearField;
        return $this;
    }

    /**
     * @return string
     */
    public function getEncryptedField()
    {
        return $this->encryptedField;
    }

    /**
     * @param string $encryptedField
     * @return UserOwnedEntity
     */
    public function setEncryptedField($encryptedField)
    {
        $this->encryptedField = $encryptedField;
        return $this;
    }
}