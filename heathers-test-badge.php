<?php
header('Content-type: application/json');

$data = array(
  "uid" => "f2c20",
  "recipient" => array(
    "type" => "email",
    "hashed" => false,
    "identity" => "hmharter@gmail.com"
  ),
  "image" => "http://insys.vmhost.psu.edu/~hms181/badging/101badge.png",
  "evidence" => "https://example.org/beths-robot-work2.html",
  "issuedOn" => 1380217622,
  "badge" => "http://insys.vmhost.psu.edu/~hms181/badging/test-badge.json",
  "verify" => array(
    "type" => "hosted",
    "url" => "http://insys.vmhost.psu.edu/~hms181/badging/heathers-test-badge.php"
  )
);

// Send the data.
echo json_encode($data);

?>