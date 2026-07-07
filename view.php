<?php
include 'dbconnect.php';

$search = "";

if(isset($_GET['search']))
{
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $sql = "SELECT * FROM notes
            WHERE title LIKE '%$search%'
            OR subject LIKE '%$search%'
            ORDER BY id DESC";
}
else
{
    $sql = "SELECT * FROM notes ORDER BY id DESC";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Notes</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">

<h1>Uploaded Notes</h1>

<br>

<form method="GET">

<input type="text"
name="search"
placeholder="Search by Title or Subject"
value="<?php echo $search; ?>">

<input type="submit" value="Search">

</form>

<br>


<table border="1" cellpadding="10" cellspacing="0" width="100%">
<tr>
    <th>ID</th>
<th>Title</th>
<th>Subject</th>
<th>File Size</th>
<th>Download</th>
<th>Uploaded On</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><?php echo $row['subject']; ?></td>

<td>
<?php
$file = "uploads/".$row['filename'];

if(file_exists($file))
{
    $size = filesize($file);

    if($size >= 1048576)
    {
        echo round($size/1048576,2)." MB";
    }
    elseif($size >= 1024)
    {
        echo round($size/1024,2)." KB";
    }
    else
    {
        echo $size." Bytes";
    }
}
else
{
    echo "File Missing";
}
?>
</td>

<td>
    <a href="uploads/<?php echo $row['filename']; ?>" download>
        Download
    </a>
</td>

<td><?php echo $row['tstamp']; ?></td>

</tr>
<?php
}
?>

</table>

<br>

<a href="upload.php">⬅ Upload More Notes</a>

</div>

</body>
</html>