<?php
include 'movies.php';

$api_key = 'api_key=d1df52f7f3812adac4100a4def73c18c';
$base_url = 'https://api.themoviedb.org/3';
$api_url = $base_url . '/discover/movie?language=en-US&sort_by=popularity.desc&' . $api_key;
$img_url = 'https://image.tmdb.org/t/p/w780/';
$search_url = $base_url . '/search/movie?' . $api_key;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($searchTerm)) {
        $query = $search_url . '&query=' . urlencode($searchTerm);
        $movies = getMovies($query);
    } else {
        $movies = getMovies($api_url);
       // displayCarousel($movies, $img_url);
        
    }
}

// function displayCarousel($movies, $img_url)
// {
//     echo '<div class="container-fluid">
//             <div class="row">
//                 <div class="col-md-12">
//                     <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" style="width: 100%;">
//                         <div class="carousel-indicators">';
    
//     $active = true;
//     for ($i = 0; $i < min(20, count($movies)); $i++) {
//         echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="' . $i . '" class="' . ($active ? 'active' : '') . '" aria-current="true" aria-label="Slide ' . ($i + 1) . '"></button>';
//         $active = false;
//     }
    
//     echo '</div>
//             <div class="carousel-inner">';
    
//     $active = true;
//     foreach ($movies as $key => $movie) {
//         if ($key >= 20) break;
//         echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">
//                 <img src="' . ($movie['poster_path'] ? $img_url . $movie['poster_path'] : 'placeholder.jpg') . '" class="d-block w-100"style="height: 550px; alt="' . $movie['title'] . '">
//                 <div class="carousel-caption d-none d-md-block">
//                     <h5>' . $movie['title'] . '</h5>
                    
//                 </div>
//               </div>';
//         $active = false;
//     }
    
    // echo '</div>
    //         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    //             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    //             <span class="visually-hidden">Previous</span>
    //         </button>
    //         <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    //             <span class="carousel-control-next-icon" aria-hidden="true"></span>
    //             <span class="visually-hidden">Next</span>
    //         </button>
    //     </div>
    // </div>';
//}

// function displayMovieDetails($movies, $img_url)
// {
//     foreach ($movies as $key => $movie) {
//         if ($key >= 2) break;
//         echo '<div class="card mb-3" style="max-width: 540px;">
//                 <div class="row g-0">
//                     <div class="col-md-4">
//                         <img src="' . ($movie['poster_path'] ? $img_url . $movie['poster_path'] : 'placeholder.jpg') . '" class="img-fluid rounded-start" alt="' . $movie['title'] . '">
//                     </div>
//                     <div class="col-md-8">
//                         <div class="card-body">
//                             <h5 class="card-title">' . $movie['title'] . '</h5>
                            
//                             <p class="card-text"><small class="text-muted">Release Date: ' . $movie['release_date'] . '</small></p>
//                         </div>
//                     </div>
//                 </div>
//             </div>';
//     }
    
//     echo '</div></div></div>';
// }
?>
