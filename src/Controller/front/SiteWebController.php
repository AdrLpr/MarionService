<?php

declare(strict_types=1);

namespace App\Controller\front;

use App\Repository\PrestationRepository;
use App\Repository\TarifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteWebController extends AbstractController
{
    #[Route("/siteWeb", name:"app_siteWeb_show")]
    public function show(PrestationRepository $repositoryPresta): Response
    {
        $prestations=$repositoryPresta->findByChoix(false);
        return $this->render("front/site_web/show.html.twig",[
            'prestations'=>$prestations
        ]);
    }

    // #[Route("/siteWeb/prestation", name:"app_siteWeb_prestation")]
    // public function prestation(PrestationRepository $repositoryPresta): Response
    // {
    //     $prestations=$repositoryPresta->findByChoix(false);
    //     return $this->render("front/site_web/prestation.html.twig",[
    //         'prestations'=>$prestations
    //     ]);
    // }

    #[Route("/siteWeb/tarif", name:"app_siteWeb_tarif")]
    public function tarif(TarifRepository $repositoryTarif): Response
    {
        $tarifs=$repositoryTarif->findByChoix(false);

        return $this->render("front/site_web/tarif.html.twig", [
            'tarifs'=> $tarifs
        ]);
    }
}


