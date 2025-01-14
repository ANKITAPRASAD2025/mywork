<?php
session_start();
echo "logout successfully" . session_destroy();
// header('location:admin/signin.php/');
