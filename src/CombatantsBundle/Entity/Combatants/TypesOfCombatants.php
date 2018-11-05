<?php

namespace CombatantsBundle\Entity\Combatants;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Types
 *
 * @ORM\Table(name="combatants_types")
 * @ORM\Entity(repositoryClass="CombatantsBundle\Repository\Combatants\TypesOfCombatantsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class TypesOfCombatants
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Health", inversedBy="combatantTypes")
     * @ORM\JoinColumn(name="health_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $health;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Defense", inversedBy="combatantTypes")
     * @ORM\JoinColumn(name="defense_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $defense;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Luck", inversedBy="combatantTypes")
     * @ORM\JoinColumn(name="luck_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $luck;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Speed", inversedBy="combatantTypes")
     * @ORM\JoinColumn(name="speed_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $speed;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Strength", inversedBy="combatantTypes")
     * @ORM\JoinColumn(name="strength_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $strength;

    /**
     * Get id
     *
     * @return int
     */
    public function id()
    {
        return $this->id;
    }


    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity="Badges",
     * inversedBy="tyoeOfCombatants")
     * @ORM\JoinColumn(name="badge_id", referencedColumnName="id")
     */
    private $badges;


    public function __construct()
    {
        $this->createdAt= new \DateTime();
        $this->updatedAt= new \DateTime();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Types
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Set health
     *
     * @param \CombatantsBundle\Entity\Combatants\Health $health
     *
     * @return TypesOfCombatants
     */
    public function setHealth(\CombatantsBundle\Entity\Combatants\Health $health = null)
    {
        $this->health = $health;

        return $this;
    }

    /**
     * Get health
     *
     * @return \CombatantsBundle\Entity\Combatants\Health
     */
    public function health()
    {
        return $this->health;
    }

    /**
     * Set defense
     *
     * @param \CombatantsBundle\Entity\Combatants\Defense $defense
     *
     * @return TypesOfCombatants
     */
    public function setDefense(\CombatantsBundle\Entity\Combatants\Defense $defense = null)
    {
        $this->defense = $defense;

        return $this;
    }

    /**
     * Get defense
     *
     * @return \CombatantsBundle\Entity\Combatants\Defense
     */
    public function defense()
    {
        return $this->defense;
    }

    /**
     * Set luck
     *
     * @param \CombatantsBundle\Entity\Luck $luck
     *
     * @return TypesOfCombatants
     */
    public function setLuck(\CombatantsBundle\Entity\Luck $luck = null)
    {
        $this->luck = $luck;

        return $this;
    }

    /**
     * Get luck
     *
     * @return \CombatantsBundle\Entity\Luck
     */
    public function luck()
    {
        return $this->luck;
    }

    /**
     * Set speed
     *
     * @param \CombatantsBundle\Entity\Speed $speed
     *
     * @return TypesOfCombatants
     */
    public function setSpeed(\CombatantsBundle\Entity\Speed $speed = null)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return \CombatantsBundle\Entity\Speed
     */
    public function speed()
    {
        return $this->speed;
    }

    /**
     * Set strength
     *
     * @param \CombatantsBundle\Entity\Strength $strength
     *
     * @return TypesOfCombatants
     */
    public function setStrength(\CombatantsBundle\Entity\Strength $strength = null)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get strength
     *
     * @return \CombatantsBundle\Entity\Strength
     */
    public function strength()
    {
        return $this->strength;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return TypesOfCombatants
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return TypesOfCombatants
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Get health
     *
     * @return \CombatantsBundle\Entity\Combatants\Health
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Get defense
     *
     * @return \CombatantsBundle\Entity\Combatants\Defense
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * Get luck
     *
     * @return \CombatantsBundle\Entity\Combatants\Luck
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * Get speed
     *
     * @return \CombatantsBundle\Entity\Combatants\Speed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Get strength
     *
     * @return \CombatantsBundle\Entity\Combatants\Strength
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @return str
     */
    public function __toString() {
        return 'TypeOfCombatants';
    }

    /**
     * Set badges
     *
     * @param \CombatantsBundle\Entity\Combatants\Badges $badges
     *
     * @return TypesOfCombatants
     */
    public function setBadges(\CombatantsBundle\Entity\Combatants\Badges $badges = null)
    {
        $this->badges = $badges;

        return $this;
    }

    /**
     * Get badges
     *
     * @return \CombatantsBundle\Entity\Combatants\Badges
     */
    public function getBadges()
    {
        return $this->badges;
    }
}
