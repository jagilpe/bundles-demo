<?php

namespace AppBundle\Service;

use Jagilpe\MenuBundle\Menu\Menu;
use Jagilpe\MenuBundle\Menu\MenuItem;
use Jagilpe\MenuBundle\Provider\AbstractMenuProvider;

/**
 * Service that provides the menus of the app
 *
 * @author Javier Gil Pereda <javier@gilpereda.com>
 */
class MenuProvider extends AbstractMenuProvider
{
    const APP_MENU = 'app_menu';
    const APP_MOBILE_MENU = 'app_mobile_menu';

    /**
     * Menus for the demo of the MenuBundle
     */
    // This menu is shown when the navbar is not collapsed
    const DEMO_MENU = 'demo_menu';
    // This menu is shown when the navbar is collapsed (smallest resolutions)
    const DEMO_MOBILE_MENU = 'demo_mobile_menu';

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
        switch ($menuName) {
            case self::APP_MENU:
                return $this->getAppMenu(false);
            case self::APP_MOBILE_MENU:
                return $this->getAppMenu(true);
            case self::DEMO_MENU:
                return $this->getDemoMenu(false);
            case self::DEMO_MOBILE_MENU:
                return $this->getDemoMenu(true);
        }

        return false;
    }

    /**
     * Returns the main app menu
     *
     * @param boolean $mobile
     * @return Menu
     */
    private function getAppMenu($mobile)
    {
        $menuBuilder = $this->menuFactory->createMenuBuilder();
        $menuBuilder->newMenuItem(array(
            'name' => 'Home',
            'route' => 'homepage'
        ));

        $menuBuilder->addMenuItem($this->getAjaxBlocksMenu($mobile));
        $menuBuilder->addMenuItem($this->getAjaxModalsMenu($mobile));
        $menuBuilder->addMenuItem($this->getEntityListMenu($mobile));

        $menuBuilder->newMenuItem(array(
            'name' => 'MenuBundle',
            'route' => 'menu_demo_home'
        ));

        return $menuBuilder->getMenu();
    }

    /**
     * Returns the menu for the demo of the menu bundle functionality. It returns two versions of the same
     * menu, depending if it's to be shown in smaller or bigger resolutions
     *
     * @param boolean $mobile
     * @return Menu
     */
    private function getDemoMenu($mobile = false)
    {
        $menuClasses = $mobile ? 'hidden-sm hidden-md hidden-lg' : 'hidden-xs';

        $menuBuilder = $this->menuFactory->createMenuBuilder(array(
            'attributes' => array('class' => $menuClasses)
        ));
        $menuBuilder->newMenuItem(array(
            'name' => 'Home',
            'route' => 'homepage'
        ));

        $menuBuilder->addMenuItem($this->getCollapsedMenuItem($mobile));
        $menuBuilder->addMenuItem($this->getExpandableMenuItem());
        $menuBuilder->addMenuItem($this->getAnchorsMenu($mobile));

        return $menuBuilder->getMenu();
    }

    /**
     * Returns the items of the collapsed menu
     *
     * @param boolean $mobile
     * @return MenuItem
     */
    private function getCollapsedMenuItem($mobile)
    {
        $collapsedMenu = $this->menuFactory->createMenuItem(array(
            'name' => 'Collapsed Menu',
            'route' => 'menu_collapsed',
            'hide_children' => !$mobile,
        ));

        for ($i = 1; $i < 4; $i++) {
            // Child with more sub children
            $child = $this->menuFactory->createMenuItem(array(
                'name' => "Level 2 - Element $i",
                'route' => 'menu_collapsed_level2',
                'route_params' => array('level2' => $i),
                'hide_children' => true,
            ));

            for ($j = 1; $j < 5; $j++) {
                $child
                    ->add($this->menuFactory->createMenuItem(array(
                        'name' => "Level 3 - Elem. $i - Subelem. $j",
                        'route' => 'menu_collapsed_level3',
                        'route_params' => array('level2' => 1, 'level3' => $j)
                    )));
            }

            $collapsedMenu->add($child);
        }

        $otherChild = $this->menuFactory->createMenuItem(array(
            'name' => 'Level 2 - Element 4',
            'route' => 'menu_collapsed_level2',
            'route_params' => array('level2' => 4)
        ));

        $collapsedMenu->add($otherChild);

        return $collapsedMenu;
    }

    /**
     * Returns the items of the expandable menu
     *
     * @return MenuItem
     */
    private function getExpandableMenuItem()
    {
        $dropDownMenu = $this->menuFactory->createMenuItem(array(
            'name' => 'Drop Down Menu',
            'route' => 'menu_drop_down',
        ));

        for ($i = 1; $i < 5; $i++) {
            // Child with more sub children
            $child = $this->menuFactory->createMenuItem(array(
                'name' => "Level 2 - Element $i",
                'route' => 'menu_drop_down_level_2',
                'route_params' => array('level2' => $i),
            ));

            $dropDownMenu->add($child);
        }

        return $dropDownMenu;
    }

    /**
     * Returns a menu area that demonstrates the navigation with anchors
     *
     * @param boolean $mobile
     * @return MenuItem
     */
    private function getAnchorsMenu($mobile)
    {
        $anchorMenu = $this->menuFactory->createMenuItem(array(
            'name' => 'Anchor Menu',
            'route' => 'menu_anchor',
            'hide_children' => !$mobile,
        ));

        $anchors = array(
            'first',
            'second',
            'third',
            'forth'
        );

        foreach ($anchors as $anchor) {
            $childItem = $this->menuFactory->createMenuItem(
                array(
                    'name' => "Anchor to $anchor target",
                ));
            $childItem->setRouteOptions(array('anchor' => $anchor));
            $anchorMenu->add($childItem);
        }

        return $anchorMenu;
    }

    /**
     * Returns the menu elements for the AjaxBlocks Bundle demo
     *
     * @param boolean $mobile
     * @return MenuItem
     */
    private function getAjaxBlocksMenu($mobile)
    {
        $ajaxBlocksMenu = $this->menuFactory->createMenuItem(array(
            'name' => 'AjaxBlocksBundle',
            'route' => 'ajax_blocks_home',
            'hide_children' => !$mobile,
        ));

        $simpleBlocks = $this->menuFactory->createMenuItem(array(
            'name' => 'Simple ajax blocks',
            'route' => 'ajax_blocks_simple',
        ));

        $ajaxBlocksMenu->add($simpleBlocks);

        return $ajaxBlocksMenu;
    }

    /**
     * Returns the menu elements for the AjaxModals Bundle demo
     *
     * @param boolean $mobile
     * @return MenuItem
     */
    private function getAjaxModalsMenu($mobile)
    {
        $ajaxModalsMenu = $this->menuFactory->createMenuItem(array(
            'name' => 'AjaxModalsBundle',
            'route' => 'ajax_modals_home',
            'hide_children' => !$mobile,
        ));

        return $ajaxModalsMenu;
    }

    /**
     * Returns the menu elements for the AjaxModals Bundle demo
     *
     * @param boolean $mobile
     * @return MenuItem
     */
    private function getEntityListMenu($mobile)
    {
        $entityListMenu = $this->menuFactory->createMenuItem(array(
            'name' => 'EntityListBundle',
            'route' => 'entity_list_home',
            'hide_children' => !$mobile,
        ));

        return $entityListMenu;
    }
}