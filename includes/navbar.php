
<nav class="navbar navbar-expand-lg bg-body bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">Pop stream</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <!-- Centered search bar -->
      <div class="mx-auto">
        <form class="d-flex" role="search" method="GET">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-warning" type="submit">Search</button>
        </form>
      </div>
      <!-- Right-aligned links -->
      <?php
if (isset($_SESSION["user_id"])) {
    // Display user name if available in session
    $user_name = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';
    echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">';
    echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">' . $user_name . '</a></li>';
    echo '<li class="nav-item"><a class="nav-link active" href="./watchlist.php">Watchlist</a></li>';
    echo '<li class="nav-item"><a class="nav-link active" href="./logout.php">Logout</a></li>';
    echo '</ul>';
} else {
    echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">';
    echo '<li class="nav-item"><a class="nav-link active" href="./login.php">Login</a></li>';
    echo '<li class="nav-item"><a class="nav-link active" href="./sign-up.php">Register</a></li>';
    echo '</ul>';
}
?>

    </div>
  </div>
</nav>
