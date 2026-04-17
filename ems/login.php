<?php session_start(); include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
    url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d');
    background-size: cover;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.card{
    width: 400px;
    border-radius: 15px;
    padding: 30px;
    background: rgba(255,255,255,0.9);
}

.btn-custom{
    background: linear-gradient(to right, #667eea, #66d3c2);
    color: white;
    border: none;
}
</style>

</head>
<body>

<div class="card text-center">
    <h4 class="mb-4">LOGIN</h4>

    <form method="POST">
        <input class="form-control mb-3" type="email" name="email" placeholder="Your Email" required>
        <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>

        <button class="btn btn-custom w-100" name="login">LOGIN</button>
    </form>

    <p class="mt-3">
        Don't have an account ? 
        <a href="register.php">Register here</a>
    </p>

    <?php
    if(isset($_POST['login'])){
        $email=$_POST['email'];
        $pass=$_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s",$email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if($user && password_verify($pass,$user['password'])){
            $_SESSION['user']=$user['name'];
            $_SESSION['login']=true;
            header("Location: dashboard.php");
        }else{
            echo "<p class='text-danger'>Invalid Login</p>";
        }
    }
    ?>
</div>

</body>
</html>