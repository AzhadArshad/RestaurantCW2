<?php
session_start();
include('db_connect.php');

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $diet = $_POST['diet'] ?? '';
    $allergies = $_POST['allergies'] ?? '';
    $cuisine = '%' . ($_POST['cuisine'] ?? '') . '%';
    $rating = $_POST['rating'] ?? 0;
    $reviews = $_POST['reviews'] ?? 0;

    // Store in session
    $_SESSION['preferences'] = [
        'diet' => $diet,
        'allergies' => $allergies,
        'cuisine' => trim($cuisine, '%'),
        'rating' => $rating,
        'reviews' => $reviews
    ];

    try {
        // Main query with proper column names
        $query = "SELECT r.restaurantID, r.Name AS restaurant_name, 
                         r.Location, r.Ratings, c.name AS cuisine_name
                  FROM Restaurants r
                  JOIN cuisines c ON r.restaurantID = c.restaurantID
                  WHERE c.name LIKE ? 
                  AND r.Ratings >= ?";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sd', $cuisine, $rating);
        $stmt->execute();
        $result = $stmt->get_result();

        // Display results
        echo '<!DOCTYPE html>
              <html>
              <head>
                  <title>Food Advisor Results</title>
                  <link rel="stylesheet" href="style.css">
              </head>
              <body>
                  <div class="container">
                      <h2>Restaurants Matching Your Preferences</h2>';

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="restaurant-card">
                        <h3 style="display: inline; border-bottom: 3px solid black; padding-bottom: 2px;">'.$row['restaurant_name'].'</h3>
                        <p><strong>Location:</strong> '.$row['Location'].'</p>
                        <p><strong>Rating:</strong> '.$row['Ratings'].'/5</p>
                        <p><strong>Cuisine:</strong> '.$row['cuisine_name'].'</p>';

                // Get dishes (using prepared statement)
                $dish_query = "SELECT Name, price, description 
                              FROM dishes 
                              WHERE restaurantID = ?";
                $dish_stmt = $conn->prepare($dish_query);
                $dish_stmt->bind_param('i', $row['restaurantID']);
                $dish_stmt->execute();
                $dish_result = $dish_stmt->get_result();

                if ($dish_result->num_rows > 0) {
                    echo '<h4>Menu Items:</h4><ul>';
                    while ($dish = $dish_result->fetch_assoc()) {
                        echo '<li>'.$dish['Name'].' - $'.$dish['price'].'<br>
                              <em>'.$dish['description'].'</em></li>';
                    }
                    echo '</ul>';
                }

                // Get reviews (using prepared statement)
                $review_query = "SELECT rating, reviewDate 
                                FROM reviews 
                                WHERE restaurantID = ? 
                                ORDER BY reviewDate DESC";
                $review_stmt = $conn->prepare($review_query);
                $review_stmt->bind_param('i', $row['restaurantID']);
                $review_stmt->execute();
                $review_result = $review_stmt->get_result();

                if ($review_result->num_rows > 0) {
                    echo '<h4>Recent Reviews:</h4><ul>';
                    while ($review = $review_result->fetch_assoc()) {
                        echo '<li>'.$review['rating'].' stars on '.$review['reviewDate'].'</li>';
                    }
                    echo '</ul>';
                }

                echo '</div><hr>';
            }
        } else {
            echo '<p>No restaurants found matching your criteria.</p>';
        }

        echo '</div></body></html>';

    } catch (Exception $e) {
        echo '<div class="error">Error: '.$e->getMessage().'</div>';
    }
} else {
    header('Location: index.php');
    exit();
}
?>
<style>
    body {
    background-image: url(images/f0b615f78dd809d68ec389f4bc8d94bb.jpg);
    background-size: cover;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
}

    </style>