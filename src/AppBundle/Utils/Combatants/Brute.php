<?php

namespace AppBundle\Utils\Combatants;

/**
 * Battle Simulator - Combatant Brute
 *
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
 * Class Brute
 * @package AppBundle\Utils\Combatants
 */
class Brute extends FightersActions implements FighterInterface
{

    /**
     * Brute constructor.
     *
     * @param String $name
     * @param String $userName
     */
    public function __construct(String $name, String $userName)
    {
        $this->userName = $userName;
        $this->name     = $name;
        $this->health   = $this->getRandomPropertyValue(90, 100);
        $this->strength = $this->getRandomPropertyValue(65, 75);
        $this->defence  = $this->getRandomPropertyValue(40, 50);
        $this->speed    = $this->getRandomPropertyValue(40, 65);
        $this->luck     = $this->getRandomPropertyValue(0.3, 0.35);
        /**
         * $this->minHealth = 90;
        $this->maxHealth = 100;
        $this->minStrength = 65;
        $this->maxStrength = 75;
        $this->minDefence  = 40;
        $this->maxDefence  = 50;
        $this->minSpeed    = 40;
        $this->maxSpeed = 65;
        $this->minLuck    = 0.3;
        $this->maxLuck = 0.35;
         */
    }

    /**
     * SpecialSkill - stunning the opponent, no permission to attack next round
     *
     * @param int    $combatantPersonalSkillValue
     * @param string $type
     *
     * @return bool
     */
    public function specialSkill($combatantPersonalSkillValue = 0, string $type = ''): bool
    {
        $randOne = random_int(1, 50);
        $randTwo = random_int(1, 50);
        if ($type === '') {
            // 2% probability ok
            if ($randOne === $randTwo) {
                // return non permission to attack
                return ($combatantPersonalSkillValue === 1 && $combatantPersonalSkillValue !== 0) ?
                    ($this->attackPermissionSecond = false) :
                    ($this->attackPermissionFirst = false);
            }
            // restore permission to attack
            return ($combatantPersonalSkillValue === 1 && $combatantPersonalSkillValue !== 0) ?
                ($this->attackPermissionSecond = true) :
                ($this->attackPermissionFirst = true);
        }
        return false;
    }
}
