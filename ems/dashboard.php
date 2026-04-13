<?php session_start(); include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Welcome <?php echo $_SESSION['user']; ?></h2>
<a href="logout.php" class="btn btn-danger mb-3">Logout</a>

<h3>Add Employee</h3>

<form method="POST">
<input class="form-control mb-2" name="name" placeholder="Name">
<input class="form-control mb-2" name="position" placeholder="Position">
<input class="form-control mb-2" name="salary" placeholder="Salary">
<button class="btn btn-primary" name="add">Add</button>
</form>

<?php
if(isset($_POST['add'])){
$conn->query("INSERT INTO employees(name,position,salary) VALUES('{$_POST['name']}','{$_POST['position']}','{$_POST['salary']}')");
}
?>

<h3 class="mt-4">Employee List</h3>

<table class="table table-bordered">
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

</body>
</html>