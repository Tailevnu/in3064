<?php
include "connection.php";

// handle form POST before any HTML output
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert'])) {
    $user_id = 1; // restore session logic if needed

    $recipe_name = mysqli_real_escape_string($link, $_POST['recipe_name'] ?? '');
    $instructions = mysqli_real_escape_string($link, $_POST['instructions'] ?? '');
    $cook_time = (int)($_POST['cook_time'] ?? 0);

    // Handle image upload
    $recipe_image = '';
    if (isset($_FILES['recipe_image']) && $_FILES['recipe_image']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);
        $filename = basename($_FILES["recipe_image"]["name"]);
        $target_path = $target_dir . time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
        if (move_uploaded_file($_FILES["recipe_image"]["tmp_name"], $target_path)) {
            $recipe_image = $target_path;
        }
    }

    // Insert recipe (prepared statement)
    $stmt = mysqli_prepare($link, "INSERT INTO recipes (user_id, recipe_name, recipe_image, instructions, cook_time) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "isssi", $user_id, $recipe_name, $recipe_image, $instructions, $cook_time);
    mysqli_stmt_execute($stmt);
    $recipe_id = mysqli_insert_id($link);
    mysqli_stmt_close($stmt);

    // Insert ingredients (prepared)
    if (!empty($_POST['ingredient_name'])) {
        $stmt2 = mysqli_prepare($link, "INSERT INTO ingredients (recipe_id, ingredient_name, quantity) VALUES (?, ?, ?)");
        foreach ($_POST['ingredient_name'] as $i => $ingredient) {
            $quantity = $_POST['quantity'][$i] ?? '';
            $ing = trim($ingredient);
            $qty = trim($quantity);
            if ($ing !== '' && $qty !== '') {
                mysqli_stmt_bind_param($stmt2, "iss", $recipe_id, $ing, $qty);
                mysqli_stmt_execute($stmt2);
            }
        }
        mysqli_stmt_close($stmt2);
    }

    // Redirect to home (must be before output)
    header('Location: home.php');
    exit;
}
?>

<html>
<head>
    <title>Recipe Management</title>
    <meta charset="utf-8">
</head>
<body>
<div>
    <div>
        <h2>Add New Recipe</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <label for="recipe_name">Recipe Name:</label>
                <input type="text" name="recipe_name" placeholder="Enter recipe name">
            </div>
            <div>
                <label for="recipe_image">Recipe Image:</label>
                <input type="file" name="recipe_image" accept="image/*">
            </div>
            <div>
                <label for="cook_time">Cooking Time (minutes):</label>
                <input type="number" name="cook_time" placeholder="Enter cooking time">
            </div>
            <div>
                <label for="instructions">Instructions:</label>
                <textarea name="instructions" rows="5" placeholder="Enter cooking instructions"></textarea>
            </div>
            
            <h3>Ingredients</h3>
            <div id="ingredient-list">
                <div class="ingredient-item">
                    <input type="text" name="ingredient_name[]" placeholder="Ingredient name">
                    <input type="text" name="quantity[]" placeholder="Quantity">
                </div>
            </div>
            <button type="button" onclick="addIngredient()">+ Add Ingredient</button>
            
            <br><br>
            <button type="submit" name="insert">Insert</button>
        </form>
    </div>
</div>

<script>
function addIngredient() {
    const container = document.getElementById('ingredient-list');
    const div = document.createElement('div');
    div.className = 'ingredient-item';
    div.innerHTML = 
        `<input type="text" name="ingredient_name[]" placeholder="Ingredient name">
         <input type="text" name="quantity[]" placeholder="Quantity">`;
    container.appendChild(div);
}
</script>
</body>
</html>