<?php
session_start();
$database = mysqli_connect('localhost','root','','fyp_database');

if(isset($_POST['Register'])){
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    $query = "INSERT INTO counsellors (Name,Email,Password)
              VALUES ('$Name','$Email','$Password')";
    mysqli_query($database,$query);

    echo "<script>alert('Registered Successfully!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mental Wellness System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .nav-a{
            color:white;
            border:1px solid white;
            border-radius:5px;
        }
        .nav-link:hover{
            background:#0a480d;
            color:white;
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

    <div class="container mt-5">
        <div class="card p-5 shadow-lg" style="width:40rem;margin:auto;">
        <h3 class="text-success text-center">Counsellor Registration</h3>

        <form method="post">
            <input type="text" name="Name" class="form-control mt-3" placeholder="Name" required>
            <input type="email" name="Email" class="form-control mt-3" placeholder="Email" required>
            <input type="password" name="Password" class="form-control mt-3" placeholder="Password" required>
            <button class="btn btn-success w-100 mt-3" name="Register">Register</button>
        </form>

        </div>
    </div>

</body>
</html>
