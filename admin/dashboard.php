<?php
session_start();
?>
<html>
<head>
	<title> Admin Dashboard </title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="../js/jquery.validate.min.js"></script>
  	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

	<?php

		if(isset($_SESSION['user_id'])){
						include '../db.php';


			$id =$_SESSION['user_id'];
			$sql="SELECT * FROM users where id = '$id' ";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				$data = mysqli_fetch_array($result);
				
			}
		}else{
			header("Location: login.php");
		}
	?>
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> Hello <?= $data['fname'] . ' '. $data['lname']  ?>
                	<span class="pull-right">
                	<a href="logout.php" clas="pull-left">Logout</a>
                </span>

                </div>

                <div class="panel-body">
                	<div class="row">
                		<div class="col-sm-4">
                			  <div class="imgProfile">
					    	<img src="../images/<?= $data['profile_pic']; ?>">
						</div>
                		</div>

                		<div class="col-sm-8">
                			 <p> Name : <?= $data['fname'] . ' '.$data['lname']; ?> </p>
                			 <p> Email : <?= $data['email']; ?> </p>
                			 <p> Username : <?= $data['uname'];  ?> </p>
                			 <p> User Type : <?php if($data['user_type']==1) {echo 'Admin' ; } else{ echo "Super Admin";}  ?> </p>
                			 <p> Gender : <?= $data['gender']; ?> </p>
                			 <p> Hobbies : <?= $data['hobbies']; ?> </p>                			 
                			 <p> DOB : <?= $data['dob'] ?> </p>
                			 <a href="edit-profile.php" class="btn btn-success">Edit Profile</a>

                		</div>
                	</div>
                </div>             	  
        	</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#LoginForm').validate();	
</script>
</body>
</html>