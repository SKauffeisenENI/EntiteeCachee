<?php

namespace App\JeuManager;

use App\Entity\Equipe;
use App\Entity\MotMystere;
use App\Repository\EquipeRepository;
use Doctrine\ORM\EntityManagerInterface;

class JeuManagerHelper
{
    private $equipes;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, EquipeRepository $equipeRepository)
    {
        $this->entityManager = $entityManager;
        $this->equipes = $equipeRepository->findAll();
    }

    public function manageScore(Equipe $equipe, MotMystere $mot ) {

    }

    public function checkReponse(MotMystere $mot, $equipeATester):bool
    {
        if(gettype($equipeATester) == "integer")
        {
            if($mot->getEquipe() == $equipeATester)
            {
                // on compte les points
                return true;
            }
        }
        return false;
    }
}