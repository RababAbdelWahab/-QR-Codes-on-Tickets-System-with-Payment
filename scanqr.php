<?php
session_start();

if( $_SESSION["Type"]!="Provider")
{
    echo "you are not allow to access this page";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charest="UTF-8">
       <title>scan</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <style>
          html, body{
              height: 100%;
              width: 100%;
          }
        </style>
    </head>

<body style="text-align:center; margin-top:100px;">
    <div class="container">
        <br><br>
        <div class="row">
            <div class="col-md-6 offset-md-3" style="background-color:white; padding:20px; box-shadow:10px 10px 5px #888;">
                <div class="panel-heading">
                     <h1>Decode QR codes</h1>
                </div>
                <hr>
                <form method="POST"  action="decode.php" enctype="multipart/form-data">
                    <input type="file" name="qrimage" accept="image/*" id="qrimage" class="form-control">
                    <br>
                    <input  type="submit" class="btn btn-md btn-black btn-danger" value="decode the code">
                </form>
            </div>
        </div>
    </div>
    

</body>
</html>