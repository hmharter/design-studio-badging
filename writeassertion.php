<?php

//ini_set('display_errors','On');
//error_reporting(E_ALL | E_STRICT);
$uid = time();
$File = "/home/hms181/www/badging/assertions/b$uid.php";
$Handle = fopen($File, 'wb') or die("can't create file");
$email = $_POST['emailaddress'];
$image = "http://insys.vmhost.psu.edu/~hms181/badging/101badge.png";
$evidence = "https://example.org/beths-robot-work2.html";
$issuedOn = $uid;
$badge = "http://insys.vmhost.psu.edu/~hms181/badging/test-badge.json";
$url = "http://insys.vmhost.psu.edu/~hms181/badging/assertions/b$uid.php";

function hashEmailAddress($email, $salt) {
  return 'sha256$' . hash('sha256', $email . $salt);
}

$identity = hashEmailAddress($email, $uid);

$Data = "<?php\nheader('Content-type: application/json');\n\n";
fwrite($Handle, $Data);
$Data = "\$data = array(\n";
fwrite($Handle, $Data);
$Data = "  'uid' => '$uid',\n  'recipient' => array(\n    'type' => 'email',\n    'hashed' => true,\n    'salt' => '$uid',\n    'identity' => '$identity'\n  ),\n";
fwrite($Handle, $Data);
$Data = "  'image' => '$image',\n  'evidence' => '$evidence',\n  'issuedOn' => $issuedOn,\n  'badge' => '$badge',\n";
fwrite($Handle, $Data);
$Data = "  'verify' => array(\n    'type' => 'hosted',\n    'url' => '$url'\n  )\n);\n\n";
fwrite($Handle, $Data);
$Data = "echo json_encode(\$data);\n?>\n";
fwrite($Handle, $Data);

fclose($Handle);

echo "http://insys.vmhost.psu.edu/~hms181/badging/assertions/b$uid.php"

?>