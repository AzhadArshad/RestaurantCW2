<?php
session_start(); // This starts the session, making session variables available across pages. 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Food Advisor</title>
</head>
<body>
    <div class="header">
        
</div>
    <div class="container">
        <h2>Enter Your Preferences</h2>
        <form method="POST" action="view_results.php">
            <label for="diet">Dietary Preference:</label>
            <select id="diet" name="diet">
                <option value="Vegetarian">Vegetarian</option>
                <option value="Vegan">Vegan</option>
                <option value="Non-Vegetarian">Non-Vegetarian</option>
            </select>

            <label for="allergies">Allergies (comma-separated):</label>
            <input type="text" id="allergies" name="allergies">

            <label for="cuisine">Preferred Cuisine:</label>
            <select id="cuisine" name="cuisine">
                <option value="Indian">Indian</option>
                <option value="Thai">Thai</option>
                <option value="Italian">Italian</option>
                <option value="Mexican">Mexican</option>
                <option value="Japanese">Japanese</option>
                <option value="Mediterranean">Mediterranean</option>
                <option value="French">French</option>
                <option value="Chinese">Chinese</option>
            </select>

            <label for="rating">Minimum Rating:</label>
            <select id="rating" name="rating">
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>

            <label for="reviews">Minimum Number of Reviews:</label>
            <input type="number" id="reviews" name="reviews" min="0">

            <button type="submit">Submit</button>
        </form>

    </div>
</body>
</html>
<style>
  body {
    background-image: url('images/WEB-CARNITAS-CRUJIENTES-DE-POLLO-0610-copia-1080x675.jpg');
    background-size: cover;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
}


.container {
    background-color: #fff;
    width: 350px;
    margin: 80px auto;
    padding: 25px 30px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

h2 {
    color: #283618;
    text-align: center;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-top: 15px;
    margin-bottom: 5px;
    font-weight: bold;
    color: #3a5a40;
}

input[type=\"text\"], select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
}

button {
    margin-top: 20px;
    width: 100%;
    padding: 10px;
    background-color: #588157;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #3a5a40;
}

a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #344e41;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

.error {
    color: red;
    font-size: 0.9em;
    margin-top: 5px;
}
.success {
    color: green;
    font-size: 0.9em;
    margin-top: 5px;
}
  </style>
