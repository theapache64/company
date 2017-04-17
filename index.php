<?php
	session_start();

	if(isset($_SESSION['company_id'])){
		$cmpId = $_SESSION['company_id'];
		$con = mysqli_connect('localhost','root','mike','company');
		$query = "SELECT username FROM companies WHERE id = '$cmpId' LIMIT 1";
		$result = mysqli_query($con,$query);
		if($result){
			$cmp = $result->fetch_assoc();
		}else{
			die(mysql_error());
		}
	}else{
		header("Location: login.php");
	}


	//Handling edit and delete
	if(isset($_POST['bEdit'])){

		$empId = $_POST['id'];
		$name = $_POST['name'];
		$mobile = $_POST['mobile'];

		$query = "UPDATE employees SET name ='$name' , mobile = '$mobile' WHERE id = '$empId'";
		$result = mysqli_query($con, $query);
		if(!$result){
			die(mysqli_error($con));
		}
	}else if(isset($_POST['bDelete'])){
		$empId = $_POST['id'];
		$query = "DELETE FROM employees WHERE id = '$empId';";
		if(!mysqli_query($con,$query)){
			die(mysqli_error($con));
		}
	}

?>
<html>
	<head>
		<title><?php echo $cmp['username']; ?></title>
	</head>
	<body>
		<h2><?php echo "Welcome ".$cmp['username']; ?> <small><a href="logout.php">(logout)</a></small> </h2>
		<h4>Add Employee</h4>
		<form action="index.php" method="POST">
			<input type="text" name="name" maxlength="50" placeholder="Name">
			<input type="text" name="mobile" maxlength="10" placeholder="Mobile">
			<input type="submit" name="bAdd" value="Add">
		</form>
		<?php
			if(isset($_POST['bAdd'])){
				$name = $_POST['name'];
				$mobile = $_POST['mobile'];
				$query = "INSERT INTO employees (company_id, name, mobile) VALUES ('$cmpId','$name','$mobile');";
				$result = mysqli_query($con,$query);
				if($result){
					echo "Employee added";
				}else{
					die(mysqli_error($con));
				}
			}
		?>

		<h4>Employees</h4>
		<table style="border: 1px solid black;">
			<thead>
				<tr>
					<th>Name</th>
					<th>Mobile</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php

				$query = "SELECT id, name, mobile FROM employees WHERE company_id = '$cmpId' AND is_active = 1 ORDER BY name;";
				$result = mysqli_query($con,$query);
				while($row = $result->fetch_assoc()){
					?>
						<tr>
						<form action="index.php" method="POST">
						<input type="hidden" name="id" value="<?php echo $row['id'];?>">
						<td><input type="text" name="name" maxlength="50" value="<?php echo $row['name']; ?>" placeholder="Name"/></td>
						<td><input type="text" name="mobile" maxlength="10" value="<?php echo $row['mobile']; ?>" placeholder="Mobile"/>
						</td>
						<td><input type="submit" name="bEdit" value="Edit"></td>
						<td><input type="submit" name="bDelete" value="Delete"></td>
						</form>
						</tr>
					<?php
				}

				
			?>
			</tbody>
			</table>
	</body>
</html>