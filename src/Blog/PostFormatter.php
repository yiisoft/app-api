<?php

declare(strict_types=1);

namespace App\Blog;

final class PostFormatter
{
    public function format(Post $post): array
    {
        return [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
        ];
    }
}
