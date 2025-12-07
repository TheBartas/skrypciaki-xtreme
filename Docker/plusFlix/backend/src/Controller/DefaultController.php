<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('public/base.html.twig');
    }

    #[Route('/item', name: 'item_page')]
    public function itemPage(): Response
    {
        return $this->render('public/item.html.twig');
    }
}
