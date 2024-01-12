<?php

$method = $_SERVER['REQUEST_METHOD'];

// Veritabanı bağlantısını içe aktar
require_once('dbbaglanti.php');

// Ürün ekleme işlemi yapan API
if ($_GET['action'] == 'ekle_urun') {
    if ($method == 'POST') {
        $urunAd = $_POST['urunAd'];
        $urunKategori = $_POST['urunKategori'];
        $urunFiyat = $_POST['urunFiyat'];
        $urunAciklama = $_POST['urunAciklama'];

        $stmt = $conn->prepare("CALL 	UrunEkle(?, ?, ?, ?)");
        $stmt->bindParam(1, $urunAd, PDO::PARAM_STR);
        $stmt->bindParam(2, $urunKategori, PDO::PARAM_STR);
        $stmt->bindParam(3, $urunFiyat, PDO::PARAM_STR);
        $stmt->bindParam(4, $urunAciklama, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Ürün başarıyla eklendi.";
        } else {
            echo "Ürün eklenirken bir hata oluştu.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

// Ürün güncelleme işlemi yapan API
else if ($_GET['action'] == 'guncelle_urun') {
    if ($method == 'PUT') {
        $put_vars = json_decode(file_get_contents("php://input"), true);

        $urunID = $put_vars['urunID'];
        $urunAd = $put_vars['urunAd'];
        $urunKategori = $put_vars['urunKategori'];
        $urunFiyat = $put_vars['urunFiyat'];
        $urunAciklama = $put_vars['urunAciklama'];

        $stmt = $conn->prepare("CALL UrunGuncelle(?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $urunID, PDO::PARAM_INT);
        $stmt->bindParam(2, $urunAd, PDO::PARAM_STR);
        $stmt->bindParam(3, $urunKategori, PDO::PARAM_STR);
        $stmt->bindParam(4, $urunFiyat, PDO::PARAM_STR);
        $stmt->bindParam(5, $urunAciklama, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Ürün başarıyla güncellendi.";
        } else {
            echo "Ürün güncellenirken bir hata oluştu.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

// Ürün silme işlemi yapan API
else if ($_GET['action'] == 'sil_urun') {
    if ($method == 'DELETE') {
        $data = json_decode(file_get_contents("php://input"), true);

        $urunID = $data['urunID'];

        $stmt = $conn->prepare("CALL 	UrunSil(?)");
        $stmt->bindParam(1, $urunID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Ürün başarıyla silindi.";
        } else {
            echo "Ürün silinirken bir hata oluştu.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

// Ürünleri getirme işlemi yapan API
else if ($_GET['action'] == 'getir_urunler') {
    if ($method == 'GET') {
        $result = $conn->query("CALL 	UrunGetir()");

        if ($result->rowCount() > 0) {
            $urunler = array();
            while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
                $urunler[] = $row;
            }
            echo json_encode($urunler);
        } else {
            echo "Ürün bulunamadı.";
        }
    } else {
        echo "Geçersiz istek yöntemi.";
    }
}

?>
