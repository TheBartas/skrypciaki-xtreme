<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Repository\CategoryRepository;
use App\Entity\Category;
use App\Service\AdminSecurityService;

#[Route('/admin')]
class AdminCategoryController extends AbstractController {

    private AdminSecurityService $adminSecurity;

    public function __construct(AdminSecurityService $adminSecurity)
    {
        $this->adminSecurity = $adminSecurity;
    }
    
    #[Route('/categories', name: 'admin_categories')]
    public function categorieList(
        Request $request,
        CategoryRepository $categoryRepository
        ) : Response {

        if ($response = $this->adminSecurity->checkAdminLoggedIn($request)) {
            return $response;
        }

        $categories = $categoryRepository->findWithItemCount();

        return $this->render('admin/categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/categories/delete/{id}', name: 'admin_category_delete', methods: ['POST'])]
    public function categorieDelete(
        Request $request,
        Category $category,
        EntityManagerInterface $em
        ) : Response
    {

        if ($response = $this->adminSecurity->checkAdminLoggedIn($request)) {
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

        if ($response = $this->adminSecurity->checkAdminLoggedIn($request)) {
            return $response;
        }

        $genre = $request->request->get('genre');
        $category = new Category();
        $category->setGenre($genre);

        $em->persist($category);
        $em->flush();

        return $this->redirectToRoute('admin_categories');
    }

    #[Route('/categories/edit/{id}', name: 'admin_category_edit', methods: ['POST'])]
    public function categorieEdit(
        Request $request,
        Category $category,
        EntityManagerInterface $em
        ) : Response
    {
        if ($response = $this->adminSecurity->checkAdminLoggedIn($request)) {
            return $response;
        }

        $genre = $request->request->get('genre');
        $category->setGenre($genre);
        $em->flush();
        return $this->redirectToRoute('admin_categories');
    }

}