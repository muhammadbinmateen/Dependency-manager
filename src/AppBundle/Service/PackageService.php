<?php

namespace AppBundle\Service;

use AppBundle\Entity\Package;
use AppBundle\Repository\PackageRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class PackageService
 * @package AppBundle\Service
 */
class PackageService
{
    /**
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * PackageService constructor.
     * @param RegistryInterface $doctrine
     */
    public function __construct(
        RegistryInterface $doctrine
    ) {
        $this->doctrine = $doctrine;
    }

    public function getPackage($id)
    {
        return $this->doctrine->getRepository('Package')->find($id);
    }

}
