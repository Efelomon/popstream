<nav class="navbar navbar-expand-lg navbar-light bg-info mb-0">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Movie hunter</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
   
      <form method="GET" class="d-flex mx-auto ">
        <input class="form-control me-2 " type="search" placeholder="Search" name="search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
  
   
      
      <?php
     
       

      
       if (isset($_SESSION["user_id"])) {
          echo '<ul class="navbar-nav mb-2 mb-lg-0">';
          echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Hello '. $_GET["name"].'</a></li>';
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
