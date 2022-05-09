<?php

declare(strict_types=1);

namespace App\Controller\front;

use App\Repository\ExperienceRepository;
use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name:'app_home_home')]
    public function home() : Response
    {
        return $this->render("front/home/home.html.twig");
    }
}
