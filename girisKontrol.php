<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$email = validate($_POST['email']);
	$pass = validate($_POST['password']);

	if (empty($email)) {
		header("Location: login.php?error=Email Adresi giriniz");
	    exit();
	}else if(empty($pass)){
        header("Location: login.php?error=Şifre giriniz");
	    exit();
	}else{

        $pass = md5($pass);

        
		$sql = "SELECT * FROM calisan WHERE email='$email' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['email'] === $uname && $row['password'] === $pass) {
            	$_SESSION['email'] = $row['email'];
            	$_SESSION['name'] = $row['name'];
            	
            	header("Location: home.php");
		        exit();
            }else{
				header("Location: login.php?error=Kullanıcı adı veya şifre hatalı");
		        exit();
			}
		}else{
			header("Location: login.php?error=Kullanıcı adı veya şifre hatalı");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}