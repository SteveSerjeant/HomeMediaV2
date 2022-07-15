
<?php

//database details
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'mysql';
$DATABASE_NAME = 'homemediav2';

// attempt connection
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// check data submitted
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    // Could not get the data that should have been sent.
    //exit('Please complete the registration form!');
}

if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
    //exit('Please complete the registration form');
}

//to check if selected userName exists
if ($stmt = $conn->prepare('SELECT userID, passCode FROM users WHERE userName =?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0){
        //username already exists
        echo 'Username already exists, please choose another.';
        header('Location: register.php?err=' . base64_encode("wrongUser"));
        die();

    } else

        //insert new account code
        // Username doesnt exists, insert new account
        if ($stmt = $conn->prepare('INSERT INTO users (userName, passCode, email) VALUES (?, ?, ?)')) {
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
            $stmt->execute();
            //echo 'You have successfully registered, you can now login!';
            header('Location: index.php?err=' . base64_encode("registered"));
            die();

        } else {
            // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
            echo 'Could not prepare statement! line 48';
        }


    $stmt->close();

} else {
    // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
    echo 'Could not prepare statement! line 56';
}

$conn->close()

?>