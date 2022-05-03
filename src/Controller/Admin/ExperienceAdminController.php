<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Repository\ExperienceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     public function create(ExperienceRepository $repository): Response
     {
         return $this->render('admin/experience/create.html.twig',);
     }
}
