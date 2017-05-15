<?php

namespace AppBundle\Service;

use Jagilpe\MenuBundle\Provider\AbstractMenuProvider;

/**
 * Service that provides the menus of the app
 *
 * @author Javier Gil Pereda <javier@gilpereda.com>
 */
class MenuProvider extends AbstractMenuProvider
{
    const APP_MENU = 'app_menu';

    /**
     * Returns a menu object
     *
     * @param string $menuName
     *
     * @throws \RuntimeException
     *
     * @return \Jagilpe\MenuBundle\Menu\Menu|null|false
     */
    public function getMenu($menuName)
    {
        if (self::APP_MENU !== $menuName) {
            return false;
        }

        $menuBuilder = $this->menuFactory->createMenuBuilder();
        $menuBuilder->newMenuItem(array(
            'name' => 'Home',
            'route' => 'homepage'
        ));

        return $menuBuilder->getMenu();
    }
}