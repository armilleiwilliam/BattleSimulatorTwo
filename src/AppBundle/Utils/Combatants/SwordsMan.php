<?php

namespace AppBundle\Utils\Combatants;

/**
 * Battle Simulator - Combatant Swordsman
 * $name, text - name of the combatant
 * $health, int - randomly assigned health value
 * $strength, int - randomly assigned strength value
 * $defence, int - randomly assigned defence value
 * $speed, int - randomly assigned speed value
 * $luck, float - randomly assigned luck value
 *
 * @author William Armillei
 */

use AppBundle\Utils\FightersActions;
use AppBundle\Model\FighterInterface;

/**
 * Class SwordsMan
 * @package AppBundle\Utils\Combatants
 */
class SwordsMan extends FightersActions implements FighterInterface
{

    /**
     * @var int
     */
    public $activeDoublePower = 0;

    /**
     * SwordsMan constructor.
     *
     * @param String $name
     * @param String $userName
     */
    public function __construct(String $name, String $userName)
    {
        $this->name     = $name;
        $this->userName = $userName;
        $this->health   = $this->getRandomPropertyValue(40, 60);
        $this->strength = $this->getRandomPropertyValue(60, 70);
        $this->defence  = $this->getRandomPropertyValue(20, 30);
        $this->speed    = $this->getRandomPropertyValue(90, 100);
        $this->luck     = $this->getRandomPropertyValue(0.3, 0.5);
    }

    /**
     * SpecialSkill - stunning the opponent, no permission to attack next round
     *
     * @param int    $combatantPersonalSkillValue
     * @param string $type
     */
    public function specialSkill($combatantPersonalSkillValue = 0, string $type = ''): void
    {
        $randOne = random_int(1, 20);
        $randTwo = random_int(1, 20);

        if ($type === '') {
            // check matching
            if ($randOne === $randTwo) {
                // double the strength if it's not already doubled
                if ($this->activeDoublePower !== 1) {
                    $this->strength          *= 2;
                    $this->activeDoublePower = 1;
                }
            }

            // back to original strength
            if ($this->activeDoublePower === 1) {
                $this->strength          /= 2;
                $this->activeDoublePower = 0;
            }
        }
    }
}
