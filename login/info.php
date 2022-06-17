<?php
include "../conn.php";
include "../filterData.php";
// insert product 
// if there is no session redirect to login page
// start session
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: ./login.php");
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



?>
<!DOCTYPE html>
<html lang="en">
<style>
    table#dataTable {
        width: 100%;
        height: 100%;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <!-- logout btn -->
    <div class="logout-btn">
    </div>

    <!-- simple table with user names -->
    <div class="table-wrapper">
    <table class="fl-table " id="dataTable" cellspacing="0" border="1">
        <thead>
            <tr>
                <th><img class="therapist_logo" src="sports lab center (1).png" alt=""></th>
                <th style='text-align:center'>username</th>
                <th style='text-align:center'>password</th>
                <th style='text-align:center'>decrypted username</th>
                <th style='text-align:center'>decrypted psw</th>

                <th style="text-align:center ;"> <a href="../login/logout.php">Logout</a>
                </th>
            </tr>
        </thead>

        <tbody>
            <?php

            $sql = "select * from user";


            $res = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($res)) {
                $username = $row['user_name'];
                $password = $row['user_password'];
                echo "<tr class='Month__info'>
      <td></td>
      <td style='text-align:center'>" . encrypt($username) . "</td>
      <td style='text-align:center'>" . encrypt($password) . "</td>
      <td style='text-align:center'>" . ($username) . "</td>
      <td style='text-align:center'>" . ($password) . "</td>

      </tr>";
            ?>



                </div>
                </div>
                </div>
            <?php
            }
            ?>
        </tbody>
        <tfoot>
            <td>


            </td>
        </tfoot>
    </table>
    </div>
</body>

</html>