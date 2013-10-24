<?php
header('Content-type: application/json');

$data = array(
  'uid' => '1382622093',
  'recipient' => array(
    'type' => 'email',
    'hashed' => false,
    'identity' => 'sha256$d1e5f012ac3e53bfeca1b46f7f328b78f764478bc2e93d33efbc91433c8e08ad'
  ),
  'image' => 'http://insys.vmhost.psu.edu/~hms181/badging/101badge.png',
  'evidence' => 'https://example.org/beths-robot-work2.html',
  'issuedOn' => 1382622093,
  'badge' => 'http://insys.vmhost.psu.edu/~hms181/badging/test-badge.json',
  'verify' => array(
    'type' => 'hosted',
    'url' => 'http://insys.vmhost.psu.edu/~hms181/badging/assertions/badge-1382622093.php'
  )
);

echo json_encode($data);
?>
