<?php

namespace App\Secrets\Repository;

use App\Secrets\Model\Secret;

/**
 * Interface SecretRepositoryInterface.
 *
 * @package App\Secrets\Repository
 */
interface SecretRepositoryInterface
{
    /**
     * Get all secrets.
     *
     * @return Secret[]
     */
    public function all(): array;

    /**
     * Get one secret.
     *
     * @param int $id
     *
     * @return Secret
     */
    public function one(int $id): Secret;

    /**
     * Get by user id and secret type id.
     *
     * @param int $userId
     * @param int $secretTypeId
     *
     * @return Secret[]
     */
    public function byUserIdAndSecretTypeId(int $userId, int $secretTypeId): array;

    /**
     * Save secret.
     *
     * @param Secret $secret
     *
     * @return Secret
     */
    public function save(Secret $secret): Secret;

    /**
     * Update secret.
     *
     * @param Secret $secret
     *
     * @return Secret
     */
    public function update(Secret $secret): Secret;

    /**
     * Remove secret.
     *
     * @param Secret $secret
     *
     * @return bool
     */
    public function remove(Secret $secret): bool;
}
