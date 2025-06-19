<?php

include 'db_config.php';

session_start();
session_unset();
session_destroy();

header("Location: index.php");


