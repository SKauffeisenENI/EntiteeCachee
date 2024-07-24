<?php

namespace App\Controller;

use App\Entity\MotMystere;
use App\Form\MotMystereType;
use App\Repository\MotMystereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjoutMotController extends AbstractController
{
    /**
     * @Route("/ajout/mot", name="app_ajout_mot")
     */
    public function ajouter(RequestStack $requestStack, MotMystereRepository $mmRepo): Response
    {
        $req = $requestStack->getMainRequest();
        dump($req);
        $motMystere = new MotMystere();
        $form = $this->createForm(MotMystereType::class, $motMystere);
        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {
            $mmRepo->add($motMystere, true);
            //TODO: ajouter une popup quand un mot est ajouter
            //return $this->redirectToRoute('app_jeu');
        } else if($form->isSubmitted()){
            //return $this->redirectToRoute('app_jeu');
        }

        return $this->render('ajout_mot/ajouter.html.twig', [
            "form" => $form->createView()
        ]);
    }

    
    /**
     * @Route("/enlever/mot/{id}", name="app_enlever_mot")
     */
    public function enlever($id, MotMystereRepository $mmRepo): Response
    {
        //TODO: mettre un try catch
        $mot = $mmRepo->find($id);
        $mmRepo->remove($mot, true);
        //TODO: ajouter une popup quand un mot est enlever

        return $this->json([
            'message' => $mot->getMot().' a été supprimer',
            'enlever' => true
        ]);
    }
}
