<?php
    $username = $_POST['user'];
    $email = $_POST['em'];
    $password = $_POST['pass'];
    

    // Database connection
    $conn = new mysqli('localhost','root','','test1');
    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    } else {
        $stmt = $conn->prepare("insert into login(username, email, password) values(?, ?, ?)");
        $stmt->bind_param("ssi", $username, $email, $password);
        $execval = $stmt->execute();
        echo $execval;
        echo "Registration successfully...";
        $stmt->close();
        $conn->close();
    }
?>