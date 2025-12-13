<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Cookie;
use App\Entity\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/admin')]
class AdminController extends AbstractController {

    #[Route('/login', name: 'admin_login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('admin/login.html.twig', [ 'last_username' => $lastUsername, 'error' => $error, ]);

    }

    #[Route('/logout', name: 'admin_logout', methods: ['POST'])]
    public function logout(): never
    {
        throw new \LogicException('Will be intercepted');
    }

    #[Route('/', name: 'admin_main')]
    public function adminIndex(): Response {

        /** @var \App\Entity\Admin $admin */
        $admin = $this->getUser();

        return $this->render('admin/base.html.twig', [
            'admin' => $admin,
        ]);
    }
}




