<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PackageRepository")
 * @ORM\Table()
 */
class Package extends AbstractEntity
{

    /**
     * Just to check enteries in DB
     *@ORM\Column(type="string", options={"default":0})
     */
    private $text;

    /**
     * @var Package[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Package", inversedBy="$dependencies")
     * @ORM\JoinTable(name="package_packages",
     * joinColumns={ @ORM\JoinColumn(name="user_source", referencedColumnName="id")},
     * inverseJoinColumns={ @ORM\JoinColumn(name="user_target", referencedColumnName="id")})
     */
    private $dependencies;


    /**
     * Package constructor.
     */
    public function __construct()
    {
        $this->dependencies = new ArrayCollection();
    }


    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param Package $dependency
     */
    public function addDependency(Package $dependency)
    {
        $checkDependency = $this->findCircularDependency($this, $dependency);

        if ($this->dependencies->contains($dependency) == false)
        {
            if ($checkDependency == false)
            {
              $this->dependencies[] = $dependency;
            }
        }
    }

    /**
     * @return Package[]
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

    /**
     * @param Package[] $dependencies
     */
    public function setDependencies($dependencies)
    {
        $dependency = new Package();
        $checkDependency = $this->findCircularDependency($this, $dependency);

        if ($this->dependencies->contains($dependencies) == false)
        {
            if ($checkDependency == false)
            {
                $this->dependencies[] = $dependencies;
            }
        }
    }

    /**
     * Checking dependencies TOP to BOTTOM
     * @param Package $dependencyTop
     * @param Package $dependencyBottom
     * @return bool
     */
    public function findCircularDependency(Package $dependencyTop , Package $dependencyBottom)
    {
        $check = false;
        if ($dependencyTop === $dependencyBottom ) {
            $check = true;
        }
        foreach ( $dependencyTop->getDependencies() as $top) {
            foreach ($top->getDependencies() as $bottom)
            {
                $check = false;
            }

        }
        return $check;
    }
}
