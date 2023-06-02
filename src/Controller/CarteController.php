<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    #[Route('/carte', name: 'app_carte')]
    public function index(ProductRepository $productRepo): Response
    {
        $starterDishes = $productRepo->findAllStarterDishes();
        $mainCourses = $productRepo->findAllMainCourses();
        $desserts = $productRepo->findAllDesserts();
        $aperitifs = $productRepo->findAllAperitifs();
        $wins = $productRepo->findAllWins();
        $digestifs = $productRepo->findAllDigestifs();

        $productsByCategory = $productRepo->findAllProductsByCategory();

        return $this->render('carte/index.html.twig', [
            'starterDishes' => $starterDishes,
            'mainCourses' => $mainCourses,
            'desserts' => $desserts,
            'aperitifs' => $aperitifs,
            'wins' => $wins,
            'digestifs' => $digestifs,
            'productsByCategory' => $productsByCategory
        ]);
    }
}
