<?php

namespace App\Controller;

use App\Entity\CharacterSheet;
use App\Entity\Skill;
use App\Form\SkillType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SkillController extends AbstractController
{
    #[Route('/skill', name: 'app_skill')]
    public function index(): Response
    {
        return $this->render('skill/index.html.twig', [
            'controller_name' => 'SkillController',
        ]);
    }
    #[Route("skill/new/{id}", name: "app_skill_new", requirements:['id'=>'\d+'])]
    #[Route('skill/modifier/{id}', name: 'app_skill_update', requirements:['id'=>'\d+'])]
    public function manageCharacterSheet(Request $request,EntityManagerInterface $entityManager,CharacterSheet $characterSheet, ?Skill $skill = null): Response
    {
        if (is_null($skill)){
            $skill = (new Skill())->setCharacterSheet($characterSheet);
        }

        $form = $this -> createForm(SkillType::class, $skill);
        $form -> handleRequest($request);


        if ($form -> isSubmitted() && $form -> isValid()) {

            $entityManager->persist($skill);
            $entityManager->flush();


            $this -> addFlash('success', 'Donnée insérée');

            return $this->redirectToRoute('app_user_index');
        }
        return $this->render('skill/index.html.twig',[
            'form'=> $form->createView(),
            ]);
        }
}
