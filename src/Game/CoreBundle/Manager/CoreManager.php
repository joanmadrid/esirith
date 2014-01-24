<?php

namespace Game\CoreBundle\Manager;

use Doctrine\ORM\EntityManager;

/**
 * Clase de soporte para la implementación de los manager
 */
abstract class CoreManager
{
    /** @var \Doctrine\ORM\EntityManager $em */
    protected $em;

    /** @var $class Clase a la que da soporte el manager */
    protected $class;

    /** @var \Doctrine\Common\Persistence\ObjectRepository $repository */
    protected $repository;

    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * Realiza la persistencia de los cambios realizados sobre las entidades
     */
    public function flush()
    {
        $this->em->flush();
    }
    /**
     * Persiste un objeto
     *
     * @param $object
     * @param bool $flush
     * @return void
     */
    public function persist($object, $flush = false)
    {
        $this->em->persist($object);

        if ($flush) {
            $this->flush();
        }
    }

    /**
     * Elimina un objeto
     *
     * @param $object
     * @param bool $flush
     * @return void
     */
    public function remove($object, $flush = false)
    {
        $this->em->remove($object);

        if ($flush) {
            $this->flush();
        }
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getRepository()
    {
        return $this->repository;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getManager()
    {
        return $this->em;
    }

    /**
     * @param EntityManager $em
     */
    public function setEntityProperties(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository($this->class);
    }
}