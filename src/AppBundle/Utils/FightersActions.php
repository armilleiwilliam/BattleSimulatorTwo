<?php

namespace AppBundle\Utils;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class FightersActions
 */
abstract class FightersActions
{
    const HEALTH = 'Health: ';
    const STRENGTH = 'Strength: ';
    const DEFENSE = 'Defense: ';
    const SPEED = 'Speed: ';
    const LUCK = 'Luck: ';
    const COMBATANT_ASSIGNED_TO = ' combatant assigned to ';
    const BLANKLINE = '\n';
    const COLON = ':';

    /**
     * @var bool
     */
    public $attackPermissionFirst = true;

    /**
     * @var bool
     */
    public $attackPermissionSecond = true;

    /**
     * @var array
     */
    public $combatantsList = [];

    /**
     * @var int
     */
    public $randomNumberReturned = 0;

    /**
     * @param $min
     * @param $max
     *
     * @return int|string
     * @throws \Exception
     */
    public function getRandomPropertyValue($min, $max)
    {
        // check if passed values are both integer or both decimals
        if ((is_integer($min) && is_integer($max)) || (is_float($min) && is_float($max))) {
            // check if the min is less than max
            if ($min < $max) {
                if (is_float($min) && is_float($max)) {
                    // return only a two decimal number (if float)
                    $this->randomNumberReturned = number_format(($min + lcg_value() * (abs($max - $min))), 2);
                } else {
                    // return integer
                    $this->randomNumberReturned = mt_rand($min, $max);
                }
                return $this->randomNumberReturned;
            }
            // throw exception
            throw new \Exception(ucwords($this->randomNumberReturned)
                . self::MAX_BE_BIGGER_THAN_MIN);
        }
        // throw exception
        throw new \Exception(ucwords($this->randomNumberReturned) . self::INTEGER_OR_FLOAT);
    }

    /**
     * heck if it's an instance of the combatants stored
     *
     * @param $combatant
     *
     * @return bool
     */
    public function checkIfInstanceOfCombatantsList(Fighters $combatant): bool
    {
        if (!empty($this->combatantsList) && is_object($combatant)) {
            foreach ($this->combatantsList as $listCombatant) {
                if ($listCombatant === $combatant->name) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param OutputInterface $output
     */
    public function showCombatantProperties(OutputInterface $output): void
    {
        $output->writeln(self::BLANKLINE . $this->name .
            self::COMBATANT_ASSIGNED_TO . ucwords($this->userName) . self::COLON);
        $output->writeln(self::HEALTH . $this->health);
        $output->writeln(self::STRENGTH . $this->strength);
        $output->writeln(self::DEFENSE . $this->defence);
        $output->writeln(self::SPEED . $this->speed);
        $output->writeln(self::LUCK . $this->luck);
    }
}
