<?php

namespace App\Secrets\Repository;

use App\Secrets\Model\Secret;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use RuntimeException;

/**
 * Class SecretRepository.
 *
 * @package App\Secrets\Repository
 */
class SecretRepository extends ServiceEntityRepository implements SecretRepositoryInterface
{
    /**
     * Entity manager.
     *
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;

    /**
     * {@inheritDoc}
     */
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        parent::__construct($registry, Secret::class);
    }

    /**
     * {@inheritDoc}
     */
    public function all(): array
    {
        return parent::findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function one(int $id): Secret
    {
        /** @var Secret $secret */
        $secret = parent::findOneBy(['id' => $id]);

        if ($secret == null) {
            throw new RuntimeException("Secret {$id} not found");
        }

        return $secret;
    }

    /**
     * {@inheritDoc}
     */
    public function save(Secret $secret): Secret
    {
        $this->manager->persist($secret);
        $this->manager->flush();

        return $secret;
    }

    /**
     * {@inheritDoc}
     */
    public function update(Secret $secret): Secret
    {
        $this->manager->flush();

        return $secret;
    }
}
