<?php
/**
 * Страница отображения всех рецептов
 *
 * Считывает и отображает все строки из файла storage/recipes.txt
 */
$recipes = [];

$filePath = __DIR__ . '/../../storage/recipes.txt';

if (file_exists($filePath)) {
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $recipes[] = json_decode($line, true);
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Все рецепты</title>
</head>
<body>
    <h1>Список всех рецептов</h1>
    <a href="/index.php">На главную</a> | 
    <a href="/recipe/create.php">Добавить рецепт</a>
    <hr>

    <?php if (!empty($recipes)): ?>
        <?php foreach ($recipes as $recipe): ?>
            <h2><?= htmlspecialchars($recipe['title']) ?></h2>
            <p><strong>Категория:</strong> <?= htmlspecialchars($recipe['category']) ?></p>
            <p><strong>Ингредиенты:</strong><br><?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>
            <p><strong>Описание:</strong><br><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>
            <p><strong>Тэги:</strong> <?= implode(', ', array_map('htmlspecialchars', $recipe['tags'])) ?></p>
            <p><strong>Шаги приготовления:</strong><br><?= nl2br(htmlspecialchars($recipe['steps'])) ?></p>
            <p><em>Добавлено: <?= htmlspecialchars($recipe['created_at']) ?></em></p>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Рецептов пока нет.</p>
    <?php endif; ?>
</body>
</html>
