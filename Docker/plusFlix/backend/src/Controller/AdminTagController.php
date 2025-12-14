<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Repository\TagRepository;
use App\Entity\Tag;

#[Route('/admin')]
class AdminTagController extends AbstractController {

    #[Route('/tags', name: 'admin_tags')]
    public function tagsList(Request $request, TagRepository $tagRepository): Response
    {
        $tags = $tagRepository->findWithItemCount();
        return $this->render('admin/tags.html.twig', [
            'tags' => $tags,
        ]);
    }

    #[Route('/tag', name: 'admin_search_tags')]
    public function tagSearch(
        Request $request, 
        TagRepository $tagRepository
    ) {
        $q = $request->query->get('q');

        $tags = $tagRepository->searchByTagName($q);
        
        return $this->render('admin/tags.html.twig', [
            'tags' => $tags,
        ]);
    }

    #[Route('/tags/add', name: 'admin_tag_add', methods: ['POST'])]
    public function tagAdd(Request $request, EntityManagerInterface $em): Response
    {

        $name = $request->request->get('name');
        $tag = new Tag();
        $tag->setTagName($name);

        $em->persist($tag);
        $em->flush();

        return $this->redirectToRoute('admin_tags');
    }

    #[Route('/tags/edit/{id}', name: 'admin_tag_edit', methods: ['POST'])]
    public function tagEdit(
        Request $request,
        Tag $tag,
        EntityManagerInterface $em): Response
    {

        $name = $request->request->get('name');
        $tag->setTagName($name);
        $em->flush();

        return $this->redirectToRoute('admin_tags');
    }

    #[Route('/tags/delete/{id}', name: 'admin_tag_delete', methods: ['POST'])]
    public function tagDelete(
        Request $request,
        Tag $tag,
        EntityManagerInterface $em): Response
    {

        $em->remove($tag);
        $em->flush();

        return $this->redirectToRoute('admin_tags');
    }

}
