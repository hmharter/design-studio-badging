<?php
ini_set('display_errors','On');
error_reporting(E_ALL | E_STRICT);

include("config.php");
session_start();

//$email = mysql_real_escape_string($_POST['emailaddress']);
$email = "hmharter@gmail.com";


$result = mysql_query("SELECT badges.id as id, badges.name as name, badges.criteria as criteria, assertions.assertionid as assertionid FROM badges INNER JOIN assertions ON assertions.badgeid = badges.id WHERE assertions.email = '$email'");
if (!$result) { die("Query failed"); }

$data = array();
while ($row = mysql_fetch_array($result, true)) {
    $data[] = $row;
};

echo json_encode($data);






// $query = "SELECT badges.id, badges.name, badges.criteria FROM badges INNER JOIN assertions ON assertions.badgeid = badges.id WHERE assertions.email = '$email'";

// $result = mysql_query($query) or die(mysql_error());

// var_dump($result);

//   $data = array();
//   while ($row = mysql_fetch_array($result, true)) {
//       $data[] = $row;
//   };

//   echo json_encode($data);

?>