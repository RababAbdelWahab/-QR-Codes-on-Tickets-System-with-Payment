<?php
session_start();
//check the user access rights
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
//send the data to payment and make a transaction
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
     <link rel="stylesheet" type="text/css" href="../style/style.css" media="screen"/>
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

<body style="text-align:center; margin-top:100px;">
<a href="../logout.php" class="button">Log Out</a>
<br>
<div class="payment-form">
    <label for="ID" class="heading"><b>Transaction ID</b></label>
    <input id="ID" name="ID" type="text" value="<?php echo $result->transaction->id;?>" disabled="disabled"><br>

    <label for="firstName" class="heading"><b>First Name</b></label>
    <input id="firstName" name="firstName" type="text" value="<?php echo $result->transaction->customer["firstName"];?>" disabled="disabled"><br>

    <label for="lastName" class="heading"><b>Last Name</b></label>
    <input id="lastName" name="lastName" type="text" value="<?php echo $result->transaction->customer["lastName"];?>" disabled="disabled"><br>

    <label for="amount" class="heading"><b>Ticket Price</b></label>
    <input id="amount" name="amount" type="text" value="<?php echo $result->transaction->amount." ".$result->transaction->currencyIsoCode;?>" disabled="disabled"><br>

    <label for="location" class="heading"><b>Location</b></label>
    <input id="location" name="location" type="text" value="<?php echo $_POST["location"];?>" disabled="disabled"><br>

    <label for="date" class="heading"><b>Date</b></label>
    <input id="date" name="date" type="text" value="<?php echo  date('Y-m-d H:i:s');?>" disabled="disabled"><br>

    <label for="provider" class="heading"><b>Service provider ID</b></label>
    <input id="provider" name="provider" type="text" value="1" disabled="disabled"><br>

    <label for="status" class="heading"><b>status</b></label>
    <input id="status" name="status" type="text" value="successful" disabled="disabled">

    <br><br>
    <button  type="button" onclick="myFunction();">generate QR code</button>
    </div>
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
