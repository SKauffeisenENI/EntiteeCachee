<?php

namespace App\Repository;

use App\Entity\MotMystere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MotMystere>
 *
 * @method MotMystere|null find($id, $lockMode = null, $lockVersion = null)
 * @method MotMystere|null findOneBy(array $criteria, array $orderBy = null)
 * @method MotMystere[]    findAll()
 * @method MotMystere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotMystereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MotMystere::class);
    }

    public function add(MotMystere $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MotMystere $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return MotMystere[] Returns an array of MotMystere objects
    */
   public function findMotRestant($equipe): array
   {
        $query = "SELECT mot.id, mot.mot, mot.equipe
            FROM App\Entity\MotMystere mot
            WHERE m.mot NOT IN (SELECT m.mot
            FROM App\Entity\MotMystere m
            RIGHT JOIN `equipe_mot_mystere` em on em.mot_mystere_id = m.id
            WHERE em.equipe_id = :equipe)
            ; ";
       return $this->getEntityManager()->createQuery($query)
           ->setParameter('equipe', $equipe)
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?MotMystere
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
