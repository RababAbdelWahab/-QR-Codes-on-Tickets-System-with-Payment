<?php
session_start();

if( $_SESSION["Type"]!="Provider")
{
    echo "you are not allow to access this page";
    exit();
}
require "boot.php";

if(empty($_POST["payment_method_nonce"]))
{
    header("Location: index.php");
}
$result = $gateway->transaction()->sale([
    'amount' => $_POST["amount"],
    'paymentMethodNonce' => $_POST["payment_method_nonce"],
    'customer' => [
        'firstName' => $_POST["firstName"],
        'lastName' => $_POST["lastName"]
    ],
    'options' => [ 'submitForSettlement' => true ]
]);

if ($result->success == true) {
}
else
{
    print_r($result->errors);
    die();
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
     <title>payment report</title>
     <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        
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

<a href="../logout.php" class="button">Log Out</a>
<br>
    <label for="ID" class="heading">Transaction ID</label><br>
    <input id="ID" name="ID" type="text" value="<?php echo $result->transaction->id;?>" disabled="disabled"><br><br>


    <label for="firstName" class="heading">First Name</label><br>
    <input id="firstName" name="firstName" type="text" value="<?php echo $result->transaction->customer["firstName"];?>" disabled="disabled"><br><br>

    <label for="lastName" class="heading">Last Name</label><br>
    <input id="lastName" name="lastName" type="text" value="<?php echo $result->transaction->customer["lastName"];?>" disabled="disabled"><br><br>

    <label for="amount" class="heading">Ticket Price</label><br>
    <input id="amount" name="amount" type="text" value="<?php echo $result->transaction->amount." ".$result->transaction->currencyIsoCode;?>" disabled="disabled"><br><br>

    <label for="location" class="heading">Location</label><br>
    <input id="location" name="location" type="text" value="<?php echo $_POST["location"];?>" disabled="disabled"><br><br>

    <label for="date" class="heading">Date</label><br>
    <input id="date" name="date" type="text" value="<?php echo  date('Y-m-d H:i:s');?>" disabled="disabled"><br><br>

    <label for="provider" class="heading">Service provider ID</label><br>
    <input id="provider" name="provider" type="text" value="1" disabled="disabled"><br><br>

    <label for="status" class="heading">status</label><br>
    <input id="status" name="status" type="text" value="successful" disabled="disabled"><br><br>

    <br><br>
    <button  type="button" onclick="myFunction();">generate QR code</button>
<div class="form-group" id="qrCode">   </div>
<script>
    function myFunction() {
        var transactionID=document.getElementById("ID").value;
        var firstName=document.getElementById("firstName").value;
        var lastName=document.getElementById("lastName").value;
        var amount=document.getElementById("amount").value;
        var location=document.getElementById("location").value;
        var date=document.getElementById("date").value;
        var provider=document.getElementById("provider").value;


        var formData = 'firstName='+firstName+'&lastName='+lastName+'&transactionID='+transactionID+'&amount='+amount+'&location='+location+'&date='+date+'&provider='+provider;
        $.ajax({
        url: "qr.php",
        type: "post",
        data: formData,
        success: function(result) { 
                var html=result;
                $( "#qrCode" ).html( html );

            }                              
            });
    }

    
</script>

</body>
</html>
