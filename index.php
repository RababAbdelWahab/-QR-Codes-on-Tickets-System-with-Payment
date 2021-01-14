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
       <title>pay</title>
        <!-- includes the Braintree JS client SDK -->
        <script src="https://js.braintreegateway.com/web/dropin/1.25.0/js/dropin.min.js"></script>
        <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>


        <!-- includes jQuery -->
        <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
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
            label.heading{
                font-weght:600;
            }
            .payment-form{
                width:300px;
                margin-left:auto;
                margin-right:auto;
                padding:10px;
                border: 1px #333 solid;
            }
        </style>
    </head>

<body style="text-align:center; margin-top:100px;">

<form method="post" class="payment-form" action="payment.php">
    <label for="firstName" class="heading">First Name</label><br>
    <input id="firstName" name="firstName" type="text" value="<?php echo $_SESSION["First_Name"];?>"><br><br>

    <label for="lastName" class="heading">Last Name</label><br>
    <input id="lastName" name="lastName" type="text" value="<?php echo $_SESSION["Last_Name"];?>"><br><br>

    <label for="location" class="heading">Location</label><br>
    <input id="location" name="location" type="text" ><br><br>

    <label for="amount" class="heading">Ticket Price</label><br>
    <input id="amount" name="amount" type="text" value="<?php echo rand(50,150); ?>" readonly><br><br>

                   
    <div id="dropin-container"> </div>

    <br><br>
    <button  type="submit">pay</button>
</form>

</body>
</html>