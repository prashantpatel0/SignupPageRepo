<?php
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$dob=$_POST['dob'];
	$gender=$_POST['gender'];

	if(!empty($username) || !empty($email) || !empty($password) || !empty($dob) || !empty($gender)){
		$host="localhost";
		$dbUsername="root";
		$dbPassword="";
		$dbname="signup";

		$conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
		if(mysqli_connect_error()){
			die('Connect Error('.mysqli_connect_err().')'.mysqli_connect_error());
		}else{
				$SELECT="SELECT email From sign_up where email=? Limit 1";
				$INSERT="INSERT into sign_up (username,email,password,dob,gender) values(?,?,?,?,?)";


				$stmt=$conn->prepare($SELECT);
				$stmt->bind_param("s",$email);
				$stmt->execute();
				$stmt->bind_result($email);
				$stmt->store_result();
				$rnum=$stmt->num_rows;

				if($rnum==0){
					$stmt->close();
					$stmt=$conn->prepare($INSERT);
					$stmt->bind_param("sssss",$username,$email,$password,$dob,$gender);
					$stmt->execute();
					echo "Welcome";
		}else{
			echo "Email Already Regestered ";
		}
		$stmt->close();
		$conn->close();

		}
	}else{
		echo "Please fill all data";
		die();
	}

  ?>