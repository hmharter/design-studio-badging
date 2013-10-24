<?php
ini_set('display_errors','On');
error_reporting(E_ALL | E_STRICT);

include("config.php");
session_start();


// if($_SERVER['REQUEST_METHOD'] == 'POST')
// {
    $uid = time();
    // $badgename = mysql_real_escape_string($_POST['badgename']);
    // $badgedesc = mysql_real_escape_string($_POST['badgedesc']);
    // $badgeimg = mysql_real_escape_string($_POST['badgeimg']);
    // $badgecriteria = mysql_real_escape_string($_POST['badgecriteria']);
    // $badgeissuer = mysql_real_escape_string($_POST['issuers']);

    $badgename = "New Awesome Badge";
    $badgedesc = "This is the new awesome badge that I earned";
    $badgeimg = "http://insys.vmhost.psu.edu/~hms181/badging/101badge.png";
    $badgecriteria = "https://example.org/robotics-badge.html";
    $badgeissuer = "1382642578";

    $query = "INSERT INTO badges (id, name, img, criteria, issuerid, descr) VALUES ('$uid','$badgename','$badgeimg','$badgecriteria','$badgeissuer','$badgedesc')";
    echo $query;

    $result = mysql_query($query) or die(mysql_error());

    var_dump($result);

    $File = "/home/hms181/www/badging/data/badges/$uid.json";
    $Handle = fopen($File, 'wb') or die("can't create file");

    $Data = "{\n  \"name\": \"$badgename\",\n  \"description\": \"$badgedesc\",\n  \"image\": \"$badgeimg\",\n  \"criteria\": \"$badgecriteria\",\n";
    fwrite($Handle, $Data);
    // if (strlen($)>0) {
    //     $Data = "  \"image\": \"$issuerlogo\",\n";
    //     fwrite($Handle, $Data);
    // }
    // if (strlen($issueremail)>0) {
    //     $Data = "  \"email\": \"$issueremail\",\n";
    //     fwrite($Handle, $Data);
    // }
    $Data = "  \"issuer\": \"http://insys.vmhost.psu.edu/~hms181/data/issers/$badgeissuer.json\"\n}";
    fwrite($Handle, $Data);
    fclose($Handle);

    echo "http://insys.vmhost.psu.edu/~hms181/badging/data/badges/$uid.json";
// }
mysql_close();

?>
