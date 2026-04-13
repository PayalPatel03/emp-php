

<?php session_start(); include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body{background:#f4f6f9;}
.sidebar{
 height:100vh;
 background:#343a40;
 color:white;
 position:fixed;
 width:220px;
}
.sidebar a{
 color:white;
 display:block;
 padding:10px;
 text-decoration:none;
}
.sidebar a:hover{background:#495057;}
.main{margin-left:230px;padding:20px;}
.card{border:none;border-radius:10px;}
</style>
</head>
<body>

<div class="sidebar">
<h4 class="text-center mt-3">Admin Panel</h4>
<a href="#">Dashboard</a>
<a href="#employee">Employees</a>
<a href="logout.php">Logout</a>
</div>

<div class="main">
<h3>Welcome <?php echo $_SESSION['user']; ?></h3>

<!-- Stats Cards -->
<div class="row mt-4">
<div class="col-md-4">
<div class="card bg-primary text-white p-3">
<h5>Total Employees</h5>
<?php $res=$conn->query("SELECT COUNT(*) as total FROM employees"); $row=$res->fetch_assoc(); ?>
<h2><?php echo $row['total']; ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card bg-success text-white p-3">
<h5>Total Salary</h5>
<?php $res=$conn->query("SELECT SUM(salary) as total FROM employees"); $row=$res->fetch_assoc(); ?>
<h2><?php echo $row['total'] ?? 0; ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card bg-warning text-white p-3">
<h5>Users</h5>
<?php $res=$conn->query("SELECT COUNT(*) as total FROM users"); $row=$res->fetch_assoc(); ?>
<h2><?php echo $row['total']; ?></h2>
</div>
</div>
</div>

<!-- Chart -->
<div class="card mt-4 p-3">
<h5>Salary Chart</h5>
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
 datasets:[{label:'Salary',data:data.salaries}]
 }
 });
});
</script>

<!-- Add Employee -->
<div class="card mt-4 p-3" id="employee">
<h5>Add Employee</h5>
<form method="POST" class="row g-2">
<div class="col-md-4"><input class="form-control" name="name" placeholder="Name"></div>
<div class="col-md-4"><input class="form-control" name="position" placeholder="Position"></div>
<div class="col-md-3"><input class="form-control" name="salary" placeholder="Salary"></div>
<div class="col-md-1"><button class="btn btn-primary" name="add">Add</button></div>
</form>
</div>

<?php
if(isset($_POST['add'])){
$conn->query("INSERT INTO employees(name,position,salary) VALUES('{$_POST['name']}','{$_POST['position']}','{$_POST['salary']}')");
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
