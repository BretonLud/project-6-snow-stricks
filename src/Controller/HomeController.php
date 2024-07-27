<?php

namespace App\Controller;

use App\Service\TricksService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(name: 'app_home_')]
class HomeController extends AbstractController
{
    public function __construct(private readonly TricksService $tricksService)
    {
    }
    
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        $tricksLength = $this->tricksService->count();
        $tricks = $this->tricksService->findByLimit(6,0, ['createdAt' => 'DESC']);
        return $this->render('home/index.html.twig', [
            'tricks' => $tricks,
            'tricksLength' => $tricksLength,
        ]);
    }
    
    #[Route('/load-more-tricks/{offset}', name: 'load_more_tricks', methods: ['GET'])]
    public function loadMoreTricks(int $offset): Response
    {
        $tricks = $this->tricksService->findByLimit(6, $offset, ['createdAt' => 'DESC']);
        
        return $this->render('_partials/_tricks.html.twig', [
            'tricks' => $tricks,
        ]);
    }
}
