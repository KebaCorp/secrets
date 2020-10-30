<?php

namespace App\Secrets\Service;

use App\Secrets\Model\Secret;
use App\Secrets\Model\SecretArchive;
use App\Secrets\Repository\SecretRepositoryInterface;
use Exception;

/**
 * Class SecretService.
 *
 * @package App\Secrets\Service
 */
class SecretService implements SecretServiceInterface
{
    /**
     * @var SecretRepositoryInterface
     */
    private SecretRepositoryInterface $repository;

    /**
     * SecretService constructor.
     *
     * @param SecretRepositoryInterface $repository
     */
    public function __construct(SecretRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritDoc}
     * @throws Exception
     */
    public function create(int $userId, int $secretTypeId, string $salt, int $length = 16): Secret
    {
        $oldSecrets = $this->repository->byUserIdAndSecretTypeId($userId, $secretTypeId);
        foreach ($oldSecrets as $oldSecret) {
            $secretArchive = new SecretArchive(
                $oldSecret->getUserId(),
                $oldSecret->getSecretTypeId(),
                $oldSecret->getSalt(),
                $oldSecret->getLength()
            );
            $secretArchive->setPassword($oldSecret->getPassword());
            $secretArchive->setCreatedAt($oldSecret->getCreatedAt());
            $secretArchive->setUpdatedAt($oldSecret->getUpdatedAt());

            $this->repository->save($secretArchive);
            $this->repository->remove($oldSecret);
        }

        $secret = new Secret($userId, $secretTypeId, $salt, $length);
        $secret->generatePassword();

        $time = time();
        $secret->setCreatedAt($time);
        $secret->setUpdatedAt($time);

        $this->repository->save($secret);

        return $secret;
    }
}
