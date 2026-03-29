<?php include "config.php"; session_start(); ?>

<?php
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user["name"];
            header("Location: dashboard.php");
        } else {
            $msg = "Wrong password!";
        }
    } else {
        $msg = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <h1>Login</h1>

        <form method="POST" onsubmit="return validateLogin()">
            <input type="email" name="email" id="loginEmail" placeholder="Email">
            <input type="password" name="password" id="loginPassword" placeholder="Password">
            <button type="submit">Login</button>
        </form>

        <p id="error"></p>
        <h3><?php echo $msg; ?></h3>

        <a href="register.php">Create new account</a>
    </div>

    <script src="script.js"></script>
</body>

</html>