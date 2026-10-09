<?php
    session_start();
    
    if (isset($_GET['logout'])) {
      	unset($_SESSION['Admin_Email']); 
      	session_destroy();
      	echo "<script>window.location.href='admin_login.php';</script>";
    }

    if (isset($_SESSION['Admin_Email'])) { 
      	echo "<script>window.location.href='admin_panel.php';</script>";
    }

    // Connection to the Satabase
    $database = mysqli_connect('localhost', 'root', '', 'fyp_database');
    if (!$database) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['Admin_Email'])) {
        $Admin_Email = mysqli_real_escape_string($database, $_POST['Admin_Email']);
        $Admin_Password = mysqli_real_escape_string($database, $_POST['Admin_Password']);

        $query = "SELECT * FROM `admins` WHERE `Email`='$Admin_Email' AND `Password`='$Admin_Password' ";
        $result = mysqli_query($database, $query);
        $user = mysqli_fetch_assoc($result);
        if ($user) {  
            $_SESSION['Admin_Email'] = $user['Email'];
            header('location: admin_panel.php');
        }else {
            echo '<script>alert("Wrong Email OR Password!")</script>';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css"> 
  <title>Project Title</title>

    <style>
    .nav-a{
        color: white;
        border: 1px solid white; 
        border-radius: 5px;
        }
    .nav-link:hover {
      background-color: #0a480d;
      color: #fcfcfc;
      border-color: #ffffff; 
    }
    .form-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    </style> 
</head>
<body>
    <nav class="navbar" style="background-color: #4CAF50; padding: 15px;">
      <div class="container-fluid">
          <a class="navbar-brand text-white" style="font-size: 25px; font-weight: bold;">
			Mental Wellness - Counsellor Panel</a>        
          <ul class="nav" style="gap:18px;">
            <li class="nav-item"><a class="nav-link nav-a" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link nav-a" href="counsellor_register.php">Counsellor Register</a></li>
            <li class="nav-item"><a class="nav-link nav-a" href="counsellor_login.php">Counsellor Login</a></li>
            <li class="nav-item"><a class="nav-link nav-a" href="admin_login.php">Admin Login</a></li>
            </ul>
      </div>
    </nav>
  <div class="container form-container">
    <div class="card p-5 shadow-lg" style="width: 30rem;">
      <h1 class="text-center text-success mb-4">Admin Login</h1>
      <form method="post">
        <div class="row"> 
          <div class="col-md-12">
            <div class="mb-3">
              <label for="email" class="form-label">Admin Email</label>
              <input type="email" class="form-control" name="Admin_Email" id="email" placeholder="Enter your email">
            </div>
          </div> 
          <div class="col-md-12">
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="Admin_Password" id="password" placeholder="Create a password">
            </div>
          </div> 
        </div>
        <button type="submit" class="btn btn-success w-100" name="Admin_Login">Admin Login</button>
      </form>
    </div>
  </div>
</body>
</html>
