<?php
session_start();

// Dane do połączenia z bazą
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'cinema';

// Tworzenie połączenia mysqli
$mysqli = new mysqli($host, $user, $pass, $db);

// Sprawdzenie połączenia
if ($mysqli->connect_error) {
    die("Błąd połączenia: " . $mysqli->connect_error);
}

// Ustawienie kodowania
$mysqli->set_charset("utf8mb4");

// Funkcje pomocnicze
function is_logged_in()
{
    return isset($_SESSION['user_id']);
}

function redirect($url)
{
    header("Location: $url");
    exit();
}

function url($path)
{
    return "/kino/" . ltrim($path, "/");
}

// Pobierz rezerwacje użytkownika
function get_user_reservations($user_id)
{
    global $mysqli;
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

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>