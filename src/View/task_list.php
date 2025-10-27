<?php

$tasks = $this->getTasks();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Лист Задач</title>
</head>

<body>
    <h1> Список задач</h1>
    <a href="?route=task/add">Добавить</a>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <?= htmlspecialchars($task->getTitle())?>
            </li>
            <?= $task->isCompleted() ? "✔" : "❌"?>
        </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>