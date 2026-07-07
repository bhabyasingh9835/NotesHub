<?php

include 'dbconnect.php';

if(isset($_POST['title']) && isset($_POST['subject']))
{

$title = mysqli_real_escape_string($conn,$_POST['title']);

$subject = mysqli_real_escape_string($conn,$_POST['subject']);

if(isset($_FILES['note']))
{

$filename = time()."_".basename($_FILES["note"]["name"]);

$tempname = $_FILES["note"]["tmp_name"];

$filesize = $_FILES["note"]["size"];

// Maximum File Size = 5 MB
$maxsize = 5 * 1024 * 1024;

if($filesize > $maxsize)
{
    echo "<span style='color:red;
    font-size:18px;
    font-weight:bold;'>
    ❌ File size exceeds 5 MB.
    Please upload a file smaller than 5 MB.
    </span>";

    exit();
}

$folder = "uploads/".$filename;

if(move_uploaded_file($tempname,$folder))
{

$sql = "INSERT INTO notes(title,subject,filename)
VALUES('$title','$subject','$filename')";

if(mysqli_query($conn,$sql))
{

echo "<span style='color:green;font-weight:bold;font-size:18px;'>✅ Note Uploaded Successfully</span>";

}
else
{

echo "<span style='color:red;font-weight:bold;'>Database Error!</span>";

}

}
else
{

echo "<span style='color:red;font-weight:bold;'>File Upload Failed!</span>";

}

}

}
?>