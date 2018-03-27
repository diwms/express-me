<?php
declare(strict_types=1);

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\PostEntity;

class PostRepository extends EntityRepository
{
    public function findAll()
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder  = $entityManager->createQueryBuilder();

        $queryBuilder->select('p')->from(PostEntity::class, 'p');

        return $queryBuilder->getQuery();
    }
}
