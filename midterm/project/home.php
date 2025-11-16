<?php
session_start();
include "connection.php";

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];

// Get user id from database
$query = "SELECT user_id FROM users WHERE username = '$username'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);
$user_id = $user['user_id'];

// Get all recipes for this user
$query = "SELECT * FROM recipes WHERE user_id = '$user_id'";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Recipe Book</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #fffaf6;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #ff914d;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        header a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
        }

        header a:hover {
            text-decoration: underline;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }

        h2 {
            color: #e67e22;
            margin-bottom: 20px;
            border-bottom: 2px solid #f4d4b5;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        table th {
            background: #ffe5d1;
            color: #444;
            text-align: left;
        }

        tr:hover {
            background-color: #fff6ef;
        }

        img {
            border-radius: 6px;
            object-fit: cover;
        }

        a.action-btn {
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 14px;
            margin-right: 4px;
        }

        a.edit {
            background-color: #3498db;
            color: white;
        }

        a.delete {
            background-color: #e74c3c;
            color: white;
        }

        a.edit:hover {
            background-color: #217dbb;
        }

        a.delete:hover {
            background-color: #c0392b;
        }

        ul {
            margin: 0;
            padding-left: 18px;
        }

        .no-recipe {
            text-align: center;
            color: #999;
            padding: 30px 0;
        }

        @media (max-width: 768px) {
            table, tr, td, th {
                display: block;
            }

            table th {
                background: none;
                color: #e67e22;
                font-size: 16px;
            }

            tr {
                margin-bottom: 20px;
                border: 1px solid #f3d1b2;
                border-radius: 10px;
                padding: 10px;
            }

            td {
                padding: 8px 0;
            }

            td img {
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>🍳 My Recipe Book</h1>
    <div>
        <span>Welcome, <?php echo htmlspecialchars($username); ?></span>
        <a href="newrecipe.php">➕ Add Recipe</a>
        <a href="logout.php">🚪 Logout</a>
    </div>
</header>

<div class="container">
    <h2>Your Recipes</h2>

    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Cooking Time</th>
            <th>Ingredients</th>
            <th>Instructions</th>
            <th>Actions</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                
                echo "<td>";
                if (!empty($row['recipe_image'])) {
                    echo "<img src='{$row['recipe_image']}' width='100' height='80'>";
                } else {
                    echo "<img src='noimage.png' width='100' height='80'>";
                }
                echo "</td>";

                echo "<td><strong>{$row['recipe_name']}</strong></td>";
                echo "<td>{$row['cook_time']} min</td>";

                // Ingredients
                echo "<td>";
                $ing_query = "SELECT * FROM ingredients WHERE recipe_id = {$row['recipe_id']}";
                $ing_result = mysqli_query($con, $ing_query);
                if (mysqli_num_rows($ing_result) > 0) {
                    echo "<ul>";
                    while ($ing = mysqli_fetch_assoc($ing_result)) {
                        echo "<li>{$ing['ingredient_name']} - {$ing['quantity']}</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<i>No ingredients</i>";
                }
                echo "</td>";

                echo "<td style='white-space: pre-line;'>" . nl2br(htmlspecialchars($row['instructions'])) . "</td>";

                echo "<td>
                    <a class='action-btn edit' href='editrecipe.php?id={$row['recipe_id']}'>Edit</a>
                    <a class='action-btn delete' href='deleterecipe.php?id={$row['recipe_id']}'
                       onclick='return confirm(\"Delete this recipe?\");'>Delete</a>
                </td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='no-recipe'>You have no recipes yet 😢</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
