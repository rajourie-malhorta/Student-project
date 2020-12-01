<?php
   
    // Database connection
    require'config/db.php';

    global $wrongPwdErr, $accountNotExistErr, $emailPwdErr, $verificationRequiredErr, $email_empty_err, $pass_empty_err;

    if(isset($_POST['login_btn'])) {
        $email_signin        = $_POST['email_signin'];
        $password_signin     = $_POST['password_signin'];

        // clean data 
        $user_email = filter_var($email_signin, FILTER_SANITIZE_EMAIL);
        $pswd = mysqli_real_escape_string($connection, $password_signin);

        // Query if email exists in db
        $sql = "SELECT * From users WHERE email = '{$email_signin}' ";
        $stmt = mysqli_stmt_init($connection);
        $query = mysqli_query($connection, $sql);
        $rowCount = mysqli_num_rows($query);

        // If query fails, show the reason 
        if(!$query){
           die("SQL query failed: " . mysqli_error($connection));
        }

        if(!empty($password_signin)){
            if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $pswd)) {
                $wrongPwdErr = '<div class="alert alert-danger">
                        Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.
                    </div>';
            }

            // Check if email exist
            if($rowCount <= 0) {
                $accountNotExistErr = '<div class="alert alert-danger">
                        User account does not exist.
                    </div>';
            } 

               else {

                 if ($row = mysqli_fetch_array($query)) {
                    // Then we match the password from the database with the password the user submitted. The result is returned as a boolean.
                    $pwdCheck = password_verify($password_signin, $row['pwdUsers']);
                    // If they don't match then we create an error message!
                    if ($pwdCheck == false) {
                      // If there is an error we send the user back to the signup page.
                      $wrongPwdErr = '<div class="alert alert-danger">
                        Wrong password.
                    </div>';
                    }
                    // Then if they DO match, then we know it is the correct user that is trying to log in!
                    else if ($pwdCheck == true) {

                      // Next we need to create session variables based on the users information from the database. If these session variables exist, then the website will know that the user is logged in.

                      // Now that we have the database data, we need to store them in session variables which are a type of variables that we can use on all pages that has a session running in it.
                      // This means we NEED to start a session HERE to be able to create the variables!
                      session_start();
                      // And NOW we create the session variables.
                      $_SESSION['id'] = $row['id'];
                      $_SESSION['firstname'] = $row['firstname'];
                      $_SESSION['lastname'] = $row['lastname'];
                      $_SESSION['email'] = $row['email'];
                      $_SESSION['mobilenumber'] = $row['mobilenumber'];
                      $_SESSION['b_image'] = $row['b_image'];
                      // Now the user is registered as logged in and we can now take them back to the front page! :)
                      header("Location: ./dashboard.php?login=success");
                      exit();
                    }
                  }
              }
                      
                } 


            }           

?>




















































































<!-- // CREATED BY: RAFAEL AQUINO // 
fb link: https://www.facebook.com/rafael.aquino.186 -->