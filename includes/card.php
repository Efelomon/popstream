<style>
    .rating{
        
        color:#fff;
        padding:5px;
        border-radius: 2.5px;
        float:right;
        border:solid black ;}

 
    .top{
        margin-left: 50px;
    }
</style>
<?php
$api_key = 'api_key=d1df52f7f3812adac4100a4def73c18c';
$base_url = 'https://api.themoviedb.org/3';
$api_url = $base_url . '/discover/movie?language=en-US&sort_by=popularity.desc&' . $api_key;
$img_url = 'https://image.tmdb.org/t/p/w500';
$search_url = $base_url . '/search/movie?' . $api_key;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($searchTerm)) {
        $query = $search_url . '&query=' . urlencode($searchTerm);
        $movies = getMovies($query);
        displayCardMovieDetails($movies, $img_url, $searchTerm); 
    } else {
        $movies = getMovies($api_url);
        displayCardMovieDetails($movies, $img_url);
    }
}

function displayCardMovieDetails($movies, $img_url, $searchTerm = null) 
{
    $title = !empty($searchTerm) ? "Search results for '$searchTerm'" : "Popular movies";
    echo "<h1 class='mt-5 ml-5 mb-0 top'>$title</h1><div class='d-flex m-5 flex-wrap'>";

    foreach ($movies as $movie) {
        $title = $movie['title'];
        $poster_path = $img_url . $movie['poster_path'];
        $vote_average = $movie['vote_average'];
        $overview = $movie['overview'];
        $id = $movie['id'];

        $trailer_link = './single.php?id=' . $id .'&title=' . urlencode($title).'&overview=' . urlencode($overview).'&poster_path=' . urlencode($poster_path);

        echo '<div class="card m-2" style="width: 16rem;">
                <a href="' . $trailer_link . '">
                    <img src="' . $poster_path . '" class="card-img-top" alt="' . $title .'">
                </a>
                <div class="m-0 card-body">
                  <span class="card-title r2">' . $title . '</span><span class="rating bg-warning">'.$vote_average.'/10</span>
                </div>
              </div>';
    }
    echo '</div>';
}
?>