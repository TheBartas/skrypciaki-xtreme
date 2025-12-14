<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RatingRepository;
use App\Entity\Rating;

#[Route('/admin')]
class AdminRatingController extends AbstractController {

    #[Route('/ratings', name: 'admin_ratings')]
    public function listRatings(
        Request $request,
        RatingRepository $ratingRepository,
    ) : Response {


        $ratings = $ratingRepository->findWithItem();

        return $this->render('admin/ratings.html.twig', [
            'ratings' => $ratings,
        ]);
    }

    #[Route('/rating', name: 'admin_rating_search')]
    public function categorySearch(
        Request $request,
        RatingRepository $ratingRepository,
    ) : Response {
        $q = $request->query->get('q');

        $ratings = $ratingRepository->searchByItemTitle($q);

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


        $em->remove($rat);
        $em->flush();

        return $this->redirectToRoute('admin_ratings');
    }
}
