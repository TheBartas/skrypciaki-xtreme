<?php
namespace App\Controller;

use App\Entity\Categories;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
}