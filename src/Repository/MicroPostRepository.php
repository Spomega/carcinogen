<?php

namespace App\Repository;

use App\Entity\MicroPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MicroPost>
 */
class MicroPostRepository extends ServiceEntityRepository implements MicroPostRepositoryInterface
{
    public function __construct(ManagerRegistry $registry,private EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, MicroPost::class);
    }

    public function findAllPost(): array
    {
        return $this->findAll();
    }

    //    /**
    //     * @return MicroPost[] Returns an array of MicroPost objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?MicroPost
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function findPostById(int $id): ?array
    {
        return $this->findBy(['id' => $id]);
    }

    public function savePost(MicroPost $microPost): void
    {
        $this->entityManager->persist($microPost);
        $this->entityManager->flush();
    }
}
