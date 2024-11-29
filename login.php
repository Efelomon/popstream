<?php

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            
            session_start();
               // Store user ID and username in session
               $_SESSION['user_id'] = $id;
               $_SESSION['username'] = $username; 
            $_SESSION['user_id'] = $id;
            header('Location: index.php?name='.$username);
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo '<span>Username not found. Please <a href="sign-up.php">register</a> first.</span>';
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
        <h5 class="card-title text-center mb-5 fw-bold fs-5">Sign in</h5>
        <form method="post">
          <div class="form-floating mb-3">
            <input type="text" class="form-control"  id="username" name="username" required placeholder="username">
            <label for="username">Username</label>
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
              in</button>
          </div>
          <p>New user? <a href="sign-up.php">Create account</a></span></p>
          <hr class="my-4">
          <div class="d-grid mb-2">
            <button class="btn btn-google btn-login text-uppercase fw-bold" type="submit">
              <i class="fab fa-google me-2"></i> Sign in with Google
            </button>
          </div>
          <div class="d-grid">
            <button class="btn btn-facebook btn-login text-uppercase fw-bold" type="submit">
              <i class="fab fa-facebook-f me-2"></i> Sign in with Facebook
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