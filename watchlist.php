<?php

session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header('Location: login.php');
    exit();
} else {
    // Include the header file
    include("includes/header.php");
    include("includes/navbar.php");
    ?>
      

   <?php include("config.php");
    $api_key = 'api_key=d1df52f7f3812adac4100a4def73c18c';
    $base_url = 'https://api.themoviedb.org/3';
    $api_url = $base_url . '/discover/movie?language=en-US&sort_by=popularity.desc&' . $api_key;
    $img_url = 'https://image.tmdb.org/t/p/w500';

    
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['remove']) && !empty($_GET['remove'])) {
        $movieIdToRemove = $_GET['remove'];

        
        $sqlRemove = "DELETE FROM movies WHERE id = ? AND user_id = ?";
        $stmtRemove = $conn->prepare($sqlRemove);
        $stmtRemove->bind_param("ii", $movieIdToRemove, $_SESSION['user_id']);

        if ($stmtRemove->execute()) {
            echo '<div class="container">';
            echo '<div class="alert alert-success" role="alert">Movie removed from your watchlist successfully.</div>';
            echo '</div>';
        } else {
            echo '<div class="container">';
            echo '<div class="alert alert-danger" role="alert">Error removing the movie: ' . $conn->error . '</div>';
            echo '</div>';
        }

        $stmtRemove->close();
    }

    
    $sql = "SELECT * FROM movies WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<div class="container">';
        echo '<h2>My Watchlist</h2>';

        while ($row = $result->fetch_assoc()) {
            echo '<div class="card mb-3" style="max-width: 480px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                           <img src="' . ($row['poster_path'] ? $img_url . $row['poster_path'] : 'placeholder.jpg') . '" class="img-fluid rounded-start" alt="' . $row['title'] . '">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">' . $row['title'] . '</h5><br><br><br><br>
                                <a href="?remove=' . $row['id'] . '" class="btn btn-warning btn-lg btn-block mt-5">Remove from Watchlist</a>
                            </div>
                        </div>
                    </div>
                </div>';
        }

        echo '</div>';
    } else {
        echo '<div class="container">';
        echo '<h2>Your watchlist is empty</h2>';
        echo '</div>';
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
