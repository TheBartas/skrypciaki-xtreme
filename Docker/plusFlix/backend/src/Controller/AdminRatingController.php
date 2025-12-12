<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Service\AdminSecurityService;
use App\Repository\RatingRepository;
use App\Entity\Rating;

#[Route('/admin')]
class AdminRatingController extends AbstractController {

    private AdminSecurityService $adminSecurity;

    public function __construct(AdminSecurityService $adminSecurity)
    {
        $this->adminSecurity = $adminSecurity;
    }
    
    #[Route('/ratings', name: 'admin_ratings')]
    public function listRatings(
        Request $request,
        RatingRepository $ratingRepository,
    ) : Response {
        
        if ($response = $this->adminSecurity->checkAdminLoggedIn($request)) {
            return $response;
        }

        $ratings = $ratingRepository->findWithItem();

        return $this->render('admin/ratings.html.twig', [
            'ratings' => $ratings,
        ]);
    }

    #[Route('/rating/edit/{id}', name: 'admin_rating_edit', methods: ['POST'])]
    public function editRating(        
        Request $request,
        Rating $rat,
        EntityManagerInterface $em
    ) : Response {

        if ($response = $this->adminSecurity->checkAdminLoggedIn($request)) {
            return $response;
        }

        $rating = $request->request->get('rating');
        $comment = $request->request->get('comment');

        $rat->setRating((float)$rating);
        $rat->setComment($comment);

        $em->flush();
        return $this->redirectToRoute('admin_ratings');
    }

    #[Route('/rating/delete/{id}', name: 'admin_rating_delete', methods: ['POST'])]
    public function deleteRating(
        Request $request,
        Rating $rat,
        EntityManagerInterface $em
    ) : Response {

        
        if ($response = $this->adminSecurity->checkAdminLoggedIn($request)) {
            return $response;
        }

        $em->remove($rat);
        $em->flush();
        
        return $this->redirectToRoute('admin_ratings');
    }
}