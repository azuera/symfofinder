<?php

namespace App\Controller;

use App\Entity\CharacterSheet;
use App\Form\CharacterSheetType;
use App\Repository\CharacterSheetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterSheetController extends AbstractController
{
    #[Route('/character/sheet/{id}', name: 'app_character_sheet', requirements: ['id' => '\d+'])]
    public function index(CharacterSheetRepository $characterSheetRepository, CharacterSheet $characterSheet): Response
    {
        return $this -> render('character_sheet/index.html.twig', [
            'characterSheet' => $characterSheet,

        ]);

    }
#[Route("characterSheet/new", name: "app_characterSheet_new")]
#[Route('characterSheet/modifier/{id}', name: 'app_characterSheet_update', requirements:['id'=>'\d+'])]
public function manageCharacterSheet(Request $request,EntityManagerInterface $entityManager, ?CharacterSheet $characterSheet = null): Response
{
    if (is_null($characterSheet)){
        $characterSheet = new CharacterSheet();
    }

    $form = $this -> createForm(CharacterSheetType::class, $characterSheet);
    $form -> handleRequest($request);


    if ($form -> isSubmitted() && $form -> isValid()) {

        $entityManager->persist($characterSheet);
        $entityManager->flush();


        $this -> addFlash('success', 'Donnée insérée');

        return $this->redirectToRoute('app_user_index');
    }
 return $this->render('character_sheet/new.html.twig',[
     'form'=> $form->createView(),
 ]);
}
}
