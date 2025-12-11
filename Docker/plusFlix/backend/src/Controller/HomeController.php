<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ItemRepository;
use App\Entity\Item;

#[Route('/')]
class HomeController extends AbstractController {

    #[Route('/', 'home')]
    public function home() {
        return $this->render('home/index.html.twig');
    }

    #[Route('/search', name: 'search_results')]
    public function search(Request $request, ManagerRegistry $doctrine): Response
    {
        $query = $request->query->get('q', '');

        $repository = $doctrine->getRepository(Item::class);

        $results = $repository->createQueryBuilder('i')
            ->where('LOWER(i.name) LIKE :search')
            ->setParameter('search', '%' . strtolower($query) . '%')
            ->orderBy('i.name', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('search/results.html.twig', [
            'query' => $query,
            'results' => $results,
        ]);
    }

    #[Route('/item/{id}', name: 'item_detail')]
    public function itemDetail(int $id, ItemRepository $itemRepository): Response
    {
        $item = $itemRepository->find($id);

        if (!$item) {
            throw $this->createNotFoundException('Nie znaleziono dzieła o id ' . $id);
        }

        return $this->render('item/detail.html.twig', [  // placeholder bo nie ma jeszcze tego
            'item' => $item,
        ]);
    }
}