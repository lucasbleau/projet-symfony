<?php

namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Etudiant>
 *
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

    // Methode permettant de rechercher tout les étudiants mineurs
    public function findMineurs() : array {
        // Uiliser le langage DQL
        // Exprimer des requêtes se basant sur le modèle objet (Entity)
        // La requête DQL sera transformé en une requête SQL par doctrine lors de l'éxecution de la méthode
        $dateMajorite = new \DateTime("-18 years");

        // 1. Exprimer la requête DQL

        $requeteDQL =   "SELECT etudiant FROM App\Entity\Etudiant as etudiant 
                         WHERE etudiant.dateNaissance > :dateMajorite" ;

        // 2. Construire la requête (représentation objet de la requête)
        $requete = $this->getEntityManager()->createQuery($requeteDQL) ;

        // 3. Donner une valeur au parametre  de la requête (:dateMajorite)
        $requete->setParameter('dateMajorite', $dateMajorite) ;

        // 4. Executer la requête et retourner le resultat
        return $requete->getResult() ;
    }

    public function findMineurs2() : array {
        // Utiliser le query builder : classe permettant de construire dynamiquement des requêtes DQL

        $dateMajorite = new \DateTime("-18 years") ;
        return $this->createQueryBuilder("e")
                    ->where('e.dateNaissance > :dateMajorite')
                    ->setParameter('dateMajorite', $dateMajorite)
                    ->getQuery()
                    ->getResult();
    }


//    /**
//     * @return Etudiant[] Returns an array of Etudiant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Etudiant
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
