<?php

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 


    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'Username or email already exists. <a href="login.php">Login</a>';
    } else {
        
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();
        header('Location: index.php?name= '.$username) ;
    }

    $stmt->close();
    $conn->close();
}
?>



<?php
require('includes/header.php');
require('includes/navbar.php');
?>
<div class="container">
<div class="row">
  <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
    <div class="card border-0 shadow rounded-3 my-5">
      <div class="card-body p-4 p-sm-5">
        <h5 class="card-title text-center mb-5 fw-bold fs-5">Sign up</h5>
        <form method="post">
          <div class="form-floating mb-3">
            <input type="text" class="form-control"  id="username" name="username" required placeholder="username">
            <label for="username">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control"  id="email" name="email" required placeholder="email">
            <label for="username">Email</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
            <label for="password">Password</label>
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
            <label class="form-check-label" for="rememberPasswordCheck">
              Remember password
            </label>
          </div>
          <div class="d-grid">
            <button class="btn btn-dark btn-login text-uppercase fw-bold" type="submit">Sign
              up</button>
          </div>
          <p>Already have an account? <a href="login.php">Sign up</a></span></p>
          <hr class="my-4">
          <div class="d-grid mb-2">
            <button class="btn btn-google btn-login text-uppercase fw-bold" type="submit">
              <i class="fab fa-google me-2"></i> Sign up with Google
            </button>
          </div>
          <div class="d-grid">
            <button class="btn btn-facebook btn-login text-uppercase fw-bold" type="submit">
              <i class="fab fa-facebook-f me-2"></i> Sign up with Facebook
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<?php
require('includes/footer.php');
?>

<style>
    body {

 
}

.btn-login {
  font-size: 0.9rem;
  letter-spacing: 0.05rem;
  padding: 0.75rem 1rem;
}

.btn-google {
  color: white !important;
  background-color: #ea4335;
}

.btn-facebook {
  color: white !important;
  background-color: #3b5998;
}
</style>