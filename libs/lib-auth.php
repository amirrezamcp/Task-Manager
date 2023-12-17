<?php defined('BASE_PATH') OR die("Permision Denied");
# Authentication
function getCurrentuserID() {
    return 1;
}
# Log
function getUserByEmail($email) {
    global $connection;
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':email' => $email]);
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records[0] ?? null;
}
function login($email, $passWord) {
    # Check the Email
    $user = getUserByEmail($email);
    if(is_null($user)) {
        return false;
    }
    # Check the Password
    if(password_verify($passWord, $user->password)) {
        $_SESSION['login'] = $user;
        return true ;
    }
    return false ;
}
function isLoggedIn() {
    return isset($_SESSION['login']) ? true : false ;
}
# Register
function register($userData) {
    global $connection;
    $passwordHash = password_hash($userData['password'], PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':name' => $userData['name'], ':email' => $userData['email'], ':password' => $passwordHash]);
    return $stmt->rowCount() ? true : false;
}

?>