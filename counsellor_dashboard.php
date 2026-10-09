<?php
	session_start();

	// ==============================
	// SESSION CHECK
	// ==============================
	if (!isset($_SESSION['Counsellor_ID'])) {
		header("Location: counsellor_login.php");
		exit();
	}

	// ==============================
	// DATABASE CONNECTION
	// ==============================
	$database = mysqli_connect('localhost', 'root', '', 'fyp_database');

	if (!$database) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$counsellor_id = $_SESSION['Counsellor_ID'];

	// ==============================
	// ADD PROGRAM
	// ==============================
	if (isset($_POST['Add'])) {

		$Title       = $_POST['Title'];
		$Description = $_POST['Description'];
		$Date        = $_POST['Date'];
		$Time        = $_POST['Time'];
		$Link        = $_POST['Link'];

		mysqli_query($database,
			"INSERT INTO programs
			(counsellor_id, Title, Description, Session_Date, Session_Time, Meet_Link)
			VALUES
			('$counsellor_id', '$Title', '$Description', '$Date', '$Time', '$Link')"
		);

		header("Location: counsellor_dashboard.php");
	}

	// ==============================
	// DELETE PROGRAM
	// ==============================
	if (isset($_GET['delete'])) {

		$id = $_GET['delete'];

		mysqli_query($database,
			"DELETE FROM programs
			 WHERE id='$id'
			 AND counsellor_id='$counsellor_id'"
		);

		header("Location: counsellor_dashboard.php");
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
		<a class="navbar-brand text-white" 
		   style="font-size: 25px; font-weight: bold;">
			Mental Wellness - Counsellor Panel
		</a>

		<ul class="nav" style="gap: 18px;">
			<li class="nav-item">
				<a class="nav-link nav-a" href="counsellor_dashboard.php">
					Dashboard
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link nav-a bg-danger" 
				   href="counsellor_logout.php">
					Logout
				</a>
			</li>
		</ul>
	</div>
</nav>


	<div class="container mt-5">

		<h2 class="text-center text-success">
			Counsellor Dashboard
		</h2>

		<!-- ==============================
		     ADD PROGRAM FORM
		============================== -->

		<div class="card p-4 shadow mt-4">
			<h4 class="text-success">Add Wellness Program</h4>

			<form method="post">

				<input type="text"
					   name="Title"
					   class="form-control mt-2"
					   placeholder="Program Title"
					   required>

				<textarea name="Description"
						  class="form-control mt-2"
						  placeholder="Description"></textarea>

				<input type="date"
					   name="Date"
					   class="form-control mt-2"
					   required>

				<input type="time"
					   name="Time"
					   class="form-control mt-2"
					   required>

				<input type="text"
					   name="Link"
					   class="form-control mt-2"
					   placeholder="Google Meet Link">

				<button class="btn btn-success mt-3"
						name="Add">
					Add Program
				</button>

			</form>
		</div>

		<!-- ==============================
		     PROGRAM LIST
		============================== -->

		<h4 class="mt-5 text-success">
			My Programs
		</h4>

		<table class="table table-bordered mt-3">
			<thead class="table-success">
				<tr>
					<th>Title</th>
					<th>Date</th>
					<th>Status</th>
					<th>Approval</th>
					<th>Action</th>
				</tr>
			</thead>

			<tbody>
				<?php
					$result = mysqli_query($database,
						"SELECT * FROM programs
						 WHERE counsellor_id='$counsellor_id'
						 ORDER BY id DESC"
					);

					while ($row = mysqli_fetch_assoc($result)) {
				?>
						<tr>
							<td><?php echo $row['Title']; ?></td>
							<td><?php echo $row['Session_Date']; ?></td>
							<td><?php echo $row['Session_Status']; ?></td>
							<td><?php echo $row['Approval_Status']; ?></td>
							<td>
								<a href="?delete=<?php echo $row['id']; ?>"
								   class="btn btn-danger btn-sm">
									Delete
								</a>
							</td>
						</tr>
				<?php } ?>
			</tbody>
		</table>

	</div>

</body>
</html>
