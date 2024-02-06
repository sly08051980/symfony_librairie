<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\LivresRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Livres;
use App\Form\LivresType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class LivresController extends AbstractController
{
    #[Route('/livres', name: 'app_livres')]
    public function index(LivresRepository $LivresRepository): Response
    {
       
        return $this->render('livres/index.html.twig', [
            'livres'=>$LivresRepository ->findAll(),
            
        ]);
    }
    #[Route('/livres/{id}/edit', name: 'livres_edit', methods: ['GET', 'POST'])]
    public function user_edit(Request $request, LivresRepository $livresRepository, Livres $livres, EntityManagerInterface $entityManager): Response
    {
      
        $form = $this->createForm(LivresType::class, $livres);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
            {
        
            $entityManager->flush();
            return $this->redirectToRoute('app_livres', [], Response::HTTP_SEE_OTHER);
            }

        return $this->render('livres/edit.html.twig', [
            'livres' => $livres,
            'form' => $form,
        ]);
    }
    #[Route('/livres/{id}/delete', name: 'livres_delete',methods: ['GET', 'POST'])]
    public function delete(Request $request, LivresRepository $livresRepository, Livres $livres, EntityManagerInterface $entityManager): Response
    {

        
    $entityManager->remove($livres);
    $entityManager->flush();
    return $this->redirectToRoute('app_livres', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/livres/create', name:'livres_create')]
    public function createLivre(Request $request,EntityManagerInterface $entityManager,LivresRepository $livresRepository):Response
    {

        $livres = new Livres();
        $form = $this->createForm(LivresType::class, $livres);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($livres);
            $entityManager->flush();
            return $this->redirectToRoute('app_livres', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('/livres/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
