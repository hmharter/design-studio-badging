<?php
header('Content-type: application/json');

$data = array(
  'uid' => '1382622126',
  'recipient' => array(
    'type' => 'email',
    'hashed' => false,
    'identity' => 'sha256$0cfb419b3288aa77e2e7ac330bee37139e93e50715604859de36327c341e3101'
  ),
  'image' => 'http://insys.vmhost.psu.edu/~hms181/badging/101badge.png',
  'evidence' => 'https://example.org/beths-robot-work2.html',
  'issuedOn' => 1382622126,
  'badge' => 'http://insys.vmhost.psu.edu/~hms181/badging/test-badge.json',
  'verify' => array(
    'type' => 'hosted',
    'url' => 'http://insys.vmhost.psu.edu/~hms181/badging/assertions/badge-1382622126.php'
  )
);

echo json_encode($data);
?>
