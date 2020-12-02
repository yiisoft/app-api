<?php

declare(strict_types=1);

namespace App\Blog;

use App\User\User;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\BelongsTo;
use Cycle\Annotated\Annotation\Table;
use Cycle\ORM\Promise\Reference;
use DateTimeImmutable;
use Yiisoft\Security\Random;

/**
 * @Entity(
 *     repository="App\Blog\PostRepository",
 * )
 * @Table()
 */
class Post
{
    /**
     * @Column(type="primary")
     */
    private ?int $id = null;

    /**
     * @Column(type="string(128)")
     */
    private string $slug;

    /**
     * @Column(type="string(255)", default="")
     */
    private string $title = '';

    /**
     * @Column(type="int(11)", default="0")
     */
    private int $status = 0;

    /**
     * @Column(type="text")
     */
    private string $content;

    /**
     * @Column(type="datetime")
     */
    private DateTimeImmutable $created_at;

    /**
     * @Column(type="datetime")
     */
    private DateTimeImmutable $updated_at;

    /**
     * @BelongsTo(target="App\User\User", nullable=false)
     *
     * @var Reference|User
     */
    private $user = null;
    private ?int $user_id = null;

    public function __construct()
    {
        $this->created_at = new DateTimeImmutable();
        $this->updated_at = new DateTimeImmutable();
        $this->resetSlug();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function resetSlug(): void
    {
        $this->slug = Random::string(128);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setStatus(PostStatus $status): void
    {
        $this->status = $status->getValue();
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Reference|User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }
}
