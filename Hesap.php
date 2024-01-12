<?php

$method = $_SERVER['REQUEST_METHOD'];

// Veritabanı bağlantısını içe aktar
require_once('dbbaglanti.php');

// Hesap ekleme işlemi yapan API
if ($_GET['action'] == 'ekle_hesap') {
    if ($method == 'POST') {
        $islem_tarih = $_POST['islem_tarih'];
        $odenecekTutar = $_POST['odenecekTutar'];
        $odemeTuru = $_POST['odemeTuru'];

        $stmt = $conn->prepare("CALL HesapEkle(?, ?, ?)");
        $stmt->bindParam(1, $islem_tarih, PDO::PARAM_STR);
        $stmt->bindParam(2, $odenecekTutar, PDO::PARAM_STR);
        $stmt->bindParam(3, $odemeTuru, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Hesap başarıyla eklendi.";
        } else {
            echo "Hesap eklenirken bir hata oluştu.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

// Hesap güncelleme işlemi yapan API
else if ($_GET['action'] == 'guncelle_hesap') {
    if ($method == 'PUT') {
        $put_vars = json_decode(file_get_contents("php://input"), true);

        $hesapID = $put_vars['hesapID'];
        $islem_tarih = $put_vars['islem_tarih'];
        $odenecekTutar = $put_vars['odenecekTutar'];
        $odemeTuru = $put_vars['odemeTuru'];

        $stmt = $conn->prepare("CALL HesapGuncelle(?, ?, ?, ?)");
        $stmt->bindParam(1, $hesapID, PDO::PARAM_INT);
        $stmt->bindParam(2, $islem_tarih, PDO::PARAM_STR);
        $stmt->bindParam(3, $odenecekTutar, PDO::PARAM_STR);
        $stmt->bindParam(4, $odemeTuru, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Hesap başarıyla güncellendi.";
        } else {
            echo "Hesap güncellenirken bir hata oluştu.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

// Hesap silme işlemi yapan API
else if ($_GET['action'] == 'sil_hesap') {
    if ($method == 'DELETE') {
        $data = json_decode(file_get_contents("php://input"), true);

        $hesapID = $data['hesapID'];

        $stmt = $conn->prepare("CALL HesapSil(?)");
        $stmt->bindParam(1, $hesapID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Hesap başarıyla silindi.";
        } else {
            echo "Hesap silinirken bir hata oluştu.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

// Hesapları getirme işlemi yapan API
else if ($_GET['action'] == 'getir_hesaplar') {
    if ($method == 'GET') {
        $result = $conn->query("CALL HesapGetir()");

        if ($result->rowCount() > 0) {
            $hesaplar = array();
            while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
                $hesaplar[] = $row;
            }
            echo json_encode($hesaplar);
        } else {
            echo "Hesap bulunamadı.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

?>
