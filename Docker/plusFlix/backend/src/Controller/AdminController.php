<?php
namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Item;
use App\Entity\Streamings;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\CategoriesRepository;

#[Route('/admin')]
class AdminController extends AbstractController {

    #[Route('/main', 'admin_main')]
    public function adminIndex() {
        return $this->render('admin/base.html.twig');
    }

    #[Route('/categories', 'admin_categories')]
    public function categorieList(ManagerRegistry $managerRegistry) : Response {

        $connection = $managerRegistry->getConnection();

        $sql = "
            SELECT
                c.cat_ID,
                c.genre,
                COUNT(ic.item_id) AS item_count
            FROM Categories c
            LEFT JOIN Item_Categories ic ON c.cat_ID = ic.cat_ID
            GROUP BY c.cat_ID, c.genre
            ORDER BY c.genre
        ";

        $stmt = $connection->prepare($sql);
        $resultSet = $stmt->executeQuery();

        $categories = $resultSet->fetchAllAssociative();
        return $this->render('admin/categories.html.twig',[
            'categories' => $categories,
        ]);
    }

    #[Route('/categories/delete/{id}', name: 'admin_category_delete', methods: ['POST'])]
    public function categorieDelete(
        Categories $category,
        EntityManagerInterface $em
        ) : Response
    {
        $em->remove($category);
        $em->flush();
        return $this->redirectToRoute('admin_categories');
    }

    #[Route('/categories/add', name: 'admin_category_add', methods: ['POST'])]
    public function categorieAdd(
        Request $request,
        EntityManagerInterface $em
        ) : Response
    {
        $genre = $request->request->get('genre');
        $category = new Categories();
        $category->setGenre($genre);

        $em->persist($category);
        $em->flush();

        return $this->redirectToRoute('admin_categories');
    }

    #[Route('/categories/edit/{id}', name: 'admin_category_edit', methods: ['POST'])]
    public function categorieEdit(
        Request $request,
        Categories $category,
        EntityManagerInterface $em
        ) : Response
    {
        $genre = $request->request->get('genre');
        $category->setGenre($genre);
        $em->flush();
        return $this->redirectToRoute('admin_categories');
    }

    #[Route('/items', name: 'admin_items')]
    public function itemsList(ItemRepository $itemRepository): Response
    {
        $items = $itemRepository->findAll();

        return $this->render('admin/items.html.twig',[
            'items' => $items,
        ]);
    }
    #[Route('/item/edit/{id}', name: 'admin_item_edit', methods: ['POST'])]
    public function itemEdit(Request $request, Item $item, EntityManagerInterface $em) : Response
    {
        $name = $request->request->get('name');
        $year = $request->request->get('year');
        $director = $request->request->get('director');
        $actors = $request->request->get('actors');
        $type = $request->request->get('type');
        $duration = $request->request->get('duration');
        $season = $request->request->get('season');

        if ($name !== null) $item->setName($name);
        if ($year !== null) $item->setYear((int)$year);
        if ($director !== null) $item->setDirector($director);
        if ($actors !== null) $item->setActors($actors);
        if ($type !== null) $item->setType((int)$type);
        if ($duration !== null) $item->setDuration((int)$duration);
        $item->setSeason($season !== '' ? (int)$season : null);

        $em->flush();
        return $this->json([
            'success' => true,
            'id' => $item->getId(),
        ]);
    }
    #[Route('/item/delete/{id}', name: 'admin_item_delete', methods: ['POST'])]
    public function itemDelete(Item $item, EntityManagerInterface $em) : Response
    {
        $em->remove($item);
        $em->flush();
        return $this->redirectToRoute('admin_items');
    }
    #[Route('/item/add', name: 'admin_item_add', methods: ['POST'])]
    public function addItem(Request $request, EntityManagerInterface $em): Response
    {
        $item = new Item();
        $item->setName($request->request->get('name'));
        $item->setYear((int)$request->request->get('year'));
        $item->setDirector($request->request->get('director'));
        $item->setActors($request->request->get('actors'));
        $item->setType($request->request->get('type'));
        $item->setDuration((int)$request->request->get('duration'));
        $item->setSeason($request->request->get('season') ? (int)$request->request->get('season') : null);

// ManyToMany categories
        $categoryIds = $request->request->all('categories') ?? [];
        foreach ($categoryIds as $id) {
            $category = $em->getRepository(Categories::class)->find($id);
            if ($category) $item->addCategory($category);
        }

// ManyToMany streamings
        $streamingIds = $request->request->all('streamings') ?? [];
        foreach ($streamingIds as $id) {
            $streaming = $em->getRepository(Streamings::class)->find($id);
            if ($streaming) $item->addStreaming($streaming);
        }

// Persist
        $em->persist($item);
        $em->flush();

        return $this->json([
            'success' => true,
            'id' => $item->getId()
        ]);
    }

    #[Route('/item/{id}', name: 'get_item', methods: ['GET'])]
    public function returnItem(Item $item): JsonResponse
    {
        // Return JSON for a single item
        return $this->json([
            'id' => $item->getId(),
            'name' => $item->getName(),
            'year' => $item->getYear(),
            'director' => $item->getDirector(),
            'actors' => $item->getActors(),
            'type' => $item->getType(),
            'duration' => $item->getDuration(),
            'season' => $item->getSeason(),
            // If you want ManyToMany relations
//            'categories' => $item->getCategories()->map(fn($c) => $c->getId())->toArray(),
//            'streamings' => $item->getStreamings()->map(fn($s) => $s->getId())->toArray(),
        ]);
    }

    #[Route('/list', name: 'get_list', methods: ['GET'])]
    public function returnByFilter(Request $request, ItemRepository $itemRepository): JsonResponse
    {
        $filters = [];

        // Scalar filters
        if ($name = $request->query->get('name')) $filters['name'] = $name;
        if ($year = $request->query->get('year')) $filters['year'] = (int)$year;
        if ($director = $request->query->get('director')) $filters['director'] = $director;
        if ($actors = $request->query->get('actors')) $filters['actors'] = $actors;
        if ($type = $request->query->get('type')) $filters['type'] = (int)$type;
        if ($duration = $request->query->get('duration')) $filters['duration'] = (int)$duration;
        if ($request->query->has('season')) {
            $filters['season'] = $request->query->get('season') !== '' ? (int)$request->query->get('season') : null;
        }

        // ManyToMany filters
        if ($categories = $request->query->get('categories')) {
            $filters['categories'] = array_filter(array_map('intval', explode(',', $categories)));
        }
        if ($streamings = $request->query->get('streamings')) {
            $filters['streamings'] = array_filter(array_map('intval', explode(',', $streamings)));
        }

        $items = $itemRepository->findByFilters($filters);

        return $this->json($items);
    }
}
