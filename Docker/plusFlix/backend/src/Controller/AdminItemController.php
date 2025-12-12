<?php
namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\StreamingRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Item;
use App\Entity\Category;
use App\Entity\Streaming;
use App\Repository\ItemRepository;

#[Route('/admin')]
class AdminItemController extends AbstractController {

    #[Route('/items', name: 'admin_items')]
    public function itemsList(
        ItemRepository $itemRepository,
        CategoryRepository $categoryRepository,
        TagRepository $tagRepository,
        StreamingRepository $streamingRepository,
    ): Response
    {
        $items = $itemRepository->findAll();
        $categories = $categoryRepository->findAll();
        $tags = $tagRepository->findAll();
        $streamings = $streamingRepository->findAll();



        return $this->render('admin/items.html.twig',[
            'items' => $items,
            'categories' => $categories,
            'tags' => $tags,
            'streamings' => $streamings,
        ]);
    }

    #[Route('/item/edit/{id}', name: 'admin_item_edit', methods: ['POST'])]
    public function itemEdit(
        Request $request,
        Item $item,
        EntityManagerInterface $em,
        CategoryRepository $categoryRepository,
        TagRepository $tagRepository,
        StreamingRepository $streamingRepository
    ) : Response
    {
        $name = $request->request->get('name');
        $year = $request->request->get('year');
        $director = $request->request->get('director');
        $actors = $request->request->get('actors');
        $type = $request->request->get('type');
        $duration = $request->request->get('duration');
        $season = $request->request->get('season');

        $categories = $request->request->get('categories', '');
        $tags = $request->request->get('tags', '');
        $streamings = $request->request->get('streamings', '');

        if ($name !== null) $item->setName($name);
        if ($year !== null) $item->setYear((int)$year);
        if ($director !== null) $item->setDirector($director);
        if ($actors !== null) $item->setActors($actors);
        if ($type !== null) $item->setType((int)$type);
        if ($duration !== null) $item->setDuration((int)$duration);
        $item->setSeason($season !== '' ? (int)$season : null);

        $item->getTags()->clear();
        $item->getCategories()->clear();
        $item->getStreamings()->clear();

        if (!empty($categories)) {
            if (is_string($categories)) {
                $categoriesIds = explode(',', $categories);

                foreach ($categoriesIds as $categorieId) {
                    $categorie = $categoryRepository->find((int)$categorieId);
                    if ($categorie) {
                        $item->addCategory($categorie);
                    }
                }
            }
        }

        if (!empty($tags)) {
            if (is_string($tags)) {
                $tagsIds = explode(',', $tags);

                foreach ($tagsIds as $tagId) {
                    $tag = $tagRepository->find((int)$tagId);
                    if ($tag) {
                        $item->addTag($tag);
                    }
                }
            }
        }

        if (!empty($streamings)) {
            if (is_string($streamings)) {
                $streamingsIds = explode(',', $streamings);

                foreach ($streamingsIds as $streamingId) {
                    $streaming = $streamingRepository->find((int)$streamingId);
                    if ($streaming) {
                        $item->addStreaming($streaming);
                    }
                }
            }
        }

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

        $categoryIds = $request->request->all('categories') ?? [];
        foreach ($categoryIds as $id) {
            $category = $em->getRepository(Category::class)->find($id);
            if ($category) $item->addCategory($category);
        }

        $streamingIds = $request->request->all('streamings') ?? [];
        foreach ($streamingIds as $id) {
            $streaming = $em->getRepository(Streaming::class)->find($id);
            if ($streaming) $item->addStreaming($streaming);
        }

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
            'categories' => $item->getCategories()->map(fn($c) => $c->getId())->toArray(),
            'streamings' => $item->getStreamings()->map(fn($s) => $s->getId())->toArray(),
            'tags'       => $item->getTags()->map(fn($t) => $t->getId())->toArray(),
        ]);
    }

    #[Route('/list', name: 'get_list', methods: ['GET'])]
    public function returnByFilter(Request $request, ItemRepository $itemRepository): JsonResponse
    {
        $filters = [];

        if ($name = $request->query->get('name')) $filters['name'] = $name;
        if ($year = $request->query->get('year')) $filters['year'] = (int)$year;
        if ($director = $request->query->get('director')) $filters['director'] = $director;
        if ($actors = $request->query->get('actors')) $filters['actors'] = $actors;
        if ($type = $request->query->get('type')) $filters['type'] = (int)$type;
        if ($duration = $request->query->get('duration')) $filters['duration'] = (int)$duration;
        if ($request->query->has('season')) {
            $filters['season'] = $request->query->get('season') !== '' ? (int)$request->query->get('season') : null;
        }

        if ($categories = $request->query->get('categories')) {
            $filters['categories'] = array_filter(array_map('intval', explode(',', $categories)));
        }
        if ($streamings = $request->query->get('streamings')) {
            $filters['streamings'] = array_filter(array_map('intval', explode(',', $streamings)));
        }
        if ($tags = $request->query->get('tags')) {
            $filters['tags'] = array_filter(array_map('intval', explode(',', $tags)));
        }

        $items = $itemRepository->findByFilters($filters);

        return $this->json($items);
    }
}
