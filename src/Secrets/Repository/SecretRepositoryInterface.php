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
     * @return array
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
}
