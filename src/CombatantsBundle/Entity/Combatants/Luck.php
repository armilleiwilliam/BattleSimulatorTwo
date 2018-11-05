<?php

namespace CombatantsBundle\Entity\Combatants;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Luck
 *
 * @ORM\Table(name="combatants_luck")
 * @ORM\Entity(repositoryClass="CombatantsBundle\Repository\Combatants\LuckRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Luck
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
     * @ORM\Column(name="min", type="decimal")
     */
    private $min;

    /**
     * @var string
     *
     * @ORM\Column(name="max", type="decimal")
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
     * @ORM\OneToMany(targetEntity="TypesOfCombatants", mappedBy="luck")
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
     * @param string $min
     *
     * @return Luck
     */
    public function setMin($min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Get min
     *
     * @return string
     */
    public function min()
    {
        return $this->min;
    }

    /**
     * Set max
     *
     * @param string $max
     *
     * @return Luck
     */
    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Get max
     *
     * @return string
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
     * @return Luck
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
     * @return Luck
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
     * @return Luck
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
     * @return string
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Get max
     *
     * @return string
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
