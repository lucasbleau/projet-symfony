<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use App\Repository\PromotionRepository;
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

    #[Route('/etudiants/{id}', name: 'app_etudiant_id', requirements:['id' => '\d+'])]
    public function detailEtudiant(EtudiantRepository $etudiantRepository,int $id): Response
    {
        $etudiant = $etudiantRepository->find($id) ;
        $nomPromotion = $etudiant->getPromotion()->getNom();
        $anneePromotion = $etudiant->getPromotion()->getAnnee();

        // Appel à la vue
        return $this->render('etudiant/detailEtudiant.html.twig', [
            'etudiant' => $etudiant ,
            'nomPromotion' => $nomPromotion ,
            'anneePromotion' => $anneePromotion
        ]) ;
    }

    #[Route('/etudiants/mineurs', name: 'app_etudiant_mineurs_list')]
    public function listMineurs(EtudiantRepository $etudiantRepository): Response
    {
        // Appel au modèle
        $etudiants = $etudiantRepository->findMineurs2();

        // Appel à la vue
        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants
        ]) ;
    }

}

