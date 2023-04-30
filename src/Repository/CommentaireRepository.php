<?php

namespace App\Repository;

use App\Entity\BlogPost;
use App\Entity\Commentaire;
use App\Entity\Peinture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commentaire>
 *
 * @method Commentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaire[]    findAll()
 * @method Commentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaire::class);
    }

    public function save(Commentaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Commentaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param Peinture|BlogPost $entity
     * @return Commentaires[] qui contient tous les commentaire faites pour la peinture ou le blogpost 
     * donner en parametre
     */
    public function findCommentaires(Peinture|BlogPost $entity){
        if($entity instanceof BlogPost){
            $link = "blogpost";
        }else{
            $link = "peinture";
        }

        return $this
            ->createQueryBuilder('c')
            ->andWhere('c.isPublished = true')
            ->andWhere('c.'.$link.' = :val')
            ->setParameter('val', $entity->getId())
            ->orderBy('c.id', "DESC")
            ->getQuery()
            ->getResult()
            ;
    }
}
