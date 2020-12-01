<?php 
session_start();
include"controllers/register.php";

if(isset($_SESSION['id'])){
  header("Location: dashboard.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

    <!-- Sign Up form -->
    <div class="App">
        <div class="vertical-center">
            <div class="inner-block">
                <form action="" method="POST" enctype="multipart/form-data" >
                    <h3>Sign Up</h3>
                    <?php echo $_passwordErr ?>
                    <?php echo $success_msg ?>
                    <?php echo $email_exist ?>
                    <?php echo $f_NameErr ?>
                    <?php echo $l_NameErr ?>
                    <?php echo $_emailErr ?>
                    <?php echo $_mobileErr ?>
                    <?php echo $fNameEmptyErr ?>
                    <?php echo $lNameEmptyErr ?>
                    <?php echo $emailEmptyErr ?>
                    <?php echo $mobileEmptyErr ?>
                    <?php echo $passwordEmptyErr ?>


                    <div class="form-group">
                        <label>Firstname</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" />
                    </div>

                    <div class="form-group">
                        <label>Lastname</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" />
                    </div>
          
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email" />
                    </div>

                    <!-- <div class="form-group">
                        <label>Mobile#</label>
                        <input type="number" class="form-control" name="mobilenumber" id="mobilenumber" />
                    </div> -->

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password" />
                    </div>
                    
                    <div class="form-group">
                    <label for="background_image">Choose background-image</label>
                    <input type="file" name="file" id="file">
                    <span id="uploaded_image"></span>
                    </div>

                    <button type="submit" name="signup_btn" id="sign_up"
                        class="btn btn-outline-success btn-lg btn-block">Sign
                        Up</button>
                        <br>
                        <a href="index.php" class="link">Already have an account?</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
<script type="text/javascript">
  $(document).ready(function(){
      $(document).on('change', '#file', function(){
        var property = document.getElementById('file').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();

        if(jQuery.inArray(image_extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {

          alert("Invalid image file");
        }

        var image_size = property.size;
        if(image_size > 5000000) {

          alert("Image file size is very big")
        }
        else {

          var form_data = new FormData();
          form_data.append("file", property);
          $.ajax({
              url: "upload.php",
              method: "POST",
              data: form_data,
              contentType: false,
              cache: false,
              processData: false,
              beforeSend: function() {
                $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
              },
              success: function(data) {
                $('#uploaded_image').html(data);
              }
          })
        }
      });
  });

</script>


































































































































