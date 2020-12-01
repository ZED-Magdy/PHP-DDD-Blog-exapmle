<?php

namespace App\UI\Http\Controller\Api\V1;

use App\Domain\Blog\Repository\PostRepositoryInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListPostsController extends AbstractController
{
    private $postRepository;
    private $serializer;
    public function __construct(PostRepositoryInterface $postRepository, SerializerInterface $serializer)
    {
        $this->postRepository = $postRepository;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/v1/posts",name="posts.list")
     */
    public function __invoke(Request $request)
    {
        $page = $request->get('page', 1);
        $page > 0 ?: $page = 1;
        $perPage = $request->get('perPage', 5);
        $paginator = $this->postRepository->listPosts([], $page, $perPage);
        $nextPage = $page * $perPage < $paginator->count();
        $posts = [
            "page" => (int)$page,
            "perPage" => (int)$perPage,
            "nextPageUrl" => $nextPage?$this->generateUrl("posts.list", ['page' => ($page + 1)]): null,
            'data' => $this->serializer->deserialize($this->serializer->serialize($paginator->getQuery()->getResult(), 'json'), 'array', 'json')
        ];

        return new Response(json_encode($posts),200, ['content-type' => 'application/json']);
    }
}
