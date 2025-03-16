<?php
require_once '../includes/hidden.php';

//  czy uzytkownik jest juz zalogowany
if (is_logged_in()) {
    redirect(url('index.php'));
}

// obsluz rejestracje
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $phone = trim($_POST['phone']);

    //  czy nazwa uzytkownika jest wolna
    $query = "SELECT user_id FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();

    if ($stmt->get_result()->num_rows > 0) {
        $error = "Ta nazwa użytkownika jest już zajęta";
    } else {
        // dodanie uzytkownika
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, password, phone) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('sss', $username, $hashed_password, $phone);

        if ($stmt->execute()) {
            redirect(url('accounts/login.php'));
        } else {
            $error = "Błąd podczas rejestracji";
        }
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
    <nav class="navbar">
        <div class="nav-left">
            <a href="<?= url('index.php') ?>" class="logo">KINO</a>
        </div>
        <div class="nav-right">
            <a href="<?= url('accounts/login.php') ?>" class="nav-link">LOGOWANIE</a>
        </div>
    </nav>

    <div class="container">
        <div class="login-form">
            <h2>Rejestracja</h2>
            <?php if (isset($error)): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
            <form method="POST">
                <input type="text" name="username" placeholder="Nazwa użytkownika" required>
                <input type="password" name="password" placeholder="Hasło" required>
                <input type="tel" name="phone" placeholder="Numer telefonu" required>
                <button type="submit">Zarejestruj</button>
            </form>

            <a href="<?= url('accounts/login.php') ?>">Masz już konto? Zaloguj się</a>
        </div>
    </div>

    <footer class="footer">
        <p>Kino Orange Wszelkie prawa zastrzerzone.</p>
    </footer>
</body>

</html>