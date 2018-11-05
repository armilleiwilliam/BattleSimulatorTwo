<?php

namespace AppBundle\Model;

use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Utils\Fighters;

interface FighterInterface
{
    /**
     * @param int $min
     * @param int $max
     *
     * @return mixed
     */
    public function getRandomPropertyValue($min, $max);

    /**
     * @param Fighters $combatants
     *
     * @return mixed
     */
    public function checkIfInstanceOfCombatantsList(Fighters $combatants);

    /**
     * @param                 $combatant
     * @param OutputInterface $output
     *
     * @return mixed
     */
    public function showCombatantProperties(OutputInterface $output);
}
