<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Repository\StreamingRepository;
use App\Entity\Streaming;

#[Route('/admin')]
class AdminStreamingController extends AbstractController {

    #[Route('/streamings', name: 'admin_streamings')]
    public function streamingsList(Request $request, StreamingRepository $streamingsRepository) : Response {

        $streamings = $streamingsRepository->findWithItemCount();
        return $this->render('admin/streamings.html.twig',[
            'streamings' => $streamings,
        ]);
    }

    #[Route('/streamings/delete/{id}', name: 'admin_streaming_delete', methods: ['POST'])]
    public function streamingDelete(
        Request $request,
        Streaming $streaming,
        EntityManagerInterface $em
    ) : Response
    {

        $em->remove($streaming);
        $em->flush();
        return $this->redirectToRoute('admin_streamings');
    }

    #[Route('/streamings/add', name: 'admin_streaming_add', methods: ['POST'])]
    public function streamingAdd(
        Request $request,
        EntityManagerInterface $em
    ) : Response
    {

        $platformName = $request->request->get('platform_name');
        $streaming = new Streaming();
        $streaming->setPlatformName($platformName);

        $em->persist($streaming);
        $em->flush();

        return $this->redirectToRoute('admin_streamings');
    }

    #[Route('/streamings/edit/{id}', name: 'admin_streaming_edit', methods: ['POST'])]
    public function streamingEdit(
        Request $request,
        Streaming $streaming,
        EntityManagerInterface $em
    ) : Response
    {

        $platformName = $request->request->get('platform_name');
        $streaming->setPlatformName($platformName);
        $em->flush();
        return $this->redirectToRoute('admin_streamings');
    }

}
