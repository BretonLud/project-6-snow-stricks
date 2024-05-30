<?php

namespace App\Controller\Admin;

use App\Entity\Group;
use App\Form\GroupFormType;
use App\Service\GroupService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_ADMIN")]
#[Route('/admin/group', name: 'app_admin_group_')]
class GroupController extends AbstractController
{
    public function __construct(private readonly GroupService $groupService)
    {
    }
    
    #[Route('/', name: 'dashboard', methods: ['GET'])]
    public function index() : Response
    {
        $groups = $this->groupService->getGroups();
        
        return $this->render('admin/group/index.html.twig', [
                'groups' => $groups,
            ]);
    }
    
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function create(Request $request) : Response
    {
        $group = new Group();
        $form = $this->createForm(GroupFormType::class, $group);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->groupService->save($group, true);
            $this->addFlash('success', 'Group created.');
            return $this->redirectToRoute('app_admin_group_dashboard');
        }
        
        return $this->render('admin/group/create.html.twig', [
                'form' => $form,
            ]
        );
    }
    
    #[Route('/edit/{slug}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Group $group, Request $request) : Response
    {
        $form = $this->createForm(GroupFormType::class, $group);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->groupService->save($group, true);
            $this->addFlash('success', 'Group updated.');
            return $this->redirectToRoute('app_admin_group_dashboard');
        }
        
        return $this->render('admin/group/edit.html.twig', [
            'form' => $form,
        ]);
    }
    
    #[Route('/{slug}', name: 'delete', methods: ['DELETE'])]
    public function delete(Group $group, Request $request) : RedirectResponse
    {
        $tokenId = 'delete' . $group->getId();
        
        if ($this->isCsrfTokenValid($tokenId, $request->get('_token'))) {
            
            $this->groupService->remove($group, true);
            
            $this->addFlash('success', 'Group deleted');
        } else {
            $this->addFlash('error', 'Cannot delete this group ' . $group->getName());
        }
        
        return $this->redirectToRoute('app_admin_group_dashboard');
    }
}
