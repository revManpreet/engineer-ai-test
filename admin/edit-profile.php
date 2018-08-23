<?php
session_start();
?>
<html>
<head>
	<title> Admin Edit Profile </title>
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
				$hobbiesArr = explode(',', $data['hobbies']);
				$dob_date = date_format(date_create($data['dob']),'d');
				$dob_month = date_format(date_create($data['dob']),'m');
				$dob_year = date_format(date_create($data['dob']),'Y');

			}
		}else{
			header("Location: login.php");
		}
	?>
	<?php
	$success_msg = "";
	$error_msg = "";
	$target_file = "";
		if(isset($_POST) && !empty($_POST)){
			include 'db.php';
			
			$err=[];
			if(empty($_POST['fname'])){
				$err['fname'] = 'This field is required';
			}
			if(empty($_POST['lname'])){
				$err['lname'] = 'This field is required';
			}
			if(empty($_POST['uname'])){
				$err['uname'] = 'This field is required';
			}else{
				$uname = $_POST['uname'];
				$sql="SELECT email FROM users where uname = '$uname' AND id !='$id'";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
				   $err['uname'] = 'username already exist in database';
				}
			}
			if(empty($_POST['email'])){
				$err['email'] = 'This field is required';

			}else{
				$email = $_POST['email'];
				$id = $data['id'];
				$sql="SELECT email FROM users where email = '$email' AND id !='$id' ";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
				   $err['email'] = 'Email already exist in database';
				}
			}
			if(empty($_POST['user_type'])){
				$err['user_type'] = 'This field is required';
			}
			if(empty($_POST['address'])){
				$err['address'] = 'This field is required';
			}
			if(empty($_POST['gender'])){
				$err['gender'] = 'This field is required';
			}
			if(empty($_POST['date'])){
				$err['date'] = 'This field is required';
			}
			if(empty($_POST['month'])){
				$err['month'] = 'This field is required';
			}
			if(empty($_POST['year'])){
				$err['year'] = 'This field is required';
			}
			if(empty($_POST['hobbies'])){
				$err['hobbies'] = 'This field is required';
			}
			if(empty($_POST['password'])){
				$err['password'] = 'This field is required';
			}

			if(isset($_FILES) && !empty($_FILES['profile_pic']['name'])){


				
				$target_dir = "../images/";
				$profile_pic = basename($_FILES["profile_pic"]["name"]) ."-".strtotime("now");
				$target_file = $target_dir . $profile_pic ;
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
		
			    $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
			    if($check !== false) {
			        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
				     
				    } else {
				         $err['profile_pic'] =  "Sorry, there was an error uploading your file.";
				    }
			    } else {
			       $err['profile_pic'] = 'Please select Image only';
			       
			    }		

				
			}

			if(empty($err)){
				
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$uname = $_POST['uname'];
				$email = $_POST['email'];
				$password = md5($_POST['password']);
				$user_type = $_POST['user_type'];
				$gender = $_POST['gender'];
				$address = $_POST['address'];

				if($target_file == ""){
					$target_file = $data['profile_pic'];
				}

			
				$hobbies = implode(",",$_POST['hobbies']);
				$time = strtotime($_POST['year'].'-'.$_POST['month'].'-'.$_POST['date']);
				$dob = date('Y-m-d',$time);
				
				$id == $data['id'];

				$sql = "UPDATE users SET fname = '$fname',
										lname ='$lname',
										email ='$email',
										uname = '$uname',
										user_type = '$user_type',
										gender ='$gender',
										dob = '$dob',
										hobbies = '$hobbies',
										address = '$address',
										profile_pic = '$target_file'
										 where id='$id' ";

				if ($conn->query($sql) === TRUE) {
				    $success_msg = "User Profile has been Updated successfully!";
				    $error_msg="";
				    header("Location: dashboard.php");
				} else {
				     
				    $error_msg = "Error: " . $sql . "<br>" . $conn->error;
				    $success_msg = "";
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
                <div class="panel-heading">Edit Profile</div>

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
					 <form action="" method="post" id="registerForm"  enctype="multipart/form-data">
					   <div class="form-group">
					    <label for="fname">First Name:</label>
					    <input type="text" class="form-control" name="fname" required value="<?= $data['fname'] ?>">
					    <span class="custom-error1">
					    <?php if(isset($err['fname'])){ echo $err['fname'];}

					    	 ?>
					    		
					    </span>
					  </div>
					   <div class="form-group">
					    <label for="lname">last Name:</label>
					    <input type="text" class="form-control" name="lname" required value="<?= $data['lname'] ?>"> 
					    <span class="custom-error"><?php if(isset($err['lname'])){ echo $err['lname'];} ?></span>
					  </div>
					   <div class="form-group">
					    <label for="uname">Username:</label>
					    <input type="text" class="form-control" name="uname" required value="<?= $data['uname'] ?>">
					    <span class="custom-error"><?php if(isset($err['uname'])){ echo $err['uname'];} ?></span>
					  </div>
					  <div class="form-group">
					    <label for="lname">User Type:</label>
					    <select class="form-control" id="user_type" name="user_type" required>
					    	<option value="">Select User Type</option>
					    	<option value="1" <?php if($data['user_type'] == 1) { echo "selected";}?>>Admin</option>
					    	<option value="2"  <?php if($data['user_type'] == 2) { echo "selected";}?>>Super Admin</option>
					    </select>
					    <span class="custom-error"><?php if(isset($err['user_type'])){ echo $err['user_type'];} ?></span>
					  </div>
					  <div class="form-group">
					    <label for="email">Email address:</label>
					    <input type="email" class="form-control" id="email" name="email" required value="<?= $data['email'] ?>"> 
					    <span class="custom-error"><?php if(isset($err['email'])){ echo $err['email'];} ?></span>
					  </div>	 
					  <div class="form-group">
					    <label for="pwd">Password:</label>
					    <input type="password" class="form-control" id="pwd" name="password" required minlength="5">
					    <span class="custom-error"><?php if(isset($err['password'])){ echo $err['password'];} ?></span>
					  </div>
					   <div class="form-group">
					    <label for="address">Address:</label>
					    <textarea class="form-control" id="address" name="address" required><?= $data['address'] ?></textarea>
					    <span class="custom-error"><?php if(isset($err['address'])){ echo $err['address'];} ?></span>
					  </div>
					   <div class="form-group">
					    <label for="pwd">gender:</label>
							<div class="radio">
							  <label><input type="radio" name="gender" checked value="male" <?php if($data['gender'] == 'male') { echo "selecetd";}?>>Male</label>
							</div>
							<div class="radio">
							  <label><input type="radio" name="gender" value="female" <?php if($data['gender'] == 'female') { echo "selecetd";}?>>Female</label>
							</div>
							<span class="custom-error"><?php if(isset($err['gender'])){ echo $err['gender'];} ?></span>
					   </div>

					   <div class="form-group">
					    <label for="pwd">DOB:</label>
					   </div> 
					    <div class="form-group">
						    <div class="col-sm-4">
						    	 <label for="date">Date:</label>
								  <select name="date" class="form-control" required>
								  	<?php  for($i=1 ; $i<=31; $i++):?>
								  		<option value="<?= $i ?>"  <?php if($dob_date == $i) { echo "selected";}?>><?= $i ?></option>
								    <?php endfor; ?>
								  </select>
								  <span class="custom-error"><?php if(isset($err['date'])){ echo $err['date'];} ?></span>
							</div>
						  <div class="col-sm-4">
						    	 <label for="date">Month:</label>
								  <select name="month" class="form-control" required>
								  	<?php  for($i=1 ; $i<=12; $i++):?>
								  		<option value="<?= $i ?>" <?php if($month == $i) { echo "selected";}?>><?= $i ?></option>
								    <?php endfor; ?>

								  	
								  </select>
								  <span class="custom-error"><?php if(isset($err['month'])){ echo $err['month'];} ?></span>
							</div>
							<div class="col-sm-4">
						    	 <label for="date">Year:</label>
								  <select name="year" class="form-control" required>
									<?php  for($i=1970 ; $i<=2010; $i++):?>
								  		<option value="<?= $i ?>" <?php if($year == $i) { echo "selected";}?>><?= $i ?></option>
								    <?php endfor; ?>
								  </select>
								  <span class="custom-error"><?php if(isset($err['year'])){ echo $err['year'];} ?></span>
							</div>
					  </div>
					  <div class="form-group">
					  	<label for="hobbies" class="hobbis">Hobbies:</label>
					  	<div class="checkbox">
					      <label><input type="checkbox" value="books_reading" name="hobbies[]" <?php if(in_array('books_reading', $hobbiesArr)){ echo "checked";}?>>Books Reading</label>
					    </div>
					    <div class="checkbox"> 
					      <label><input type="checkbox" value="surfing_on_internet" name="hobbies[]" <?php if(in_array('surfing_on_internet', $hobbiesArr)){ echo "checked";}?>>Surfing On Internet</label>
					    </div>
					    <div class="checkbox">
					      <label><input type="checkbox" value="dancing" name="hobbies[]" <?php if(in_array('dancing', $hobbiesArr)){ echo "checked";}?>>Dancing</label>
					    </div>
					    <span id="hob_err"></span>
					    <span class="custom-error"><?php if(isset($err['hobbies'])){ echo $err['hobbies'];} ?></span>
					  </div>

					  <div class="form-group">
					    <label for="profile_pic">Profile Picture (Dont select if you dont want to change)</label>
					    <input type="file" class="form-control" id="profile_pic"  name="profile_pic">
					    <span class="custom-error"><?php if(isset($err['profile_pic'])){ echo $err['profile_pic']; } ?></span>	
					    <div class="imgProfile">
					    	<img src="../images/<?= $data['profile_pic']; ?>">
						</div>

					  </div>
					
					  <button type="submit" class="btn btn-default">Submit</button>
					</form> 
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	$('#registerForm').validate({

		 errorPlacement: function(error, element) {
       
            if (element.attr("name") == "hobbies[]" ) {
               error.insertAfter($(element).parents('div').next($('.hobbis'))); 
                
            }          
            // Default position: if no match is met (other fields)
            else {
                error.insertAfter(element);
            }
        },
	});
</script>
</body>
</html>