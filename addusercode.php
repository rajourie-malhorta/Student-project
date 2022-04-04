<?php

 require'config/db.php';
$conn = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.");

if(isset($_POST['registerbtn']) && isset($_FILES["file"]["name"])) {
  $name =  basename($_FILES["file"]["name"]);
  $location = '/uploads/' .$name;
 
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $error= "";
  $message = "";

  if (empty($firstname) || empty($lastname) || empty($email)) {
    header("Location: dashboard.php?error=emptyfields&uid=");

    exit();
  }
  /*elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $uname)) {
    header("Location: dashboard.php?error=invalidmailuid");
    exit();
  }
  // We check for an invalid username AND invalid e-mail.
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $uname)) {
    header("Location: dashboard.php?invalid=name&email");
    $error = "Invalid Name!";
    exit();
  }
  else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: users.php?error=emailalreadyexist");
    $error = "Email Already Exist!";
    exit();
  }
  // We check for an invalid username. In this case ONLY letters and numbers.
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $uname)) {
    header("Location: dashboard.php?name=invalid");
     $error = "Invalid Name!";
    exit();
  }
  // We check for an invalid e-mail.
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: dashboard.php?email=invalid");
     $error = "Invalid Email!";
    exit();
  }*/
  
  else {

    // First we create the statement that searches our database table to check for any identical usernames.
    $sql = "SELECT * FROM users WHERE id=? OR email=?; ";
    // We create a prepared statement.
    $stmt = mysqli_stmt_init($conn);
    // Then we prepare our SQL statement AND check if there are any errors with it.
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      // If there is an error we send the user back to the signup page.
      header("Location: dashboard.php?errorsql");
      exit();
    }
    else {
      // Next we need to bind the type of parameters we expect to pass into the statement, and bind the data from the user.
      // In case you need to know, "s" means "string", "i" means "integer", "b" means "blob", "d" means "double".
      mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $email, $password, $name);
      // Then we execute the prepared statement and send it to the database!
      mysqli_stmt_execute($stmt);
      // Then we store the result from the statement.
      mysqli_stmt_store_result($stmt);
      // Then we get the number of result we received from our statement. This tells us whether the username already exists or not!
      $resultCount = mysqli_stmt_num_rows($stmt);
      // Then we close the prepared statement!
      mysqli_stmt_close($stmt);
      // Here we check if the username exists.
      if ($resultCount > 0) {
        header("Location: dashboard.php?error=emailtaken");
        exit();
      }
      else {
        // If we got to this point, it means the user didn't make an error! :)

        // Next thing we do is to prepare the SQL statement that will insert the users info into the database. We HAVE to do this using prepared statements to make this process more secure. DON'T JUST SEND THE RAW DATA FROM THE USER DIRECTLY INTO THE DATABASE!

        // Prepared statements works by us sending SQL to the database first, and then later we fill in the placeholders (this is a placeholder -> ?) by sending the users data.
        move_uploaded_file($_FILES["file"]["tmp_name"], $name);
        $sql = "INSERT INTO users (firstname, lastname, email, pwdUsers, b_image) VALUES (?, ?, ?, ?, ?)";
        // Here we initialize a new statement using the connection from the dbh.inc.php file.
        $stmt = mysqli_stmt_init($conn);
        // Then we prepare our SQL statement AND check if there are any errors with it.
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          // If there is an error we send the user back to the signup page.
          header("Location: dashboard.php?error=sqlerror");
          exit();
        }
        else {

          // If there is no error then we continue the script!

          // Before we send ANYTHING to the database we HAVE to hash the users password to make it un-readable in case anyone gets access to our database without permission!
          // The hashing method I am going to show here, is the LATEST version and will always will be since it updates automatically. DON'T use md5 or sha256 to hash, these are old and outdated!
          /*$hashedPwd = password_hash($password, PASSWORD_DEFAULT);*/

          // Next we need to bind the type of parameters we expect to pass into the statement, and bind the data from the user.
          mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $email, $password, $name);
          // Then we execute the prepared statement and send it to the database!
          // This means the user is now registered! :)
          mysqli_stmt_execute($stmt);
          // Lastly we send the user back to the signup page with a success message!
          echo "User Added";
          header("Location: dashboard.php?success");
          exit();

        }
      }
    }
  }
  // Then we close the prepared statement and the database connection!
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  // If the user tries to access this page an inproper way, we send them back to the signup page.
  
}


?>
