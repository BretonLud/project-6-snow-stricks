<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Tricks;
use App\Form\CommentFormType;
use App\Form\TricksType;
use App\Service\CommentService;
use App\Service\PicturesUploaderService;
use App\Service\TricksService;
use Exception;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/tricks', name: 'app_tricks_')]
class TricksController extends AbstractController
{
    public function __construct(
        private readonly TricksService $tricksService,
        private readonly PicturesUploaderService $picturesUploader,
        private readonly CommentService $commentService,
        private readonly TranslatorInterface $translator,
    )
    {}
    
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        $tricks = $this->tricksService->findBy([], ['createdAt' => 'DESC']);
        
        return $this->render('tricks/index.html.twig', [
            'tricks' => $tricks
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
            $this->addFlash('success', $this->translator->trans('Tricks saved.'));
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
    public function edit(Request $request,#[MapEntity(mapping: ['slug' => 'slug'])] Tricks $tricks): Response
    {
        $form = $this->createForm(TricksType::class, $tricks);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->picturesUploader->setPictures($tricks, true);
            $this->tricksService->save($tricks);
            $this->addFlash('success', $this->translator->trans('Tricks edited.'));
            return $this->redirectToRoute('app_tricks_show', [
                'slug' => $tricks->getSlug()
            ]);
        }
        
        return $this->render('tricks/edit.html.twig', [
            'form' => $form,
            'tricks' => $tricks
        ]);
    }
    
    #[Route('/show/{slug}', name: 'show', methods: ['GET', 'POST'])]
    public function show(#[MapEntity(mapping: ['slug' => 'slug'])] Tricks $trick, Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($this->getUser());
            $comment->setTricks($trick);
            $this->commentService->save($comment);
            $this->addFlash('success', $this->translator->trans('Comment saved.'));
            return $this->redirectToRoute('app_tricks_show', ['slug' => $trick->getSlug()]);
        }
        
        return $this->render('tricks/show.html.twig', [
            'trick' => $trick,
            'form' => $form
        ]);
    }
    
    /**
     * @throws Exception
     */
    #[Route('/delete/{slug}', name: 'delete', methods: ['DELETE'])]
    #[isGranted("ROLE_USER")]
    public function delete(#[MapEntity(mapping: ['slug' => 'slug'])] Tricks $tricks, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete-tricks-' . $tricks->getSlug(), $request->get('_token'))) {
            
            $this->tricksService->remove($tricks);
            
            $this->addFlash('success', $this->translator->trans('Tricks deleted'));
        } else {
            $this->addFlash('error', $this->translator->trans('Cannot delete this tricks '));
        }
        
        return $this->redirectToRoute('app_tricks_index');
    }
    
    #[Route('/show/{slug}/comment/edit/{id}', name: 'editComment', methods: ['GET', 'POST'])]
    #[IsGranted("COMMENT_ACCESS", "comment")]
    public function editComment(
        #[MapEntity(mapping: ['slug' => 'slug'])]Tricks $tricks,
        #[MapEntity(mapping: ['id' => 'id'])]Comment $comment,
        Request $request
    ): Response|RedirectResponse
    {
        $form = $this->createForm(CommentFormType::class, $comment, [
            'action' => $this->generateUrl('app_tricks_editComment', ['slug' => $tricks->getSlug(), 'id' => $comment->getId()]),
        ]);
        
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            
            if ($form->isValid())
            {
                $this->commentService->save($comment);
                $this->addFlash('success', $this->translator->trans('Comment edited.'));
                return $this->redirectToRoute('app_tricks_show', ['slug' => $tricks->getSlug()]);
            }
            
            return new Response($this->renderView('comment/_form.html.twig', [
                'form' => $form,
                'tricks' => $tricks,
                'comment' => $comment,
                ]), Response::HTTP_BAD_REQUEST);
        }
        
        return $this->render('comment/_form.html.twig', [
            'form' => $form,
            'tricks' => $tricks,
            'comment' => $comment
        ]);
    }
    
    #[Route('/show/{slug}/comment/delete/{id}', name: 'deleteComment', methods: ['DELETE'])]
    #[IsGranted("COMMENT_ACCESS", "comment")]
    public function deleteComment(
        #[MapEntity(mapping: ['slug' => 'slug'])]Tricks $tricks,
        #[MapEntity(mapping: ['id' => 'id'])]Comment $comment,
        Request $request
    ): Response|RedirectResponse
    {
        if ($this->isCsrfTokenValid('delete-comment-' . $comment->getId(), $request->get('_token'))) {
            
            $this->commentService->remove($comment);
            
            $this->addFlash('success', $this->translator->trans('Comment deleted'));
        } else {
            $this->addFlash('error', $this->translator->trans('Cannot delete this comment'));
        }
        
        return $this->redirectToRoute('app_tricks_show', ['slug' => $tricks->getSlug()]);
    }
}
