<?php

namespace App\Controller;

use App\Entity\CharacterSheet;
use App\Entity\Equipement;
use App\Entity\Skill;
use App\Entity\User;
use App\Form\CharacterSheetType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterSheetController extends AbstractController
{
    #[Route('/character/sheet/{id}', name: 'app_character_sheet', requirements: ['id' => '\d+'])]
    public function index(CharacterSheet $characterSheet): Response
    {


        return $this -> render('character_sheet/index.html.twig', [
            'characterSheet' => $characterSheet,

        ]);

    }

    #[Route("characterSheet/new", name: "app_characterSheet_new")]
    #[Route('characterSheet/modifier/{id}', name: 'app_characterSheet_update', requirements: ['id' => '\d+'])]
    public function manageCharacterSheet(Request $request, EntityManagerInterface $entityManager, ?CharacterSheet $characterSheet = null): Response
    {
        if (is_null($characterSheet)) {
            /** @var User $user */
            $user = $this -> getUser();
            $characterSheet = new CharacterSheet();
            $characterSheet -> setCharacterSheetUser($user);
            $equipement = new Equipement();
            $characterSheet->addEquipement($equipement);
            $skill = new Skill();
            $characterSheet->addSkill($skill);
        }

        $form = $this -> createForm(CharacterSheetType::class, $characterSheet);
        $form -> handleRequest($request);


        if ($form -> isSubmitted() && $form -> isValid()) {

            $entityManager -> persist($characterSheet);
            $entityManager -> flush();


            $this -> addFlash('success', 'Donnée insérée');

            return $this -> redirectToRoute('app_user_index');
        }
        return $this -> render('character_sheet/new.html.twig', [
            'form' => $form -> createView(),
        ]);
    }
    #[Route('/character/sheet/remove/{id}', name: 'app_character_sheet_remove', requirements: ['id' => '\d+'])]
    public function remove(CharacterSheet $characterSheet , EntityManagerInterface $entityManager): Response
    {

        $entityManager->remove($characterSheet);
        $entityManager->flush();

        return $this -> redirectToRoute('app_user_index');


    }
    #[Route('/character/sheet/skill/remove/{id}', name: 'app_character_sheet_remove_skill', requirements: ['id' => '\d+'])]
    public function removeSkill(Skill $skill , EntityManagerInterface $entityManager): Response
    {

        $entityManager->remove($skill);
        $entityManager->flush();

        return $this -> redirectToRoute('app_user_index');


    }
    #[Route('/character/sheet/equipement/remove/{id}', name: 'app_character_sheet_remove_equipement', requirements: ['id' => '\d+'])]
    public function removeEquipement(Equipement $equipement , EntityManagerInterface $entityManager): Response
    {

        $entityManager->remove($equipement);
        $entityManager->flush();

        return $this -> redirectToRoute('app_user_index');


    }
}
