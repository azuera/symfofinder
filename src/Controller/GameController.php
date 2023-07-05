<?php

namespace App\Controller;
use App\Entity\CharacterSheet;
use App\Entity\Game;
use App\Entity\GameMaster;
use App\Form\AddCharacterType;
use App\Form\GameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class GameController extends AbstractController
{
    #[Route('/game', name: 'app_game_index')]
    #[IsGranted('ROLE_GAMEMASTER')]
    public function index(): Response
    {

        return $this->render('game/index.html.twig', [
        ]);
    }


    #[Route('/game/{id}', name: 'app_game', requirements: ['id' => '\d+'])]
    #[IsGranted('ROLE_GAMEMASTER')]
    public function showOne(Request $request, EntityManagerInterface $entityManager,  ?Game $game = null ): Response
    {


        $form = $this -> createForm(AddCharacterType::class, $game);
        $form -> handleRequest($request);


        if ($form -> isSubmitted() && $form -> isValid()) {

            $entityManager -> persist($game);
            $entityManager -> flush();


            $this -> addFlash('success', 'Donnée insérée');

            return $this -> redirectToRoute('app_game_index');
        }

        return $this->render('game/id.html.twig', [
            'game' => $game,
            'form' => $form -> createView(),


        ]);
    }


    #[Route("/game/new", name: "app_game_new")]
    #[Route('game/modifier/{id}', name: 'app_game_update', requirements: ['id' => '\d+'])]
    public function manageCharacterSheet(Request $request, EntityManagerInterface $entityManager, ?Game $game = null): Response
    {
        if (is_null($game)) {
            /** @var GameMaster $gameMaster */
            $gameMaster = $this ->getUser();
            $game = new Game();
            $game -> setGameMaster($gameMaster);

        }

        $form = $this -> createForm(GameType::class, $game);
        $form -> handleRequest($request);


        if ($form -> isSubmitted() && $form -> isValid()) {

            $entityManager -> persist($game);
            $entityManager -> flush();


            $this -> addFlash('success', 'Donnée insérée');

            return $this -> redirectToRoute('app_game_index');
        }
        return $this -> render('game/new.html.twig', [
            'form' => $form -> createView(),
        ]);
    }
}
