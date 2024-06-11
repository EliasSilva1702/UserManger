<?php
include_once('userSession.php');

$userSession=new userSession();
$userSession->CloseSession();

header("location: ../index.php");