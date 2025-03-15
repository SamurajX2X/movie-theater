ls
<?php
session_start();
require_once 'includes/hidden.php';

// Pobierz listę filmów z bazy danych
$stmt = $pdo->query('SELECT * FROM films');
$films = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kino - Strona główna</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Kino XYZ</h1>
        <nav>
            <ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="accounts/profile.php">Profil</a></li>
                    <li><a href="accounts/logout.php">Wyloguj</a></li>
                <?php else: ?>
                    <li><a href="accounts/login.php">Zaloguj</a></li>
                    <li><a href="accounts/register.php">Zarejestruj</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Dostępne seanse</h2>
        <div class="films">
            <?php foreach ($films as $film): ?>
                <div class="film">
                    <h3><?php echo htmlspecialchars($film['movie_title']); ?></h3>
                    <p>Data: <?php echo htmlspecialchars($film['movie_date']); ?></p>
                    <a href="seats.php?movie_id=<?php echo $film['movie_id']; ?>">Wybierz miejsca</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2023 Kino XYZ. Wszelkie prawa zastrzeżone.</p>
    </footer>
    <script src="js/script.js"></script>
</body>

</html>