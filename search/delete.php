<<?php 
include ("../backend/conn.php");
$id = $_GET['id'];
$query = "DELETE FROM `infra` WHERE id = '$id'";

$data = mysqli_query($conn, $query);

if($data) {
    echo "<script> alert ('Record has been Deleted') </script>";
    echo  "<script>window.location = 'list.php'</script>";
}
else {
    echo "<script> alert ('Failed to Delete Record') </script>";
}


?>