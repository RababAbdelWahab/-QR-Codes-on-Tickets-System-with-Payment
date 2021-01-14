<?php
//DB connection
$url='localhost';
$username='root';
$password='';
$conn=mysqli_connect($url,$username,$password,"qrcode");
if(!$conn){
    die('Could not Connect My Sql:' .mysql_error());
}

//start the session after login  
session_start();
if(isset($_POST['login']))
{
    if($_POST)
    {
        $email=$_POST["email"];
        $pass=$_POST["psw"];

        //encrept the password for security
        $encPass=md5($pass);
        //get the data of login user
        $sql=mysqli_query($conn,"SELECT * FROM user where Email='$email' and Password='$encPass'");
        $row  = mysqli_fetch_array($sql);

        //check if the user is aready regester or not
        if(is_array($row))
        {
            $_SESSION["ID"] = $row['ID'];
            $_SESSION["Email"]=$row['Email'];
            $_SESSION["First_Name"]=$row['First_Name'];
            $_SESSION["Last_Name"]=$row['Last_Name']; 
            $_SESSION["Type"]=$row['Type']; 
            //redirect to home is dependent on user type
            if($row['Type']=="Customer")
            {
                header("Location: customer/scanqr.php"); 
            }
            else
            {
                header("Location: provider/index.php"); 
            }
        }
        else
        {
            echo "Invalid Email or Password";
        }
    }
}

?>
<!DOCTYPE html>
<html>
  <head>
      <link rel="stylesheet" type="text/css" href="style/style.css" media="screen"/>
      <style>
        /* Change styles for cancel button and signup button on extra small screens */
        @media screen and (max-width: 300px) {
          .cancelbtn, .signupbtn {
            width: 100%;
          }
        }
      </style>
   </head>
  <body>
      <center>
        <div style="width:45%; text-align:left;">
          <form action="login.php" style="border:1px solid #ccc" method="post">
            <div class="container">
              <h1>LOG IN</h1>
              <p>Please fill in this form to login.</p>
              <p> Don't have account ? <a href="signup.php" class="button">Sign Up</a></p> 
              
              <hr>
              
              <label for="email"><b>Email</b></label>
              <input type="text" placeholder="Enter Email" name="email" required>

              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required>
              
              <div class="clearfix">
                <button type="submit" name="login" class="loginbtn">LOG IN</button>
              </div>
            </div>
          </form>
        </div>
      </center>
    </body>
</html>
