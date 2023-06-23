<?php

namespace App\Repository;

use App\Entity\CharacterSheet;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CharacterSheet>
 *
 * @method CharacterSheet|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacterSheet|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacterSheet[]    findAll()
 * @method CharacterSheet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterSheetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacterSheet::class);
    }

    public function save(CharacterSheet $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CharacterSheet $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findUserCharacterSheet(User $user): array
    {
        return $this
            ->createQueryBuilder('c')
            ->andWhere('c.CharacterSheetUser=:id')
            ->setParameter('id', $user->getId())
            ->getQuery()
            ->getResult()
        ;
    }

    //    public function findOneBySomeField($value): ?CharacterSheet
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
