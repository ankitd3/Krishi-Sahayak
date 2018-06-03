<?php

session_unset(); 

// destroy the session 
session_destroy(); 

header('Location:../login.html');

?>