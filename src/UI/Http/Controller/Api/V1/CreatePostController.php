<?php

namespace App\UI\Http\Controller\Api\V1;

use App\Domain\Blog\Service\CreatePostServiceInterface;
use App\Domain\Blog\ValueObject\CategoryId;
use App\Domain\Blog\ValueObject\PostContent;
use App\Domain\Blog\ValueObject\PostSlug;
use App\Domain\Blog\ValueObject\PostTitle;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreatePostController extends AbstractController
{
    private $createPostService;
    private $serializer;
    public function __construct(CreatePostServiceInterface $createPostService, SerializerInterface $serializer)
    {
        $this->createPostService = $createPostService;
        $this->serializer = $serializer;
    }
    /**
     * @Route("/api/v1/posts",name="posts.store", methods={"POST"})
     */
    public function __invoke(Request $request)
    {
        $category = $request->request->get('category_id') ? CategoryId::fromString($request->request->get('category_id')) : null;
        try {
            $post = $this->createPostService->execute(
                new PostSlug($request->request->get('slug')),
                new PostTitle($request->request->get('title')),
                new PostContent($request->request->get('content')),
                 $category,
                $request->request->get('tags') ?? null
            );
            return new Response($this->serializer->serialize($post, 'json'), 201, ['Content-Type' => 'application/json']);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), 422);
        }
    }
}
