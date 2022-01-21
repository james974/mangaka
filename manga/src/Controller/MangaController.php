<?php

namespace App\Controller;

use App\Entity\Manga;
use App\Form\MangaType;
use App\Repository\MangaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;





/**
 * @IsGranted("ROLE_USER")
 * @Route("/manga")
 */

class MangaController extends AbstractController
{
/**
 * @IsGranted("ROLE_USER")
 * @Route("/", name="manga_index", methods={"GET"})
 */
public function index(MangaRepository $mangaRepository): Response
    {
        return $this->render('manga/index.html.twig', [
            'mangas' => $mangaRepository->findAll(),
        ]);
    }

 /**
  * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="manga_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $manga = new Manga();
        $form = $this->createForm(MangaType::class, $manga);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($manga);
            $entityManager->flush();

            return $this->redirectToRoute('manga_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('manga/new.html.twig', [
            'manga' => $manga,
            'form' => $form,
        ]);
    }
    
     /**
      * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="manga_show", methods={"GET"})
     */
    public function show(Manga $manga): Response
    {
        return $this->render('manga/show.html.twig', [
            'manga' => $manga,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="manga_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Manga $manga, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MangaType::class, $manga);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('manga_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('manga/edit.html.twig', [
            'manga' => $manga,
            'form' => $form,
        ]);
    }

     /**
      * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="manga_delete", methods={"POST"})
     */
    public function delete(Request $request, Manga $manga, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$manga->getId(), $request->request->get('_token'))) {
            $entityManager->remove($manga);
            $entityManager->flush();
        }

        return $this->redirectToRoute('manga_index', [], Response::HTTP_SEE_OTHER);
    }

      /**
      * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="manga_delete", methods={"POST"})
     */
    public function search(Request $request, Manga $manga, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$manga->getId(), $request->request->get('_token'))) {
            $entityManager->remove($manga);
            $entityManager->flush();
        }

        return $this->redirectToRoute('manga_index', [], Response::HTTP_SEE_OTHER);
    }



}
        
        


