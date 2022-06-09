<?php


require "pdoconn.php";
$i = 1;

// echo $_POST['quant'];
if (isset($_POST['pono']) && isset($_POST['dname']) && isset($_POST['dconfig']) && isset($_POST['cost']) && isset($_POST['dept']) && isset($_POST['quant'])) {
    $pono = $_POST['pono'];
    $dname = $_POST['dname'];
    $dconfig = $_POST['dconfig'];
    $cost = $_POST['cost'];
    // $dept=$_POST['dept'];
    $quant = $_POST['quant'];
    // $tags = $_POST['tags-1'];
}

/////////////////////////////////////////////// None Selected /////////////////////////////////////////////
if (!(isset($_POST['department']) && !(isset($_POST['Tags'])) && !(isset($_POST['location'])) && !(isset($_POST['status']))  && !(isset($_POST['person'])))) {

    $pono = $_POST['pono'];
    $dname = $_POST['dname'];
    $dconfig = $_POST['dconfig'];
    $cost = $_POST['cost'];
    // $dept=$_POST['dept'];
    $quant = $_POST['quant'];
    // $tags = $_POST['tags-1'];

    // $quant = $_POST['quant'];


    try {
        while ($i <= $quant + 1) {

            echo $_POST['location-' . $i];
            echo $_POST['status-' . $i];
            if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                $_POST['person-' . $i] = null;
            } else if (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                $_POST['location-' . $i] = NULL;
            }



            $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
            $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $_POST['person-' . $i]));
            // echo $_POST['location-' . $i];
            // echo strlen($_POST['person-' . $i]);
            $count = $stmt1->rowCount();
            if ($count > 0) {
                while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $example = $result['allot'];
                }
            } else {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => NULL));
                    $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else if (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => NULL));
                    $stmt1->execute(array(':pid' =>  $_POST['person-' . $i], ':lid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                }
            }





            $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
            $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $_POST['dept-1'], ':status' => $_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
            $i = $i + 1;
        }
        echo "<script>alert('insertion completed')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('An error occured .. Try again later')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    }
}
///////////////////////////////////////////only dept//////////////////////////////////////////////////////////
if (isset($_POST['department']) && !(isset($_POST['Tags'])) && !(isset($_POST['location'])) && !(isset($_POST['status']))  && !(isset($_POST['person']))) {

    $pono = $_POST['pono'];
    $dname = $_POST['dname'];
    $dconfig = $_POST['dconfig'];
    $cost = $_POST['cost'];
    // $dept=$_POST['dept'];
    $quant = $_POST['quant'];
    // $tags = $_POST['tags-1'];

    // $quant = $_POST['quant'];





    $dept = $_POST['dept-1'];
    try {
        while ($i <= $quant + 1) {

            echo $_POST['location-' . $i];
            echo $_POST['status-' . $i];
            if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                $_POST['person-' . $i] = null;
            } else if (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                $_POST['location-' . $i] = NULL;
            }



            $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
            $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $_POST['person-' . $i]));
            // echo $_POST['location-' . $i];
            // echo strlen($_POST['person-' . $i]);
            $count = $stmt1->rowCount();
            if ($count > 0) {
                while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $example = $result['allot'];
                }
            } else {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => NULL));
                    $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else if (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => NULL));
                    $stmt1->execute(array(':pid' =>  $_POST['person-' . $i], ':lid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                }
            }





            $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
            $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $dept, ':status' => $_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
            $i = $i + 1;
        }
        echo "<script>alert('insertion completed')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('An error occured .. Try again later')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    }
}


/////////////////////////////////////////      ONLY TAGS     //////////////////////////////////////////////////


if (!(isset($_POST['department'])) && (isset($_POST['Tags'])) && !(isset($_POST['location'])) && !(isset($_POST['status'])) && !(isset($_POST['person']))) {

    $pono = $_POST['pono'];
    $dname = $_POST['dname'];
    $dconfig = $_POST['dconfig'];
    $cost = $_POST['cost'];
    // $dept=$_POST['dept'];
    $quant = $_POST['quant'];
    // $tags = $_POST['tags-1'];

    // $quant = $_POST['quant'];




    $tags = $_POST['tags-1'];
    try {
        while ($i <= $quant + 1) {


            if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                $_POST['person-' . $i] = null;
            } else if (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                $_POST['location-' . $i] = NULL;
            }



            $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
            $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $_POST['person-' . $i]));
            // echo $_POST['location-' . $i];
            // echo strlen($_POST['person-' . $i]);
            $count = $stmt1->rowCount();
            if ($count > 0) {
                while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $example = $result['allot'];
                }
            } else {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => NULL));
                    $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else if (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => NULL));
                    $stmt1->execute(array(':pid' =>  $_POST['person-' . $i], ':lid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                }
            }





            $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
            $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' => $_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
            $i = $i + 1;
        }
        echo "<script>alert('insertion completed')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('An error occured .. Try again later')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    }
}


/////////////////////////////////////  ONLY LOCATION   //////////////////////////////////////////////////////// error


if (!(isset($_POST['department'])) && !(isset($_POST['Tags'])) && (isset($_POST['location'])) && !(isset($_POST['status'])) && !(isset($_POST['person']))) {

    $pono = $_POST['pono'];
    $dname = $_POST['dname'];
    $dconfig = $_POST['dconfig'];
    $cost = $_POST['cost'];
    // $dept=$_POST['dept'];
    $quant = $_POST['quant'];
    // $tags = $_POST['tags-1'];

    // $quant = $_POST['quant'];




    $location = $_POST['location-1'];
    try {
        while ($i <= $quant + 1) {


            if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                $_POST['person-' . $i] = null;
            } else if (!(isset($location)) ||  strlen($location) == 0) {
                $location = NULL;
            }



            $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
            $stmt1->execute(array(':lid' => $location, ':pid' => $_POST['person-' . $i]));
            // echo $_POST['location-' . $i];
            // echo strlen($_POST['person-' . $i]);
            $count = $stmt1->rowCount();
            if ($count > 0) {
                while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $example = $result['allot'];
                }
            } else {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':lid' =>  $location, ':pid' => NULL));
                    $stmt1->execute(array(':lid' => $location, ':pid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else if (!(isset($location)) ||  strlen($location) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => NULL));
                    $stmt1->execute(array(':pid' =>  $_POST['person-' . $i], ':lid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                }
            }





            $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
            $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' => $_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
            $i = $i + 1;
        }
        echo "<script>alert('insertion completed')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('An error occured .. Try again later')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    }
}



///////////////////////////// ONLY STATUS/////////////////////////////////////

if (!(isset($_POST['department'])) && !(isset($_POST['Tags'])) && !(isset($_POST['location'])) && (isset($_POST['status'])) && !(isset($_POST['person']))) {

    $pono = $_POST['pono'];
    $dname = $_POST['dname'];
    $dconfig = $_POST['dconfig'];
    $cost = $_POST['cost'];
    // $dept=$_POST['dept'];
    $quant = $_POST['quant'];
    // $tags = $_POST['tags-1'];

    // $quant = $_POST['quant'];




    $status = $_POST['status-1'];
    try {
        while ($i <= $quant + 1) {


            if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                $_POST['person-' . $i] = null;
            } else if (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                $_POST['location-' . $i] = NULL;
            }



            $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
            $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $_POST['person-' . $i]));
            // echo $_POST['location-' . $i];
            // echo strlen($_POST['person-' . $i]);
            $count = $stmt1->rowCount();
            if ($count > 0) {
                while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $example = $result['allot'];
                }
            } else {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => NULL));
                    $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else if (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => NULL));
                    $stmt1->execute(array(':pid' =>  $_POST['person-' . $i], ':lid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                }
            }





            $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
            $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' => $status, ':srno' => $_POST['serial-' . $i]
            ));
            $i = $i + 1;
        }
        echo "<script>alert('insertion completed')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('An error occured .. Try again later')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    }
}


////////////////////////////////////    only Person    ///////////////////////////////////////////////

if (!(isset($_POST['department'])) && !(isset($_POST['Tags'])) && !(isset($_POST['location'])) && !(isset($_POST['status'])) && (isset($_POST['person']))) {

    $pono = $_POST['pono'];
    $dname = $_POST['dname'];
    $dconfig = $_POST['dconfig'];
    $cost = $_POST['cost'];
    // $dept=$_POST['dept'];
    $quant = $_POST['quant'];
    // $tags = $_POST['tags-1'];

    // $quant = $_POST['quant'];




    $person = $_POST['person-1'];
    try {
        while ($i <= $quant + 1) {


            if (!(isset($person)) ||  strlen($person) == 0) {
                $person = null;
            } else if (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                $_POST['location-' . $i] = NULL;
            }



            $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
            $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $person));
            // echo $_POST['location-' . $i];
            // echo strlen($_POST['person-' . $i]);
            $count = $stmt1->rowCount();
            if ($count > 0) {
                while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $example = $result['allot'];
                }
            } else {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => NULL));
                    $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else if (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':pid' => $person, ':lid' => NULL));
                    $stmt1->execute(array(':pid' =>  $person, ':lid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                }
            }





            $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
            $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' => $_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
            $i = $i + 1;
        }
        echo "<script>alert('insertion completed')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('An error occured .. Try again later')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    }
}



//////////////////////////////////// dept and tags ///////////////////////////////


if (isset($_POST['department']) && (isset($_POST['Tags'])) && !(isset($_POST['location'])) && !(isset($_POST['status'])) && !(isset($_POST['person']))) {


    $pono = $_POST['pono'];
    $dname = $_POST['dname'];
    $dconfig = $_POST['dconfig'];
    $cost = $_POST['cost'];
    // $dept=$_POST['dept'];
    $quant = $_POST['quant'];
    // $tags = $_POST['tags-1'];

    // $quant = $_POST['quant'];




    $dept = $_POST['dept-1'];
    $tags = $_POST['tags-1'];
    try {
        while ($i <= $quant + 1) {


            if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                $_POST['person-' . $i] = null;
            } else if (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                $_POST['location-' . $i] = NULL;
            }



            $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
            $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $_POST['person-' . $i]));
            // echo $_POST['location-' . $i];
            // echo strlen($_POST['person-' . $i]);
            $count = $stmt1->rowCount();
            if ($count > 0) {
                while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $example = $result['allot'];
                }
            } else {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => NULL));
                    $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else if (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => NULL));
                    $stmt1->execute(array(':pid' => $_POST['person-' . $i], ':lid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                }
            }





            $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
            $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $dept, ':status' => $_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
            $i = $i + 1;
        }
        echo "<script>alert('insertion completed')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('An error occured .. Try again later')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    }
}


//////////////////////////////////////////// dept and location /////////////////////////////////////// error


if (isset($_POST['department']) && !(isset($_POST['Tags'])) && (isset($_POST['location'])) && !(isset($_POST['status'])) && !(isset($_POST['person']))) {


    $pono = $_POST['pono'];
    $dname = $_POST['dname'];
    $dconfig = $_POST['dconfig'];
    $cost = $_POST['cost'];
    // $dept=$_POST['dept'];
    $quant = $_POST['quant'];
    // $tags = $_POST['tags-1'];

    // $quant = $_POST['quant'];




    $dept = $_POST['dept-1'];
    $location = $_POST['location-1'];
    try {
        while ($i <= $quant + 1) {


            if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                $_POST['person-' . $i] = null;
            } else if (!(isset($location)) ||  strlen($location) == 0) {
                $location = NULL;
            }



            $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
            $stmt1->execute(array(':lid' => $location, ':pid' => $_POST['person-' . $i]));
            // echo $_POST['location-' . $i];
            // echo strlen($_POST['person-' . $i]);
            $count = $stmt1->rowCount();
            if ($count > 0) {
                while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $example = $result['allot'];
                }
            } else {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':lid' => $location, ':pid' => NULL));
                    $stmt1->execute(array(':lid' =>  $location, ':pid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else if (!(isset($location)) ||  strlen($location) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => NULL));
                    $stmt1->execute(array(':pid' => $_POST['person-' . $i], ':lid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                }
            }





            $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
            $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $dept, ':status' => $_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
            $i = $i + 1;
        }
        echo "<script>alert('insertion completed')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('An error occured .. Try again later')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    }
}



//////////////////////////////        status and dept     ////////////////////////////////////////////////////

if (isset($_POST['department']) && !(isset($_POST['Tags'])) && !(isset($_POST['location'])) && (isset($_POST['status'])) && !(isset($_POST['person']))) {

    $pono = $_POST['pono'];
    $dname = $_POST['dname'];
    $dconfig = $_POST['dconfig'];
    $cost = $_POST['cost'];
    // $dept=$_POST['dept'];
    $quant = $_POST['quant'];
    // $tags = $_POST['tags-1'];

    // $quant = $_POST['quant'];




    $dept = $_POST['dept-1'];
    $status = $_POST['status-1'];
    try {
        while ($i <= $quant + 1) {


            if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                $_POST['person-' . $i] = null;
            } else if (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                $_POST['location-' . $i] = NULL;
            }



            $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
            $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $_POST['person-' . $i]));
            // echo $_POST['location-' . $i];
            // echo strlen($_POST['person-' . $i]);
            $count = $stmt1->rowCount();
            if ($count > 0) {
                while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $example = $result['allot'];
                }
            } else {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => NULL));
                    $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else if (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => NULL));
                    $stmt1->execute(array(':pid' => $_POST['person-' . $i], ':lid' => NULL));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                }
            }





            $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
            $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $dept, ':status' => $status, ':srno' => $_POST['serial-' . $i]
            ));
            $i = $i + 1;
        }
        echo "<script>alert('insertion completed')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('An error occured .. Try again later')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    }
}


//////////////////////////////////////// tags and location //////////////////////////////////////


if (!(isset($_POST['department'])) && (isset($_POST['Tags'])) && (isset($_POST['location'])) && !(isset($_POST['status'])) && !(isset($_POST['person']))) {
    $pono = $_POST['pono'];
    $dname = $_POST['dname'];
    $dconfig = $_POST['dconfig'];
    $cost = $_POST['cost'];
    // $dept=$_POST['dept'];
    $quant = $_POST['quant'];
    // $tags = $_POST['tags-1'];

    // $quant = $_POST['quant'];




    $tags = $_POST['tags-1'];
    $location = $_POST['location-1'];
    try {
        while ($i <= $quant + 1) {
            if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                $_POST['person-' . $i] = null;
            } elseif (!(isset($location)) ||  strlen($location) == 0) {
                $location = null;
            }



            $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
            $stmt1->execute(array(':lid' =>$location, ':pid' => $_POST['person-' . $i]));
            // echo $_POST['location-' . $i];
            // echo strlen($_POST['person-' . $i]);
            $count = $stmt1->rowCount();
            if ($count > 0) {
                while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $example = $result['allot'];
                }
            } else {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':lid' =>  $location, ':pid' => null));
                    $stmt1->execute(array(':lid' =>  $location, ':pid' => null));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } elseif (!(isset($location)) ||  strlen($location) == 0) {
                    $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                    $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                    $stmt1->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                }
            }





            $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
            $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' =>$_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
            $i = $i + 1;
        }
        echo "<script>alert('insertion completed')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
        echo "<script>alert('An error occured .. Try again later')</script>";
        echo  "<script>window.location = '../insert.php'</script>";
    }
    }


    //////////////////////////////////        Tags and  Status            /////////////////////////////////////////


    if (!(isset($_POST['department'])) && (isset($_POST['Tags'])) && !(isset($_POST['location'])) && (isset($_POST['status']))  && !(isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];




        $tags = $_POST['tags-1'];
        $status = $_POST['status-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $_POST['person-' . $i] = null;
                } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $_POST['location-' . $i] = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $_POST['person-' . $i]));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                        $stmt1->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' => $status, ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }


    ///////////////////////////////////       Location and Status         /////////////////////////////////////////


    if (!(isset($_POST['department'])) && !(isset($_POST['Tags'])) && (isset($_POST['location'])) && (isset($_POST['status']))  && !(isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];




        $location = $_POST['location-1'];
        $status = $_POST['status-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $_POST['person-' . $i] = null;
                } elseif (!(isset($location)) ||  strlen($location) == 0) {
                    $location = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' => $location, ':pid' => $_POST['person-' . $i]));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($location)) ||  strlen($location) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                        $stmt1->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' => $status, ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }

    //////////////////////////////////////// dept and person ////////////////////////////////////////////

    if ((isset($_POST['department'])) && !(isset($_POST['Tags'])) && !(isset($_POST['location'])) && !(isset($_POST['status']))  && (isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];




        $dept = $_POST['dept-1'];
        $person = $_POST['person-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $person = null;
                } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $_POST['location-' . $i] = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $person));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($person)) ||  strlen($person) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $person, ':lid' => null));
                        $stmt1->execute(array(':pid' => $person, ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $dept, ':status' => $_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }

    //////////////////////////////////////////////////tags and person ///////////////////////////////////////////

    if (!(isset($_POST['department'])) && (isset($_POST['Tags'])) && !(isset($_POST['location'])) && !(isset($_POST['status']))  && (isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];




        $tags = $_POST['tags-1'];
        $person = $_POST['person-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $person = null;
                } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $_POST['location-' . $i] = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' =>$person));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $person, ':lid' => null));
                        $stmt1->execute(array(':pid' =>$person, ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' =>  $_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }

    ////////////////////////////////////////////////location and person ///////////////////////////////////////
    if (!(isset($_POST['department'])) && !(isset($_POST['Tags'])) && (isset($_POST['location'])) && !(isset($_POST['status']))  && (isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];




        $location = $_POST['location-1'];
        $person = $_POST['person-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $person = null;
                } elseif (!(isset($location)) ||  strlen($location) == 0) {
                    $location = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' => $location, ':pid' => $person));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($person)) ||  strlen($person) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $location, ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $location, ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($location)) ||  strlen($location) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $person, ':lid' => null));
                        $stmt1->execute(array(':pid' => $person, ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' =>$_POST['tags-' . $i], ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' => $_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }

    ////////////////////////////////////////////////// status and person ///////////////////////////////////////

    if (!(isset($_POST['department'])) && !(isset($_POST['Tags'])) && !(isset($_POST['location'])) && (isset($_POST['status']))  && (isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];




        $person = $_POST['person-1'];
        $status = $_POST['status-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $person = null;
                } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $_POST['location-' . $i] = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $person));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($person)) ||  strlen($person) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $person, ':lid' => null));
                        $stmt1->execute(array(':pid' => $person, ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' => $status, ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }


    //////////////////////////////////////////// All at once ///////////////////////////////////

    if (isset($_POST['department']) && (isset($_POST['Tags'])) && (isset($_POST['location'])) && (isset($_POST['status']))  && (isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];




        $dept = $_POST['dept-1'];
        $tags = $_POST['tags-1'];
        $location = $_POST['location-1'];
        $status = $_POST['status-1'];
        $person = $_POST['person-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $person = null;
                } elseif (!(isset($location)) ||  strlen($location) == 0) {
                    $location = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' => $location, ':pid' => $person));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($person)) ||  strlen($person) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $location, ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $location, ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($location)) ||  strlen($location) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $person, ':lid' => null));
                        $stmt1->execute(array(':pid' => $person, ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $dept, ':status' => $status, ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }


    //////////////////////////////////////// dept tags and location //////////////////////////////////


    if (isset($_POST['department']) && (isset($_POST['Tags'])) && (isset($_POST['location'])) && !(isset($_POST['status']))  && !(isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];




        $dept = $_POST['dept-1'];
        $tags = $_POST['tags-1'];
        $location = $_POST['location-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $_POST['person-' . $i] = null;
                } elseif (!(isset($location)) ||  strlen($location) == 0) {
                    $location = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' =>$location, ':pid' => $_POST['person-' . $i]));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $location, ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $location, ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($location)) ||  strlen($location) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                        $stmt1->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $dept, ':status' =>$_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            // echo "<script>alert('An error occured .. Try again later')</script>";
            // echo  "<script>window.location = '../insert.php'</script>";
        }
    }

    //////////////////////////////////////////////// dept tags status ///////////////////////////////////////

    if (isset($_POST['department']) && (isset($_POST['Tags'])) && !(isset($_POST['location'])) && (isset($_POST['status'])) && !(isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];



        $tags = $_POST['tags-1'];
        $dept = $_POST['dept-1'];
        $status = $_POST['status-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $_POST['person-' . $i] = null;
                } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $_POST['location-' . $i] = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $_POST['person-' . $i]));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                        $stmt1->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $dept, ':status' => $status, ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }

    ///////////////////////////////////               dept location and status      /////////////////////////////


    if (isset($_POST['department']) && !(isset($_POST['Tags'])) && (isset($_POST['location'])) && (isset($_POST['status']))  && !(isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];




        $dept = $_POST['dept-1'];
        $status = $_POST['status-1'];
        $location = $_POST['location-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $_POST['person-' . $i] = null;
                } elseif (!(isset($location)) ||  strlen($location) == 0) {
                    $location = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' =>$location, ':pid' => $_POST['person-' . $i]));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $location, ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $location, ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($location)) ||  strlen($location) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                        $stmt1->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $dept, ':status' =>$status, ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }


    //////////////////                       tags location and status            /////////////////////////////


    if (!(isset($_POST['department'])) && (isset($_POST['Tags'])) && (isset($_POST['location'])) && (isset($_POST['status']))  && !(isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];




        $tags = $_POST['tags-1'];
        $status = $_POST['status-1'];
        $location = $_POST['location-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $_POST['person-' . $i] = null;
                } elseif (!(isset($location)) ||  strlen($location) == 0) {
                    $location = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' =>$location, ':pid' => $_POST['person-' . $i]));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $location, ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $location, ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($location)) ||  strlen($location) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                        $stmt1->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' =>$status, ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }


    ///////////////////////////////////////////// dept location and person //////////////////////////////////////////////////////////////////

    if ((isset($_POST['department'])) && !(isset($_POST['Tags'])) && (isset($_POST['location'])) && !(isset($_POST['status']))  && (isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];




        $dept = $_POST['dept-1'];
        $person = $_POST['person-1'];
        $location = $_POST['location-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $person = null;
                } elseif (!(isset($location)) ||  strlen($location) == 0) {
                    $location = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' =>$location, ':pid' => $person));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($person)) ||  strlen($person) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $location, ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $location, ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($location)) ||  strlen($location) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $person, ':lid' => null));
                        $stmt1->execute(array(':pid' => $person, ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $dept, ':status' =>$_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }

    ////////////////////////////////////////////////////////// tags location person /////////////////////////////////////////////

    if (!(isset($_POST['department'])) && (isset($_POST['Tags'])) && (isset($_POST['location'])) && !(isset($_POST['status']))  && (isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];




        $tags = $_POST['tags-1'];
        $person = $_POST['person-1'];
        $location = $_POST['location-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $person = null;
                } elseif (!(isset($location)) ||  strlen($location) == 0) {
                    $location = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' =>$location, ':pid' => $person));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($person)) ||  strlen($person) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $location, ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $location, ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($location)) ||  strlen($location) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $person, ':lid' => null));
                        $stmt1->execute(array(':pid' => $person, ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' =>$_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }

    //////////////////////////////////////////////////////////// location status person /////////////////////////////////////////////////

    if (!(isset($_POST['department'])) && !(isset($_POST['Tags'])) && (isset($_POST['location'])) && (isset($_POST['status']))  && (isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];




        $person = $_POST['person-1'];
        $status = $_POST['status-1'];
        $location = $_POST['location-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $person = null;
                } elseif (!(isset($location)) ||  strlen($location) == 0) {
                    $location = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' =>$location, ':pid' => $person));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($person)) ||  strlen($person) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $location, ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $location, ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($location)) ||  strlen($location) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $person, ':lid' => null));
                        $stmt1->execute(array(':pid' => $person, ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' =>$status, ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }

    /////////////////////////////////////////////////////// dept tags person ///////////////////////////////////////////////////////////////////////

    if (isset($_POST['department']) && (isset($_POST['Tags'])) && !(isset($_POST['location'])) && !(isset($_POST['status'])) && (isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];



        $person = $_POST['person-1'];
        $dept = $_POST['dept-1'];
        $tags = $_POST['tags-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $person = null;
                } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $_POST['location-' . $i] = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $person));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($person)) ||  strlen($person) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $person, ':lid' => null));
                        $stmt1->execute(array(':pid' => $person, ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $dept, ':status' => $_POST['status-' . $i], ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }

    /////////////////////////////////////////////////////// dept status person ////////////////////////////////////

    if (isset($_POST['department']) && !(isset($_POST['Tags'])) && !(isset($_POST['location'])) && (isset($_POST['status'])) && (isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];



        $person = $_POST['person-1'];
        $dept = $_POST['dept-1'];
        $status = $_POST['status-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $person = null;
                } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $_POST['location-' . $i] = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $person));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($person)) ||  strlen($person) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $person, ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $person, ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $person, ':lid' => null));
                        $stmt1->execute(array(':pid' => $person, ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $dept, ':status' => $status, ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }

    ///////////////////////////////////////////////////////// tags status person ///////////////////////////////////////////

    if (isset($_POST['department']) && (isset($_POST['Tags'])) && !(isset($_POST['location'])) && !(isset($_POST['status'])) && (isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];



        $person = $_POST['person-1'];
        $status = $_POST['status-1'];
        $tags = $_POST['tags-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $person = null;
                } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $_POST['location-' . $i] = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $person));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($person)) ||  strlen($person) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $_POST['location-' . $i], ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $person, ':lid' => null));
                        $stmt1->execute(array(':pid' => $person, ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' => $status, ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }
    ////////////////////////////////////////////////////////// dept tags location status /////////////////////////////////////

    if (isset($_POST['department']) && (isset($_POST['Tags'])) && (isset($_POST['location'])) && (isset($_POST['status']))  && !(isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];



        $status = $_POST['status-1'];
        $dept = $_POST['dept-1'];
        $tags = $_POST['tags-1'];
        $location = $_POST['location-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                    $_POST['person-' . $i] = null;
                } elseif (!(isset($location)) ||  strlen($location) == 0) {
                    $location = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' =>$location, ':pid' => $_POST['person-' . $i]));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($_POST['person-' . $i])) ||  strlen($_POST['person-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $location, ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $location, ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($location)) ||  strlen($location) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                        $stmt1->execute(array(':pid' => $_POST['person-' . $i], ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $dept, ':status' =>$status, ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }

    ////////////////////////////////////////////////dept tags status person ////////////////////////////////////////////////
    if (isset($_POST['department']) && (isset($_POST['Tags'])) && !(isset($_POST['location'])) && (isset($_POST['status'])) && (isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];


        $tags = $_POST['tags-1'];
        $person = $_POST['person-1'];
        $dept = $_POST['dept-1'];
        $status = $_POST['status-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $person = null;
                } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                    $_POST['location-' . $i] = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' => $_POST['location-' . $i], ':pid' => $person));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($person)) ||  strlen($person) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $person, ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $person, ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($_POST['location-' . $i])) ||  strlen($_POST['location-' . $i]) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $person, ':lid' => null));
                        $stmt1->execute(array(':pid' => $person, ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $dept, ':status' => $status, ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }

    ////////////////////////////////////////////////// dept location status person /////////////////////////////////////


    if ((isset($_POST['department'])) && !(isset($_POST['Tags'])) && (isset($_POST['location'])) && (isset($_POST['status']))  && (isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];



        $status = $_POST['status-1'];
        $dept = $_POST['dept-1'];
        $person = $_POST['person-1'];
        $location = $_POST['location-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $person = null;
                } elseif (!(isset($location)) ||  strlen($location) == 0) {
                    $location = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' =>$location, ':pid' => $person));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($person)) ||  strlen($person) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $location, ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $location, ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($location)) ||  strlen($location) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $person, ':lid' => null));
                        $stmt1->execute(array(':pid' => $person, ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $_POST['tags-' . $i], ':cost' => $cost, ':dept' => $dept, ':status' =>$status, ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }

    /////////////////////////////////////////////////////// tags location status person ///////////////////////////////////

    if (!(isset($_POST['department'])) && (isset($_POST['Tags'])) && (isset($_POST['location'])) && (isset($_POST['status']))  && (isset($_POST['person']))) {
        $pono = $_POST['pono'];
        $dname = $_POST['dname'];
        $dconfig = $_POST['dconfig'];
        $cost = $_POST['cost'];
        // $dept=$_POST['dept'];
        $quant = $_POST['quant'];
        // $tags = $_POST['tags-1'];

        // $quant = $_POST['quant'];



        $status = $_POST['status-1'];
        $tags = $_POST['tags-1'];
        $person = $_POST['person-1'];
        $location = $_POST['location-1'];
        try {
            while ($i <= $quant + 1) {
                if (!(isset($person)) ||  strlen($person) == 0) {
                    $person = null;
                } elseif (!(isset($location)) ||  strlen($location) == 0) {
                    $location = null;
                }



                $stmt1 = $pdo->prepare("select allot from allot where lid=:lid or pid=:pid");
                $stmt1->execute(array(':lid' =>$location, ':pid' => $person));
                // echo $_POST['location-' . $i];
                // echo strlen($_POST['person-' . $i]);
                $count = $stmt1->rowCount();
                if ($count > 0) {
                    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        $example = $result['allot'];
                    }
                } else {
                    if (!(isset($person)) ||  strlen($person) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':lid' =>  $location, ':pid' => null));
                        $stmt1->execute(array(':lid' =>  $location, ':pid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    } elseif (!(isset($location)) ||  strlen($location) == 0) {
                        $stmt2 = $pdo->prepare("insert into allot(lid,pid) values(:lid,:pid)");
                        $stmt2->execute(array(':pid' => $person, ':lid' => null));
                        $stmt1->execute(array(':pid' => $person, ':lid' => null));
                        while ($result = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $example = $result['allot'];
                        }
                    }
                }





                $stmt = $pdo->prepare("insert into infra ( `po_no`, `d_name`, `d_config`, `tags_id`, `cost`, `dept`, `allot`, `status`, `srno`) 
        values (:po_no,:d_name,:d_config, :tags_id, :cost, :dept, :allot, :status, :srno)");
                $stmt->execute(array(
                ':allot' => $example, ':po_no' => $pono, ':d_name' => $dname, ':d_config' => $dconfig,
                ':tags_id' => $tags, ':cost' => $cost, ':dept' => $_POST['dept-' . $i], ':status' =>$status, ':srno' => $_POST['serial-' . $i]
            ));
                $i = $i + 1;
            }
            echo "<script>alert('insertion completed')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        } catch (PDOException $e) {
            echo "<script>alert('An error occured .. Try again later')</script>";
            echo  "<script>window.location = '../insert.php'</script>";
        }
    }