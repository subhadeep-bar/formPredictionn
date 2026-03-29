<?php include "config.php"; ?>

<?php
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $password);

    if ($stmt->execute()) {
        $msg = "Registration successful 🎉";
    } else {
        $msg = "Error: Email already exists!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <h1>Register</h1>

        <form method="POST" onsubmit="return validateRegister()">
            <input type="text" name="name" id="name" placeholder="Name">
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="text" name="phone" id="phone" placeholder="Phone">
            <input type="password" name="password" id="password" placeholder="Password">
            <button type="submit">Register</button>
        </form>

        <p id="error"></p>
        <h3><?php echo $msg; ?></h3>

        <a href="login.php">Already have an account? Login</a>
    </div>

    <script src="script.js"></script>
</body>

</html>