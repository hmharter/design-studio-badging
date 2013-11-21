<?php
// ini_set('display_errors','On');
// error_reporting(E_ALL | E_STRICT);
include("config.php");
session_start();


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $uid = time();
    $badgename = mysql_real_escape_string($_POST['badgename']);
    $badgeimg = "http://insys.vmhost.psu.edu/~hms181/badging/101badge.png";
    //$badgeimg = "http://insys.vmhost.psu.edu/~hms181/badging/data/badges/img/$uid.png";
    $badgedesc = mysql_real_escape_string($_POST['badgedesc']);
    $badgecriteria = mysql_real_escape_string($_POST['badgecriteria']);
    $badgeissuer = mysql_real_escape_string($_POST['issuers']);

    //
    // Reactivate this code when the image upload is working
    //
    // if($_FILES['badgeimg']['name'])
    //     echo "there is a badge image";
    // {
    //     if(!$_FILES['badgeimg']['error'])
    //     {
    //         if(!$_FILES['badgeimg']['type'] = "image/png")
    //         {
    //             $valid_file = false;
    //             $message = 'Oops!  Your image must be a PNG.';
    //         }
    //         if($_FILES['badgeimg']['size'] > (1024000))
    //         {
    //             $valid_file = false;
    //             $message = 'Oops!  Your image must be less than 1MB.';
    //         }
    //         if($valid_file)
    //         {
    //             $new_file_name = $uid.".png";
    //             move_uploaded_file($_FILES['badgeimg']['tmp_name'], 'data/badges/img/'.$new_file_name);
    //             $message = 'Congratulations!  Your image was accepted.';
    //         }
    //     }
    //     else
    //     {
    //         $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['badgeimg']['error'];
    //     }
    // }

    $query = "INSERT INTO badges (id, name, img, criteria, issuerid, descr) VALUES ('$uid','$badgename','$badgeimg','$badgecriteria','$badgeissuer','$badgedesc')";
    echo $query;

    $result = mysql_query($query) or die(mysql_error());

    var_dump($result);

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
