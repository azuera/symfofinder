<?php

namespace App\Controller;

use App\Entity\CharacterSheet;
use App\Entity\Equipement;
use App\Form\EquipementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Sodium\add;

class EquipementController extends AbstractController
{
    #[Route('/equipement', name: 'app_equipement')]
    public function index(): Response
    {
        return $this->render('equipement/index.html.twig', [
            'controller_name' => 'EquipementController',
        ]);
    }
    #[Route("equipement/new/{id}", name: "app_equipement_new")]
    #[Route('equipement/modifier/{id}', name: 'app_equipement_update', requirements:['id'=>'\d+'])]
    public function manageCharacterSheet(Request $request,EntityManagerInterface $entityManager,CharacterSheet $characterSheet, ?Equipement $equipement = null): Response
    {
        if (is_null($equipement)){
            $equipement = (new Equipement())->setCharacterSheet($characterSheet)

            ;

        }

        $form = $this -> createForm(EquipementType::class, $equipement);
        $form -> handleRequest($request);


        if ($form -> isSubmitted() && $form -> isValid()) {

            $entityManager->persist($equipement);
            $entityManager->flush();


            $this -> addFlash('success', 'Donnée insérée');

            return $this->redirectToRoute('app_user_index');
        }
        return $this->render('equipement/index.html.twig',[
            'form'=> $form->createView(),
        ]);
    }
}
