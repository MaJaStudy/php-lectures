<?php

namespace App\Controller;

use App\Model\Task;
use App\Repository\TaskRepositoryInterface;

class TaskController {

    private TaskRepositoryInterface $repository;
    private array $tasks;

    public function __construct(TaskRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function list() {
        $tasks = $this->repository->findAll();
        require __DIR__ . '/../View/task_list.php';
        return;
    }

    public function add(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $title = trim($_POST['title']??'');
            if ($title === '')
            {
                $err = 'Пустая задача';
                require __DIR__ . '/../View/task_form.php';
                return;
            }
            $task = new Task($title);
            $this->repository->add($task);
        }
    }

    public function getTasks()  {
        return $this->repository->findAll();
    }
}