<?php
	session_start();
	if(isset($_SESSION['company_id'])){
		header('Location: index.php');
		return;
	}
?>
<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<form action="login.php" method="POST">
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<input type="submit" name="bLogIn" value="LogIn">
		</form>

		<?php
			if(isset($_POST['bLogIn'])){
				$username = $_POST['username'];
				$password = $_POST['password'];
				$con = mysqli_connect('localhost','root','mike','company');
				if($con){
					$query = "SELECT id FROM companies WHERE username = '$username' AND password='$password' AND is_active = 1 ORDER BY name; ";
					$result = mysqli_query($con,$query);
					$cmpId = null;
					if($result->num_rows > 0){
						$cmpId = $result->fetch_assoc()['id'];
					}else{
						//company doesn't exists
						$query = "INSERT INTO companies (username, password) VALUES ('$username','$password');";
						if(mysqli_query($con, $query)){
							$cmpId = mysqli_insert_id($con);
						}else{
							die("Company failed to add : " + mysqli_error($con));
						}
					}

					$_SESSION['company_id'] = $cmpId;
					header('Location: index.php');


				}else{
					die("Connection error : " . mysql_error());
				}
			}
		?>
	</body>
</html>