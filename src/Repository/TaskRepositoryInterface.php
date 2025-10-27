<?php

namespace App\Repository;

use App\Model\Task;

interface TaskRepositoryInterface
{
    public function findAll(): array;
    public function add($task): void;
}