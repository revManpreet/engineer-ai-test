<?php
session_start();
?><!DOCTYPE html>
<html>
<head>
	<title> Admin Login </title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="../js/jquery.validate.min.js"></script>
  	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

	<?php
	$success_msg = "";
	$error_msg = "";


	if(isset($_SESSION['user_id'])){
		header("Location: dashboard.php");
	}


		if(isset($_POST) && !empty($_POST)){
			include '../db.php';
			
			$err=[];
			if(empty($_POST['uname'])){
				$err['uname'] = 'This field is required';

			}
			if(empty($_POST['password'])){
				$err['password'] = 'This field is required';
			}

			if(empty($err)){
				
				
				$password = md5($_POST['password']);
				$uname = $_POST['uname'];
				
				$sql="SELECT * FROM users where uname = '$uname' AND password = '$password' ";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
					$data = mysqli_fetch_array($result);
				    $success_msg = "Login Succcessfull";
				    $error_msg="";
				    $_SESSION["user_id"] = $data['id'];

				    header("Location: dashboard.php");
				}else{
					$success_msg = "";
				    $error_msg="Please enter valid credentials";
				}

			}else{
				
				$success_msg = "";
				$error_msg = "Please check following validation errors.";
			}
			
	
		}

	?>
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Login </div>

                <div class="panel-body">
                	     <div class="panel-body">
                	<?php if(!empty($success_msg)): ?>
                	<div class="alert alert-success">
	                	<?= $success_msg ?>
	                </div>
	            <?php endif ;  ?>
	            <?php if(!empty($error_msg)): ?>
	                <div class="alert alert-danger">
	                	<?= $error_msg ?>
	                </div>
	                   <?php endif ;  ?>
                
					 <form action="" method="post" id="LoginForm">
					  
					  <div class="form-group">
					    <label for="uname">Username:</label>
					    <input type="uname" class="form-control" id="uname" name="uname" required > 
					    <span class="error"><?php if(isset($err['uname'])){ echo $err['uname'];} ?></span>
					  </div>	 
					  <div class="form-group">
					    <label for="pwd">Password:</label>
					    <input type="password" class="form-control" id="pwd" name="password" required>
					    <span class="error"><?php if(isset($err['password'])){ echo $err['password'];} ?></span>
					  </div>
					 
					
					  <button type="submit" class="btn btn-default">Submit</button>
					</form> 
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	$('#LoginForm').validate();	
</script>
</body>
</html>