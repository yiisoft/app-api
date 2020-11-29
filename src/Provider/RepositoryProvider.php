<?php

declare(strict_types=1);

namespace App\Provider;

use App\Blog\Post;
use App\Blog\PostRepository;
use App\User\User;
use App\User\UserRepository;
use Cycle\ORM\ORMInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;

final class RepositoryProvider extends ServiceProvider
{
    private const REPOSITORIES = [
        User::class => UserRepository::class,
        Post::class => PostRepository::class,
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
