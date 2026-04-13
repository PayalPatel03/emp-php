<?php session_start(); include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Login</h2>

<form method="POST">
<input class="form-control mb-2" type="email" name="email" placeholder="Email" required>
<input class="form-control mb-2" type="password" name="password" placeholder="Password" required>
<button class="btn btn-success" name="login">Login</button>
</form>

<?php
if(isset($_POST['login'])){
$email=$_POST['email'];
$pass=$_POST['password'];

$res=$conn->query("SELECT * FROM users WHERE email='$email'");
$user=$res->fetch_assoc();

if($user && password_verify($pass,$user['password'])){
$_SESSION['user']=$user['name'];
header("Location: dashboard.php");
}else{
echo "Invalid Login";
}
}
?>

</body>
</html>