<?php

namespace App\Domain\Blog\Service;

use App\Domain\Blog\Exception\PostNotFoundException;
use App\Domain\Blog\ValueObject\PostId;

interface DeletePostServiceInterface
{
    /**
     * Undocumented function
     *
     * @param PostId $postId
     * @return void
     * @throws PostNotFoundException
     */
    public function execute(PostId $postId): void;
}
