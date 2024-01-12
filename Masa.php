<?php

$method = $_SERVER['REQUEST_METHOD'];

// Veritabanı bağlantısını içe aktar
require_once('dbbaglanti.php');

// Masa ekleme işlemi yapan API
if ($_GET['action'] == 'ekle_masa') {
    if ($method == 'POST') {
        $masa_kapasite = $_POST['masa_kapasite'];
        $masa_durum = $_POST['masa_durum'];
        $fk_siparisID = $_POST['fk_siparisID'];
        $fk_personelD = $_POST['fk_personelD'];

        $stmt = $conn->prepare("CALL MasaEkle(?, ?, ?, ?)");
        $stmt->bindParam(1, $masa_kapasite, PDO::PARAM_INT);
        $stmt->bindParam(2, $masa_durum, PDO::PARAM_STR);
        $stmt->bindParam(3, $fk_siparisID, PDO::PARAM_INT);
        $stmt->bindParam(4, $fk_personelD, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Masa başarıyla eklendi.";
        } else {
            echo "Masa eklenirken bir hata oluştu.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

// Masa güncelleme işlemi yapan API
else if ($_GET['action'] == 'guncelle_masa') {
    if ($method == 'PUT') {
        $put_vars = json_decode(file_get_contents("php://input"), true);

        $masa_id = $put_vars['masa_id'];
        $masa_kapasite = $put_vars['masa_kapasite'];
        $masa_durum = $put_vars['masa_durum'];
        $fk_siparisID = $put_vars['fk_siparisID'];
        $fk_personelD = $put_vars['fk_personelD'];

        $stmt = $conn->prepare("CALL MasaGuncelle(?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $masa_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $masa_kapasite, PDO::PARAM_INT);
        $stmt->bindParam(3, $masa_durum, PDO::PARAM_STR);
        $stmt->bindParam(4, $fk_siparisID, PDO::PARAM_INT);
        $stmt->bindParam(5, $fk_personelD, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Masa başarıyla güncellendi.";
        } else {
            echo "Masa güncellenirken bir hata oluştu.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

// Masa silme işlemi yapan API
else if ($_GET['action'] == 'sil_masa') {
    if ($method == 'DELETE') {
        $data = json_decode(file_get_contents("php://input"), true);

        $masa_id = $data['masa_id'];

        $stmt = $conn->prepare("CALL MasaSil(?)");
        $stmt->bindParam(1, $masa_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Masa başarıyla silindi.";
        } else {
            echo "Masa silinirken bir hata oluştu.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

// Masaları getirme işlemi yapan API
else if ($_GET['action'] == 'getir_masalar') {
    if ($method == 'GET') {
        $result = $conn->query("CALL MasaGetir()");

        if ($result->rowCount() > 0) {
            $masalar = array();
            while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
                $masalar[] = $row;
            }
            echo json_encode($masalar);
        } else {
            echo "Masa bulunamadı.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

?>
