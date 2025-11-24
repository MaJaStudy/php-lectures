<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Добавить задачу</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .mode-switcher {
            margin-bottom: 20px;
            text-align: center;
        }
        .mode-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 8px 16px;
            margin: 0 5px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .mode-btn.active {
            background: #007bff;
        }
        .mode-btn:hover {
            background: #0056b3;
            color: white;
            text-decoration: none;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-link {
            display: inline-block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="mode-switcher">
        <a href="?route=task/switch-mode&mode=mysql" class="mode-btn <?= ($_SESSION['repository_mode'] ?? 'mysql') === 'mysql' ? 'active' : '' ?>">
            MySQL режим
        </a>
        <a href="?route=task/switch-mode&mode=file" class="mode-btn <?= ($_SESSION['repository_mode'] ?? 'mysql') === 'file' ? 'active' : '' ?>">
            File режим
        </a>
    </div>

    <h1>Добавить новую задачу (<?= ($_SESSION['repository_mode'] ?? 'mysql') === 'mysql' ? 'MySQL' : 'File' ?>)</h1>
    
    <form method="POST" action="?route=task/add">
        <div class="form-group">
            <label for="title">Название задачи:</label>
            <input type="text" id="title" name="title" required 
                   placeholder="Введите название задачи..." 
                   value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty(trim($_POST['title'] ?? ''))): ?>
                <div class="error">Пожалуйста, введите название задачи</div>
            <?php endif; ?>
        </div>
        
        <button type="submit">Добавить задачу</button>
    </form>
    
    <a href="?route=task/list" class="back-link">← Вернуться к списку задач</a>
</body>

</html>