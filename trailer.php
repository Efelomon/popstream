<?php
$api_key = 'api_key=d1df52f7f3812adac4100a4def73c18c';
$base_url = 'https://api.themoviedb.org/3';
$img_url = 'https://image.tmdb.org/t/p/w500';

include('index.php');

$movie_id = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($movie_id)) {

    $video_url = $base_url . '/movie/' . $movie_id . '/videos?' . $api_key;
    $videos = getVideos($video_url);

    if (!empty($videos)) {
        $trailer_key = $videos[0]['key'];
        $trailer_url = 'https://www.youtube.com/embed/' . $trailer_key;

        echo '<iframe width="560" height="315" src="' . $trailer_url . '" frameborder="0" allowfullscreen></iframe>';
    } else {
        echo 'No trailer available.';
    }
} else {
    echo 'Invalid movie ID.';
}

function getVideos($url)
{
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    return isset($data['results']) ? $data['results'] : [];
}
?>
