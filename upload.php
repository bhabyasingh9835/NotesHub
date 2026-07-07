<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Upload Notes</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<h1>Upload Notes</h1>

<form id="uploadForm" enctype="multipart/form-data">

<input type="text"
name="title"
placeholder="Topic Name"
required>

<br><br>

<input type="text"
name="subject"
placeholder="Enter Subject Name"
required>

<br><br>

<input type="file"
name="note"
accept=".pdf,.jpg,.jpeg"
required>

<p class="upload-info">
📄 Allowed files: <b>PDF, JPG, JPEG</b><br>
📏 Maximum file size: <b>5 MB</b>
</p>

<br><br>

<div id="progressArea" style="display:none;">
<div class="progress">

<div class="progress-bar" id="progressBar">

0%

</div>

</div>

<br>

<p id="status"></p>

</div>

<input
type="submit"
value="Upload">

</form>

<br>

<a href="index.php">⬅ Back to Home</a>

</div>

<script>

const form = document.getElementById("uploadForm");

form.addEventListener("submit",function(e){

e.preventDefault();

let formData = new FormData(form);

let xhr = new XMLHttpRequest();

xhr.open("POST","upload_process.php",true);

document.getElementById("progressArea").style.display="block";

xhr.upload.addEventListener("progress",function(e){

if(e.lengthComputable){

let percent=Math.round((e.loaded/e.total)*100);

document.getElementById("progressBar").style.width=percent+"%";

document.getElementById("progressBar").innerHTML=percent+"%";

}

});

xhr.onload=function(){

if(xhr.status==200){

document.getElementById("status").innerHTML=xhr.responseText;

document.getElementById("progressBar").style.width="100%";

document.getElementById("progressBar").innerHTML="100%";

form.reset();

}

};

xhr.send(formData);

});

</script>

</body>
</html>