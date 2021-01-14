<?php
//DB connection
$url='localhost';
$username='root';
$password='';
$conn=mysqli_connect($url,$username,$password,"qrcode");
if(!$conn){
    die('Could not Connect My Sql:' .mysql_error());
}

if($_POST)
{
  $first_name=$_POST["firstName"];
  $last_name=$_POST["lastName"];
  $email=$_POST["email"];
  $pass=$_POST["psw"];
  $type=$_POST["type"];

  $sql=mysqli_query($conn,"SELECT * FROM user where Email='$email'");
  //check if the mail is used before
  if(mysqli_num_rows($sql)>0)
  {
      echo "Email Id Already Exists"; 
      exit;
  }
  else if(isset($_POST['save']))
  {
          //encrept the password for security
          $encPass=md5($pass);
          //add the user in DB
          $query="INSERT INTO user(First_Name, Last_Name, Email, Password, Type ) VALUES ('$first_name', '$last_name', '$email', '$encPass', '$type')";
          $sql=mysqli_query($conn,$query)or die("Could Not Perform the Query");
          header ("Location: login.php?status=success");

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
       <form action="signup.php" style="border:1px solid #ccc" method="post">
          <div class="container">
            <h1>Sign Up</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>
            <label for="firstName"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="firstName" required>

            <label for="lastName"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="lastName" required>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <label for="type"><b>Account Type</b></label>
            <select name="type" id="type" required>
                <option value="Customer">Customer</option>
                <option value="Provider">Services Provider</option>
              
             </select>    
             <div class="clearfix">
                <button type="submit" name="save" class="signupbtn">Sign Up</button>
             </div>
          </div>
        </form>
      </div>
    </center>
  </body>
</html>
