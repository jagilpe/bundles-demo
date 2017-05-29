<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\EntityList\Type\UserListType;
use Jagilpe\EntityListBundle\Controller\EntityListControllerTrait;
use Jagilpe\EntityListBundle\EntityList\ColumnType\SingleFieldColumnType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller class for the entity list demo
 *
 * @author Javier Gil Pereda <javier@gilpereda.com>
 */
class EntityListDemoController extends Controller
{
    use EntityListControllerTrait;

    /**
     * Home page for the entity list bundle demo
     *
     * @return Response
     */
    public function entityListDemoHomeAction()
    {
        // Get the users
        $repo = $this->get('doctrine')->getRepository(User::class);
        $users = $repo->findAll();

        $listBuilder = $this->createEntityListBuilder($users);
        $listBuilder->add('username', SingleFieldColumnType::class, array('label' => 'Username'));
        $listBuilder->add('email', SingleFieldColumnType::class, array('label' => 'Email'));
        $listBuilder->add('profile::firstName', SingleFieldColumnType::class, array('label' => 'First name'));
        $listBuilder->add('profile::lastName', SingleFieldColumnType::class, array('label' => 'Last name'));
        $list1 = $listBuilder->getEntityList();

        $list2 = $this->createEntityList($users, UserListType::class);

        return $this->render(':entity_list_demo:entity-list-index.html.twig', array('list1' => $list1, 'list2' => $list2));
    }
}