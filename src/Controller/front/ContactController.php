<?php

declare(strict_types=1);

namespace App\Controller\front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route("/contact", name:"app_contact_show")]
    public function show(): Response
    {
        return $this->render("front/contact/show.html.twig");
    }
}
