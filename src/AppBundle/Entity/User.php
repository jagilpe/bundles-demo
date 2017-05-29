<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Jagilpe\EncryptionBundle\Entity\PKEncryptionEnabledUserInterface;
use Jagilpe\EncryptionBundle\Entity\Traits\EncryptionEnabledUserTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="app_user")
 */
class User extends BaseUser implements PKEncryptionEnabledUserInterface
{
    use EncryptionEnabledUserTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var UserProfile
     *
     * @ORM\OneToOne(targetEntity="UserProfile", mappedBy="user", cascade={"persist", "remove"})
     */
    protected $profile;

    /**
     * @return UserProfile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param UserProfile $profile
     * @return User
     */
    public function setProfile(UserProfile $profile)
    {
        $this->profile = $profile;
        return $this;
    }
}