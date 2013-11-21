<?php
// ini_set('display_errors','On');
// error_reporting(E_ALL | E_STRICT);
include("config.php");
session_start();


$uid = time();
$email = $_POST['emailaddress'];
$badgeid = $_POST['badges'];
$evidence = $_POST['evidence'];
$file = "/home/hms181/www/badging/data/assertions/b$uid.php";
$handle = fopen($file, 'wb') or die("can't create file");
$issuedOn = $uid;
$badge = "http://insys.vmhost.psu.edu/~hms181/badging/data/badges/$badgeid.json";
$url = "http://insys.vmhost.psu.edu/~hms181/badging/data/assertions/b$uid.php";

$result = mysql_query("SELECT img FROM badges");
if (!$result) { die("No image, query failed"); }

$image = mysql_result($result, 0);



function hashEmailAddress($email, $salt) {
  return 'sha256$' . hash('sha256', $email . $salt);
}

$identity = hashEmailAddress($email, $uid);

$data = "<?php\nheader('Content-type: application/json');\n\n";
fwrite($handle, $data);
$data = "\$data = array(\n";
fwrite($handle, $data);
$data = "  'uid' => '$uid',\n  'recipient' => array(\n    'type' => 'email',\n    'hashed' => true,\n    'salt' => '$uid',\n    'identity' => '$identity'\n  ),\n";
fwrite($handle, $data);
$data = "  'image' => '$image',\n  'evidence' => '$evidence',\n  'issuedOn' => $issuedOn,\n  'badge' => '$badge',\n";
fwrite($handle, $data);
$data = "  'verify' => array(\n    'type' => 'hosted',\n    'url' => '$url'\n  )\n);\n\n";
fwrite($handle, $data);
$data = "echo json_encode(\$data);\n?>\n";
fwrite($handle, $data);

fclose($handle);

echo "http://insys.vmhost.psu.edu/~hms181/badging/data/assertions/b$uid.php"

?>