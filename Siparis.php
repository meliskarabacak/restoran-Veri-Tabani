<?php

$method = $_SERVER['REQUEST_METHOD'];

// Veritabanı bağlantısını içe aktar
require_once('dbbaglanti.php');

// Sipariş ekleme işlemi yapan API
if ($_GET['action'] == 'ekle_siparis') {
    if ($method == 'POST') {
        $siparisDurum = $_POST['siparisDurum'];
        $urunID = $_POST['urunID'];
        $tarih_saat = $_POST['tarih_saat'];
        $toplamTutar = $_POST['toplamTutar'];
        $PersonelID = $_POST['PersonelID'];

        $stmt = $conn->prepare("CALL SiparisEkle(?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $siparisDurum, PDO::PARAM_STR);
        $stmt->bindParam(2, $urunID, PDO::PARAM_INT);
        $stmt->bindParam(3, $tarih_saat, PDO::PARAM_STR);
        $stmt->bindParam(4, $toplamTutar, PDO::PARAM_STR);
        $stmt->bindParam(5, $PersonelID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Sipariş başarıyla eklendi.";
        } else {
            echo "Sipariş eklenirken bir hata oluştu.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

// Sipariş güncelleme işlemi yapan API
else if ($_GET['action'] == 'guncelle_siparis') {
    if ($method == 'PUT') {
        $put_vars = json_decode(file_get_contents("php://input"), true);

        $siparisID = $put_vars['siparisID'];
        $siparisDurum = $put_vars['siparisDurum'];
        $urunID = $put_vars['urunID'];
        $tarih_saat = $put_vars['tarih_saat'];
        $toplamTutar = $put_vars['toplamTutar'];
        $PersonelID = $put_vars['PersonelID'];

        $stmt = $conn->prepare("CALL SiparisGuncelle(?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $siparisID, PDO::PARAM_INT);
        $stmt->bindParam(2, $siparisDurum, PDO::PARAM_STR);
        $stmt->bindParam(3, $urunID, PDO::PARAM_INT);
        $stmt->bindParam(4, $tarih_saat, PDO::PARAM_STR);
        $stmt->bindParam(5, $toplamTutar, PDO::PARAM_STR);
        $stmt->bindParam(6, $PersonelID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Sipariş başarıyla güncellendi.";
        } else {
            echo "Sipariş güncellenirken bir hata oluştu.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

// Sipariş silme işlemi yapan API
else if ($_GET['action'] == 'sil_siparis') {
    if ($method == 'DELETE') {
        $data = json_decode(file_get_contents("php://input"), true);

        $siparisID = $data['siparisID'];

        $stmt = $conn->prepare("CALL 	SiparisSil(?)");
        $stmt->bindParam(1, $siparisID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Sipariş başarıyla silindi.";
        } else {
            echo "Sipariş silinirken bir hata oluştu.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

// Siparişleri getirme işlemi yapan API
else if ($_GET['action'] == 'getir_siparisler') {
    if ($method == 'GET') {
        $result = $conn->query("CALL SiparisGetir()");

        if ($result->rowCount() > 0) {
            $siparisler = array();
            while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
                $siparisler[] = $row;
            }
            echo json_encode($siparisler);
        } else {
            echo "Sipariş bulunamadı.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

?>
