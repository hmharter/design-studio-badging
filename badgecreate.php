<?php
// ini_set('display_errors','On');
// error_reporting(E_ALL | E_STRICT);

include("config.php");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $uid = time();
    $badgename = mysql_real_escape_string($_POST['badgename']);
    $badgeimg = "http://insys.vmhost.psu.edu/~hms181/badging/images/101badge.png";
    $badgedesc = mysql_real_escape_string($_POST['badgedesc']);
    $badgecriteria = mysql_real_escape_string($_POST['badgecriteria']);
    $badgeissuer = mysql_real_escape_string($_POST['issuers']);

    $query = "INSERT INTO badges (id, name, img, criteria, issuerid, descr) VALUES ('$uid','$badgename','$badgeimg','$badgecriteria','$badgeissuer','$badgedesc')";

    $result = mysql_query($query) or die(mysql_error());

    $File = "/home/hms181/www/badging/data/badges/$uid.json";
    $Handle = fopen($File, 'wb') or die("can't create file");

    $Data = "{\n  \"name\": \"$badgename\",\n  \"description\": \"$badgedesc\",\n  \"image\": \"$badgeimg\",\n  \"criteria\": \"$badgecriteria\",\n";
    fwrite($Handle, $Data);

    $Data = "  \"issuer\": \"http://insys.vmhost.psu.edu/~hms181/badging/data/issuers/$badgeissuer.json\"\n}";
    fwrite($Handle, $Data);
    fclose($Handle);

    echo "http://insys.vmhost.psu.edu/~hms181/badging/data/badges/$uid.json";
}
mysql_close();

?>
