<?php
session_start();
$con=mysqli_connect("localhost","root","","myhmsdb");

if(isset($_POST['adsub'])){
	$username=$_POST['username1'];
	$password=$_POST['password2'];
	$query="SELECT * FROM admintb WHERE username=? AND password=?";
	$stmt = mysqli_prepare($con, $query);
	mysqli_stmt_bind_param($stmt, "ss", $username, $password);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if(mysqli_num_rows($result)==1)
	{
		$_SESSION['username']=$username;
		$_SESSION['se']=1;
		header("Location:admin-panel1.php");
	}
	else
	{
		echo "<script>alert('Invalid Username or Password. Try Again!');
			window.location.href = 'index.php';</script>";
	}
	mysqli_stmt_close($stmt);
}

if(isset($_POST['update_data']))
{
	$contact=$_POST['contact'];
	$status=$_POST['status'];
	$query="UPDATE appointmenttb SET payment=? WHERE contact=?";
	$stmt = mysqli_prepare($con, $query);
	mysqli_stmt_bind_param($stmt, "ss", $status, $contact);
	mysqli_stmt_execute($stmt);
	header("Location:updated.php");
	mysqli_stmt_close($stmt);
}

function display_docs()
{
	global $con;
	$query="SELECT * FROM doctb";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
		$name=$row['name'];
		echo '<option value="'.$name.'">'.$name.'</option>';
	}
}

if(isset($_POST['doc_sub']))
{
	$name=$_POST['name'];
	$query="INSERT INTO doctb (name) VALUES (?)";
	$stmt = mysqli_prepare($con, $query);
	mysqli_stmt_bind_param($stmt, "s", $name);
	mysqli_stmt_execute($stmt);
	header("Location:adddoc.php");
	mysqli_stmt_close($stmt);
}
?>
