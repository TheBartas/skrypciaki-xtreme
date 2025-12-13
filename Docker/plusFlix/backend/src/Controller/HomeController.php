<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ItemRepository;
use App\Entity\Item;
use App\Entity\Category;
use App\Entity\Tag;
use App\Service\FilterOptionsProviderService;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/')]
class HomeController extends AbstractController {

    #[Route('/', name: 'home')]
    public function home() {
        return $this->render('home/index.html.twig');
    }

    #[Route('/search-suggestions', name: 'search_suggestions', methods: ['GET'])]
    public function suggestions(Request $request, ItemRepository $itemRepository): JsonResponse
    {
        $q = $request->query->get('q', '');
        if (strlen($q) < 2) {
            return $this->json([]);
        }

        $results = $itemRepository->findSuggestionsByQuery($q);

        return $this->json($results);
    }



    #[Route('/search', name: 'search_results')]
    public function search(Request $request, ItemRepository $itemRepository, ManagerRegistry $doctrine, FilterOptionsProviderService $filterOptionsProviderService): Response
    {
        $filters = [
            'name' => $request->query->get('q', ''),
            'type' => $request->query->get('type', ''),
            'categories' => $request->query->get('category') ? [(int)$request->query->get('category')] : [],
            'streamings' => $request->query->get('platform') ? [(int)$request->query->get('platform')] : [],
            'tags' =>  array_filter(array_map('intval', $request->query->all('tags'))),
            'director' => $request->query->get('director', ''),
            'year_range' => $request->query->get('year_range', ''),
        ];

        $sort = $request->query->get('sort', 'popularity');
        $results = $itemRepository->findByFiltersSorted($filters, $sort);

        $options = $filterOptionsProviderService->getOptions();

        return $this->render('search/results.html.twig', [
            'query' => $filters['name'],
            'results' => $results,
            'sort'    => $sort,
            
            'categories' => $options['categories'],
            'tags' => $options['tags'],
            'authors' => $options['authors'],

            'selectedType' => $filters['type'],
            'selectedCategory' => $filters['categories'][0] ?? null,
            'selectedTags' => $filters['tags'],
            'selectedDirector' => $filters['director'],
            'selectedYearRange'=> $filters['year_range']
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

    #[Route('/favorites', name: 'favorites_items')]
    public function favoritesItems(Request $request, ItemRepository $itemRepository) : Response {
        $favoritesRaw = $request->cookies->get('favorites', '[]');
        $favorites = json_decode($favoritesRaw, true) ?? [];
        $favorites = $itemRepository->findByIds(array_map('intval', $favorites));

        return $this->render('search/favorites.html.twig', [
            'favorites' => $favorites,
        ]);
    }

}