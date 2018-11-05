<?php
// src/AppBundle/Command/GreetCommand.php
namespace AppBundle\Command;

use AppBundle\Model\FighterInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use AppBundle\Utils\Fighters;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

/**
 * Class BattleCommand
 * @package AppBundle\Command
 */
class BattleCommand extends ContainerAwareCommand
{
    const REQUIRE_USER_ONE = 'You need to enter the first user in order to start the fight. 
    Run the application again please.';
    const REQUIRE_BOTH_USER = 'You need to enter both users in order to start the fight. 
    Run the application again please.';
    const VARIABLE_PASSED_IS_NOT_AN_OBJECT_OF_COMBATANT_METHODS = 'Variable passed is not 
    an Object of CombatantMethods';
    const VARIABLE_PASSED_IS_NOT_AN_OBJECT_OF_BATTLE_METHODS = 'Variable passed is not an 
    Object of Battle';
    const REQUIRE_SECOND_COMBATANT = 'Please, enter the name of the second combatant, 
    and push enter to start the battle: ';
    const ARE_YOU_READY_TO_PLAY = 'Are you ready to play?';
    const ENTER_NAME_FIRST_COMBATANT = 'Please, enter the name of the first combatant:';
    const MISSED_THE_ATTACK = ' missed the attack.';
    const GRAPPLER = 'Grappler';
    const HEALTH_POINTS_DAMAGE = ' health points damage. ';
    const HEALTH_POINTS_DAMAGE1 = ' health points damage.';

    // Messages to be returned
    const COMBATANTS_NAME_ARE_EMPTY = 'Combatants name are empty.';
    const DRAW_MESSAGE = 'DRAW! It seems that none of the valiant combatants prevailed after 
                30 rounds.';
    const CONTACT_ADMIN_ERROR = "The system can't determine which combatant has to start. 
        Please contact the administrator. (Wrong object entered)";

    /**
     * @var
     */
    private $exceptionHandler;

    protected function configure(): void
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:sim-battle')
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates users for starting a battle simulation.')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a user...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // set style for titles
        $style = new OutputFormatterStyle(
            'red',
            'yellow',
            ['bold', 'blink']
        );

        $this->exceptionHandler = $this->getContainer()->get('app.classes.exception_handler');

        $output->getFormatter()->setStyle('fireTwo', $style);

        // welcome message
        $output->writeln([
            '<fireTwo>',
            ' ____   ____   _____ _____         _____          ____     _ _    _     _ ',
            '|    \ |    |    |     |    |      |             /    \\     |    |  \  / |',
            '|    / |    |    |     |    |      |             \\          |    |   \/  |',
            '|====  |====|    |     |    |      |==             ==       |    |       |',
            '|    \ |    |    |     |    |      |                  \\     |    |       |',
            '|____/ |    |    |     |    |____  |____         \____/    _|_   |       |',
            '                                                                          ',
            '',
            '</fireTwo>',
            'WELCOME TO \'ULTIMATE BATTLE SIMULATOR\', HERE YOU WILL PROVE YOUR BRAVERY.',
            '============================================================',
            '',
        ]);

        $helper = $this->getHelper('question');

        // ask first combatant username
        $question = new Question("<question>" . self::ARE_YOU_READY_TO_PLAY . "</question>\n" .
            self::ENTER_NAME_FIRST_COMBATANT);

        // set the first combatant username
        $firstUserName = $helper->ask($input, $output, $question);

        if ($firstUserName !== "") {
            // ask second combatant username
            $questionTwo = new Question(self::REQUIRE_SECOND_COMBATANT);

            // set the second combatant username
            $secondUserName = $helper->ask($input, $output, $questionTwo);

            // if both usernames have been inserted show the battle's results
            if (trim($firstUserName) !== "" && trim($secondUserName) !== "") {
                // init obj
                $combat = new Fighters($this->getContainer());

                if ($combat instanceof Fighters) {
                    // assign a combatant type to each user
                    $combatantOneName = $combat->getCombatantTypeName();
                    $combatantTwoName = $combat->getCombatantTypeName();

                    // instantiate an object for each combatant
                    $combatantOne = $combat->getCombatantTypeObject(
                        $combatantOneName,
                        $firstUserName
                    );
                    $combatantTwo = $combat->getCombatantTypeObject(
                        $combatantTwoName,
                        $secondUserName
                    );

                    $output->writeln("\nCheck the combatants properties!");
                    // show first combatant properties
                    $combatantOne->showCombatantProperties($output);

                    // show second combatant properties
                    $combatantTwo->showCombatantProperties($output);
                    $output->writeln("\n\nLet's start the ferocious battle!!");

                    // start fighting
                    $this->startBattle(
                        $output,
                        [$combatantOne,$combatantTwo]
                    );
                } else {
                    $this->exceptionHandler->exceptionHandler(
                        self::VARIABLE_PASSED_IS_NOT_AN_OBJECT_OF_COMBATANT_METHODS
                    );
                }
            } else {
                $output->writeln(self::REQUIRE_BOTH_USER);
            }
        } else {
            $output->writeln(self::REQUIRE_USER_ONE);
        }
    }

    /**
     * @return array
     */
    public function whoStarts(FighterInterface $combatantOne, FighterInterface $combatantTwo): array
    {
        if ($combatantOne->speed > $combatantTwo->speed) {
            return [$combatantOne, $combatantTwo];
        }
        if ($combatantOne->speed < $combatantTwo->speed) {
            return [$combatantTwo, $combatantOne];
        }
        // if the speeds are the same compare the defence values to determine which one starts first
        if ($combatantTwo->defence < $combatantOne->defence) {
            return [$combatantOne, $combatantTwo];
        }

        return [$combatantTwo, $combatantOne];
    }

    /**
     * @param       $output
     * @param array $combatants
     *
     * @throws \Exception
     */
    public function startBattle(
        OutputInterface $output,
        array $combatants = []
    ): void {
        $draw = true;
        $combatants = $this->whoStarts($combatants[0], $combatants[1]);

        $firstCombatantName = ucwords($combatants[0]->name);
        $secondCombatantName= ucwords($combatants[1]->name);

        // style format
        $style = new OutputFormatterStyle('red', 'yellow', ['bold', 'blink']);
        $output->getFormatter()->setStyle('fire', $style);

        // loop rounds
        for ($a = 1; $a < 31; $a++) {
            if ($combatants[0]->health > 0 && $combatants[1]->health > 0) {
                $output->writeln("\n\n<fire>Round " . $a . ")</fire>");
                $output->writeln("<options=bold,underscore>Attacks:</>");

                // combatant 1 attack
                // check first if the attack has been avoided
                if (!$this->avoidAttack($combatants[1]->luck)) {
                    // active special skill for first combatant
                    $combatants[0]->specialSkill(2);

                    if ($combatants[0]->attackPermissionFirst) {
                        $output->writeln($firstCombatantName . ' (' . $combatants[0]->userName . ') '
                            . $this->randomAttackMessage() . ' ' . $secondCombatantName . ' causing '
                            . ($combatants[0]->strength - $combatants[1]->defence) . self::HEALTH_POINTS_DAMAGE);
                        $combatants[1]->health -=
                            ($combatants[0]->strength - $combatants[1]->defence);
                    } else {
                        $combatants[0]->attackPermissionFirst = true;
                        $output->writeln($firstCombatantName . ' (' . $combatants[0]->userName . ")"
                            . self::MISSED_THE_ATTACK);
                    }
                } else {
                    // active special skill and in case it's Grappler
                    // subtract health points to the one who missed the attack
                    $combatants[0]->specialSkill($combatants[1], self::GRAPPLER);
                    $output->writeln($firstCombatantName . "'s attack has been avoided.");
                }

                // if the first combatant is still alive proceed with the next combatant attack
                if ($combatants[1]->health > 0) {
                    // combatant 2 attack
                    // check first if the attack has been avoided
                    if (!$this->avoidAttack($combatants[0]->luck)) {
                        // Active special skill for the second combatant
                        $combatants[1]->specialSkill(1);

                        if ($combatants[1]->attackPermissionSecond) {
                            $output->writeln($secondCombatantName . ' (' . $combatants[1]->userName . ') '
                                . $this->randomAttackMessage() . ' ' . $firstCombatantName . ' causing '
                                . ($combatants[1]->strength - $combatants[0]->defence)
                                . self::HEALTH_POINTS_DAMAGE1);
                            $combatants[0]->health -=
                                ($combatants[1]->strength - $combatants[0]->defence);
                        } else {
                            $combatants[0]->attackPermissionSecond = true;
                            $output->writeln($secondCombatantName . ' (' . $combatants[1]->userName . ')'
                                . self::MISSED_THE_ATTACK);
                        }
                    } else {
                        // active special  skill in case it's Grappler
                        // to subtract health points to the opponent
                        $combatants[1]->specialSkill($combatants[0], self::GRAPPLER);
                        $output->write($secondCombatantName . ' (' . $combatants[1]->userName . ')'
                            . '\'s attack has been avoided.\n');
                    }
                    $output->writeln("\n<options=bold,underscore>Remaining health points.</>");
                    $output->writeln($firstCombatantName . ' (' . $combatants[0]->userName . ')' . '
                        : ' . ($combatants[0]->health > 0 ? $combatants[0]->health : 0));
                    $output->writeln($secondCombatantName . ' (' . $combatants[1]->userName . ')' . '
                        : ' . ($combatants[1]->health > 0 ? $combatants[1]->health : 0));
                } else {
                    // combatant 2 wins, final score and message
                    $output->writeln("\n<options=bold,underscore>Remaining health points. </>");
                    $output->writeln($firstCombatantName . ' (' . $combatants[0]->userName . ')' . ':'
                        . ($combatants[0]->health > 0 ? $combatants[0]->health : 0));
                    $output->writeln($secondCombatantName . ' (' . $combatants[1]->userName . ')'
                        . ': ' . ($combatants[1]->health > 0 ? $combatants[1]->health : 0));
                    $output->writeln("\n\n<comment>The winner is " .
                        ($combatants[0]->health > $combatants[1]->health ?
                            $firstCombatantName . ' (' . $combatants[0]->userName . ')'
                            : $secondCombatantName . ' (' . $combatants[1]->userName . ')') . "</comment>\n\n");
                    $draw = false;
                    break;
                }
            } else {
                // one of the two opponents wins, final message
                $output->writeln("\n\n<comment>The winner is " . ($combatants[0]->health > $combatants[1]->health ?
                        $firstCombatantName . ' (' . $combatants[0]->userName . ')'
                        : $secondCombatantName) . ' (' . $combatants[1]->userName . ')'
                    . "</comment>\n\n");
                $draw = false;

                // stop loop
                break;
            }
        }
        // show draw message
        if ($draw) {
            $output->writeln("\n\n<comment>" . self::DRAW_MESSAGE . "</comment>\n\n");
        }
    }

    /**
     * @return string
     */
    public function randomAttackMessage(): string
    {
        // array
        $randomMessage = ['punches', 'kicks', 'stabs', 'wounds with the sword', 'wounds with the spear'];
        // array random
        $arrayIndex = array_rand($randomMessage);
        return $randomMessage[$arrayIndex];
    }

    /**
     * @param int $attackLuck
     *
     * @return bool]
     */
    public function avoidAttack(
        $attackLuck = 0
    ): bool {
        $percent     = random_int(1, 100);
        $percentLuck = $attackLuck * 100;
        return $percent <= $percentLuck;
    }
}
