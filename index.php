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
?>
<html>
	<head>
		<title><?php echo $cmp['username']; ?></title>
	</head>
	<body>
		<h2><?php echo "Welcome ".$cmp['username']; ?> <small><a href="logout.php">(logout)</a></small> </h2>
	</body>
</html>