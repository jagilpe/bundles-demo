<?php

namespace AppBundle\EntityList\Type;

use AppBundle\Entity\User;
use Jagilpe\EntityListBundle\EntityList\AbstractListType;
use Jagilpe\EntityListBundle\EntityList\ColumnType\CallbackColumnType;
use Jagilpe\EntityListBundle\EntityList\ColumnType\DateTimeColumnType;
use Jagilpe\EntityListBundle\EntityList\ColumnType\SingleFieldColumnType;
use Jagilpe\EntityListBundle\EntityList\EntityListBuilderInterface;

/**
 * Entity list type example for the user entity
 *
 * @author Javier Gil Pereda <javier@gilpereda.com>
 */
class UserListType extends AbstractListType
{
    /**
     * {@inheritDoc}
     * @see \Jagilpe\EntityListBundle\EntityList\ListTypeInterface::buildList()
     */
    public function buildList(EntityListBuilderInterface $builder, array $options = array())
    {
        $builder
            ->add('username', SingleFieldColumnType::class, array('label' => 'Username'))
            ->add('fullName', CallbackColumnType::class, array(
                'label' => 'Full name',
                'content-callback' => function(User $user) {
                    $userProfile = $user->getProfile();
                    return $userProfile ? $userProfile->getLastName().', '.$userProfile->getFirstName() : null;
                }))
            ->add('profile::birthDate', DateTimeColumnType::class, array(
                'label' => 'Birth date',
                'cell-options' => array('datetime_format' => 'm/d/Y')))
            ->add('Age', CallbackColumnType::class, array(
                'content-callback' => array($this, 'getUserAge')
            ))
            ->add('profile::address', SingleFieldColumnType::class, array('label' => 'Address'))
            ->add('profile::address::country', SingleFieldColumnType::class, array('label' => 'Country'))
        ;
    }

    /**
     * Returns the age of the user
     *
     * @param User $user
     * @return string
     */
    public function getUserAge(User $user)
    {
        $profile = $user->getProfile();
        if ($profile) {
            $now = new \DateTime();
            $birthDate = $profile->getBirthDate();
            return $birthDate ? $now->diff($birthDate)->y : null;
        } else {
            return null;
        }
    }
}