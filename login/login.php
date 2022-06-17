<?php
include '../conn.php';
$dsn = 'mysql:host=localhost;dbname=sqlinjectionproject';
$db = new PDO($dsn, 'root', '');
if (isset($_POST['username'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];
    $uname = encrypt($uname);
    $password = encrypt($password);
    // alert echo $uname;
    // echo '<script>alert("' . $uname . '")</script>';
    // protected using PDO

    $sql = "SELECT * FROM user WHERE user_name=? and user_password=?";
    $result = $db->prepare($sql);
    $result->execute(array($_POST['username'], $_POST['password']));
    $count = $result->rowCount();
    $res = $result->fetch(PDO::FETCH_ASSOC);
    if ($count == 1) {
        header("Location: ./info.php");
        // start session
        session_start();
        $_SESSION['user_name'] = $res['user_name'];
        $_SESSION['user_id'] = $res['user_id'];

    } else {
        $errors[] = "User Name  not Valid";
    }
}
function encrypt($string, $key = 5)
{
    $result = '';
    for ($i = 0, $k = strlen($string); $i < $k; $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result .= $char;
    }
    return base64_encode($result);
}

function decrypt($string, $key = 5)
{
    $result = '';
    $string = base64_decode($string);
    for ($i = 0, $k = strlen($string); $i < $k; $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result .= $char;
    }
    return $result;
}
if (isset($_POST['username1'])) {

    $uname = $_POST['username1'];
    $password = $_POST['password1'];
    $uname = encrypt($uname);
    $password = encrypt($password);
    $dsn = 'mysql:host=localhost;dbname=sqlinjectionproject';
    $db = new PDO($dsn, 'root', '');
    $sql = "SELECT * FROM user";
    $result = $db->prepare($sql);
    // encrypt the password using created function encrypt
    $result->execute(array($uname, $password));
    $count = $result->rowCount();
    $res = $result->fetch(PDO::FETCH_ASSOC);
   while ($res = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($count>0) {
            $res['user_name'] = encrypt($res['user_name']);
            echo '<script>alert("' . $res['user_name'] . '")</script>';    
            // start session
           
        } else {
            $errors[] = "User Name not Valid";
        }
}
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Project</title>
    <link rel="stylesheet" a href="../styles.css">
</head>

<body>
    <div class="container">
        <form method="POST" action="login.php">
            <div class="form-input">
                <input type="text" name="username" placeholder="Enter the User Name" />
            </div>
            <div class="form-input">
                <!-- cmnt -->
                <input type="password" name="password" placeholder="password" />
            </div>
            <input type="submit" type="submit" value="LOGIN" class="btn-login" />
        </form>

        <form method="POST" action="login.php">
            <div class="form-input">
                <input type="text" name="username1" placeholder="Enter the User Name" />
            </div>
            <div class="form-input">
                <input type="password" name="password1" placeholder="password" />
            </div>
            <input  type="submit" value="SQL INJECTION" class="btn-login" />
        </form>

        <!-- <form method="POST" action="login.php">
            <div class="form-input">
                <input type="text" name="username3" placeholder="Enter the User Name" />
            </div>
            <div class="form-input">
                <input type="text" name="password2" placeholder="password" />
            </div>
            <input  type="submit" value="sqlInjectionInsert" class="btn-login" />
        </form> -->
        

    </div>
</body>

</html>