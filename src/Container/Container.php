<?php

namespace App\Container;

use App\Repository\{TaskRepositoryInterface,FileTaskRepository,InMemoryTaskRepository,MySqlTaskRepository};
use Exception;
use PDO;

class Container {
    

    private array $definitions = [];
    private array $config = ['repository'];
 
/*     public function __construct(array $config){
        $this->config = $config;
    } */

    public function set (string $id, callable $callable): void {
        $this->definitions[$id] = $callable;
    }

    public function get (string $id): mixed {
        if (!isset($this->definitions[$id])) {
            throw $this->definitions[$id] = $this->create($id);
        }
        return $this->definitions[$id]($this);
    }
    
    

    public function create (string $id)
    {
        switch ($id) {
            case PDO::class:
                $db = $this->config['db'];
            return new PDO($db['dsn'], $db['user'],$db['pass'],$db['options']??[]);
            
            case FileTaskRepository::class:
                return new FileTaskRepository($this->config['storage']['file']);
            case MySqlTaskRepository::class:
                return new MySqlTaskRepository($this->get(PDO::class));
            case InMemoryTaskRepository::class:
                $repos = $this->config['repository']??'memory';
                return match ($repos) {
                    'musql' => $this->get(MySqlTaskRepository::class),
                    'file' => $this->get(FileTaskRepository::class),
                    default => $this->get(InMemoryTaskRepository::class)
                };
            default:
            throw new Exception('Ошибка ID: $id');
        }
    }
}