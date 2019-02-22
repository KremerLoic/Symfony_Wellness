<?php

namespace App\Repository;

use App\Entity\Provider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
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
     * @return Provider[]
     */
    public function findByNameCpService($searchName,$searchLocality,$searchService){

        $qb = $this->createQueryBuilder('p');

        $qb->leftJoin('p.photo','photo');
        $qb->addSelect('photo');


        if($searchName !== ''){
            $qb->andWhere('p.name LIKE :value');
            $qb->setParameter('value', '%'.$searchName.'%');
        }

        if($searchService !== ''){
            $qb->leftJoin('p.services', 'services');
            $qb->addSelect('services');
            $qb->andWhere('services.name LIKE :value');
            $qb->setParameter('value', '%'.$searchService.'%' );
        }

        if($searchLocality !== ''){
            $qb->leftJoin('p.locality', 'locality');
            $qb->addSelect('locality');
            $qb->andWhere('locality.locality LIKE :value');
            $qb->setParameter('value', '%'.$searchLocality.'%');
        }

        $result = $qb->getQuery()->getResult();
        return $result;



    }



    public function findAllProviders(){
        $qb = $this->createQueryBuilder('p');
            $result= $qb->getQuery()->getResult();
            return  $result;


    }

}
