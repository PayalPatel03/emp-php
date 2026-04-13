<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Register</h2>

<form method="POST">
<input class="form-control mb-2" type="text" name="name" placeholder="Name" required>
<input class="form-control mb-2" type="email" name="email" placeholder="Email" required>
<input class="form-control mb-2" type="password" name="password" placeholder="Password" required>
<button class="btn btn-primary" name="register">Register</button>
</form>

<?php
if(isset($_POST['register'])){
$name=$_POST['name'];
$email=$_POST['email'];
$pass=password_hash($_POST['password'], PASSWORD_DEFAULT);

$conn->query("INSERT INTO users(name,email,password) VALUES('$name','$email','$pass')");
echo "Registered Successfully <a href='login.php'>Login</a>";
}
?>

</body>
</html>