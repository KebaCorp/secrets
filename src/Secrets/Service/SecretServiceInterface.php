<?php

namespace App\Secrets\Service;

use App\Secrets\Model\Secret;

/**
 * Interface SecretServiceInterface.
 *
 * @package App\Secrets\Service
 */
interface SecretServiceInterface
{
    /**
     * Create secret.
     *
     * @param int    $userId
     * @param int    $secretTypeId
     * @param string $salt
     * @param int    $length
     *
     * @return Secret
     */
    public function create(int $userId, int $secretTypeId, string $salt, int $length = 16): Secret;
}
