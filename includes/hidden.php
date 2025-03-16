<?php
session_start();

// Dane połączenia z bazą danych
$host = 'localhost';
$db = 'cinema';
$user = 'root';
$pass = '';

try {
    // Utworzenie połączenia PDO
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass
    );
    // Włączenie zgłaszania błędów
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Błąd połączenia z bazą: " . $e->getMessage());
}

// Sprawdza czy użytkownik jest zalogowany
function is_logged_in()
{
    return isset($_SESSION['user_id']);
}

// Przekierowanie do innej strony
function redirect($url)
{
    header("Location: $url");
    exit();
}

// Helper dla URL-i
function url($path)
{
    return "/kino/" . ltrim($path, "/");
}

// Pobierz rezerwacje użytkownika
function get_user_reservations($user_id)
{
    global $pdo;
    $query = "SELECT 
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
    GROUP BY r.reservation_id";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}
?>