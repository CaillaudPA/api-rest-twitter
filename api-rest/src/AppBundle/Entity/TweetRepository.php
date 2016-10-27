<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TweetRepository extends EntityRepository
{
    public function findAllIds()
    {
        $query = $this	->createQueryBuilder('t');
        $query 	->select('t')
        		->getQuery()
        		->getResult();

	    return $query;
    }
}