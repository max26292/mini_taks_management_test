<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function getTasksByUser($user_id, $status = null)
    {
        $query = $this->createQueryBuilder('t')
            ->andWhere('t.user_id = :user_id')
            ->setParameter('user_id', $user_id);

        if ($status) {
            $query->andWhere('t.status = :status')
                ->setParameter('status', $status);
        }

        return $query->getQuery()->getResult();
    }
}
