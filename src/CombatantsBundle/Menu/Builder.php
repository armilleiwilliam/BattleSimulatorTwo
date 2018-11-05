<?php
// src/AppBundle/Menu/Builder.php
namespace CombatantsBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->setChildrenAttribute("class", "nav navbar-nav");

        $menu->addChild('Home', array('route' => 'homepage'));

        // access services from the container!
        $em = $this->container->get('doctrine')->getManager();
        // findMostRecent and Blog are just imaginary examples
        //$blog = $em->getRepository('AppBundle:Blog')->findMostRecent();

        $menu->addChild('Home', array(
            'route' => 'homepage'
        ));

        // create another menu item
        $menu->addChild('About Me', array('route' => 'about-me'));

        // Defense
        $menu->addChild('Defense', array('route' => 'combatants_defense_edit',
                                        'routeParameters' => array('id' => 2))
        );

        // Health
        $menu->addChild('Health', array('route' => 'combatants_health_index',
                                         'routeParameters' => array('id' => 2))
        );

        // ... add more children

        return $menu;
    }
}