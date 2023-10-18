<?php

session_start();

session_destroy();

header('Location: /annuaire/index.php');
exit();
?>
