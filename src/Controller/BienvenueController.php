<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienvenueController extends AbstractController
{
    #[Route('/welcome', name: 'app_bienvenue')]
    public function bienvenue(): Response
    {
        // Appel à la vue
        return $this->render('bienvenue/index.html.twig');
    }

    #[Route('/bienvenue/{prenom}', name: 'app_bienvenue_prenom')]
    public function bienvenuePrenom(string $prenom): Response
    {
        // Appel à la vue
        return $this->render('bienvenue/index.html.twig', [
            "prenom" => $prenom
        ]) ;
    }

    #[Route('/bienvenues', name: 'app_bienvenues')]
    public function bienvenues(): Response
    {
        // Appel simulé au modele
        $personnes = ["jean","paul","anne","julie"] ;

        // Appel à la vue
        return $this->render('bienvenue/bienvenues.html.twig', [
            "personnes" => $personnes
        ] );

    }
}
