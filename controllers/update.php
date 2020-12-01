<?php 

$mysqli = new mysqli('localhost','root','', 'crud');

	

		if(isset($_POST['updatebtn']))
		{

			$message = "";
			$id = $_POST['update_id'];


			
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];


			
			$query = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE id='$id' ";
			$query_run = mysqli_query($mysqli,$query);

			if($query_run)
			{
				echo '<script> alert("Data Updated"); </script>';
				header('location: dashboard.php?update=success');
			}
			else
			{
				echo '<script> alert("Error Updating Data"); </script>';
				header('location: dashboard.php?update=error');
			}
		}

?>