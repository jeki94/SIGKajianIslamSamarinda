package com.example.jekiansari.sig_kajianislam.services;

public class Config {
    //location server
    public static final String IP = "http://192.168.1.4/";
    public static final String URL_GMB = IP+"SIGKajianIslam2/";
    public static final String URL_SERVER = IP+"SIGKajianIslam2/MobileKajianIslam/";
    // plis jangan d ganti kalo mau d commen aja malas aku bukka cmd berat

//    public static final String URL_SERVER = "http://192.168.100.87/SIGKajianIslam2/MobileKajianIslam/"; //untuk nanti seminar
//    public static final String URL_SERVER = "http://192.168.1.10/MapsBencanaFinal/MapsBencanaMobile/"; //dirumah
//public static final String URL_SERVER = "http://10.140.0.228/MapsBencanaFinal/MapsBencanaMobile/"; //dikampus
//    public static final String URL_SERVER = "http://sambalbasi.000webhostapp.com/mobile/";

    // path gambar
    public static final String PATH_BENCANA = "img/bencana/";
    public static final String PATH_BUKTI = "img/bukti/";

    //    public static final String URL_ADD = URL_SERVER + "TambahBencana.php";
    public static final String URL_MAPS = URL_SERVER;
    public static final String URL_ADD_KAJIAN = URL_SERVER + "TambahKajian.php";
    public static final String URL_EDIT = URL_SERVER + "util/EditBencana.php";
    public static final String URL_HAPUS = URL_SERVER + "util/HapusBencana.php";
    public static final String URL_ADD_USER = URL_SERVER + "TambahUser.php";
    public static final String URL_SHOW_DETAIL_KAJIAN = URL_SERVER + "ShowKajian.php?id_kajian=";
    public static final String URL_SHOW_ID_BENCANA = URL_SERVER + "services/IdBencana.php";
    public static final String EEK ="http://192.168.1.6/MapBencana/services/ShowBencana.php?id_bencana=";
    //    public static final String URL_SHOW_DETAIL_TEST_BENCANA = URL_SERVER + "services/ShowBencana.php?id_bencana=115";
    public static final String URL_SHOW_DETAIL_TEST_BENCANA = URL_SERVER + "services/ShowBencana.php?id_bencana=106";
    public static final String URL_GET_BENCANA = URL_SERVER + "TampilBencana.php?id=";
    public static final String URL_UPDATE_BENCANA = URL_SERVER + "UpdateBencana.php";
    public static final String URL_DELETE_BENCANA = URL_SERVER + "HapusBencana.php?id=";
    public static final String URL_UPLOAD = URL_SERVER + "";
    public static final String URL_LOGIN = URL_SERVER + "Login.php";

    // untuk d kirim ke php tabl bencana
    public static final String KEY_NAMA_KAJIAN = "namakajian";
    public static final String KEY_NAMA_PEMATERI = "namapemateri";
    public static final String KEY_LAT_KAJIAN = "latitude";
    public static final String KEY_LNG_KAJIAN = "longtitude";
    public static final String KEY_NAMA_TEMPAT = "namatempat";
    public static final String KEY_ALAMAT_KAJIAN = "alamat";
    public static final String KEY_KELURAHAN_KAJIAN = "kelurahan";
    public static final String KEY_KECAMATAN_KAJIAN = "kecamatan";
    public static final String KEY_TANGGAL_KAJIAN = "tanggalkajian";
    public static final String KEY_WAKTUMULAI_KAJIAN = "waktumulai";
    public static final String KEY_WAKTUSELESAI_KAJIAN = "waktuselesai";
    public static final String KEY_KUOTAPESERTA_KAJIAN = "kuotapeserta";
    public static final String KEY_STATUSPESERTA_KAJIAN = "statuspeserta";
    public static final String KEY_STATUSBERBAYAR_KAJIAN = "statusberbayar";
    public static final String KEY_PENGELOLA_KAJIAN = "pengelola";
    public static final String KEY_KONTAKPENGELOLA_KAJIAN = "kontakpengelola";
    public static final String KEY_INFORMASI_KAJIAN = "informasi";
    public static final String KEY_GAMBARTEMPAT_KAJIAN = "gambartempat";
    public static final String KEY_GAMBARPOSTER_KAJIAN = "gambarposter";
    public static final String KEY_USERNAME_KAJIAN = "username";


    // untuk d kirim ke php tabel user
    public static final String KEY_USERNAME = "username";
    public static final String KEY_PASSWORD = "password";
    public static final String KEY_TOKEN = "token";

    // untuk d kirim ke php tabel identitas
    public static final String KEY_NAMA = "nama";
    public static final String KEY_TEMPATLAHIR = "tempatlahir";
    public static final String KEY_TANGGALLAHIR = "tanggallahir";
    public static final String KEY_ALAMAT = "alamat";
    public static final String KEY_KELURAHAN = "kelurahan";
    public static final String KEY_KECAMATAN = "kecamatan";
    public static final String KEY_EMAIL = "email";
    public static final String KEY_SOSIALMEDIA = "sosialmedia";
    public static final String KEY_TELP = "no_telepon";
    public static final String KEY_NO_IDEN = "no_ktp";
    public static final String KEY_FOTOKTP = "fotoktp";
    public static final String KEY_FOTO3X4 = "foto3x4";


    //id bencana
    public static final String TAG_BENCANA = "data";
    public static final String TAG_ID_BENCANA = "id_bencana";
    public static final String TAG_NAMA_BENCANA = "nama_bencana";
    public static final String TAG_TGL_BENCANA = "tgl";
    public static final String TAG_LOKASI_BENCANA = "lokasi";
    public static final String TAG_KORBAN_BENCANA = "korban";
    public static final String TAG_KERUGIAN_BENCANA = "kerugian";
    public static final String TAG_PENYEBAB_BENCANA = "penyebab";
    public static final String TAG_KET_BENCANA = "keterangan";
    public static final String TAG_GAMBAR_BENCANA = "gambar";


    public static final String TAG_SUCCESS = "success";
    public static final String TAG_MESSAGE = "message";
    public static final String TAG_NULL ="0";

//    private final String "no_identitas" = "no_identitas";
}
