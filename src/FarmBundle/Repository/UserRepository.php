<?php

namespace FarmBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{

    public function findUserByRoles()
    {
        $qb = $this->createQueryBuilder('p');
        $qb ->andWhere("p.roles LIKE '%ROLE_FARMER%'");

        $query = $qb->getQuery();

        $users = $query->getResult();
        return $users;
    }
}
