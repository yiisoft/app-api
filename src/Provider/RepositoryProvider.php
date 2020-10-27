<?php

declare(strict_types=1);

namespace App\Provider;

use App\Entity\Post;
use App\Repository\PostRepository;
use App\Entity\User;
use App\Repository\UserRepository;
use Cycle\ORM\ORMInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;

final class RepositoryProvider extends ServiceProvider
{
    private const REPOSITORIES = [
        User::class => UserRepository::class,
        Post::class => PostRepository::class
    ];

    /**
     * @psalm-suppress InaccessibleMethod
     */
    public function register(Container $container): void
    {
        $orm = $container->get(ORMInterface::class);
        foreach (self::REPOSITORIES as $entity => $repository) {
            $container->set($repository, $orm->getRepository($entity));
        }
    }
}
