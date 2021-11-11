<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>USER LOGIN</title>
	<link rel="stylesheet" type="text/css" href="user/login.css">
</head>
<body>
<script>
<?php
	if(isset($_SESSION["retryuser"])){
	echo 'alert("Invalid username or password! Retry or check if Mysql is running on your system");';
}

?>
</script>
<div class="login-page">
    <form action="user/authenticate.php" method="post" autocomplete="off">
      <input type="text" name="user" placeholder="username"/>
      <input type="password" name="pwd" placeholder="password"/>
      <button><b>login</b></button>
    </form>
</div>
</body>
</html>