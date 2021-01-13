<?php
require "boot.php";
echo json_encode($gateway->clientToken()->generate());

?>