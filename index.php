<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    echo "<script>window.location.href='index.php';</script>";
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
    <div class="container mt-5 text-center">
    <h1 class="text-success">Admin & Counsellor Management System</h1>
    <p>Our goal is to create a user-friendly online platform dedicated to mental wellness program management within workplaces or educational institutions, where participants can track mood check-ins, schedule counselling sessions, and access resources for well-being. Additionally, the platform will feature a section for connecting users with support networks and self-help tools. With a focus on privacy, accessibility, and proactive care, our platform aims to enhance mental health support by providing everything needed to foster a supportive environment in one place. Participants can select preferred counsellors, share moods via profiles, and request personal sessions, while counsellors create and manage Google Meet sessions for virtual consultations.</p>
    </div>

</body>
</html>
