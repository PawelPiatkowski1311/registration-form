<?php
session_start();
// Dane do połączenia z bazą danych
$host = 'localhost';   // Adres hosta
$dbname = 'ticket'; // Nazwa bazy danych
$username = 'root';    // Nazwa użytkownika MySQL
$password = '';        // Hasło do MySQL (zostaw puste, jeśli nie masz hasła)

// Tworzenie połączenia z bazą danych
$conn = mysqli_connect($host, $username, $password, $dbname);

// Sprawdzanie połączenia
if (!$conn) {
    die("Błąd połączenia: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['haslo'] ?? '';

    // Przygotowanie zapytania SQL, aby uniknąć SQL Injection
    $stmt = mysqli_prepare($conn, "SELECT `login`, `haslo` FROM `administratorzy` WHERE login = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $login);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Sprawdzanie, czy użytkownik istnieje
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $poprawneHasloHash = $row['haslo']; // Hasło zaszyfrowane w bazie

        // Weryfikacja hasła
        if (password_verify($password, $poprawneHasloHash)) {
            // Regeneracja ID sesji dla bezpieczeństwa
            session_regenerate_id();

            // Ustawienie zmiennych sesji
            $_SESSION['loggedin'] = true;
            $_SESSION['login'] = $login;

            // Przekierowanie do strony powitalnej
            header("Location: http://localhost/Tickety/Strony/Administracja/Menu.html");
            exit;
        } else {
            // Błędne hasło
            $_SESSION['bladHaslo'] = "Niepoprawne hasło!";
            header("Location: http://localhost/Tickety/Strony/Administracja/Logowanie.php");
            exit;
        }
    } else {
        // Błędny login
        $_SESSION['bladLogin'] = "Nie znaleziono użytkownika o podanym loginie!";
        header("Location: http://localhost/Tickety/Strony/Administracja/Logowanie.php");
        exit;
    }

    // Zamknięcie zapytania
    mysqli_stmt_close($stmt);
}

// Zamknięcie połączenia z bazą danych
mysqli_close($conn);
?>
