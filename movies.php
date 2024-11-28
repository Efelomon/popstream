<?php

function getMovies($url)
{
    $response = file_get_contents($url);
    return json_decode($response, true)["results"];
}

// function displayMovieDetails($movies, $img_url)
// {
//     echo '<div class="d-flex m-5">';
//     foreach ($movies as $movie) {
//         $title = $movie['title'];
//         $poster_path = $img_url . $movie['poster_path'];
//         $vote_average = $movie['vote_average'];
//         $overview = $movie['overview'];
//         $id = $movie['id'];

//         echo '<div class="card m-2" style="width: 10rem;">
//                 <img src="' . $poster_path . '" class="card-img-top" alt="' . $title . '">
//                 <div class="card-body">
//                   <h5 class="card-title">' . $title . '</h5>
//                   <p class="card-text">' . $overview . '</p>
//                 </div>
//               </div>';
//     }
//     echo '</div>';
// }

?>
