<?php
require_once '../includes/hidden.php';

if (is_logged_in()) {
    redirect(url('index.php'));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = trim($_POST['phone']);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, phone) VALUES (?, ?, ?)");
        $stmt->execute([$username, $password, $phone]);
        redirect(url('accounts/login.php'));
    } catch (PDOException $e) {
        $error = "Nazwa użytkownika jest już zajęta";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="<?= url('css/style.css') ?>">
</head>

<body>
    <div class="container">
        <h2>Rejestracja</h2>
        <?php if (isset($error))
            echo "<p class='error'>$error</p>"; ?>

        <form method="post">
            <input type="text" name="username" placeholder="Nazwa użytkownika" required>
            <input type="password" name="password" placeholder="Hasło" required>
            <input type="tel" name="phone" placeholder="Numer telefonu" required>
            <button type="submit">Zarejestruj</button>
        </form>

        <a href="<?= url('accounts/login.php') ?>">Masz już konto? Zaloguj się</a>
    </div>

    <footer class="footer">
        <p>Kino Orange Wszelkie prawa zastrzerzone.</p>
    </footer>
</body>

</html>