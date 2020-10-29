<?php

namespace App\Secrets\Service;

use App\Secrets\Model\Secret;
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
    public function create(int $secretType, string $salt, int $length = 16): Secret
    {
        $secret = new Secret($secretType, $salt, $length);
        $secret->generatePassword();

        $time = time();
        $secret->setCreatedAt($time);
        $secret->setUpdatedAt($time);

        $this->repository->save($secret);

        return $secret;
    }
}
