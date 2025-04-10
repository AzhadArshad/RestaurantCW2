<?php
include("db_connect.php");
session_start();

$options = [
    "vegetarian" => "SELECT * FROM meals WHERE diet = 'Vegetarian'",
    "vegan" => "SELECT * FROM meals WHERE diet = 'Vegan'",
    "fast" => "SELECT * FROM meals WHERE cooking_time <= 30",
    "all" => "SELECT * FROM meals"
];

$selected = $_POST['query_type'] ?? null;
?>

<h2>Select a Predefined Query</h2>
<form method="post">
    <select name="query_type">
        <option value="vegetarian">Vegetarian Meals</option>
        <option value="vegan">Vegan Meals</option>
        <option value="fast">Meals Under 30 Min</option>
        <option value="all">All Meals</option>
    </select>
    <button type="submit">Search</button>
</form>

<?php
if ($selected && isset($options[$selected])) {
    $result = $conn->query($options[$selected]);
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>{$row['meal_name']} ({$row['diet']})</li>";
    }
    echo "</ul>";
}
?>