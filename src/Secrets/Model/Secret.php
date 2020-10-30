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
    protected int $id;

    /**
     * Secret user id.
     *
     * @var int
     * @ORM\Column(type="integer")
     */
    protected int $userId;

    /**
     * Secret type id.
     *
     * @var int
     * @ORM\Column(type="integer")
     */
    protected int $secretTypeId;

    /**
     * Salt to generate password.
     *
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected string $salt;

    /**
     * Generated password.
     *
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected string $password;

    /**
     * Password length.
     *
     * @var int
     * @ORM\Column(type="integer")
     */
    protected int $length;

    /**
     * Secret created at timestamp.
     *
     * @var int
     * @ORM\Column(type="integer")
     */
    protected int $createdAt;

    /**
     * Secret updated at timestamp.
     *
     * @var int|null
     * @ORM\Column(type="integer", nullable=true)
     */
    protected ?int $updatedAt = null;

    /**
     * Secret constructor.
     *
     * @param int    $userId
     * @param int    $secretTypeId
     * @param string $salt
     * @param int    $length
     */
    public function __construct(int $userId, int $secretTypeId, string $salt, int $length = 16)
    {
        $this->userId = $userId;
        $this->secretTypeId = $secretTypeId;
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
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getSecretTypeId(): int
    {
        return $this->secretTypeId;
    }

    /**
     * @param int $secretTypeId
     */
    public function setSecretTypeId(int $secretTypeId): void
    {
        $this->secretTypeId = $secretTypeId;
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
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
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
            $this->password = mb_strimwidth($passwordHash, 0, $this->length);
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
