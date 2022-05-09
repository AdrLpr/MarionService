<?php

declare(strict_types=1);

namespace App\Controller\front;

use App\Repository\PrestationRepository;
use App\Repository\TarifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecretariatController extends AbstractController
{
    #[Route("/secretariat", name:"app_secretariat_show")]
    public function show(): Response
    {
        return $this->render("front/secretariat/show.html.twig");
    }

    #[Route("/secretariat/prestation", name:"app_secretariat_prestation")]
    public function prestation(PrestationRepository $repositoryPresta): Response
    {
        $prestations=$repositoryPresta->findByChoix(true);
        return $this->render("front/secretariat/prestation.html.twig", [
            'prestations'=>$prestations
        ]);
    }

    #[Route("/secretariat/tarif", name:"app_secretariat_tarif")]
    public function tarif(TarifRepository $repositoryTarif): Response
    {
        $tarifs=$repositoryTarif->findByChoix(true);
        return $this->render("front/secretariat/tarif.html.twig", [
            'tarifs'=>$tarifs
        ]);
    }
}
