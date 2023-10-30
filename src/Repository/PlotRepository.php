<?php

namespace App\Repository;

use App\Entity\Plot;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Plot>
 *
 * @method Plot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plot[]    findAll()
 * @method Plot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plot::class);
    }

    /**
     * @param array<string> $plotIds
     *
     * @return array<Plot>
     */
    public function getByIds(array $plotIds): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.plotId IN (:plotIds)')
            ->andWhere('p.createdAt <= :date')
            ->setParameters([
                'plotIds' => $plotIds,
                'date' => new DateTimeImmutable('-1 hour'),
            ])->getQuery()
            ->getResult();
    }

    public function save(Plot $entity, bool $flush = false): Plot
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $entity;
    }

    public function remove(Plot $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
