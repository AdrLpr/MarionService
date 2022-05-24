<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Realisation;
use App\Form\RealisationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[IsGranted('ROLE_ADMIN')]
class RealisationAdminController extends AbstractController
{
    #[Route("/admin/realisation", name:'app_admin_realisation_retrieve')]
    public function retrieve(RealisationRepository $repository): Response
     {
         $realisations=$repository->findAll();

         return $this->render('admin/realisation/retrieve.html.twig', [
             'realisations'=>$realisations
         ]);
     }

     #[Route('/admin/realisation/create', name:'app_admin_realisation_create')]
     public function create(RealisationRepository $repository, Request $request, SluggerInterface $slugger): Response
     {
        $realisation = new Realisation();
        $form = $this->createForm(RealisationType::class, $realisation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();

            //condition néccésaire parce l'input n'est pas required
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // néccésaire pour inclure de manière sécurisé le nom du fichier dans l'url
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
            

            try {
                $imageFile->move(
                    $this->getParameter('img_rea'),
                    $newFilename
                );
            } catch (FileException $e)  
            {
                // si il y a une erreur
            }
            
            $realisation->setImage($newFilename);

            }

            $repository->add($form->getData());
            
            return $this->redirectToRoute("app_admin_realisation_retrieve");
        }

        $formView = $form->createView();
        return $this->render('admin/realisation/create.html.twig', [
            'formView'=>$formView
        ]);
     }

     #[Route("/admin/realisation/{id}/update", name:'app_admin_realisation_update')]
     public function update(RealisationRepository $repository, Request $request, Realisation $realisation, SluggerInterface $slugger): Response
     {
         
        if (!$realisation){
            return new Response("Cette expérience n'existe pas", 404);
        }

        $form = $this->createForm(RealisationType::class, $realisation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();

            //condition néccésaire parce l'input n'est pas required
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // néccésaire pour inclure de manière sécurisé le nom du fichier dans l'url
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
            

            try {
                $imageFile->move(
                    $this->getParameter('img_dir'),
                    $newFilename
                );
            } catch (FileException $e)  
            {
                // si il y a une erreur
            }
            
            $realisation->setImage($newFilename);

            }

            $repository->add($form->getData());
            
            return $this->redirectToRoute("app_admin_realisation_retrieve");
        }

        $formView = $form->createView();
        return $this->render('admin/realisation/create.html.twig', [
            'formView'=>$formView
        ]);
     }

     #[Route('/admin/realisation/{id}/delete', name:'app_admin_realisation_delete')]
     public function delete(RealisationRepository $repository, Realisation $realisation): Response
     {
        if (!$realisation){
            return new Response("Cette expérience n'existe pas", 404);
        }

        $repository->remove($realisation);

        return $this->redirectToRoute("app_admin_realisation_retrieve");
     }
}
