<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Form\TricksType;
use App\Service\PicturesUploaderService;
use App\Service\TricksService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/tricks', name: 'app_tricks_')]
class TricksController extends AbstractController
{
    public function __construct(
        private readonly TricksService $tricksService,
        private readonly PicturesUploaderService $picturesUploader,
    )
    {}
    
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('tricks/index.html.twig', [
            'tricks' => $this->tricksService->findAll()
        ]);
    }
    
    /**
     * @throws Exception
     */
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_USER")]
    public function create(Request $request): null|Response
    {
        $tricks = new Tricks();
        $form = $this->createForm(TricksType::class, $tricks);
        $form->handleRequest($request);
  
        if ($form->isSubmitted() && $form->isValid()) {
            $this->picturesUploader->setPictures($tricks, true);
            $tricks->setUser($this->getUser());
            $this->tricksService->save($tricks);
            $this->addFlash('success', 'Tricks saved.');
            return $this->redirectToRoute('app_tricks_index');
        }
        
        return $this->render('tricks/create.html.twig', [
            'form' => $form
        ]);
    }
    
    /**
     * @throws Exception
     */
    #[Route('/edit/{slug}', name: 'edit', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_USER")]
    public function edit(Request $request, Tricks $tricks): Response
    {
        $form = $this->createForm(TricksType::class, $tricks);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->picturesUploader->setPictures($tricks, true);
            $this->tricksService->save($tricks);
            $this->addFlash('success', 'Tricks edited.');
            return $this->redirectToRoute('app_tricks_index');
        }
        
        return $this->render('tricks/edit.html.twig', [
            'form' => $form,
            'tricks' => $tricks
        ]);
    }
    
    #[Route] #[Route('/show/{slug}', name: 'show', methods: ['GET'])]
    public function show(Tricks $tricks): Response
    {
        return $this->render('tricks/show.html.twig', [
            'tricks' => $tricks
        ]);
    }
}
