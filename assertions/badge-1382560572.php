<?php
header('Content-type: application/json');

$data = array(
  'uid' => '1382560572',
  'recipient' => array(
    'type' => 'email',
    'hashed' => false,
    'identity' => 'hmharter@gmail.com'
  ),
  'image' => 'http://insys.vmhost.psu.edu/~hms181/badging/101badge.png',
  'evidence' => 'https://example.org/beths-robot-work2.html',
  'issuedOn' => 1382560572,
  'badge' => 'http://insys.vmhost.psu.edu/~hms181/badging/test-badge.json',
  'verify' => array(
    'type' => 'hosted',
    'url' => 'http://insys.vmhost.psu.edu/~hms181/badging/hmharter1-test-badge.php'
  )
);

echo json_encode($data);
?>
