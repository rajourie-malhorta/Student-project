<?php 
session_start();
include"controllers/login.php";

global $alert;
if(isset($_SESSION['id'])){
  header("Location: dashboard.php");
}  else {
    $alert = '<p class="alert alert-danger>
              Oops!, you cant do that here, you need an account to access that site.
                </p>"';
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

    <!-- Login form -->
    <div class="App">
        <div class="vertical-center">

            <div class="inner-block">
                <form action="" method="POST">
                    <h3>Login</h3>
                    <?php 

                    if(isset($_GET['user'])) {
                         if ($_GET['user'] == "bad") {
                            echo '<p style="color: #E30B29">
                               Oops!, you cant do that here, go create an account or login first. <a href="signup_form.php"><br>Click here to create account</a></p>';
                    }
                }

                     ?>
                    <?php echo $emailPwdErr; ?>
                    <?php echo $email_empty_err; ?>
                    <?php echo $wrongPwdErr; ?>
                    <?php echo $accountNotExistErr; ?>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email_signin" id="email_signin" />
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password_signin" id="password_signin" />
                    </div>

                    <button type="submit" name="login_btn" id="sign_in"
                        class="btn btn-outline-primary btn-lg btn-block">Sign
                        in</button>
                        <br>
                     Be a member,   
                    <a href="signup_form.php" class="link">Sign Up now!</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>


































































































































<!-- // CREATED BY: RAFAEL AQUINO // 
fb link: https://www.facebook.com/rafael.aquino.186 -->
