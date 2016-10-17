<?php
header("Content-Type:application/json");
$body = file_get_contents('https://www.jstree.com/fiddle/?lazy');
$json = json_decode($body);
echo json_encode($json);