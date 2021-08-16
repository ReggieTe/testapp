<?php

$action = filter_var(strtolower(trim($_GET['type'], FILTER_SANITIZE_STRING)));

$path = "web/views/authorize/" . $action . "/engine.php";

if (is_file($path)) {
    include $path;
} else {
    include 'web/views/home/index.php';
}
