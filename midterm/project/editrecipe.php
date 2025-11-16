<?php
include "connection.php";

$id = $_GET["id"];

$res = mysqli_query($con, "SELECT * FROM recipes WHERE recipe_id=$id");
while ($row = mysqli_fetch_array($res)) {
    $recipe_name = $row["recipe_name"];
    $recipe_image = $row["recipe_image"];
    $cook_time = $row["cook_time"];
    $instructions = $row["instructions"];
}

$ing_res = mysqli_query($con, "SELECT * FROM ingredients WHERE recipe_id=$id");
?>

<html lang="en">
<head>
    <title>Edit Recipe</title>
    <meta charset="utf-8">
    <style>
        /* 🌸 Tổng thể */
        body {
            font-family: "Poppins", sans-serif;
            background: #fff8f3;
            margin: 0;
            padding: 0;
            color: #444;
        }

        .container {
            width: 85%;
            max-width: 850px;
            margin: 50px auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            padding: 40px 45px;
        }

        h2 {
            text-align: center;
            color: #e67e22;
            font-weight: 600;
            margin-bottom: 30px;
        }

        form div {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.25s ease;
            background-color: #fff;
        }

        input:focus,
        textarea:focus {
            border-color: #e67e22;
            box-shadow: 0 0 0 3px rgba(230, 126, 34, 0.2);
            outline: none;
        }

        img {
            border-radius: 8px;
            margin-top: 5px;
            border: 1px solid #eee;
        }

        h3 {
            color: #d35400;
            margin-top: 25px;
            border-bottom: 2px solid #f5b041;
            padding-bottom: 5px;
        }

        #ingredient-list {
            background: #fffaf5;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #f3d2b5;
            margin-top: 10px;
        }

        .ingredient-item {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .ingredient-item input {
            flex: 1;
        }

        button {
            background: #e67e22;
            color: white;
            border: none;
            padding: 10px 18px;
            font-size: 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }

        button:hover {
            background: #ca6f1e;
        }

        button[type="button"] {
            background: #27ae60;
            margin-top: 10px;
        }

        button[type="button"]:hover {
            background: #1e8449;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .ingredient-item {
                flex-direction: column;
            }
            .container {
                width: 94%;
                padding: 25px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Recipe</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="recipe_name">Recipe Name:</label>
            <input type="text" id="recipe_name" name="recipe_name" value="<?php echo $recipe_name; ?>">
        </div>

        <div>
            <label>Current Image:</label><br>
            <img src="<?php echo $recipe_image; ?>" width="150">
        </div>

        <div>
            <label for="recipe_image">Change Image:</label>
            <input type="file" id="recipe_image" name="recipe_image">
        </div>

        <div>
            <label for="cook_time">Cooking Time (minutes):</label>
            <input type="number" id="cook_time" name="cook_time" value="<?php echo $cook_time; ?>">
        </div>

        <div>
            <label for="instructions">Instructions:</label>
            <textarea id="instructions" name="instructions" rows="5"><?php echo $instructions; ?></textarea>
        </div>
        
        <h3>Ingredients</h3>
        <div id="ingredient-list">
            <?php while($ing = mysqli_fetch_array($ing_res)): ?>
            <div class="ingredient-item">
                <input type="text" name="ingredient_name[]" value="<?php echo $ing['ingredient_name']; ?>">
                <input type="text" name="quantity[]" value="<?php echo $ing['quantity']; ?>">
            </div>
            <?php endwhile; ?>
        </div>

        <button type="button" onclick="addIngredient()">+ Add Ingredient</button>
        <br><br>
        <button type="submit" name="update">Update</button>
    </form>
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

<?php
if (isset($_POST["update"])) {
    $new_image = $recipe_image; 
    if (isset($_FILES['recipe_image']) && $_FILES['recipe_image']['error'] == 0) {
        $target_dir = "uploads/";
        $new_image = $target_dir . basename($_FILES["recipe_image"]["name"]);
        move_uploaded_file($_FILES["recipe_image"]["tmp_name"], $new_image);
    }
    
    mysqli_query($con, "UPDATE recipes 
        SET recipe_name='$_POST[recipe_name]',
            recipe_image='$new_image',
            instructions='$_POST[instructions]',
            cook_time='$_POST[cook_time]'
        WHERE recipe_id=$id");

    mysqli_query($con, "DELETE FROM ingredients WHERE recipe_id=$id");  
    if (!empty($_POST['ingredient_name'])) {
        foreach($_POST['ingredient_name'] as $i => $ingredient) {
            $quantity = $_POST['quantity'][$i];
            if ($ingredient && $quantity) {
                mysqli_query($con, "INSERT INTO ingredients (recipe_id, ingredient_name, quantity) 
                        VALUES ('$id', '$ingredient', '$quantity')");
            }
        }
    }
    ?>
    <script type="text/javascript">
        window.location = "home.php";
    </script>
    <?php
}
?>
</html>
