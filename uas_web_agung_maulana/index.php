<!DOCTYPE html>
<html>
<head>
	<title>Klinik LP3I</title>
</head>
<body>
<?php 
	session_start();
	session_destroy();
	include("database.php");
	$action = (!isset($_REQUEST["action"]))? null : $_REQUEST["action"];
  	if($action == null){
?>
<h1>Welcome</h1>
<form method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">
	<label>Username</label>
	<input type="text" name="username" required/>
	<label>Password</label>
	<input type="password" name="password" required/>
	<input type="submit" name="action" value="Login"/>
</form>
<?php 
	} elseif($action == "Login") {
		$d = new Database();
		$username = $_POST["username"];
		$password = md5($_POST["password"]);
		$sql = "SELECT nip, namaadmin, password_user FROM `admin` where namaadmin='".$username."' and password_user ='".$password."'";
		$islogin = $d->getList($sql);
		if(isset($islogin[0]["namaadmin"]) == $username){
			session_start();
			/*session is started if you don't write this line can't use $_Session  global variable*/
			$_SESSION["nip"] = $islogin[0]["nip"];
			header("location: home.php");
		}else{
			die("<h1>Username Atau Password Salah</h1><p><a href='#' onClick='window.history.back()'>Coba lagi</a></p>");
		}

	}
?>

</body>
</html>