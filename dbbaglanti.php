<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restoran2";

try {
    // PDO bağlantısı oluştur
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // PDO hata modunu ayarla
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
?>
