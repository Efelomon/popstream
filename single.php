<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

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
            text-align: center;
            padding: 30px 0;
        }

        .cast-crew-member {
            margin-top: 20px;
        }
        .actors{
          width:50px !important;
          height:50px !important;
          border-radius:360px !important;
          border:solid yellow 1.5px;
        
        }
        .nb{
            font-weight: bold !important;
            
        }
        
    </style>
</head>

<body>

    <?php
    include("includes/header.php");?>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-info mb-0">
  <div class="container-fluid">
    <a class="navbar-brand nb" href="index.php">Movie hunter</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">

  
      <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
        <li class="nav-item text-light"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
        <li class="nav-item text-light"><a class="nav-link active" href="watchlist.php">Watchlist</a></li>
    </ul>

    </div>
  </div>
</nav>

  
        

   <?php $api_key = 'api_key=d1df52f7f3812adac4100a4def73c18c';
    $base_url = 'https://api.themoviedb.org/3';
    $img_url = 'https://image.tmdb.org/t/p/original/';
 
    function getMoviesDetails($movie_id)
    {
        global $api_key, $base_url;

        if (!empty($movie_id)) {
            $video_url = $base_url . '/movie/' . $movie_id . '/videos?' . $api_key;
            $videos = getVideos($video_url);

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

        return isset($data['results']) ? $data['results'] : [];
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
            $trailer_key = $movieDetails['videos'][0]['key'];
            $trailer_url = 'https://www.youtube.com/embed/' . $trailer_key;

            echo '<div class="container video-container">';
            echo '<iframe width="530" height="300" src="' . $trailer_url . '" frameborder="2" allowfullscreen></iframe>';
            echo '</div>';
        } else {
            echo 'No trailer available.';
        }

        echo '<div class="container overview-section">';
        echo '<h2>'. $title .'</h2>';
        echo '<p>'.$overview.'</p>';
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
        echo '<h2>Cast and Crew</h2>';
        echo '<div class="row">';
        foreach ($movieDetails['credits'] as $castMember) {
            echo '<div class="col-md-4">';
            echo '<div class="cast-crew-member">';
            echo '<img class="actors" src="' . ($castMember['profile_path'] ? $img_url . $castMember['profile_path']  : 'placeholder.jpg') . '" alt="' . $castMember['name'] . '"><br>';
            echo '<span> Role:' . $castMember['character'] . '</span><br><span class="stubborn">Original name: '. $castMember['original_name'] . '</span>';
            
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
</body>

</html>
