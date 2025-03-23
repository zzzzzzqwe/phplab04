<?php
/**
 * Главная страница
 *
 * Показывает 2 последних рецепта и сообщение об успешном добавлении.
 */
$recipes = [];

$filePath = __DIR__ . '/../storage/recipes.txt';
if (file_exists($filePath)) {
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $lines = array_reverse($lines);
    $lastTwo = array_slice($lines, 0, 2);

    foreach ($lastTwo as $line) {
        $recipes[] = json_decode($line, true);
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
</head>
<body>
    <h1>Добро пожаловать! <br>Желаете добавить рецепт?</h1>
    <a href="/recipe/create.php">Добавить рецепт</a> |
    <a href="/recipe/index.php">Посмотреть все рецепты</a>

    <h2>Последние рецепты:</h2>
    <?php if (!empty($recipes)): ?>
        <ul>
            <?php foreach ($recipes as $recipe): ?>
                <li>
                    <strong><?= htmlspecialchars($recipe['title']) ?></strong> —
                    <?= htmlspecialchars($recipe['category']) ?> <br>
                    <em><?= nl2br(htmlspecialchars($recipe['description'])) ?></em>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Рецептов пока нет.</p>
    <?php endif; ?>
</body>
</html>
