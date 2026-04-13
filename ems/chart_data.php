
<?php
include 'db.php';
$res=$conn->query("SELECT name,salary FROM employees");
$names=[];
$salaries=[];
while($row=$res->fetch_assoc()){
 $names[]=$row['name'];
 $salaries[]=$row['salary'];
}
echo json_encode(["names"=>$names,"salaries"=>$salaries]);
?>
