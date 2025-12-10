<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user', name: 'user_page')]
class UserController extends AbstractController {

    #[Route('/home', name: 'home_page')]
    public function index() : Response {
        return $this->render('public/base.html.twig');
    }

    #[Route('/item', name: 'item_page')]
    public function itemPage(): Response
    {
        return $this->render('public/item.html.twig');
    }
}
