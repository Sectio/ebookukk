<?php 
    session_start();
    include "authentication.php";
    include "config.php";

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $sex = $_POST['sex'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $photo = $_FILES['photo'];
        $photo_name = $photo['name'];
        $photo_temp = $photo['tmp_name'];

        move_uploaded_file($photo_temp,'uploads/'.$photo_name);

        if(empty($photo_name)){
            $sql = "INSERT INTO users (name,sex,phone,email,image) VALUES ('$name','$sex','$phone','$email','avatar.png')";
        }else{
            $sql = "INSERT INTO users (name,sex,phone,email,image) VALUES ('$name','$sex','$phone','$email','$photo_name')";
        }
        $query = mysqli_query($link,$sql);
        if($query){
            $log = getHostByName($_SERVER['HTTP_HOST']).' - '.date("F j, Y, g:i a").PHP_EOL.
            "Record created_".time().PHP_EOL.
            "---------------------------------------".PHP_EOL;
            file_put_contents('logs/log_'.date("j-n-Y").'.log', $log, FILE_APPEND);

            $_SESSION['success'] = "One record inserted successfully";
            header('location:index.php');
        }else{
            $_SESSION['error'] = "Something is wrong, Record not inserted";
            header('location:index.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>e-book</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Book</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
	<link href="https://fonts.googleapis.com/css?family=Amaranth" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <header style="background: #727272;">
			<div class="container">
				<h1><a>Fairy Tale</a></h1>
			</div>
		</header>

<body>
    <div class="container">
        <h1 class="text-center">Add Book</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name"><strong>Name</strong></label>
                <input type="text" class="form-control" placeholder="Enter Book Title" name="name" required>
            </div>
            <div class="form-group">
                <label for="email"><strong>Stock</strong></label><br>
                <input type="radio" name="sex" value="male"> Avaliable &nbsp;
                <input type="radio" name="sex" value="female"> Not Avaliable
            </div>
            <div class="form-group">
                <label for="phone"><strong>Price</strong></label>
                <input type="text" class="form-control" placeholder="Enter Price" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email"><strong>Description</strong></label>
                <input type="text" class="form-control" placeholder="Enter Description" name="email" required>
            </div>
            <div class="form-group">
                <label for="photo"><strong>Photo</strong></label><br>
                <input type="file" name="photo">
            </div>
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary" name="submit">Publish</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>