<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Prestation;
use App\Form\PrestationType;
use App\Repository\PrestationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//limite l'accès à la page aux admins
// #[IsGranted('ROLE_ADMIN')]
class PrestationAdminController extends AbstractController
{
    #[Route('/admin/prestation', name:'app_admin_prestation_retrieve')]
     public function retrieve(PrestationRepository $repository): Response
     {
         $prestations=$repository->findAll();//retrieve

         return $this->render('admin/prestation/retrieve.html.twig', [
             'prestations'=>$prestations
         ]);
     }

     #[Route('/admin/prestation/create', name:'app_admin_prestation_create')]
     public function create(PrestationRepository $repository, Request $request): Response
     {
        $form = $this->createForm(PrestationType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $repository->add($form->getData());
            
            return $this->redirectToRoute("app_admin_prestation_retrieve");
        }

        $formView = $form->createView();
        return $this->render('admin/prestation/create.html.twig', [
            'formView'=>$formView
        ]);
     }
     
     #[Route("/admin/prestation/{id}/update", name:'app_admin_prestation_update')]
     public function update(PrestationRepository $repository, Request $request, Prestation $prestation ): Response
     {
         
        if (!$prestation){
            return new Response("Cette expérience n'existe pas", 404);
        }

        $form = $this->createForm(PrestationType::class, $prestation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $repository->add($form->getData());
            
            return $this->redirectToRoute("app_admin_prestation_retrieve");
        }
        $formView = $form->createView();

        return $this->render('admin/prestation/update.html.twig', [
            'formView' => $formView,
        ]);
     }

     #[Route('/admin/prestation/{id}/delete', name:'app_admin_prestation_delete')]
     public function delete(prestationRepository $repository, prestation $prestation): Response
     {
        if (!$prestation){
            return new Response("Cette prestation n'existe pas", 404);
        }

        $repository->remove($prestation);

        return $this->redirectToRoute("app_admin_prestation_retrieve");
     }
}
