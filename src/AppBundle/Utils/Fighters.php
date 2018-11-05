<?php

namespace AppBundle\Utils;

/**
 * Battle Simulator - CombatantMethods, class
 * $name, text - name of the combatant
 * $health,
 * $strength, int - randomly assigned strength value
 * $defence, int - randomly assigned defence value
 * $speed, int - randomly assigned speed value
 * $luck, float - randomly assigned luck value
 *
 * @author William Armillei
 */
use AppBundle\Model\FighterInterface;
use AppBundle\Utils\Combatants\Brute;
use AppBundle\Utils\Combatants\Grappler;
use AppBundle\Utils\Combatants\SwordsMan;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Fighters
 * @package AppBundle\Utils
 */
class Fighters
{
    const SWORDSMAN = 'swordsman';
    const GRAPPLER = 'grappler';
    const DOT = '.';
    const WRONG_FOLDER = 'Wrong combatant folder. Please, provide a valid directory!';
    const THE_COMBATANT_GIVEN_DOESN_T_EXIST = 'The combatant given doesn\'t exist';
    const MAX_BE_BIGGER_THAN_MIN = ' max value must be bigger than min!';
    const INTEGER_OR_FLOAT = ' value must be an integer or float!';

    /**
     * @var string
     */
    public $name = '';

    /**
     * @var string
     */
    public $userName = '';

    /**
     * @var integer
     */
    public $health;

    /**
     * @var integer
     */
    public $strength;

    /**
     * @var integer
     */
    public $defence;

    /**
     * @var integer
     */
    public $speed;

    /**
     * @var decimal
     */
    public $luck;

    /**
     * @var bool
     */
    public $attackAvoided;

    /**
     * @var array
     */
    public $combatantsList = [];

    /**
     * @var
     */
    public $exceptionHandler;

    /**
     * @var
     */
    public $container;

    /**
     * @var
     */
    public $minHealth;

    /**
     * @var
     */
    public $maxHealth;

    /**
     * @var
     */
    public $minStrength;

    /**
     * @var
     */
    public $maxStrength;

    /**
     * @var
     */
    public $minDefence;

    /**
     * @var
     */
    public $maxDefence;

    /**
     * @var
     */
    public $minSpeed;

    /**
     * @var
     */
    public $maxSpeed;

    /**
     * @var
     */
    public $minLuck;

    /**
     * @var
     */
    public $maxLuck;

    /**
     * CombatantMethods constructor.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->exceptionHandler = $this->container->get('app.classes.exception_handler');
        /*
        die($this->minHealth . " sss " . $this->maxHealth);
        $this->health   = $this->getRandomPropertyValue($this->minHealth, $this->maxHealth);
        $this->strength = $this->getRandomPropertyValue($this->minStrength, $this->maxStrength);
        $this->defence  = $this->getRandomPropertyValue($this->minDefence, $this->maxDefence);
        $this->speed    = $this->getRandomPropertyValue($this->minSpeed, $this->maxSpeed);
        $this->luck     = $this->getRandomPropertyValue($this->minLuck, $this->maxLuck);
        */
    }

    /**
     *  randomly assign a type of combatant (Brute, Grappler or SwordsMan)
     *  $combatant - folder where the combatants classes are contained
     * @return mixed
     * @throws \Exception
     */

    public function getCombatantTypeName(): string
    {
        // where storing list of combatants
        $this->combatantsList = [];

        $combatant = __DIR__ . '/Combatants';

        if (is_dir($combatant)) {
            $dir = scandir($combatant);

            foreach ($dir as $d) {
                // check if the item name doesn't start with '.'
                if (strpos($d, self::DOT) !== 0) {
                    $comb = explode(self::DOT, $d);

                    //  include the new combatant in the array
                    $this->combatantsList[] = $comb[0];
                }
            }

            // if array is not empty
            if (count($this->combatantsList) > 0 && !empty($this->combatantsList)) {
                // New combatant list
                shuffle($this->combatantsList);
                return $this->combatantsList[0];
            }
        }
        // throw exception
        $this->exceptionHandler->exceptionHandler(self::WRONG_FOLDER . $combatant);
    }

    /**
     * @param string $combatantName
     * @param string $combatantUserName
     *
     * @return FighterInterface
     */
    public function getCombatantTypeObject(string $combatantName, string $combatantUserName): FighterInterface
    {
        $combatantName = ucwords($combatantName);
        $combatantUserName = ucwords($combatantUserName);
        if (strtolower($combatantName) === self::SWORDSMAN) {
            return new SwordsMan(
                $combatantName,
                $combatantUserName
            );
        }

        if (strtolower($combatantName) === self::GRAPPLER) {
            return new Grappler(
                $combatantName,
                $combatantUserName
            );
        }

        return new Brute(
            $combatantName,
            $combatantUserName
        );
    }
}
