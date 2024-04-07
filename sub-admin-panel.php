<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload Video</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <style>
        h1{

        }
    </style>

</head>
<body>
    <?php
    session_start();
    $con=mysqli_connect("localhost","root","","myhmsdb");
    if(!isset($_SESSION['se']) || $_SESSION['se'] !== 1){
      session_destroy();
      header("Location: logout1.php");
      exit;
    }
    ?>
	<!-- NAVBAR -->
<div class="container mt-5">
    <h1>Upload Video</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="subtext" class="form-label">Subtext</label>
            <input type="text" class="form-control" id="subtext" name="subtext" required>
        </div>
        <div class="mb-3">
            <label for="video" class="form-label">Video (MP4 only)</label>
            <input type="file" class="form-control" id="video" name="video" accept="video/mp4" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
        <button style="left:20rem;position:absolute;"  onclick="window.location.href='admin-panel1.php'" class="btn btn-primary">Exit</button>

    </form>
</div>
</body>
</html>
