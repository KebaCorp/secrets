<?php

declare(strict_types=1);

namespace App\Secrets\Model;

use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * Class Secret.
 *
 * @package App\Secrets\Model
 * @ORM\Table(name="secret")
 * @ORM\Entity(repositoryClass="App\Secrets\Repository\SecretRepository")
 */
class Secret
{
    /**
     * Primary key.
     *
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $secretType;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $salt;

    /**
     * Generated password.
     *
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $password;

    /**
     * Password length.
     *
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $length;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $createdAt;

    /**
     * @var int|null
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $updatedAt = null;

    /**
     * Secret constructor.
     *
     * @param int    $secretType
     * @param string $salt
     * @param int    $length
     */
    public function __construct(int $secretType, string $salt, int $length = 16)
    {
        $this->secretType = $secretType;
        $this->salt = $salt;
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getSecretType(): int
    {
        return $this->secretType;
    }

    /**
     * @param int $secretType
     */
    public function setSecretType(int $secretType): void
    {
        $this->secretType = $secretType;
    }

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt(string $salt): void
    {
        $this->salt = $salt;
    }

    /**
     * Generate password.
     *
     * @throws Exception
     */
    public function generatePassword(): void
    {
        $password = random_bytes($this->length) . $this->salt;
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if ($passwordHash) {
            $this->password = mb_strimwidth($passwordHash, 0, $this->length, $passwordHash);;
        }
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     */
    public function setCreatedAt(int $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int|null
     */
    public function getUpdatedAt(): ?int
    {
        return $this->updatedAt;
    }

    /**
     * @param int|null $updatedAt
     */
    public function setUpdatedAt(?int $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
