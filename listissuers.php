<?php
// ini_set('display_errors','On');
// error_reporting(E_ALL | E_STRICT);
include("config.php");
session_start();

$result = mysql_query("SELECT id, name, url FROM issuers");
if (!$result) { die("Query failed"); }

$data = array();
while ($row = mysql_fetch_array($result, true)) {
  $data[] = $row;
};

echo json_encode($data);

?>