<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Exception;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

readonly class RegisterService
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private UserRepository              $userRepository,
        private EmailVerifier               $emailVerifier
    )
    {
    }
    
    /**
     * @throws TransportExceptionInterface
     */
    public function register(User $user, FormInterface $form): void
    {
        $user->setPassword(
            $this->passwordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            )
        );
       
        $this->userRepository->save($user, true);
        
        $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            (new TemplatedEmail())
                ->from(new Address('no-reply@snowtricks.com', 'Snowtricks'))
                ->to($user->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
        );
        
    }
    
    public function find(int $id)
    {
        return $this->userRepository->find($id);
    }
    
    /**
     * @throws Exception
     */
    public function verifyEmail(Request $request, User $user): void
    {
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}