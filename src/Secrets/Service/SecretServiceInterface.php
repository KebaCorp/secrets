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
     * @param int    $secretType
     * @param string $salt
     *
     * @return Secret
     */
    public function create(int $secretType, string $salt): Secret;
}
