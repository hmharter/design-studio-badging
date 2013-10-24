<?php
include("config.php");
session_start();
// ini_set('display_errors','On');
// error_reporting(E_ALL | E_STRICT);

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $uid = time();
    $issuername = mysql_real_escape_string($_POST['issuername']);
    $issuerurl = mysql_real_escape_string($_POST['issuerurl']);
    $issuerdesc = mysql_real_escape_string($_POST['issuerdesc']);
    $issueremail = mysql_real_escape_string($_POST['issueremail']);
    $issuerlogo = mysql_real_escape_string($_POST['issuerlogo']);

    // $issuername = 'Mr. Issuer';
    // $issuerurl = 'http://www.google.com';
    // $issuerdesc = 'This is the description';
    // $issueremail = 'hmharter@gmail.com';
    // $issuerlogo = '';

    $query = "INSERT INTO issuers (id, name, url, descr, email, logo) VALUES ('$uid','$issuername','$issuerurl','$issuerdesc','$issueremail','$issuerlogo')";
    echo $query;

    $result = mysql_query($query) or die(mysql_error());

    var_dump($result);

    $File = "/home/hms181/www/badging/data/issuers/$uid.json";
    $Handle = fopen($File, 'wb') or die("can't create file");

    $Data = "{\n  \"name\": \"$issuername\",\n";
    fwrite($Handle, $Data);
    if (strlen($issuerdesc)>0) {
        $Data = "  \"description\": \"$issuerdesc\",\n";
        fwrite($Handle, $Data);
    }
    if (strlen($issuerlogo)>0) {
        $Data = "  \"image\": \"$issuerlogo\",\n";
        fwrite($Handle, $Data);
    }
    if (strlen($issueremail)>0) {
        $Data = "  \"email\": \"$issueremail\",\n";
        fwrite($Handle, $Data);
    }
    $Data = "  \"url\": \"$issuerurl\"\n}";
    fwrite($Handle, $Data);
    fclose($Handle);

    echo "http://insys.vmhost.psu.edu/~hms181/badging/data/issuers/$uid.json";
}
mysql_close();

?>
