<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use \Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    public function queryCategoriesGroupByCirclesByUser(User $user)
    {
        $qb = $this->createQueryBuilder('category')
            ->join('category.sector','sector')
            ->join('sector.circle', 'circle')
            ->where('circle.user = :user')
            ->setParameter('user',$user)
            ->orderBy('category.name', 'ASC');

        return $qb;
    }
}
