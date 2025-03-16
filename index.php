<?php
require_once 'includes/hidden.php';

if (!is_logged_in()) {
    redirect(url('accounts/login.php'));
}

// Simple query for future screenings
$query = "
    SELECT 
        s.screening_id,
        m.title as movie_title,
        s.screening_date
    FROM screenings s
    JOIN movies m ON s.movie_id = m.movie_id
    WHERE s.screening_date > NOW()
    ORDER BY s.screening_date ASC
";

$stmt = $pdo->query($query);
$screenings = $stmt->fetchAll(PDO::FETCH_ASSOC);

//  debug
// echo "<pre>";
// echo "czas " . date('Y-m-d H:i:s') . "\n";
// echo "seanse" . count($screenings) . "\n";
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Kino Orange</title>
    <link rel="stylesheet" href="<?= url('css/style.css') ?>">
</head>

<body>
    <nav class="navbar">
        <div class="nav-left">
            <a href="<?= url('index.php') ?>" class="logo">KINO</a>
            <a href="<?= url('movies.php') ?>" class="nav-link">REPERTUAR</a>
        </div>
        <div class="nav-right">
            <a href="<?= url('accounts/profile.php') ?>" class="nav-link">PROFIL</a>
            <a href="<?= url('accounts/logout.php') ?>" class="nav-link">WYLOGUJ</a>
        </div>
    </nav>

    <div class="container">
        <h1>Nadchodzące seanse</h1>
        <?php if (empty($screenings)): ?>
            <p>Brak nadchodzących seansów.</p>
        <?php else: ?>
            <?php foreach ($screenings as $screening): ?>
                <div class="screening-card">
                    <h3><?= htmlspecialchars($screening['movie_title']) ?></h3>
                    <p><?= date('d.m.Y H:i', strtotime($screening['screening_date'])) ?></p>
                    <a href="<?= url('seats.php?screening_id=' . $screening['screening_id']) ?>" class="btn">
                        Wybierz miejsca
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <footer class="footer">
        <p>Kino Orange Wszelkie prawa zastrzeżone.</p>
    </footer>
</body>

</html>