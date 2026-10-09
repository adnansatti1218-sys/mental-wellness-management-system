<?php
	session_start();

	$database = mysqli_connect('localhost', 'root', '', 'fyp_database');

	if (isset($_POST['Login'])) {

		$Email    = $_POST['Email'];
		$Password = $_POST['Password'];

		$query = "SELECT * FROM counsellors
				  WHERE Email='$Email'
				  AND Password='$Password'
				  AND Status='Active'";

		$result = mysqli_query($database, $query);
		$user   = mysqli_fetch_assoc($result);

		if ($user) {

			$_SESSION['Counsellor_ID']   = $user['id'];
			$_SESSION['Counsellor_Name'] = $user['Name'];

			header("Location: counsellor_dashboard.php");

		} else {
			echo "<script>alert('Invalid Credentials or Inactive Account');</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css"> 
  <title>Login</title>
  <style>
    .nav-a{ color: white; border: 1px solid white; border-radius: 5px; }
    .nav-link:hover { background-color: #0a480d; color: #fcfcfc; border-color: #ffffff; }
    .form-container { display: flex; justify-content: center; align-items: center; height: 100vh; }
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
      <h1 class="text-center text-success mb-4">Login</h1>
      <form method="post">
        <div class="row"> 
          <div class="col-md-12 mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" name="Email" placeholder="Enter your email">
          </div> 
          <div class="col-md-12 mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="Password" placeholder="Enter password">
          </div> 
        </div>
        <button type="submit" class="btn btn-success w-100" name="Login">Login</button>
      </form>
    </div>
  </div>
</body>
</html>