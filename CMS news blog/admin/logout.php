<?php
include("common.php");
session_unset();
session_destroy();
header("Location: " . $main_url . "admin/index.php");
