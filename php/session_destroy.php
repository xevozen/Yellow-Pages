<?php
session_id('id');
session_start();
session_destroy();
header("location:../index.php");
?>