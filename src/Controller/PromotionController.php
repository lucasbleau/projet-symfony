<?php

namespace App\Controller;

use App\Repository\PromotionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{
    #[Route('/promotion', name: 'app_promotion')]
    public function list(PromotionRepository $promotionRepository): Response
    {
        $promotions = $promotionRepository->findAll() ;


        return $this->render('promotion/index.html.twig', [
            'promotions' => $promotions
        ]);
    }
}
