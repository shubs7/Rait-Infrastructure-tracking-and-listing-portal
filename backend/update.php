<?php 
include ("..\backend\conn.php");
require "pdoconn.php";
if (isset($_POST["Update"])){
    $srno = $_POST['serial-1'];

    $stmt2 = $pdo->prepare("select dept, tags_id, status, allot from infra where srno = :srno");
            $stmt2->execute(array(':srno' => $srno));
            while ($result = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $example1 = $result['allot'];
                $dept1 = $result['dept'];
                $status1 = $result['status'];
                $tags1 = $result['tags_id'];
            }
            if (isset($_POST['dept-1']) && strlen($_POST['dept-1'])>=1) {
                $dept = $_POST['dept-1'];
            }
            else{
                $dept = $dept1;
            }
            if (isset($_POST['status-1']) && strlen($_POST['status-1'])>=1) {
                $status = $_POST['status-1'];
            }
            else{
                $status = $status1;
            }
            if (isset($_POST['tags-1']) && strlen($_POST['tags-1'])>=1) {
                $tags = $_POST['tags-1'];
            }
            else{
                $tags = $tags1;
            }

    // $id = $_POST['id'];
    $po_no = $_POST['pono'];
    $d_name = $_POST['dname'];
    $d_config = $_POST['dconfig'];
    $cost = $_POST['cost'];

    $stmt3 = $pdo->prepare("select lid, pid from allot where allot = :aid");
    $stmt3->execute(array(':aid' => $example1));
    while ($result = $stmt3->fetch(PDO::FETCH_ASSOC)) {
        $location1 = $result['lid'];
        $person1 = $result['pid'];
    }
    if (isset($_POST['location-1']) && strlen($_POST['location-1'])>=1) {
        $location = $_POST['location-1'];
    }
    else{
        $location = $location1;
    }
    if (isset($_POST['person-1']) && strlen($_POST['person-1'])>=1) {
        $person = $_POST['person-1'];
    }
    else{
        $person = $person1;
    }
    // echo $location;
    // echo $person;

    
try {
    $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
    $stmt1->execute(array(':lid' => $location, ':pid' => $person));
    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $example = $result['allot'];
    }
}
catch(PDOException $e){
    if (strlen($example)<=0) {
        $example = $example1;
    }
}
    $query = "UPDATE `infra` SET `po_no`=' $po_no',`d_name`='$d_name',`d_config`='$d_config',`tags_id`='$tags',
    `cost`='$cost',`dept`='$dept',`allot`=$example,`status`='$status',`srno`='$srno' WHERE srno = '$srno'";
    $data = mysqli_query($conn,$query);

    if($data) {
        echo "<script> alert ('Record has been Updated') </script>";
        echo  "<script>window.location = '../search/list.php'</script>";
    }
    else {
        echo "<script> alert ('Failed to Update Record') </script>";
    }
}
?>