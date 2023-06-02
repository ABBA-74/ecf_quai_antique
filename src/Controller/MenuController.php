<?php

namespace App\Controller;

use App\Entity\MenuFormula;
use App\Repository\MenuFormulaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function index(MenuFormulaRepository $menuFormulaRepo): Response
    {

        $menus = $menuFormulaRepo->findBy(['isMenu'=> true]);
        $formules = $menuFormulaRepo->findBy(['isMenu'=> false]);

        return $this->render('menu/index.html.twig', [
            'menus' => $menus,
            'formules' => $formules,
        ]);
    }
}
