<?php
require_once '../includes/hidden.php';

// sprawdz czy uzytkownik jest juz zalogowany
if (is_logged_in()) {
    redirect(url('index.php'));
}

// obsluz logowanie
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // sprawdz dane logowania
    $query = "SELECT user_id, password FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // jesli dane sa poprawne zaloguj uzytkownika
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        redirect(url('index.php'));
    } else {
        $error = "Nieprawidłowa nazwa użytkownika lub hasło";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="<?= url('css/style.css') ?>">
</head>

<body>
    <!-- Header -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="<?= url('index.php') ?>" class="logo">KINO</a>
        </div>
        <div class="nav-right">
            <a href="<?= url('accounts/register.php') ?>" class="nav-link">REJESTRACJA</a>
        </div>
    </nav>

    <div class="container">
        <!-- Formularz logowania -->
        <div class="login-form">
            <h2>Logowanie</h2>
            <?php if (isset($error)): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
            <form method="POST">
                <input type="text" name="username" placeholder="Nazwa użytkownika" required>
                <input type="password" name="password" placeholder="Hasło" required>
                <button type="submit" class="btn">Zaloguj</button>
            </form>
            <p>Nie masz konta? <a href="<?= url('accounts/register.php') ?>">Zarejestruj się</a></p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>Kino Orange &copy; Wszelkie prawa zastrzeżone.</p>
    </footer>
</body>

</html>