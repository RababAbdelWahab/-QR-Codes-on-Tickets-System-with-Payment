<?php
session_start();

if( $_SESSION["Type"]!="Customer")
{
    echo "you are not allow to access this page";
    exit();
}
require_once 'phpqrcode/qrlib.php';
if(!empty($_REQUEST))
{
$path='images/';
$file=$path.uniqid().".png";

$text="FirstName: ".$_REQUEST["firstName"].", ";
$text .="LastName: ".$_REQUEST["lastName"].", ";
$text .="Price: ".$_REQUEST["amount"].", ";
$text .="TransactionID: ".$_REQUEST["transactionID"].", ";
$text .="Location: ".$_REQUEST["location"].", ";
$text .="Provider ID: ".$_REQUEST["provider"].", ";


QRcode::png($text,$file,'L',10,2);
echo "<img src='".$file."'>";
}
else
{
}
?>