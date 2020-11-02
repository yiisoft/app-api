<?php

declare(strict_types=1);

namespace App\Entity;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\HasMany;
use Cycle\Annotated\Annotation\Table;
use Cycle\Annotated\Annotation\Table\Index;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Yiisoft\Security\PasswordHasher;
use Yiisoft\Security\Random;
use Yiisoft\Auth\IdentityInterface;

/**
 * @Entity(repository="App\Repository\UserRepository", mapper="Yiisoft\Yii\Cycle\Mapper\TimestampedMapper")
 * @Table(
 *     indexes={
 *         @Index(columns={"login"}, unique=true),
 *         @Index(columns={"token"}, unique=true)
 *     }
 * )
 */
class User implements IdentityInterface
{
    /**
     * @Column(type="primary")
     */
    private ?int $id = null;

    /**
     * @Column(type="string(128)")
     */
    private string $token;

    /**
     * @Column(type="string(48)")
     */
    private string $login;

    /**
     * @Column(type="string")
     */
    private string $passwordHash;

    /**
     * Annotations for this field placed in a mapper class
     */
    private DateTimeImmutable $created_at;

    /**
     * Annotations for this field placed in a mapper class
     */
    private DateTimeImmutable $updated_at;

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->created_at = new DateTimeImmutable();
        $this->updated_at = new DateTimeImmutable();
        $this->setPassword($password);
        $this->resetToken();
    }

    public function getId(): ?string
    {
        return $this->id === null ? null : (string)$this->id;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function resetToken(): void
    {
        $this->token = Random::string(128);
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function validatePassword(string $password): bool
    {
        return (new PasswordHasher())->validate($password, $this->passwordHash);
    }

    public function setPassword(string $password): void
    {
        $this->passwordHash = (new PasswordHasher())->hash($password);
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updated_at;
    }
}
