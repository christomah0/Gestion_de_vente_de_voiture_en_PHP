<?php
session_start();
$_SESSION['AUTHENTICATION'] = array();
session_destroy();

header("Location: /");
