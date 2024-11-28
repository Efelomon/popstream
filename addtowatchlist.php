<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movie_id = $_POST['movie_id'];
    $title = $_POST['title'];
    $overview = $_POST['overview'];
    $trailer_key = $_POST['trailer_key'];
    $poster_path = $_POST['poster_path'];
    $user_id = $_SESSION['user_id'];
    

    $sql = "INSERT INTO movies (user_id, movie_id, title, trailer_key,poster_path) 
            VALUES ('$user_id','$movie_id', '$title', '$trailer_key', '$poster_path')";

    if ($conn->query($sql) === TRUE) {
        header("Location:watchlist.php?movieaddedsuccessfully");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
