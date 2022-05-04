<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Experience;
use App\Form\ExperienceType;
use App\Repository\ExperienceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExperienceAdminController extends AbstractController
{
    #[Route('/admin/experience', name:'app_admin_experience_retrieve')]
     public function retrieve(ExperienceRepository $repository): Response
     {
         $experiences=$repository->findAll();

         return $this->render('admin/experience/retrieve.html.twig', [
             'experiences'=>$experiences
         ]);
     }

     #[Route('/admin/experience/create', name:'app_admin_experience_create')]
     public function create(ExperienceRepository $repository, Request $request): Response
     {
        $form = $this->createForm(ExperienceType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $repository->add($form->getData());
            
            return $this->redirectToRoute("app_admin_experience_retrieve");
        }

        $formView = $form->createView();
        return $this->render('admin/experience/create.html.twig', [
            'formView'=>$formView
        ]);
     }

     #[Route("/admin/experience/{id}/update", name:'app_admin_experience_update')]
     public function update(ExperienceRepository $repository, Request $request, Experience $experience ): Response
     {
         
        if (!$experience){
            return new Response("Cette expérience n'existe pas", 404);
        }

        $form = $this->createForm(ExperienceType::class, $experience);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $repository->add($form->getData());
            
            return $this->redirectToRoute("app_admin_experience_retrieve");
        }
        $formView = $form->createView();

        return $this->render('admin/experience/update.html.twig', [
            'formView' => $formView,
        ]);
     }

     #[Route('/admin/experience/{id}/delete', name:'app_admin_experience_delete')]
     public function delete(ExperienceRepository $repository, Experience $experience): Response
     {
        if (!$experience){
            return new Response("Cette expérience n'existe pas", 404);
        }

        $repository->remove($experience);

        return $this->redirectToRoute("app_admin_experience_retrieve");
     }
}
