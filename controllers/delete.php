<?php 

$mysqli = new mysqli("localhost","root","","crud");
	
if(isset($_POST['deletebtn']))
{
	$id = $_POST['delete_id'];

	$message = "";

	$query = "DELETE FROM users WHERE id ='$id' ";
	$query_run = mysqli_query($mysqli,$query);


	if($query_run)
	{
		echo'<script> alert("Data Deleted"); </script>';
		header('location: dashboard.php?');
	}
	else
	{
		echo'<script> alert("Error Deleting Data"); </script>';
		header('location: dashboard.php?');
	}
}

?>