<?php

namespace App\Service;

use Symfony\Bridge\Doctrine\ManagerRegistry;

class DoctrineService
{
    public $doctrine;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->doctrine = $managerRegistry;
    }
}