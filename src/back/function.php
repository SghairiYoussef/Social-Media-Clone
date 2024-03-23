<?php
include "DataBase.php";
function signUp($table, $fullname, $email, $username, $password, $birthDate)
{
    // Get database connection instance
    $connexion = ConnexionBD::getInstance();

    // Quote the variables to prevent SQL injection
    $fullname = $connexion->quote($fullname);
    $email = $connexion->quote($email);
    $username = $connexion->quote($username);
    $password = $connexion->quote($password);
    $birthDate = $connexion->quote($birthDate);

    // Check if username or email already exists
    $checkSql = "SELECT COUNT(*) AS count FROM $table WHERE userName = $username OR email = $email";
    $stmt = $connexion->query($checkSql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result['count'] > 0) {
        return false;
    }

    // Insert user data into the database
    $sql = "INSERT INTO $table (userName, email, password, fullName,birthDay) VALUES ($username,$email,$password,$fullname,$birthDate)";
    try {
        $connexion->exec($sql);
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

function logIn($table, $username, $password)
{
    $connexion = ConnexionBD::getInstance(); // Get database connection instance
    $user_name = $connexion->quote($username);
    $sql = "SELECT * FROM $table WHERE username = $user_name";
    $stmt = $connexion->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $dbusername = $row['userName'];
        $dbpassword = $row['password'];

        if ($dbusername == $username && $dbpassword == $password) {
            return true;
        }
    }
    return false;
}
?>
