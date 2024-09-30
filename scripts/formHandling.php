<?php
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

// Pobieranie danych z formularza
$email = $_POST['email'];
$telefon = $_POST['telefon'];
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$dzien = $_POST['dzien'];
$miesiac = $_POST['miesiac'];
$rok = $_POST['rok'];

// Przekonwertowanie danych jednostkowych na date
$data = sprintf('%04d-%02d-%02d', $rok, $miesiac, $dzien);

// Ustalenie daty wstępu

$data_zapisu = date("Y-m-d H:i:s");

// Przygotowanie zapytania SQL do wstawienia danych
$sql = "INSERT INTO uzytkownicy (email, imie, nazwisko, dataurodzenia, telefon, data_zapisu) VALUES ('$email', '$imie', '$nazwisko', '$data', '$telefon', '$data_zapisu')";

// Wykonanie zapytania
if (mysqli_query($conn, $sql)) {
    echo "Rekord został dodany pomyślnie";
    header("Location: ../Strony/Uzytkownicy/Podsumowanie.html");
} else {
    echo "Błąd: " . $sql . "<br>" . mysqli_error($conn);
}

// Zamknięcie połączenia
mysqli_close($conn);
?>
