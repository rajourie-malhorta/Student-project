<?php 
include('config/db.php'); 
include 'controllers/delete.php';
include('controllers/update.php');
include('addusercode.php');
global $alert;

if(!isset($_SESSION['id'])){
  header("Location: index.php?user=bad");
}

    $b_image = $_SESSION['b_image'];
    $b_image2 = './uploads/' .$b_image;


    $b_image3 = "style='background-image: url($b_image2);'";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <!-- get -->
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style type="text/css">
  body {

    background-size: cover;
  }
</style>
</head>

<body <?php echo $b_image3?> >

    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 25rem">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Admin Profile</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $_SESSION['firstname']; ?>
                        <?php echo $_SESSION['lastname']; ?></h6>
                    <p class="card-text">Email address: <?php echo $_SESSION['email']; ?></p>
                    
                    
                    <a class="btn btn-danger btn-block" href="controllers/logout.php">Log out</a>
                </div>
            </div>
        </div>
    </div>
    <br>

    <?php 

      $mysqli = new mysqli('localhost', 'root', '', 'crud') or die (mysqli_error($mysqli));
      $result = $mysqli->query("SELECT * FROM users") or die ($mysqli->error);
    ?>
<div class="container">
  <div class="row justify-content-center">
    <section class="section-default">
      <center>
    <h3 class="records">Records</h3>
    </center>
        <table id="datatableid" class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Email</th>
          <th>Password</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php while ($row = $result->fetch_assoc()):?> 
        <tr>
          <td><?php echo $row['id']?></td>
          <td><?php echo $row['firstname']?></td>
          <td><?php echo $row['lastname']?></td>
          <td><?php echo $row['email']?></td>
          <td><?php echo $row['pwdUsers']?></td>
          <td>
            
          <button type="submit"class="btn btn-outline-info btn-sm editbtn">EDIT</button>
          <button type="submit"class="btn btn-outline-danger btn-sm deletebtn">DELETE</button>
          
        </td>
        </tr>
      <?php endwhile;?>
      </tbody>
  </table>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Add User
</button>
    </section>
  </div>
</div>
          
          

<!-- DIVIDER -->
<!--EDIT POP UP FORM-->

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit user data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <?php 
         if(isset($_GET["update"]))
              {
                if($_GET["update"] == "success")
                {
                  echo  '<script> alert("Successfully updated!"); </script>';
                }
                elseif ($_GET["updated"] == "error") {
                   echo  '<script> alert("There was an error updating the data!"); </script>';
                 } 
              }
          ?>
          <form action="" method="POST">
          <div class="modal-body">
              <input type="hidden" name="update_id" id="update_id">

              <div class="form-group">
                <label>Firstname</label>
                <input type="text" name="firstname" id="firstname" class="form-control" autocomplete="off" >
              </div>


               <div class="form-group">
                <label>Lastname</label>
                <input type="text" name="lastname" id="lastname" class="form-control" autocomplete="off" >
              </div>


               <div class="form-group" >
                  <label>Email</label>
                  <input type="text" name="email" id="email" class="form-control" autocomplete="off" >
              </div>


              <div class="form-group" >
                  <label>Password</label>
                  <input type="text" name="password" id="password" class="form-control" autocomplete="off" disabled="">
              </div>
              



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" name="updatebtn" class="btn btn-primary">Update</button>
          </div>
          </form>
    </div>
  </div>
</div>
<!-- END OF DIVIDER -->




<!--DELETE POP UP FORM-->

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete user data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php 
          if(isset($_GET["delete"]))
              {
                if($_GET["delete"] == "success")
                {
                  echo  '<script> alert("Successfully deleted!"); </script>';
                }
                elseif ($_GET["delete"] == "error") {
                   echo  '<script> alert("There was an error deleting the data!"); </script>';
                 } 
              }
          ?>
          <form action="" method="POST">
          <div class="modal-body">
          <input type="hidden" name="delete_id" id="delete_id">
          <center> 
          <h4>Are you sure?</h4>

          <h6 >Do you really want to delete the records of selected user? <br>This process cannot be undone.</h6>
          </center>
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" name="deletebtn" class="btn btn-danger">Yes</button>
          </div>
          </form>
    </div>
  </div>
</div>
<!-- END OF DIVIDER -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registration Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <!--  <?php
       if(isset($_GET["error"]))
              {
                if($_GET["error"] == "usernametaken")
                {
                  echo  '<script> alert("Invalid Username or Email address!"); </script>';
                }
              }


        ?> -->


          <form action="" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Firstname</label>
              <input type="text" name="firstname" class="form-control" autocomplete="off" required="">
            </div>
             <div class="form-group">
              <label>Lastname</label>
              <input type="text" name="lastname" class="form-control" autocomplete="off" required="">
            </div>
             <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" autocomplete="off" required="">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" autocomplete="off" required="">
            </div>
           <!--  <div class="form-group">
              <label>Confirm</label>
              <input type="password" name="confirmpwd" class="form-control" autocomplete="off" required="">
            </div> -->
            <div class="form-group">
              <label for="background_image">Choose background-image</label>
              <input type="file" name="file" id="file">
              <span id="uploaded_image"></span>
            </div>

                      
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Register</button>
          </div>
          </form>


    </div>
  </div>

</div>
          

</body>

</html>
<!-- Edit button function -->

  <script>
    
    $(document).ready(function() {
      $('.editbtn').on('click',function(){

        $('#editmodal').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          console.log(data);


          $('#update_id').val(data[0]);
          $('#firstname').val(data[1]);
          $('#lastname').val(data[2]);
          $('#email').val(data[3]);
          $('#password').val(data[4]);


      });
    });
 </script>

<!-- Delete button function -->
<script>
    
    $(document).ready(function() {
      $('.deletebtn').on('click',function(){

        $('#deletemodal').modal('show');





          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          console.log(data);


          $('#delete_id').val(data[0]);


          

      });
    });
  </script>
  <script>
  
  $(document).ready(function() {

    $('#datatableid').DataTable({
        "pagingtype": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records..",
        }
    });

});

</script>

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








































































