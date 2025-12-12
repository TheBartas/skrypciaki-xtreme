<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Service\AdminSecurityService;

#[Route('/admin')]
class AdminController extends AbstractController {

    #[Route('/login', name: 'admin_login', methods: ['GET','POST'])]
    public function login(Request $request): Response
    {
        $error = null;

        if ($request->isMethod('POST')) {
            $user = $request->request->get('username');
            $pass = $request->request->get('password');

            $adminLogin = $_ENV['ADMIN_LOGIN'] ?? 'ENV_ADMIN_LOGIN_MISSING';
            $adminPass = $_ENV['ADMIN_PASS'] ?? 'ENV_ADMIN_PASS_MISSING';

            if ($user === $adminLogin && $pass === $adminPass) {
                $response = $this->redirectToRoute('admin_main');
                $response->headers->setCookie(new Cookie('admin_logged_in', '1'));
                return $response;
            } else {
                $error = 'Niepoprawny login lub hasło';
            }
        }

        return $this->render('admin/login.html.twig', [
            'error' => $error
        ]);
    }

    #[Route('/', name: 'admin_main')]
    public function adminIndex(
        Request $request,
        AdminSecurityService $adminSecurityService
        ): Response {

        if ($response = $adminSecurityService->checkAdminLoggedIn($request)) {
            return $response;
        }

        return $this->render('admin/base.html.twig');
    }
}




