<?php
header('Content-type: application/json');

$data = array(
  'uid' => '1382622173',
  'recipient' => array(
    'type' => 'email',
    'hashed' => true,
    'salt' => 1382622173,
    'identity' => 'sha256$cfce3515e6d38b37d0b2d248ae0fbbcc9c4412203ca5b6cf47edf1258f74a462'
  ),
  'image' => 'http://insys.vmhost.psu.edu/~hms181/badging/101badge.png',
  'evidence' => 'https://example.org/beths-robot-work2.html',
  'issuedOn' => 1382622173,
  'badge' => 'http://insys.vmhost.psu.edu/~hms181/badging/test-badge.json',
  'verify' => array(
    'type' => 'hosted',
    'url' => 'http://insys.vmhost.psu.edu/~hms181/badging/assertions/badge-1382622173.php'
  )
);

echo json_encode($data);
?>
