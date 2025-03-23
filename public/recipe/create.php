<?php

/**
 * Страница добавления рецепта
 *
 * Отображает HTML-форму и выводит ошибки из сессии.
 */

session_start();
$errors = $_SESSION['errors'] ?? [];
$formData = $_SESSION['form_data'] ?? [];
session_unset();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить рецепт</title>
</head>
<body>
    <h1>Добавить новый рецепт</h1>
    <form action="/handlers/create_recipe.php" method="POST" novalidate>

        <label>Название рецепта:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($formData['title'] ?? '') ?>">
        <?php if (isset($errors['title'])): ?>
            <p style="color:red"><?= $errors['title'] ?></p>
        <?php endif; ?>
        <br><br>

        <label>Категория:</label><br>
        <select name="category">
            <option value="">--Выберите--</option>
            <?php
            $categories = ['Завтрак', 'Обед', 'Ужин', 'Десерт', 'Напитки'];
            foreach ($categories as $cat):
                $selected = ($formData['category'] ?? '') === $cat ? 'selected' : '';
                echo "<option value=\"$cat\" $selected>$cat</option>";
            endforeach;
            ?>
        </select>
        <?php if (isset($errors['category'])): ?>
            <p style="color:red"><?= $errors['category'] ?></p>
        <?php endif; ?>
        <br><br>

        <label>Ингредиенты:</label><br>
        <textarea name="ingredients"><?= htmlspecialchars($formData['ingredients'] ?? '') ?></textarea>
        <?php if (isset($errors['ingredients'])): ?>
            <p style="color:red"><?= $errors['ingredients'] ?></p>
        <?php endif; ?>
        <br><br>

        <label>Описание:</label><br>
        <textarea name="description"><?= htmlspecialchars($formData['description'] ?? '') ?></textarea>
        <br><br>

        <label>Тэги:</label><br>
        <select name="tags[]" multiple>
            <?php
            $tagsList = ['Вегетарианское', 'Без глютена', 'Быстро', 'Острое', 'Праздничное'];
            $selectedTags = $formData['tags'] ?? [];
            foreach ($tagsList as $tag):
                $selected = in_array($tag, $selectedTags) ? 'selected' : '';
                echo "<option value=\"$tag\" $selected>$tag</option>";
            endforeach;
            ?>
        </select>
        <br><br>

        <label>Шаги приготовления:</label><br>
        <textarea name="steps"><?= htmlspecialchars($formData['steps'] ?? '') ?></textarea>
        <?php if (isset($errors['steps'])): ?>
            <p style="color:red"><?= $errors['steps'] ?></p>
        <?php endif; ?>
        <br><br>

        <button type="submit">Сохранить рецепт</button>
    </form>
</body>
</html>
