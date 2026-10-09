<?php
	session_start();

	// ==============================
	// SESSION CHECK
	// ==============================
	if (!isset($_SESSION['Admin_Email'])) {
		echo "<script>window.location.href='admin_login.php';</script>";
		exit();
	}

	// ==============================
	// DATABASE CONNECTION
	// ==============================
	$database = mysqli_connect('localhost', 'root', '', 'fyp_database');

	if (!$database) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// ==============================
	// PROGRAM APPROVAL ACTIONS
	// ==============================
	if (isset($_GET['approve'])) {
		$id = $_GET['approve'];
		mysqli_query($database, 
			"UPDATE programs 
			 SET Approval_Status='Approved' 
			 WHERE id='$id'"
		);
		header("Location: admin_panel.php");
	}

	if (isset($_GET['disapprove'])) {
		$id = $_GET['disapprove'];
		mysqli_query($database, 
			"UPDATE programs 
			 SET Approval_Status='Disapproved' 
			 WHERE id='$id'"
		);
		header("Location: admin_panel.php");
	}

	// ==============================
	// COUNSELLOR STATUS ACTIONS
	// ==============================
	if (isset($_GET['activate'])) {
		$id = $_GET['activate'];
		mysqli_query($database, 
			"UPDATE counsellors 
			 SET Status='Active' 
			 WHERE id='$id'"
		);
		header("Location: admin_panel.php");
	}

	if (isset($_GET['deactivate'])) {
		$id = $_GET['deactivate'];
		mysqli_query($database, 
			"UPDATE counsellors 
			 SET Status='Inactive' 
			 WHERE id='$id'"
		);
		header("Location: admin_panel.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
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
		<a class="navbar-brand text-white" 
		   style="font-size: 25px; font-weight: bold;">
			Mental Wellness - Admin Panel
		</a>

		<ul class="nav" style="gap: 18px;">
			<li class="nav-item">
				<a class="nav-link nav-a" href="admin_panel.php">
					Admin Panel
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link nav-a bg-danger" 
				   href="admin_login.php?logout='1'">
					Logout
				</a>
			</li>
		</ul>
	</div>
</nav>


	<div class="container mt-5">

		<h2 class="text-center text-success">
			Admin Dashboard
		</h2>

		<!-- ==================================
		     PROGRAM APPROVAL SECTION
		================================== -->

		<h4 class="mt-5 text-success">
			All Wellness Programs
		</h4>

		<table class="table table-bordered mt-3">
			<thead class="table-success">
				<tr>
					<th>Title</th>
					<th>Counsellor</th>
					<th>Date</th>
					<th>Time</th>
					<th>Session Status</th>
					<th>Approval Status</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>
				<?php
					$query = "
						SELECT programs.*, counsellors.Name 
						FROM programs
						JOIN counsellors
						ON programs.counsellor_id = counsellors.id
						ORDER BY programs.id DESC
					";

					$result = mysqli_query($database, $query);

					while ($row = mysqli_fetch_assoc($result)) {
				?>
						<tr>
							<td><?php echo $row['Title']; ?></td>
							<td><?php echo $row['Name']; ?></td>
							<td><?php echo $row['Session_Date']; ?></td>
							<td><?php echo $row['Session_Time']; ?></td>
							<td><?php echo $row['Session_Status']; ?></td>
							<td><?php echo $row['Approval_Status']; ?></td>
							<td>
								<a href="?approve=<?php echo $row['id']; ?>" 
								   class="btn btn-success btn-sm">
									Approve
								</a>

								<a href="?disapprove=<?php echo $row['id']; ?>" 
								   class="btn btn-danger btn-sm">
									Disapprove
								</a>
							</td>
						</tr>
				<?php
					}
				?>
			</tbody>
		</table>


		<!-- ==================================
		     COUNSELLOR MANAGEMENT
		================================== -->

		<h4 class="mt-5 text-success">
			Manage Counsellors
		</h4>

		<table class="table table-bordered mt-3">
			<thead class="table-success">
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>

			<tbody>
				<?php
					$counsellors = mysqli_query(
						$database,
						"SELECT * FROM counsellors ORDER BY id DESC"
					);

					while ($row = mysqli_fetch_assoc($counsellors)) {
				?>
						<tr>
							<td><?php echo $row['Name']; ?></td>
							<td><?php echo $row['Email']; ?></td>
							<td><?php echo $row['Status']; ?></td>
							<td>
								<a href="?activate=<?php echo $row['id']; ?>" 
								   class="btn btn-success btn-sm">
									Activate
								</a>

								<a href="?deactivate=<?php echo $row['id']; ?>" 
								   class="btn btn-danger btn-sm">
									Deactivate
								</a>
							</td>
						</tr>
				<?php
					}
				?>
			</tbody>
		</table>

	</div>

</body>
</html>
