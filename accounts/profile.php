<?php
require_once '../includes/hidden.php';

if (!is_logged_in()) {
    redirect(url('accounts/login.php'));
}

$reservations = get_user_reservations($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="<?= url('css/style.css') ?>">
</head>

<body>
    <!-- Header -->
    <nav class="navbar">
        <a href="<?= url('index.php') ?>" class="logo">KINO</a>
        <div>
            <a href="<?= url('accounts/profile.php') ?>">PROFIL</a>
            <a href="<?= url('accounts/logout.php') ?>">WYLOGUJ</a>
        </div>
    </nav>

    <div class="container">
        <h2>Twoje rezerwacje</h2>
        <?php foreach ($reservations as $reservation): ?>
            <div class="reservation-card">
                <h3><?= htmlspecialchars($reservation['title']) ?></h3>
                <p>Data: <?= date('d.m.Y H:i', strtotime($reservation['screening_date'])) ?></p>
                <p>Miejsca: <?= htmlspecialchars($reservation['seats']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>Kino Orange Wszelkie prawa zastrzerzone.</p>
    </footer>
</body>

</html>