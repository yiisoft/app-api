<?php

declare(strict_types=1);

namespace App\Builder;

use App\Entity\Post;
use App\Validation\EditPostRequest;

final class PostBuilder
{
    public function build(Post $post, EditPostRequest $request): Post
    {
        $post->setTitle($request->getTitle());
        $post->setContent($request->getText());
        $post->setStatus($request->getStatus());

        return $post;
    }
}
