<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add_accounts</title>
    <style>
        .error{color: #FF0000;}
    </style>
</head>
<body>
    <h2>PHP Form Validation Example</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    Username: <input type="text" name="username" value=<?php echo $username; ?> > <br>
    Password: <input type="password" name="password" value="<?php echo $password; ?>" id=""> <br>
    <input type="submit" name='submit' value="Submit">
    </form>
    <?php
    $username=$_POST["username"];
    $password=$_POST["password"];
    function pg_connection_string_from_database_url(){
        extract(parse_url($_ENV["DATABASE_URL"]));
        return "user=$user password=$pass host=$host dbname=" . substr($path,1); 
    }
    
    $db=pg_connect(pg_connection_string_from_database_url());
    if(!$db){
        echo "Error: Unable to open database\n";
    }else{
        echo "Opened database successfully\n";
    }
    
    $sql="INSERT INTO MyAccounts (username, password) VALUES('$username','$password')";
    
    print " <br> $sql <br>";
    $ret=pg_query($db,$sql);
    if(!$ret){
        echo pg_last_error(($db));
    
    }else{
        echo "Insert succesfully\n";
    }
    pg_close($db);


?>
</body>
</html>