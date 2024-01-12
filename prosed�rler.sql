DELIMITER //

CREATE PROCEDURE PersonelEkle(
    IN p_personel_isim VARCHAR(100),
    IN p_personel_tel VARCHAR(25),
    IN p_personel_mail VARCHAR(250),
    IN p_personal_pozisyon VARCHAR(150)
)
BEGIN
    INSERT INTO Personel
    VALUES (null,p_personel_isim, p_personel_tel, p_personel_mail, p_personal_pozisyon);
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE PersonelSil(
    IN p_personel_id INT
)
BEGIN
    DELETE FROM Personel WHERE personel_id = p_personel_id;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE PersonelGuncelle(
    IN p_personel_id INT,
    IN p_personel_isim VARCHAR(100),
    IN p_personel_tel VARCHAR(25),
    IN p_personel_mail VARCHAR(250),
    IN p_personal_pozisyon VARCHAR(150)
)
BEGIN
    UPDATE Personel
    SET personel_isim = p_personel_isim,
        personel_tel = p_personel_tel,
        personel_mail = p_personel_mail,
        personal_pozisyon = p_personal_pozisyon
    WHERE personel_id = p_personel_id;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE PersonelGetir()
BEGIN
    SELECT * FROM Personel;
END //

DELIMITER ;





DELIMITER //

CREATE PROCEDURE UrunEkle(
    IN p_urun_ad VARCHAR(250),
    IN p_urun_kategori VARCHAR(250),
    IN p_urun_fiyat FLOAT,
    IN p_urun_aciklama VARCHAR(250)
)
BEGIN
    INSERT INTO Urun (urun_ad, urun_kategori, urun_fiyat, urun_aciklama)
    VALUES (p_urun_ad, p_urun_kategori, p_urun_fiyat, p_urun_aciklama);
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE UrunSil(
    IN p_urun_id INT
)
BEGIN
    DELETE FROM Urun WHERE urun_id = p_urun_id;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE UrunGuncelle(
    IN p_urun_id INT,
    IN p_urun_ad VARCHAR(250),
    IN p_urun_kategori VARCHAR(250),
    IN p_urun_fiyat FLOAT,
    IN p_urun_aciklama VARCHAR(250)
)
BEGIN
    UPDATE Urun
    SET urun_ad = p_urun_ad,
        urun_kategori = p_urun_kategori,
        urun_fiyat = p_urun_fiyat,
        urun_aciklama = p_urun_aciklama
    WHERE urun_id = p_urun_id;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE UrunGetir()
BEGIN
    SELECT * FROM Urun;
END //

DELIMITER ;





DELIMITER //

CREATE PROCEDURE GetUrun1(IN p_id INT)
BEGIN
    SELECT * FROM Urun WHERE urun_id = p_id;
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE MasaEkle(
  
    IN p_masa_kapasite INT,
    IN p_masa_durum VARCHAR(20),
    IN p_siparis_id INT,
    IN p_personel_id INT,
    IN p_hesap_id INT
)
BEGIN
    INSERT INTO Masa 
    VALUES (null, p_masa_kapasite, p_masa_durum, p_siparis_id, p_personel_id, p_hesap_id);
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE MasaSil(
    IN p_masa_id INT
)
BEGIN
    DELETE FROM Masa WHERE masa_id = p_masa_id;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE MasaGuncelle(
    IN p_masa_id INT,
    IN p_masa_no INT,
    IN p_masa_kapasite INT,
    IN p_masa_durum VARCHAR(20),
    IN p_siparis_id INT,
    IN p_personel_id INT,
    IN p_hesap_id INT
)
BEGIN
    UPDATE Masa
    SET masa_no = p_masa_no,
        masa_kapasite = p_masa_kapasite,
        masa_durum = p_masa_durum,
        siparis_id = p_siparis_id,
        personel_id = p_personel_id,
        hesap_id = p_hesap_id
    WHERE masa_id = p_masa_id;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE MasaGetir()
BEGIN
    SELECT * FROM Masa;
END //

DELIMITER ;





DELIMITER //

CREATE PROCEDURE SiparisEkle(
    IN p_siparis_durum VARCHAR(64),
    IN p_urun_id INT,
    IN p_tarih_saat DATETIME,
    IN p_toplam_tutar FLOAT,
    IN p_personel_id INT
)
BEGIN
    INSERT INTO Siparis 
    VALUES (null,p_siparis_durum, p_urun_id, p_tarih_saat, p_toplam_tutar, p_personel_id);
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE SiparisSil(
    IN p_siparis_id INT
)
BEGIN
    DELETE FROM Siparis WHERE siparis_id = p_siparis_id;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE SiparisGuncelle(
    IN p_siparis_id INT,
    IN p_siparis_durum VARCHAR(64),
    IN p_urun_id INT,
    IN p_tarih_saat DATETIME,
    IN p_toplam_tutar FLOAT,
    IN p_personel_id INT
)
BEGIN
    UPDATE Siparis
    SET siparis_durum = p_siparis_durum,
        urun_id = p_urun_id,
        tarih_saat = p_tarih_saat,
        toplam_tutar = p_toplam_tutar,
        personel_id = p_personel_id
    WHERE siparis_id = p_siparis_id;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE SiparisGetir()
BEGIN
    SELECT * FROM Siparis;
END //

DELIMITER ;





DELIMITER //

CREATE PROCEDURE HesapEkle(
    IN p_islem_tarih DATETIME,
    IN p_odenecek_tutar FLOAT,
    IN p_odeme_turu VARCHAR(50)
)
BEGIN
    INSERT INTO Hesap 
    VALUES (null,p_islem_tarih, p_odenecek_tutar, p_odeme_turu);
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE HesapSil(
    IN p_hesap_id INT
)
BEGIN
    DELETE FROM Hesap WHERE hesap_id = p_hesap_id;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE HesapGuncelle(
    IN p_hesap_id INT,
    IN p_islem_tarih DATETIME,
    IN p_odenecek_tutar FLOAT,
    IN p_odeme_turu VARCHAR(50)
)
BEGIN
    UPDATE Hesap
    SET islem_tarih = p_islem_tarih,
        odenecek_tutar = p_odenecek_tutar,
        odeme_turu = p_odeme_turu
    WHERE hesap_id = p_hesap_id;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE HesapGetir()
BEGIN
    SELECT * FROM Hesap;
END //

DELIMITER ;







DELIMITER //

CREATE PROCEDURE DeleteHesap(IN p_id INT)
BEGIN
    DELETE FROM Hesap WHERE hesap_id = p_id;
END //

DELIMITER ;

DELIMITER //
CREATE PROCEDURE GetHesap(IN p_id INT)
BEGIN
    SELECT * FROM Hesap WHERE hesap_id = p_id;
END //
DELIMITER ;







DELIMITER //

CREATE TRIGGER tg_stok_kontrol 
BEFORE INSERT ON Siparis FOR EACH ROW 
BEGIN
    DECLARE uid INT;       -- ürün id
    DECLARE stk INT;       -- stok adedi
    DECLARE adt INT;       -- sipariş adedi
    DECLARE hatamesaj VARCHAR(250);

    SET uid = NEW.urun_id;
    SET adt = 1; -- eğer bir siparişte birden fazla ürün sipariş edilecekse 
                 -- NEW.siparis_adet kullanılabilirdi.
    
    SELECT urun_stok INTO stk  
    FROM Urun 
    WHERE urun_id = uid;

    IF adt > stk THEN
        SET hatamesaj = CONCAT('Hata! ', adt, ' adet sipariş verildi, ancak ', stk, ' adet stokta mevcut!');
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = hatamesaj;
    END IF;
    
END //

DELIMITER ;



DELIMITER //

CREATE TRIGGER tg_stok_guncelle 
AFTER INSERT ON Siparis FOR EACH ROW 
BEGIN
    DECLARE uid INT;       -- ürün id
    DECLARE adet INT;      -- sipariş adedi

    SET uid = NEW.urun_id;
    SET adet = 1; -- birden fazla ürün sipariş edildiyse NEW.siparis_adet kullanılabilirdi.
    
    UPDATE Urun SET urun_stok = urun_stok - adet 
    WHERE urun_id = uid;

END //

DELIMITER ;