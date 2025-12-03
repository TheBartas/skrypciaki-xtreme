<?php
namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Streamings;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CrudController extends AbstractController
{
    // ------------------- Categories -------------------

    #[Route('/categories/list', name: 'categories_list')]
    public function listCategories(EntityManagerInterface $em): Response
    {
        $categories = $em->getRepository(Categories::class)->findAll();
        $data = array_map(function (Categories $c) {
            return [
                'id' => $c->getId(),
                'genre' => $c->getGenre(),
            ];
        }, $categories);
        return $this->json($data);
    }

    #[Route('/categories/add', name: 'categories_add')]
    public function addCategory(Request $request, EntityManagerInterface $em): Response
    {
        $genre = $request->query->get('genre', 'Default Genre');
        $category = new Categories();
        $category->setGenre($genre);

        $em->persist($category);
        $em->flush();

        return $this->json(['ok' => true, 'id' => $category->getId()]);
    }

    #[Route('/categories/edit/{id}', name: 'categories_edit')]
    public function editCategory(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $category = $em->getRepository(Categories::class)->find($id);
        if (!$category) {
            return $this->json(['error' => 'Category not found'], 404);
        }

        $genre = $request->query->get('genre', $category->getGenre());
        $category->setGenre($genre);

        $em->flush();
        return $this->json(['ok' => true]);
    }

    #[Route('/categories/delete/{id}', name: 'categories_delete')]
    public function deleteCategory(int $id, EntityManagerInterface $em): Response
    {
        $category = $em->getRepository(Categories::class)->find($id);
        if (!$category) {
            return $this->json(['error' => 'Category not found'], 404);
        }

        $em->remove($category);
        $em->flush();

        return $this->json(['ok' => true]);
    }

    // ------------------- Streamings -------------------

    #[Route('/streamings/list', name: 'streamings_list')]
    public function listStreamings(EntityManagerInterface $em): Response
    {
        $streamings = $em->getRepository(Streamings::class)->findAll();
        $data = array_map(function (Streamings $s) {
            return [
                'id' => $s->getId(),
                'platform_name' => $s->getPlatformName(),
            ];
        }, $streamings);
        return $this->json($data);
    }

    #[Route('/streamings/add', name: 'streamings_add')]
    public function addStreaming(Request $request, EntityManagerInterface $em): Response
    {
        $platform = $request->query->get('platform_name', 'Default Platform');
        $streaming = new Streamings();
        $streaming->setPlatformName($platform);

        $em->persist($streaming);
        $em->flush();

        return $this->json(['ok' => true, 'id' => $streaming->getId()]);
    }

    #[Route('/streamings/edit/{id}', name: 'streamings_edit')]
    public function editStreaming(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $streaming = $em->getRepository(Streamings::class)->find($id);
        if (!$streaming) {
            return $this->json(['error' => 'Streaming not found'], 404);
        }

        $platform = $request->query->get('platform_name', $streaming->getPlatformName());
        $streaming->setPlatformName($platform);

        $em->flush();
        return $this->json(['ok' => true]);
    }

    #[Route('/streamings/delete/{id}', name: 'streamings_delete')]
    public function deleteStreaming(int $id, EntityManagerInterface $em): Response
    {
        $streaming = $em->getRepository(Streamings::class)->find($id);
        if (!$streaming) {
            return $this->json(['error' => 'Streaming not found'], 404);
        }

        $em->remove($streaming);
        $em->flush();

        return $this->json(['ok' => true]);
    }
}

