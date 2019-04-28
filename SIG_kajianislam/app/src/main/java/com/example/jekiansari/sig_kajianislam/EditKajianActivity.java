package com.example.jekiansari.sig_kajianislam;

import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.graphics.Color;
import android.graphics.drawable.BitmapDrawable;
import android.graphics.drawable.ColorDrawable;
import android.net.Uri;
import android.provider.MediaStore;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.example.jekiansari.sig_kajianislam.Adapter.Kelurahan;
import com.example.jekiansari.sig_kajianislam.Adapter.MyKajianAdapter;
import com.example.jekiansari.sig_kajianislam.Model.EditResponse;
import com.example.jekiansari.sig_kajianislam.Model.ListLocationModel;
import com.example.jekiansari.sig_kajianislam.handler.ImageUtils;
import com.example.jekiansari.sig_kajianislam.handler.JSONParser;
import com.example.jekiansari.sig_kajianislam.services.ApiClient;
import com.example.jekiansari.sig_kajianislam.services.ApiService;
import com.example.jekiansari.sig_kajianislam.services.Config;

import org.json.JSONArray;

import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.HashMap;

import id.zelory.compressor.Compressor;
import okhttp3.MediaType;
import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static com.example.jekiansari.sig_kajianislam.services.Config.URL_GMB;

public class EditKajianActivity extends AppCompatActivity {

    //Dibawah ini merupakan perintah untuk mendefinikan View
    private EditText editTextNamakajian;
    private EditText editTextNamapemateri;
    private EditText editTextNamatempat;
    private EditText editTextAlamat;
    private EditText editTextKelurahan;
    private EditText editTextKecamatan;
    private EditText editTextTanggalkajian;
    private EditText editTextWaktumulai;
    private EditText editTextWaktuselesai;
    private EditText editTextKuotapeserta;
    private EditText editTextStatuspeserta;
    private EditText editTextStatusberbayar;
    private EditText editTextPengelola;
    private EditText editTextKontakpengelola;
    private EditText editTextInformasi;


    private DatePickerDialog.OnDateSetListener mDateSetListener1;
    String Parameter1="";

    private Button buttonAddKajian;
    private Button buttonBackKajian;
    Button buttonChooseTempat, buttonChoosePoster;
    int click = 0;
    int click2 = 0;
    Spinner spinKecamatan, spinKelurahan;
    private ProgressDialog pDialog;

    ArrayList<Kelurahan> kelurahanArrayList = new ArrayList<Kelurahan>();
    ArrayList<HashMap<String, String>> AarayList;

    TextView InfoLoc;
    ImageView imageView, imageView2;
    Bitmap bitmap, bitmap2;
    int PICK_IMAGE_REQUEST = 1;
    int PICK_IMAGE_REQUEST2 = 2;

    JSONParser jParser = new JSONParser();
    JSONArray daftarKelurahan = null;

    String username;

    String imgTempatPath, imgPosterPath;
    private File compressImgTempat, compressImgPoster;


    private String id, namakajian = null, namapemateri = null, namatempat = null, alamat = null, lat = null, lng = null, kelurahan = null, kecamatan = null, tanggalkajian = null, waktumulai = null, waktuselesai = null, kuotapeserta = null, statuspeserta = null, statusberbayar = null, pengelola = null, kontakpengelola = null, informasi = null, gambarposter = null, gambartempat = null;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_kajian);

        editTextNamakajian = (EditText) findViewById(R.id.namakajian);
        editTextNamapemateri = (EditText) findViewById(R.id.namapemateri);
        editTextNamatempat = (EditText) findViewById(R.id.namatempat);
        editTextAlamat = (EditText) findViewById(R.id.alamatkajian);
        editTextKelurahan = (EditText) findViewById(R.id.kelurahankajiantambah);
        editTextKecamatan = (EditText) findViewById(R.id.kecamatankajiantambah);
        editTextTanggalkajian = (EditText) findViewById(R.id.tanggalkajian);
        editTextWaktumulai = (EditText) findViewById(R.id.waktumulai);
        editTextWaktuselesai = (EditText) findViewById(R.id.waktuselesai);
        editTextKuotapeserta = (EditText) findViewById(R.id.kuotapeserta);
        editTextStatuspeserta = (EditText) findViewById(R.id.statuspeserta);
        editTextStatusberbayar = (EditText) findViewById(R.id.statusberbayar);
        editTextPengelola = (EditText) findViewById(R.id.pengelola);
        editTextKontakpengelola = (EditText) findViewById(R.id.kontakpengelola);
        editTextInformasi = (EditText) findViewById(R.id.informasi);

        InfoLoc = (TextView)findViewById(R.id.infoloc);
        imageView = (ImageView) findViewById(R.id.gambartempat);
        imageView2 = (ImageView) findViewById(R.id.gambarposter);
        buttonAddKajian = (Button) findViewById(R.id.buttonEditkajian);
        buttonBackKajian = (Button) findViewById(R.id.buttonBackkajian);
        buttonChooseTempat = (Button) findViewById(R.id.buttonChooseTempat);
        buttonChoosePoster = (Button) findViewById(R.id.buttonChoosePoster);

        id = getIntent().getStringExtra("id");
        Toast.makeText(this, id, Toast.LENGTH_SHORT).show();
        namakajian = getIntent().getStringExtra("namakajian");
        namapemateri = getIntent().getStringExtra("namapemateri");
        namatempat = getIntent().getStringExtra("namatempat");
        lat = getIntent().getStringExtra("lat");
        lng = getIntent().getStringExtra("lng");
        alamat = getIntent().getStringExtra("alamat");
        kelurahan = getIntent().getStringExtra("kelurahan");
        kecamatan = getIntent().getStringExtra("kecamatan");
        tanggalkajian = getIntent().getStringExtra("tanggalkajian");
        waktumulai = getIntent().getStringExtra("waktumulai");
        waktuselesai = getIntent().getStringExtra("waktuselesai");
        kuotapeserta = getIntent().getStringExtra("kuota");
        statuspeserta = getIntent().getStringExtra("statuspeserta");
        statusberbayar = getIntent().getStringExtra("statusberbayar");
        pengelola = getIntent().getStringExtra("pengelola");
        kontakpengelola = getIntent().getStringExtra("kontakpengelola");
        informasi = getIntent().getStringExtra("informasi");
        gambartempat = getIntent().getStringExtra("gambartempat");
        gambarposter = getIntent().getStringExtra("gambarposter");

        editTextNamakajian.setText(namakajian);
        editTextNamatempat.setText(namatempat);
        editTextNamapemateri.setText(namapemateri);
        editTextAlamat.setText(alamat);
        editTextKelurahan.setText(kelurahan);
        editTextKecamatan.setText(kecamatan);
        editTextTanggalkajian.setText(tanggalkajian);
        editTextWaktumulai.setText(waktumulai);
        editTextWaktuselesai.setText(waktuselesai);
        editTextKuotapeserta.setText(kuotapeserta);
        editTextStatuspeserta.setText(statuspeserta);
        editTextStatusberbayar.setText(statusberbayar);
        editTextPengelola.setText(pengelola);
        editTextKontakpengelola.setText(kontakpengelola);
        editTextInformasi.setText(informasi);
        InfoLoc.setText(lat+", "+lng);

        buttonChooseTempat.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showFileChooser();
            }
        });

        buttonChoosePoster.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showFileChooser2();
            }
        });

        SharedPreferences pref = getSharedPreferences("SP_USER",MODE_PRIVATE);
        TextView author = (TextView)findViewById(R.id.author);
        username = pref.getString("username",null);
        author.setText("Author : "+username);

        String gbrPoster = URL_GMB+gambarposter;
        String gbrTempat = URL_GMB+gambartempat;
        // glide fungsi on
//            Log.i("gambar",gbrBncana);
//            Glide.with(NewDetailActivity.this).load(gbrBncana).into(ivGambar);
        Log.e("dancok", gbrPoster);
        Log.e("dancok", gbrTempat);
        Glide.with(this)
                .load(gbrPoster)
                .into(imageView2);

        Glide.with(this)
                .load(gbrTempat)
                .into(imageView);

        editTextTanggalkajian.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Calendar cal = Calendar.getInstance();
                int year = cal.get(Calendar.YEAR);
                int month = cal.get(Calendar.MONTH);
                int day = cal.get(Calendar.DAY_OF_MONTH);

                DatePickerDialog dialog = new DatePickerDialog(
                        EditKajianActivity.this,
                        android.R.style.Theme_Holo_Light_Dialog_MinWidth,
                        mDateSetListener1,
                        year,month,day);
                dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
                dialog.show();
            }
        });

        mDateSetListener1 = new DatePickerDialog.OnDateSetListener() {
            @Override
            public void onDateSet(DatePicker datePicker, int year, int month, int day) {
                month = month + 1;
                day = day;
                String monthConverted = ""+month;
                String dayConverted = ""+day;
                if(month<10 && day <10){
                    monthConverted = "0"+monthConverted;
                    dayConverted = "0"+dayConverted;
                }
                Log.d("Isinya ", "onDateSet: dd/mm/yyy: " + dayConverted + "/" + monthConverted + "/" + year);

                String date = dayConverted + "/" + monthConverted + "/" + year;
                editTextTanggalkajian.setText(date);

                String sendParameter1 = year + "-" + monthConverted + "-" + dayConverted;
                Parameter1 = sendParameter1;
                Log.e("parameter",sendParameter1);
            }
        };

        buttonAddKajian.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                BitmapDrawable drawable = (BitmapDrawable) imageView.getDrawable();
                Bitmap bit = drawable.getBitmap();
                String gambar = ImageUtils.BitMapToString(bit);

                BitmapDrawable drawable2 = (BitmapDrawable) imageView2.getDrawable();
                Bitmap bit2 = drawable2.getBitmap();
                String gambar2 = ImageUtils.BitMapToString(bit2);

                editKajian(id,
                        editTextNamakajian.getText().toString(),
                        editTextNamapemateri.getText().toString(),
                        editTextNamatempat.getText().toString(),
                        lat,
                        lng,
                        editTextAlamat.getText().toString(),
                        editTextKelurahan.getText().toString(),
                        editTextKecamatan.getText().toString(),
                        editTextTanggalkajian.getText().toString(),
                        editTextWaktumulai.getText().toString(),
                        editTextWaktuselesai.getText().toString(),
                        editTextKuotapeserta.getText().toString(),
                        editTextStatuspeserta.getText().toString(),
                        editTextStatusberbayar.getText().toString(),
                        editTextPengelola.getText().toString(),
                        editTextKontakpengelola.getText().toString(),
                        editTextInformasi.getText().toString(),
                        gambar,
                        gambar2
                        );
            }
        });


    }

    private void editKajian(
            String idKajian,
            String namakajian,
            String namapemateri,
            String namatempat,
            String latitud,
            String longtit,
            String alamat,
            String kelurah,
            String kecamat,
            String tanggal,
            String waktumu,
            String waktuse,
            String kuotape,
            String statusp,
            String statusb,
            String pengelo,
            String kontakp,
            String informa,
            String gambarp,
            String gambart
    ){
        final ProgressDialog dialog = new ProgressDialog(this);
        dialog.setMessage("Mengedit kajian ..");
        dialog.show();

        MultipartBody.Part imgTempat, imgPoster;

        RequestBody dataIdKajian = RequestBody.create(MediaType.parse("text/plain"), idKajian);
        RequestBody dataNamaKajian = RequestBody.create(MediaType.parse("text/plain"), namakajian);
        RequestBody dataNamaPemateri = RequestBody.create(MediaType.parse("text/plain"), namapemateri);
        RequestBody dataNamaTempat = RequestBody.create(MediaType.parse("text/plain"), namatempat);
        RequestBody dataLat = RequestBody.create(MediaType.parse("text/plain"), latitud);
        RequestBody dataLng = RequestBody.create(MediaType.parse("text/plain"), longtit);
        RequestBody dataAlamat = RequestBody.create(MediaType.parse("text/plain"), alamat);
        RequestBody dataKelurahan = RequestBody.create(MediaType.parse("text/plain"), kelurah);
        RequestBody dataKecamatan = RequestBody.create(MediaType.parse("text/plain"), kecamat);
        RequestBody dataTanggal = RequestBody.create(MediaType.parse("text/plain"), tanggal);
        RequestBody dataWaktuMulai = RequestBody.create(MediaType.parse("text/plain"), waktumu);
        RequestBody dataWaktuSelesai = RequestBody.create(MediaType.parse("text/plain"), waktuse);
        RequestBody dataKuotaPeserta = RequestBody.create(MediaType.parse("text/plain"), kuotape);
        RequestBody dataStatusPeserta = RequestBody.create(MediaType.parse("text/plain"), statusp);
        RequestBody dataStatusBerbayar = RequestBody.create(MediaType.parse("text/plain"), statusb);
        RequestBody dataPengelola = RequestBody.create(MediaType.parse("text/plain"), pengelo);
        RequestBody dataCpPengelola = RequestBody.create(MediaType.parse("text/plain"), kontakp);
        RequestBody dataInformasi = RequestBody.create(MediaType.parse("text/plain"), informa);
        RequestBody dataUsername = RequestBody.create(MediaType.parse("text/plain"), username);

        if (imgTempatPath != null) {
            File fileImgTempat = new File(imgTempatPath);
            try {
                compressImgTempat = new Compressor(this).compressToFile(fileImgTempat);
            } catch (IOException e) {
                e.printStackTrace();
            }
            RequestBody fileTempatPath = RequestBody.create(MediaType.parse("image/*"), compressImgTempat);
            imgTempat = MultipartBody.Part.createFormData("profile_photo", fileImgTempat.getName(), fileTempatPath);
        } else {
            imgTempat = null;
        }
        if (imgPosterPath != null) {
            File filePoster = new File(imgPosterPath);
            try {
                compressImgPoster = new Compressor(this).compressToFile(filePoster);
            } catch (IOException e) {
                e.printStackTrace();
            }
            RequestBody filePosterPath = RequestBody.create(MediaType.parse("image/*"), compressImgPoster);
            imgPoster = MultipartBody.Part.createFormData("ktp_photo", filePoster.getName(), filePosterPath);
        } else {
            imgPoster = null;
        }


        ApiService apiService = ApiClient.getClient().create(ApiService.class);
        Call<EditResponse> call = apiService.editKajian(
                dataIdKajian,
                dataUsername,
                dataNamaKajian,
                dataNamaPemateri,
                dataNamaTempat,
                dataLat,
                dataLng,
                dataAlamat,
                dataKelurahan,
                dataKecamatan,
                dataTanggal,
                dataWaktuMulai,
                dataWaktuSelesai,
                dataKuotaPeserta,
                dataStatusPeserta,
                dataStatusBerbayar,
                dataPengelola,
                dataCpPengelola,
                dataInformasi,
                imgPoster,
                imgTempat
        );
        call.enqueue(new Callback<EditResponse>() {
            @Override
            public void onResponse(Call<EditResponse> call, Response<EditResponse> response) {
                dialog.dismiss();
                if (response.code() == 200){
                    String message = response.body().getSuccess();
                    Toast.makeText(EditKajianActivity.this, message, Toast.LENGTH_SHORT).show();
                    startActivity(new Intent(EditKajianActivity.this, MyKajianActivity.class));
                    finish();
                }

            }

            @Override
            public void onFailure(Call<EditResponse> call, Throwable t) {
                dialog.dismiss();
                Toast.makeText(EditKajianActivity.this, t.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });


    }
    private void showFileChooser() {
        Intent intent = new Intent();
        intent.setType("image/*");
        intent.setAction(Intent.ACTION_GET_CONTENT);
        startActivityForResult(Intent.createChooser(intent, "Select Picture"), PICK_IMAGE_REQUEST);
    }

    private void showFileChooser2() {
        Intent intent = new Intent();
        intent.setType("image/*");
        intent.setAction(Intent.ACTION_GET_CONTENT);
        startActivityForResult(Intent.createChooser(intent, "Select Picture"), PICK_IMAGE_REQUEST2);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
//        Uri selectedImageUri = null ;
        int aa = requestCode;
        Log.e("req", String.valueOf(aa));
        if (requestCode == PICK_IMAGE_REQUEST) {
            if (resultCode == RESULT_OK && data != null && data.getData() != null) {
                imgTempatPath = data.getData().getPath();

//                try {
//
//                    //mengambil fambar dari Gallery
//                    bitmap = MediaStore.Images.Media.getBitmap(getContentResolver(), filePath);
//                    imageView.setImageBitmap(getResizedBitmap(bitmap, 512));
//                    click = 1;
//
//
//                } catch (IOException e) {
//                    e.printStackTrace();
//                }
            } else if (resultCode == RESULT_CANCELED) {
                Log.e("gambar", " ada error digambar");
            }
        }

        if (requestCode == PICK_IMAGE_REQUEST2) {
            if (resultCode == RESULT_OK && data != null && data.getData() != null) {
                 imgPosterPath = data.getData().getPath();

//                try {
//
//                    //mengambil fambar dari Gallery
//                    bitmap2 = MediaStore.Images.Media.getBitmap(getContentResolver(), filePath);
//                    imageView2.setImageBitmap(getResizedBitmap(bitmap2, 512));
//                    click2 = 1;
//
//
//                } catch (IOException e) {
//                    e.printStackTrace();
//                }
            } else if (resultCode == RESULT_CANCELED) {
                Log.e("gambar", "ada error di gambar");

            }
        }
    }

//    public Bitmap getResizedBitmap(Bitmap image, int maxSize) {
//        int width = image.getWidth();
//        int height = image.getHeight();
//
//        float bitmapRatio = (float) width / (float) height;
//        if (bitmapRatio > 1) {
//            width = maxSize;
//            height = (int) (width / bitmapRatio);
//        } else {
//            height = maxSize;
//            width = (int) (height * bitmapRatio);
//        }
//        return Bitmap.createScaledBitmap(image, width, height, true);
//    }
}
