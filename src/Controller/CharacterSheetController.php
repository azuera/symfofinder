<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterSheetController extends AbstractController
{
    #[Route('/character/sheet', name: 'app_character_sheet')]
    public function index(): Response
    {
        return $this->render('character_sheet/index.html.twig', [
            'controller_name' => 'CharacterSheetController',
        ]);
    }
}
