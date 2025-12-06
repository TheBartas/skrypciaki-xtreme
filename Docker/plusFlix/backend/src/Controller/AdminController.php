<?php
namespace App\Controller;

use App\Entity\Categories;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\CategoriesRepository;

#[Route('/admin')]
class AdminController extends AbstractController {
    private function checkAdminLoggedIn(Request $request): ?Response
    {
        if ($request->cookies->get('admin_logged_in') !== '1') {
            return $this->redirectToRoute('admin_login');
        }
        return null;
    }

    #[Route('/login', name: 'admin_login', methods: ['GET','POST'])]
    public function login(Request $request): Response
    {
        $error = null;

        if ($request->isMethod('POST')) {
            $user = $request->request->get('username');
            $pass = $request->request->get('password');

            $adminLogin = $_ENV['ADMIN_USER'] ?? 'admin';
            $adminPass = $_ENV['ADMIN_PASS'] ?? 'devpass';

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

    #[Route('/main', 'admin_main')]
    public function adminIndex(Request $request): Response {

        if ($response = $this->checkAdminLoggedIn($request)) {
            return $response;
        }

        return $this->render('admin/base.html.twig');
    }

    #[Route('/categories', 'admin_categories')]
    public function categorieList(Request $request, ManagerRegistry $managerRegistry) : Response {

        if ($response = $this->checkAdminLoggedIn($request)) {
            return $response;
        }

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
        Request $request,
        Categories $category,
        EntityManagerInterface $em
        ) : Response
    {

        if ($response = $this->checkAdminLoggedIn($request)) {
            return $response;
        }

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

        if ($response = $this->checkAdminLoggedIn($request)) {
            return $response;
        }

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
        if ($response = $this->checkAdminLoggedIn($request)) {
            return $response;
        }

        $genre = $request->request->get('genre');
        $category->setGenre($genre);
        $em->flush();
        return $this->redirectToRoute('admin_categories');
    }
}
