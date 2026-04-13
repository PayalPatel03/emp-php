<?php include 'db.php';
$id=$_GET['id'];
$res=$conn->query("SELECT * FROM employees WHERE id=$id");
$row=$res->fetch_assoc();
?>

<form method="POST">
<input name="name" value="<?php echo $row['name']; ?>">
<input name="position" value="<?php echo $row['position']; ?>">
<input name="salary" value="<?php echo $row['salary']; ?>">
<button name="update">Update</button>
</form>

<?php
if(isset($_POST['update'])){
$conn->query("UPDATE employees SET name='{$_POST['name']}', position='{$_POST['position']}', salary='{$_POST['salary']}' WHERE id=$id");
header("Location: dashboard.php");
}
?>