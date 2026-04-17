<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>

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
    <h4 class="mb-4">CREATE ACCOUNT</h4>

    <form method="POST">
        <input class="form-control mb-3" type="text" name="name" placeholder="Your Name" required>
        <input class="form-control mb-3" type="email" name="email" placeholder="Your Email" required>
        <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>

        <button class="btn btn-custom w-100" name="register">SIGN UP</button>
    </form>

    <p class="mt-3">
        Have already an account ? 
        <a href="login.php">Login here</a>
    </p>

    <?php
    if(isset($_POST['register'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $pass=password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");
        $stmt->bind_param("sss",$name,$email,$pass);

        if($stmt->execute()){
            echo "<p class='text-success'>Registered Successfully</p>";
        }else{
            echo "<p class='text-danger'>Email already exists</p>";
        }
    }
    ?>
</div>

</body>
</html>