<?php
session_start();
//check the user access rights
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
        <title>pay</title>
        <!-- includes the Braintree JS client SDK -->
        <script src="https://js.braintreegateway.com/web/dropin/1.25.0/js/dropin.min.js"></script>
        <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <!-- includes jQuery -->
        <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../style/style.css" media="screen"/>

       <script>
            $.ajax({
                url: "token.php",
                type: "get",
                dataType: "json",
                success: function(data) {    
                    braintree.setup(data,'dropin',{ container : 'dropin-container' });
                }                              
            });
       </script>
       <style>
           input[type=text], input[type=password] {
            width: 100%;
            padding: 10px;
            margin: -5px 0 5px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
            }
       </style>
    </head>

    <body style="text-align:center; margin-top:40px;">
        <a href="../logout.php" class="button">Log Out</a>
        <br><br>
        <form method="post" class="payment-form" action="payment.php">
            <label for="firstName" ><b>First Name</b></label>
            <input id="firstName"  name="firstName" type="text" value="<?php echo $_SESSION["First_Name"];?>"><br>

            <label for="lastName" class="heading"><b>Last Name</b></label>
            <input id="lastName"  name="lastName" type="text" value="<?php echo $_SESSION["Last_Name"];?>"><br>

            <label for="location" class="heading"><b>Location</b></label>
            <input id="location"  name="location" type="text" ><br>

            <label for="amount" class="heading"><b>Ticket Price</b></label>
            <input id="amount"  name="amount" type="text" value="<?php echo rand(50,150); ?>" readonly>
        
            <div id="dropin-container"> </div>

            <br><br>
            <button  type="submit">pay</button>
        </form>
    </body>
</html>