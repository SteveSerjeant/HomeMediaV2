<?php
session_start();
echo "hello";

//database details
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'mysql';
$DATABASE_NAME = 'homemediav2';

//connection details
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()){
    //if connection fails, shows error
    exit ('Connection Error:' . mysqli_connect_error());
}
echo "  hello !!";
//check submitted information
if ( !isset($_POST['username'], $_POST['password']) ) {
    // Could not get the data that should have been sent.
    exit('Please fill both the username and password fields!');
}

echo "       hello !!";
echo "<br>";
//test inputs from index page
$password = $_POST["password"];
$email = $_POST["username"];
echo $email;
echo "<br>";
echo $password;
echo "<br>";




//help prevent SQL injection, use prepared statement
if ($stmt = $conn->prepare('SELECT userID, passCode, userType FROM users WHERE userName =?')){

    $stmt->bind_param('s',$_POST['username']);
    $stmt->execute();


    //store result
    $stmt->store_result();

    if($stmt->num_rows > 0){
        $stmt->bind_result($userID,$passCode, $userType);
        $stmt->fetch();
        echo "  still here!!";

        if(password_verify($_POST['password'], $passCode)){

            session_regenerate_id();
            //$_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $userID;
            $_SESSION['type'] = $userType;
            echo 'Welcome ' .$_SESSION['name'] . '!, userType: ' . $_SESSION['type'];
            //header('location: mainPage.php');

        }else {
            // Incorrect password
            echo 'Incorrect username and/or PASSWORD!';
        }
    }else {
        // Incorrect username
        echo 'Incorrect USERNAME and/or password!';
    }

    $stmt->close();
}
echo "  still here!!";

