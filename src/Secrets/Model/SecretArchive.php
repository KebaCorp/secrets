<?php

declare(strict_types=1);

namespace App\Secrets\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class SecretArchive.
 *
 * @package App\Secrets\Model
 * @ORM\Table(name="secret_archive")
 * @ORM\Entity(repositoryClass="App\Secrets\Repository\SecretRepository")
 */
class SecretArchive extends Secret
{
}
