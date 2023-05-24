<?php
if (!isset($_SESSION['AUTHENTICATION']) && !isset($_SESSION['AUTHENTICATION']['username']) && !isset($_SESSION['AUTHENTICATION']['password'])) {
    header("Location: /");
}
