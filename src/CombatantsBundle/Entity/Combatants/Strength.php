<?php

namespace CombatantsBundle\Entity\Combatants;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Strength
 *
 * @ORM\Table(name="combatants_strength")
 * @ORM\Entity(repositoryClass="CombatantsBundle\Repository\Combatants\StrengthRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Strength
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
     * @ORM\OneToMany(targetEntity="TypesOfCombatants", mappedBy="strength")
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
     * @return Strength
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
     * @return Strength
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
     * @ORM\PrePersist()
     * @return Strength
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
     * @return Strength
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
     * @return Strength
     */
    public function addCombatantType(\CombatantsBundle\Entity\TypesOfCombatants $combatantType)
    {
        $this->combatantTypes[] = $combatantType;

        return $this;
    }

    /**
     * Remove combatantTypes
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
     * Get combatantTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCombatantTypes()
    {
        return $this->combatantTypes;
    }
}
