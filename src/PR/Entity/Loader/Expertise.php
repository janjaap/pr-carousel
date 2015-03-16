<?php
namespace PR\Entity\Loader;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\ChoiceList\EntityLoaderInterface;

class Expertise implements EntityLoaderInterface
{
    protected $repository;

    public function __construct()
    {
        return $this;
    }

    /**
     * @param EntityRepository $repository
     *
     * @return $this
     */
    public function setRepository(EntityRepository $repository)
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * Returns an array of entities that are valid choices in the corresponding choice list.
     *
     * @return array The entities.
     */
    public function getEntities()
    {
        return $this->getRepository()->findBy([], ['discipline' => 'ASC']);
    }

    /**
     * Returns an array of entities matching the given identifiers.
     *
     * @param string $identifier The identifier field of the object. This method
     *                           is not applicable for fields with multiple
     *                           identifiers.
     * @param array  $values The values of the identifiers.
     *
     * @return array The entities.
     */
    public function getEntitiesByIds($identifier, array $values)
    {
        return $this->getRepository()->findBy(['id' => $identifier], ['discipline' => 'ASC']);
    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }
}
