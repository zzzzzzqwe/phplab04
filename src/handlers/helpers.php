<?php
/**
 * Сохраняет рецепт в файл recipes.txt
 *
 * @param array $recipe Ассоциативный массив с данными рецепта
 * @return void
 */
function saveRecipe(array $recipe): void {
    $filePath = __DIR__ . '/../../storage/recipes.txt';
    $json = json_encode($recipe, JSON_UNESCAPED_UNICODE);
    file_put_contents($filePath, $json . PHP_EOL, FILE_APPEND);
}
