<?php

declare(strict_types=1);

namespace App\Controller\front;

use App\Repository\ExperienceRepository;
use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresentationController extends AbstractController
{
    #[Route("/presentation", name:"app_presentation_show")]
    public function show(ExperienceRepository $repositoryEx, RealisationRepository $repositoryRea): Response
    {
        $experiences = $repositoryEx->findAll();
        $realisations = $repositoryRea->findAll();

        return $this->render("front/presentation/show.html.twig", [
            'experiences' => $experiences, 'realisations'=>$realisations
        ]);
    }
}
