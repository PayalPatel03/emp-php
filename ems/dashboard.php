<?php
session_start();
include 'db.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
body{background:#eef2f7; font-family: 'Segoe UI';}

.sidebar{
 height:100vh;
 background:#1e293b;
 color:white;
 position:fixed;
 width:230px;
}

.sidebar h4{
 padding:20px;
 text-align:center;
 border-bottom:1px solid #3d4e65;

}

.sidebar a{
 color:#cbd5e1;
 display:block;
 padding:12px 20px;
 text-decoration:none;
}

.sidebar a:hover{
 background:#334155;
 color:white;
}

.main{
 margin-left:240px;
 padding:20px;
}

.navbar{
 background:white;
 border-radius:10px;
 padding:10px 20px;
 box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

.card{
 border:none;
 border-radius:15px;
 box-shadow:0 4px 10px rgba(0,0,0,0.05);
}

.card i{
 font-size:25px;
}

.table{
 background:white;
 border-radius:10px;
 overflow:hidden;
}

.btn{
 border-radius:8px;
}
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
<h4>Admin Panel</h4>
<a href="#"><i class="fa fa-home"></i> Dashboard</a>
<a href="#employee"><i class="fa fa-users"></i> Employees</a>
<a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
</div>

<!-- Main -->
<div class="main">

<!-- Navbar -->
<div class="navbar d-flex justify-content-between">
<h5>Welcome, <?php echo $_SESSION['user']; ?> </h5>
<span class="text-muted">Admin Dashboard</span>
</div>

<!-- Cards -->
<div class="row mt-4">

<div class="col-md-4">
<div class="card p-3 bg-primary text-white">
<div class="d-flex justify-content-between">
<div>
<h6>Total Employees</h6>
<?php $res=$conn->query("SELECT COUNT(*) as total FROM employees"); $row=$res->fetch_assoc(); ?>
<h3><?php echo $row['total']; ?></h3>
</div>
<i class="fa fa-users"></i>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card p-3 bg-success text-white">
<div class="d-flex justify-content-between">
<div>
<h6>Total Salary</h6>
<?php $res=$conn->query("SELECT SUM(salary) as total FROM employees"); $row=$res->fetch_assoc(); ?>
<h3><?php echo $row['total'] ?? 0; ?></h3>
</div>
<i class="fa fa-money-bill"></i>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card p-3 bg-warning text-white">
<div class="d-flex justify-content-between">
<div>
<h6>Total Users</h6>
<?php $res=$conn->query("SELECT COUNT(*) as total FROM users"); $row=$res->fetch_assoc(); ?>
<h3><?php echo $row['total']; ?></h3>
</div>
<i class="fa fa-user"></i>
</div>
</div>
</div>

</div>

<!-- Chart -->
<div class="card mt-4 p-3">
<h5>Salary Overview</h5>
<canvas id="myChart"></canvas>
</div>

<script>
fetch('chart_data.php')
.then(res=>res.json())
.then(data=>{
 new Chart(document.getElementById('myChart'),{
 type:'bar',
 data:{
  labels:data.names,
  datasets:[{
   label:'Salary',
   data:data.salaries,
   backgroundColor:'#4f46e5'
  }]
 },
 options:{
  responsive:true,
  plugins:{legend:{display:false}}
 }
 });
});
</script>

<!-- Add Employee -->
<div class="card mt-4 p-3" id="employee">
<h5>Add Employee</h5>
<form method="POST" class="row g-2">
<div class="col-md-4"><input class="form-control" name="name" placeholder="Name" required></div>
<div class="col-md-4"><input class="form-control" name="position" placeholder="Position" required></div>
<div class="col-md-3"><input class="form-control" name="salary" placeholder="Salary" required></div>
<div class="col-md-1"><button class="btn btn-primary w-100" name="add">Add</button></div>
</form>
</div>

<?php
if(isset($_POST['add'])){
$stmt = $conn->prepare("INSERT INTO employees(name,position,salary) VALUES(?,?,?)");
$stmt->bind_param("ssi", $_POST['name'], $_POST['position'], $_POST['salary']);
$stmt->execute();
}
?>

<!-- Employee Table -->
<div class="card mt-4 p-3">
<h5>Employee List</h5>
<table class="table table-hover">
<tr><th>ID</th><th>Name</th><th>Position</th><th>Salary</th><th>Action</th></tr>

<?php
$res=$conn->query("SELECT * FROM employees");
while($row=$res->fetch_assoc()){
?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['position']; ?></td>
<td><?php echo $row['salary']; ?></td>
<td>
<a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
<a class="btn btn-warning btn-sm" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
</td>
</tr>
<?php } ?>

</table>
</div>

</div>

</body>
</html>