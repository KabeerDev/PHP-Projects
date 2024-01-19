<?php
session_start();
session_unset();
session_destroy();
header('Location: /projects/.23 (Online Forum Website)/index.php');
exit();
