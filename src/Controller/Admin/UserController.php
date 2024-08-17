<?php
    
    namespace App\Controller\Admin;
    
    use App\Entity\User;
    use App\Service\UserService;
    use Symfony\Bridge\Doctrine\Attribute\MapEntity;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;
    use Symfony\Contracts\Translation\TranslatorInterface;
    
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/user', name: 'app_admin_user_')]
    class UserController extends AbstractController
    {
        
        public function __construct(
            private readonly UserService         $userService,
            private readonly TranslatorInterface $translator,
        )
        {
        }
        
        #[Route('', name: 'index', methods: ['GET'])]
        public function index(): Response
        {
            $users = $this->userService->findAll();
            
            return $this->render('admin/user/index.html.twig', [
                'users' => $users,
            ]);
        }
        
        #[Route('{username}', name: 'delete', methods: ['DELETE'])]
        public function delete(#[MapEntity(mapping: ['username' => 'username'])] User $user, Request $request): Response
        {
            if ($this->isCsrfTokenValid('delete-user-' . $user->getUsername(), $request->get('_token'))) {
                
                $this->userService->remove($user);
                
                $this->addFlash('success', $this->translator->trans('User deleted'));
            } else {
                $message = $this->translator->trans("Cannot delete this user");
                $this->addFlash('error', $message . ": " . $user->getUsername());
            }
            
            return $this->redirectToRoute('app_admin_user_index');
        }
    }
