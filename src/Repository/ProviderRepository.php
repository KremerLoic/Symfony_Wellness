<?php

namespace App\Repository;

use App\Entity\Provider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Provider|null find($id, $lockMode = null, $lockVersion = null)
 * @method Provider|null findOneBy(array $criteria, array $orderBy = null)
 * @method Provider[]    findAll()
 * @method Provider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProviderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Provider::class);
    }

    /**
     * @param $name
     * @return Provider[]
     */
    public function findProviderByName($request)
    {

        $qb = $this->createQueryBuilder('p')


           ->andWhere('p.name = :name')
                ->setParameter('name', $request)
                ->getQuery();

        return $qb->getResult();




    }

    public function findProviderByLocality($locality)
    {
        $qb = $this->createQueryBuilder('l')
            ->andWhere('l.locality = :locality')
            ->setParameter('locality',$locality)
            ->getQuery();
        return $qb->getResult();
    }
}
