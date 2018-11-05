<?php

namespace CombatantsBundle\Entity\Combatants;

use Doctrine\ORM\Mapping as ORM;

/**
 * Badges
 *
 * @ORM\Table(name="badges")
 * @ORM\Entity(repositoryClass="CombatantsBundle\Repository\BadgesRepository")
 */
class Badges
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Color", type="string", length=255)
     */
    private $color;

    /**
     * @ORM\OneToOne(targetEntity="TypesOfCombatants",
     * inversedBy="badges")
     */
    private $typeOfCombatant;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Badges
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Badges
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set typeOfCombatant
     *
     * @param \CombatantsBundle\Entity\Combatants\TypesOfCombatants $typeOfCombatant
     *
     * @return Badges
     */
    public function setTypeOfCombatant(\CombatantsBundle\Entity\Combatants\TypesOfCombatants $typeOfCombatant = null)
    {
        $this->typeOfCombatant = $typeOfCombatant;

        return $this;
    }

    /**
     * Get typeOfCombatant
     *
     * @return \CombatantsBundle\Entity\Combatants\TypesOfCombatants
     */
    public function getTypeOfCombatant()
    {
        return $this->typeOfCombatant;
    }
}
