<?php
require_once 'includes/hidden.php';

// Get all movies with their upcoming screenings
$query = "
    SELECT 
        m.movie_id,
        m.title,
        m.description,
        s.screening_id,
        s.screening_date
    FROM movies m
    LEFT JOIN screenings s ON m.movie_id = s.movie_id
    WHERE s.screening_date >= NOW()
    ORDER BY m.title ASC, s.screening_date ASC
";

$stmt = $pdo->query($query);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group screenings by movie
$movies = [];
foreach ($results as $row) {
    if (!isset($movies[$row['movie_id']])) {
        $movies[$row['movie_id']] = [
            'title' => $row['title'],
            'description' => $row['description'],
            'screenings' => []
        ];
    }
    if ($row['screening_id']) {
        $movies[$row['movie_id']]['screenings'][] = [
            'id' => $row['screening_id'],
            'date' => $row['screening_date']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repertuar - Kino Orange</title>
    <link rel="stylesheet" href="<?= url('css/style.css') ?>">
</head>

<body>
    <nav class="navbar">
        <a href="<?= url('index.php') ?>" class="logo">KINO</a>
        <div>
            <?php if (is_logged_in()): ?>
                <a href="<?= url('accounts/profile.php') ?>" class="nav-link">PROFIL</a>
                <a href="<?= url('accounts/logout.php') ?>" class="nav-link">WYLOGUJ</a>
            <?php else: ?>
                <a href="<?= url('accounts/login.php') ?>" class="nav-link">ZALOGUJ</a>
                <a href="<?= url('accounts/register.php') ?>" class="nav-link">ZAREJESTRUJ</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        <h1>Repertuar</h1>
        <?php if (empty($movies)): ?>
            <p>Brak filmów w repertuarze.</p>
        <?php else: ?>
            <div class="movies-grid">
                <?php foreach ($movies as $movie): ?>
                    <div class="movie-card">
                        <h2><?= htmlspecialchars($movie['title']) ?></h2>
                        <p class="movie-description"><?= htmlspecialchars($movie['description']) ?></p>
                        
                        <div class="screening-times">
                            <h3>Dostępne seanse:</h3>
                            <?php if (!empty($movie['screenings'])): ?>
                                <div class="screening-buttons">
                                    <?php foreach ($movie['screenings'] as $screening): ?>
                                        <?php if (is_logged_in()): ?>
                                            <a href="<?= url('seats.php?screening_id=' . $screening['id']) ?>" 
                                               class="screening-btn">
                                                <?= date('d.m.Y H:i', strtotime($screening['date'])) ?>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= url('accounts/login.php') ?>" 
                                               class="screening-btn">
                                                <?= date('d.m.Y H:i', strtotime($screening['date'])) ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p>Brak zaplanowanych seansów</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <footer class="footer">
        <p>Kino Orange &copy; Wszelkie prawa zastrzeżone.</p>
    </footer>
</body>

</html>