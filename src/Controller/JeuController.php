<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\JeuManager\JeuManagerHelper;
use App\Repository\EquipeRepository;
use App\Repository\MotMystereRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class JeuController extends AbstractController
{
    /**
     * @Route("/", name="app_jeu")
     */
    public function index(MotMystereRepository $mmRepo): Response
    {
        $user = $this->getUser();
        $listeMotTrouver = $user->getMotsValide();
        dump($listeMotTrouver->toArray());
        $listeMot = $mmRepo->findAll();
        $listeMotDiff = array_udiff($listeMot, $listeMotTrouver->toArray(), function ($a, $b) {
            if ($a->getId() == $b->getId()) {
                return 0;
            } else {
                return 1;
            }
        });
        dump($listeMotDiff);
        return $this->render('jeu/index.html.twig', [
            'listeMot' => $listeMotDiff
        ]);
    }

    /**
     * @Route("/affichage", name="app_jeu_affichage")
     */
    public function affichage(EquipeRepository $equipeRepo): Response
    {
        $equipes = $equipeRepo->findAll();
        return $this->render('jeu/affichage.html.twig', [
            "equipes" => $equipes
        ]);
    }

    /**
     * @Route("/reponse/{id}", name="app_jeu_reponse")
     */
    public function reponse($id, Request $req, MotMystereRepository $mmRepo, EntityManagerInterface $em, JeuManagerHelper $jmh): Response
    {
        $mot = $mmRepo->find($id);
        $user = $this->getUser()->addMotsValide($mot);
        $em->persist($user);
        $em->flush();
        return $this->render('jeu/reponse.html.twig', [
            'mot' => $mot,
            'isBonneReponse' => $jmh->checkReponse($mot, $req->query->get("equipe"))
        ]);
    }
    
}
