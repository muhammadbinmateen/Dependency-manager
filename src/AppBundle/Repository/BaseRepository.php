<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class BaseRepository
 * @package AppBundle\Repository
 */
class BaseRepository extends EntityRepository
{
    /**
     * @param object $object
     * @param bool $isFlush
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function persist($object, $isFlush = false)
    {
        $this->getEntityManager()->persist($object);

        if ($isFlush) {
            $this->flush();
        }
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @param mixed $object
     * @param bool $isFlush
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove($object, $isFlush = false)
    {
        $this->getEntityManager()->remove($object);

        if ($isFlush) {
            $this->flush();
        }
    }
}
