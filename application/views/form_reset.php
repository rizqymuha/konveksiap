<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Lost Password</title>

      <!-- Bootstrap -->
      <link href="<?= base_url(); ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">
      <!-- Font Awesome -->
      <link href="<?= base_url(); ?>admin_assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <style media="screen">
         body{
            background: #00252a;
         }
         .form {
            margin-top: 10%;
         }

         .header {
            font-size: 40px;
            color: #f7f7f7;
         }
         .header .fa {
            border: 2px solid #fcfcfc;
            border-radius: 50%;
            padding: 5px;
         }
         .container {
            padding-top: 5%;
         }
         .form-control {
            padding: 20px 10px;
            font-size: 20px;
         }
         .btn {
            padding: 5px 20px;
            font-size: 16px;
            border-radius: 0px;
         }
      </style>
   </head>

   <body>
      <div class="container">
         <center>
            <span class="header"><i class="fa fa-shopping-cart"></i> OlShopku</span>
         </center>
         <div class="col-md-6 col-sm-12 col-md-offset-3">
            <?php
            if($this->session->flashdata('alert')) {
               echo '<div class="alert alert-warning alert-message">';
               echo $this->session->flashdata('alert');
               echo '</div>';
            }
            echo validation_errors('<p style="color:red">','</p>')
            ?>
            <form class="form" action="" method="post">

               <div class="panel panel-primary">
                  <div class="panel-heading"><h4>Reset Password</h4></div>
                  <div class="panel-body">

                     <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="pass1" class="form-control" placeholder="Password Baru">
                     </div>

                     <div class="form-group">
                        <label>Ketik Ulang Password</label>
                        <input type="password" name="pass2" class="form-control" placeholder="Ketik Ulang Password">
                     </div>

                     <div class="form-group" style="text-align:right">
                        <button type="submit" name="submit" value="Submit" class="btn btn-primary">Update Password</button>
                        <a href="<?= base_url(); ?>login" class="btn btn-default">Sign in..</a>
                     </div>

                  </div>

               </div>

            </form>
         </div>
      </div>
      <!-- jQuery -->
      <script src="<?= base_url(); ?>admin_assets/js/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="<?= base_url(); ?>admin_assets/js/bootstrap.min.js"></script>
      <script type="text/javascript">
         $('.alert-message').alert().delay(3000).slideUp('slow');
      </script>
   </body>
</html>
