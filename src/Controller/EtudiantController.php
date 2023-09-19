<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    #[Route('/etudiants', name: 'app_etudiant_list')]
    public function list(EtudiantRepository $etudiantRepository): Response
    {
        // Appel au modèle
        //  Le controller va demander au modele la liste des étudiants
        $etudiants =  $etudiantRepository->findAll() ;

        // Appel a la vue
        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants ,
        ]);
    }

    #[Route('/etudiant/{id}', name: 'app_etudiant_id')]
    public function detailEtudiant(EtudiantRepository $etudiantRepository, $id): Response
    {
        $etudiant = $etudiantRepository->find($id) ;

        // Appel à la vue
        return $this->render('etudiant/detailEtudiant.html.twig', [
            'etudiant' => $etudiant
        ]) ;
    }

}

