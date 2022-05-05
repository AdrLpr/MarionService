<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Tarif;
use App\Form\TarifType;
use App\Repository\TarifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TarifAdminController extends AbstractController
{
    #[Route('/admin/tarif', name:'app_admin_tarif_retrieve')]
     public function retrieve(TarifRepository $repository): Response
     {
         $tarifs=$repository->findAll();

         return $this->render('admin/tarif/retrieve.html.twig', [
             'tarifs'=>$tarifs
         ]);
     }

     #[Route('/admin/tarif/create', name:'app_admin_tarif_create')]
     public function create(tarifRepository $repository, Request $request): Response
     {
        $form = $this->createForm(tarifType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $repository->add($form->getData());
            
            return $this->redirectToRoute("app_admin_tarif_retrieve");
        }

        $formView = $form->createView();
        return $this->render('admin/tarif/create.html.twig', [
            'formView'=>$formView
        ]);
     }
     
     #[Route("/admin/tarif/{id}/update", name:'app_admin_tarif_update')]
     public function update(tarifRepository $repository, Request $request, Tarif $tarif ): Response
     {
         
        if (!$tarif){
            return new Response("Cette expérience n'existe pas", 404);
        }

        $form = $this->createForm(TarifType::class, $tarif);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $repository->add($form->getData());
            
            return $this->redirectToRoute("app_admin_tarif_retrieve");
        }
        $formView = $form->createView();

        return $this->render('admin/tarif/update.html.twig', [
            'formView' => $formView,
        ]);
     }

     #[Route('/admin/tarif/{id}/delete', name:'app_admin_tarif_delete')]
     public function delete(tarifRepository $repository, tarif $tarif): Response
     {
        if (!$tarif){
            return new Response("Cette tarif n'existe pas", 404);
        }

        $repository->remove($tarif);

        return $this->redirectToRoute("app_admin_tarif_retrieve");
     }
}

