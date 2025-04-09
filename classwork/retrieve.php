<?php
session_start();
echo "welcome" . $_SESSION['username'];
echo "The role is" . $_SESSION['role'];
?>