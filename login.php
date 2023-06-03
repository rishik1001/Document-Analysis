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
    $name = $_POST['username'];
    $password = $_POST["password"];
    $sql = "select * from user";
    $result2 = $mysqli->query($sql);
    while($row = $result2->fetch_assoc()){
        if($name == $row['name'])
        {
            if($password == $row['password'])
            {
                session_start();
                $_SESSION["username"] = $name;
                echo '<script>alert("Successfully Logged In as User");window.location = "demo.html";</script>';
            }
            else
            {
                echo '<script>alert("Wrong Password");
                window.location = "se3.html";</script>';
            }
        }
    }
    echo '<script>alert("User Not Found");window.location = "se3.html";</script>';
    $mysqli->close();
?>