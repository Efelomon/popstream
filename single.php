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
}
?>

<style>
    body {
        background-color: #fff;
        color: #fff;
        font-size: 1.2rem;
    }

    .navbar {
        background-color: #000;
        color: #fff;
    }

    h2 {
        font-size: 1.5rem;
    }

    .video-container {
        position: relative;
        padding-bottom: 47%;
        padding-top: 30px;
        height: 0;
        overflow: hidden;
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .overview-section {
        text-align: center;
        padding: 30px 0;
    }

    .cast-crew-section {
        padding: 10px 0;
        background-color: #f9f9f9;
    }

    .cast-crew-section h2 {
        font-size: 2rem;
        font-weight: bold;
        color: #000;
    }

    .cast-crew-member {
        background-color: #fff;
        
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .cast-crew-member:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .actors {
        width: 120px !important;
        height: 120px !important;
     
      
   
    }

    .role {
        font-size: 0.9rem;
        font-weight: 600;
        color: #000;
    }

    .original-name {
        font-size: 0.85rem;
        font-style: italic;
        color: #000;
    }

    .text-muted {
        color: #000 !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .cast-crew-member {
            padding: 15px;
        }

        .actors {
            width: 100px !important;
            height: 100px !important;
        }
    }    .nb {
        font-weight: bold !important;
    }

</style>

<?php
$api_key = 'api_key=d1df52f7f3812adac4100a4def73c18c';
$base_url = 'https://api.themoviedb.org/3';
$img_url = 'https://image.tmdb.org/t/p/original/';

function getMoviesDetails($movie_id)
{
    global $api_key, $base_url;

    if (!empty($movie_id)) {
        // Get video details (only trailers)
        $video_url = $base_url . '/movie/' . $movie_id . '/videos?' . $api_key;
        $videos = getVideos($video_url);

        // Get credits (cast and crew)
        $credits_url = $base_url . '/movie/' . $movie_id . '/credits?' . $api_key;
        $credits = getCredits($credits_url);

        return ['videos' => $videos, 'credits' => $credits];
    } else {
        return null;
    }
}

function getVideos($url)
{
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Filter videos to return only official trailers
    if (isset($data['results'])) {
        $officialTrailers = [];
        foreach ($data['results'] as $video) {
            if ($video['type'] === 'Trailer' && stripos($video['name'], 'official') !== false) {
                $officialTrailers[] = $video;
            }
        }
        return $officialTrailers;
    }
    return [];
}

function getCredits($url)
{
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    return isset($data['cast']) ? $data['cast'] : [];
}

$movie_id = isset($_GET['id']) ? $_GET['id'] : '';
$overview = isset($_GET['overview']) ? $_GET['overview'] : '';
$title = isset($_GET['title']) ? $_GET['title'] : '';
$poster_path = isset($_GET['poster_path']) ? $_GET['poster_path'] : '';

if (!empty($movie_id)) {

    $movieDetails = getMoviesDetails($movie_id);

    if (!empty($movieDetails['videos'])) {
        // Use the first official trailer
        $trailer_key = $movieDetails['videos'][0]['key'];
        $trailer_url = 'https://www.youtube.com/embed/' . $trailer_key;

        echo '<div class="container video-container">';
        echo '<iframe width="530" height="300" src="' . $trailer_url . '" frameborder="2" allowfullscreen></iframe>';
        echo '</div>';
    } else {
        echo 'No official trailer available.';
    }

    echo '<div class="container overview-section">';
    echo '<h2>' . $title . '</h2>';
    echo '<p>' . $overview . '</p>';
    echo '<form method="post" action="addtowatchlist.php">
      <input type="hidden" name="movie_id" value="' . $movie_id . '">
      <input type="hidden" name="title" value="' . $title . '">
      <input type="hidden" name="overview" value="' . $overview . '">
      <input type="hidden" name="trailer_key" value="' . $trailer_key . '">
      <input type="hidden" name="poster_path" value="' . $poster_path . '">
      <button type="submit" class="btn btn-warning btn-lg btn-block">Add to Watchlist</button>
    </form>';
    echo '</div>';
    echo '<div class="container cast-crew-section">';
echo '<h2 class="text-center mb-4">Cast and Crew</h2>';
echo '<div class="row justify-content-center">';
foreach ($movieDetails['credits'] as $castMember) {
    echo '<div class="col-md-3 col-sm-4 col-6 mb-4">';
    echo '<div class="cast-crew-member text-center">';
    echo '<img class="actors img-fluid  shadow" src="' . ($castMember['profile_path'] ? $img_url . $castMember['profile_path'] : 'placeholder.jpg') . '" alt="' . $castMember['name'] . '" />';
    echo '<h5 class="mt-1">' . $castMember['name'] . '</h5>';
    echo '<span class="role text-muted">' . ($castMember['character'] ? 'Role: ' . $castMember['character'] : 'No role information') . '</span>';
    echo '<p class="original-name text-muted mt-1">Original Name: ' . $castMember['original_name'] . '</p>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
echo '</div>';
} else {
    echo 'Invalid movie ID.';
}

if (!empty($movie_id)) {
    $title = mysqli_real_escape_string($conn, $title);
    $overview = mysqli_real_escape_string($conn, $overview);
    $trailer_key = mysqli_real_escape_string($conn, $trailer_key);
    $poster_path = mysqli_real_escape_string($conn, $poster_path);

    $sql = "INSERT INTO movies (movie_id, title, overview, trailer_key, release_date, poster_path) 
            VALUES ('$movie_id', '$title', '$overview', '$trailer_key', '$release_date', '$poster_path')";

    if ($conn->query($sql) === TRUE) {
        echo "Movie details added to the database.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script>
