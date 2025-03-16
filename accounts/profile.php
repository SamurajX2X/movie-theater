<?php
require_once '../includes/hidden.php';

// sprawdz czy uzytkownik jest zalogowany
if (!is_logged_in()) {
    redirect(url('accounts/login.php'));
}

$user_id = $_SESSION['user_id'];

// pobierz dane uzytkownika
$query = "
    SELECT username, phone 
    FROM users 
    WHERE user_id = ?
";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// pobierz rezerwacje uzytkownika
$query = "
    SELECT 
        r.reservation_id,
        m.title,
        s.screening_date,
        GROUP_CONCAT(CONCAT(st.row_num, '-', st.seat_num)) as seats
    FROM reservations r
    JOIN screenings s ON r.screening_id = s.screening_id
    JOIN movies m ON s.movie_id = m.movie_id
    JOIN reserved_seats rs ON r.reservation_id = rs.reservation_id
    JOIN seats st ON rs.seat_id = st.seat_id
    WHERE r.user_id = ?
    GROUP BY r.reservation_id
    ORDER BY s.screening_date DESC
";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$reservations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="<?= url('css/style.css') ?>">
</head>

<body>
    <nav class="navbar">
        <div class="nav-left">
            <a href="<?= url('index.php') ?>" class="logo">KINO</a>
            <a href="<?= url('movies.php') ?>" class="nav-link">REPERTUAR</a>
        </div>
        <div class="nav-right">
            <a href="<?= url('accounts/logout.php') ?>" class="nav-link">WYLOGUJ</a>
        </div>
    </nav>

    <div class="container">
        <h1>Profil użytkownika</h1>
        <div class="user-info">
            <p>Nazwa użytkownika: <?= htmlspecialchars($user['username']) ?></p>
            <p>Telefon: <?= htmlspecialchars($user['phone']) ?></p>
        </div>

        <h2>Twoje rezerwacje</h2>
        <?php if (empty($reservations)): ?>
            <p>Brak rezerwacji</p>
        <?php else: ?>
            <?php foreach ($reservations as $res): ?>
                <div class="reservation-card">
                    <h3><?= htmlspecialchars($res['title']) ?></h3>
                    <p>Data: <?= date('d.m.Y H:i', strtotime($res['screening_date'])) ?></p>
                    <p>Miejsca: <?= htmlspecialchars($res['seats']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <footer class="footer">
        <p>Kino Orange &copy; Wszelkie prawa zastrzeżone.</p>
    </footer>
</body>

</html>