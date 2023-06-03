<?php
    $user = 'root';
    $password = 'Rishik@123';
    $database = 'se';
     
    $servername='localhost:3306';
    $mysqli = new mysqli($servername, $user,
                    $password, $database);
     
    if ($mysqli->connect_error) {
        die('Connect Error (' .
        $mysqli->connect_errno . ') '.
        $mysqli->connect_error);
    }
    $email = $_POST['email'];
    $name = $_POST['username'];
    $password = $_POST["password"];
    $sql = "select * from user";
    $result2 = $mysqli->query($sql);
    while($row = $result2->fetch_assoc()){
        if($name == $row['name'])
        {
            echo '<script>alert("Username has been taken");window.location = "signupse.html";</script>';
        }
    }
    $sql1 = "insert into user values('".$email."','".$name."','".$password."')";
    $result3 =  $mysqli->query($sql1);
    echo '<script>alert("User Registered");window.location = "se3.html";</script>';
    $mysqli->close();
?>