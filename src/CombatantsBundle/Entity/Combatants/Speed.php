<?php

namespace CombatantsBundle\Entity\Combatants;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Speed
 *
 * @ORM\Table(name="combatants_speed")
 * @ORM\Entity(repositoryClass="CombatantsBundle\Repository\Combatants\SpeedRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Speed
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
     * @var int
     *
     * @ORM\Column(name="min", type="integer")
     */
    private $min;

    /**
     * @var int
     *
     * @ORM\Column(name="max", type="integer")
     */
    private $max;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToOne(targetEntity="TypesOfCombatants", mappedBy="speed")
     */
    private $combatantTypes;

    public function __construct()
    {
        $this->createdAt= new \DateTime();
        $this->updatedAt= new \DateTime();
        $this->combatantTypes = new ArrayCollection();
    }

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
     * Set min
     *
     * @param integer $min
     *
     * @return Speed
     */
    public function setMin($min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Get min
     *
     * @return int
     */
    public function min()
    {
        return $this->min;
    }

    /**
     * Set max
     *
     * @param integer $max
     *
     * @return Speed
     */
    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Get max
     *
     * @return int
     */
    public function max()
    {
        return $this->max;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updatedAt= new \DateTime();
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Speed
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
    public function createdAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Speed
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
    public function updatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add combatantType
     *
     * @param \CombatantsBundle\Entity\TypesOfCombatants $combatantType
     *
     * @return Speed
     */
    public function addCombatantType(\CombatantsBundle\Entity\TypesOfCombatants $combatantType)
    {
        $this->combatantTypes[] = $combatantType;

        return $this;
    }

    /**
     * Remove combatantType
     *
     * @param \CombatantsBundle\Entity\TypesOfCombatants $combatantType
     */
    public function removeCombatantType(\CombatantsBundle\Entity\TypesOfCombatants $combatantType)
    {
        $this->combatantTypes->removeElement($combatantType);
    }

    /**
     * Get combatantTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function combatantTypes()
    {
        return $this->combatantTypes;
    }

    /**
     * @return string
     */
    public function __toString() {
        return 'Min: ' . $this->min . ' Max: ' . $this->max;
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
     * Get min
     *
     * @return integer
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Get max
     *
     * @return integer
     */
    public function getMax()
    {
        return $this->max;
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
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set combatantTypes
     *
     * @param \CombatantsBundle\Entity\Combatants\TypesOfCombatants $combatantTypes
     *
     * @return Speed
     */
    public function setCombatantTypes(\CombatantsBundle\Entity\Combatants\TypesOfCombatants $combatantTypes = null)
    {
        $this->combatantTypes = $combatantTypes;

        return $this;
    }

    /**
     * Get combatantTypes
     *
     * @return \CombatantsBundle\Entity\Combatants\TypesOfCombatants
     */
    public function getCombatantTypes()
    {
        return $this->combatantTypes;
    }
}
