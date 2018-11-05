<?php

namespace AppBundle\Utils\Combatants;

/**
 * Battle Simulator - Combatants Grappler
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
 * Class Grappler
 * @package AppBundle\Utils\Combatants
 */
class Grappler extends FightersActions implements FighterInterface
{
    const GRAPPLER = "Grappler";

    /**
     * @var int
     */
    public $activeDoublePower = 0;

    /**
     * Grappler constructor.
     *
     * @param string $name
     * @param string $userName
     */
    public function __construct(string $name, string $userName)
    {
        $this->userName = $userName;
        $this->name     = $name;
        $this->health   = $this->getRandomPropertyValue(60, 100);
        $this->strength = $this->getRandomPropertyValue(75, 80);
        $this->defence  = $this->getRandomPropertyValue(35, 40);
        $this->speed    = $this->getRandomPropertyValue(60, 80);
        $this->luck     = $this->getRandomPropertyValue(0.3, 0.4);
        /**
         *
        $this->minHealth = 60;
        $this->maxHealth = 100;
        $this->minStrength = 75;
        $this->maxStrength = 80;
        $this->minDefence  = 35;
        $this->maxDefence  = 40;
        $this->minSpeed    = 60;
        $this->maxSpeed = 80;
        $this->minLuck    = 0.3;
        $this->maxLuck = 0.4;
         */
    }

    /**
     * @param        $combatantPersonalSkillValue
     * @param string $type
     */
    public function specialSkill($combatantPersonalSkillValue, string $type = ''): void
    {
        // check matchin
        if ($type === self::GRAPPLER) {
            $combatantPersonalSkillValue->health -= 10;
        }
    }
}
