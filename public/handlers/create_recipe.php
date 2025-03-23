<?php
/**
 * Обработчик формы добавления рецепта
 *
 * Выполняет валидацию, сохраняет данные в файл и делает редирект.
 */
require_once __DIR__ . '/../../src/handlers/helpers.php';


ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $errors = [];

    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $ingredients = trim($_POST['ingredients'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $tags = $_POST['tags'] ?? [];
    $steps = trim($_POST['steps'] ?? '');

    // Валидация
    if ($title === '') $errors['title'] = 'Обязательно ввести название';
    if ($category === '') $errors['category'] = 'Категория не выбрана';
    if ($ingredients === '') $errors['ingredients'] = 'Введите ингредиенты';
    if ($steps === '') $errors['steps'] = 'Введите шаги приготовления';

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = compact('title', 'category', 'ingredients', 'description', 'tags', 'steps');
        header('Location: /recipe/create.php');
        exit;
    }

    $recipe = [
        'title' => $title,
        'category' => $category,
        'ingredients' => $ingredients,
        'description' => $description,
        'tags' => $tags,
        'steps' => $steps,
        'created_at' => date('Y-m-d H:i:s')
    ];

    saveRecipe($recipe);

    header('Location: /index.php');
    exit;
}
