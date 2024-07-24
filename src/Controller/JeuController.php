<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Repository\MotMystereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JeuController extends AbstractController
{
    /**
     * @Route("/", name="app_jeu")
     */
    public function index(MotMystereRepository $mmRepo): Response
    {
        $listeMot = $mmRepo->findAll();
        return $this->render('jeu/index.html.twig', [
            'listeMot' => $listeMot,
        ]);
    }

    /**
     * @Route("/affichage", name="app_jeu_affichage")
     */
    public function affichage(): Response
    {
        $equipes = [
            new Equipe(),
            new Equipe(),
            new Equipe(),
            new Equipe()
        ];
        return $this->render('jeu/affichage.html.twig', [
            "equipes" => $equipes
        ]);
    }
}
