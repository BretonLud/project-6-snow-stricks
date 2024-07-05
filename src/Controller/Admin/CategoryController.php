<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Service\CategoryService;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_ADMIN")]
#[Route('/admin/group', name: 'app_admin_category_')]
class CategoryController extends AbstractController
{
    public function __construct(private readonly CategoryService $categoryService)
    {
    }
    
    #[Route('/', name: 'dashboard', methods: ['GET'])]
    public function index() : Response
    {
        $categories = $this->categoryService->getCategories();
        
        return $this->render('admin/category/index.html.twig', [
                'categories' => $categories,
            ]);
    }
    
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function create(Request $request) : Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryService->save($category, true);
            $this->addFlash('success', 'Category created.');
            return $this->redirectToRoute('app_admin_category_dashboard');
        }
        
        return $this->render('admin/category/create.html.twig', [
                'form' => $form,
            ]
        );
    }
    
    #[Route('/edit/{slug}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit( #[MapEntity(mapping: ['slug' => 'slug'])] Category $category, Request $request) : Response
    {
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryService->save($category, true);
            $this->addFlash('success', 'Category updated.');
            return $this->redirectToRoute('app_admin_category_dashboard');
        }
        
        return $this->render('admin/category/edit.html.twig', [
            'form' => $form,
        ]);
    }
    
    #[Route('/{slug}', name: 'delete', methods: ['DELETE'])]
    public function delete(#[MapEntity(mapping: ['slug' => 'slug'])] Category $category, Request $request) : RedirectResponse
    {
        if ($this->isCsrfTokenValid('delete-category-' . $category->getSlug(), $request->get('_token'))) {
            
            $this->categoryService->remove($category, true);
            
            $this->addFlash('success', 'Category deleted');
        } else {
            $this->addFlash('error', 'Cannot delete this category ' . $category->getName());
        }
        
        return $this->redirectToRoute('app_admin_category_dashboard');
    }
}
