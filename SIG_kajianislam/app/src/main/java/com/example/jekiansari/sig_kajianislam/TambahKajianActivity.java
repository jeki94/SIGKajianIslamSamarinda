package com.example.jekiansari.sig_kajianislam;

import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.Color;
import android.graphics.drawable.BitmapDrawable;
import android.graphics.drawable.ColorDrawable;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.provider.MediaStore;
import android.support.v7.app.AppCompatActivity;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.example.jekiansari.sig_kajianislam.Adapter.Kelurahan;
import com.example.jekiansari.sig_kajianislam.handler.ImageUtils;
import com.example.jekiansari.sig_kajianislam.handler.JSONParser;
import com.example.jekiansari.sig_kajianislam.handler.RequestHandler;
import com.example.jekiansari.sig_kajianislam.services.Config;

import org.json.JSONArray;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.HashMap;

import static com.example.jekiansari.sig_kajianislam.services.Config.URL_ADD_KAJIAN;

public class TambahKajianActivity extends AppCompatActivity implements View.OnClickListener {
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


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tambahkajian);
//        getdata();
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
        buttonAddKajian = (Button) findViewById(R.id.buttonAddkajian);
        buttonBackKajian = (Button) findViewById(R.id.buttonBackkajian);
        buttonChooseTempat = (Button) findViewById(R.id.buttonChooseTempat);
        buttonChoosePoster = (Button) findViewById(R.id.buttonChoosePoster);


        //Setting listeners to button
        buttonAddKajian.setOnClickListener(this);
        buttonBackKajian.setOnClickListener(this);

        Intent addPos = getIntent();
        String pos = addPos.getStringExtra("Value");
        InfoLoc.setText(pos);
// date
        editTextTanggalkajian.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Calendar cal = Calendar.getInstance();
                int year = cal.get(Calendar.YEAR);
                int month = cal.get(Calendar.MONTH);
                int day = cal.get(Calendar.DAY_OF_MONTH);

                DatePickerDialog dialog = new DatePickerDialog(
                        TambahKajianActivity.this,
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



        //spinner dropdown
//        getKelurahanList();
//        ArrayAdapter<Kelurahan> adapter = new ArrayAdapter<Kelurahan>(TambahUserActivity.this.getApplicationContext(),
//                R.layout.spinner_item,kelurahanArrayList);
//        spinKecamatan.setAdapter(adapter);
//        Log.e("data",adapter.toString());
//        Log.e("data",getKelurahanList().toString());
//        Log.e("lll",kelurahanArrayList.toString());

//        ArrayAdapter<CharSequence> adapter2 = ArrayAdapter.createFromResource(this, R.array.bencana, android.R.layout.simple_spinner_item);
//        adapter2.setDropDownViewResource(android.R.layout.simple_spinner_item);
//        spinKelurahan.setAdapter(adapter2);

        // milih gambar
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
        String username = pref.getString("username",null);
        author.setText("Author : "+username);
        Log.e("username",username);
    }

//--------------------------------------------------    picture 1 mulainya ----------------------------------------

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
                Uri filePath = data.getData();

                try {

                    //mengambil fambar dari Gallery
                    bitmap = MediaStore.Images.Media.getBitmap(getContentResolver(), filePath);
                    imageView.setImageBitmap(getResizedBitmap(bitmap, 512));
                    click = 1;


                } catch (IOException e) {
                    e.printStackTrace();
                }
            } else if (resultCode == RESULT_CANCELED) {
                Log.e("gambar", " ada error digambar");
            }
        }

        if (requestCode == PICK_IMAGE_REQUEST2) {
            if (resultCode == RESULT_OK && data != null && data.getData() != null) {
                Uri filePath = data.getData();

                try {

                    //mengambil fambar dari Gallery
                    bitmap2 = MediaStore.Images.Media.getBitmap(getContentResolver(), filePath);
                    imageView2.setImageBitmap(getResizedBitmap(bitmap2, 512));
                    click2 = 1;


                } catch (IOException e) {
                    e.printStackTrace();
                }
            } else if (resultCode == RESULT_CANCELED) {
                Log.e("gambar", "ada error di gambar");
            }
        }

//        if (requestCode == PICK_IMAGE_REQUEST && resultCode == RESULT_OK && data != null && data.getData() != null) {
//            Uri filePath = data.getData();
//
//            try {
//
//                //mengambil fambar dari Gallery
//                bitmap = MediaStore.Images.Media.getBitmap(getContentResolver(), filePath);
//                imageView.setImageBitmap(getResizedBitmap(bitmap, 512));
//                click = 1;
//
//
//
//            } catch (IOException e) {
//                e.printStackTrace();
//            }
//        }

    }

    public String getPath(Uri uri) {
        Cursor cursor = getApplication().getContentResolver().query(uri, null, null, null, null);
        cursor.moveToFirst();
        String document_id = cursor.getString(0);
        document_id = document_id.substring(document_id.lastIndexOf(":") + 1);
        cursor.close();

        cursor = getApplication().getContentResolver().query(
                MediaStore.Images.Media.EXTERNAL_CONTENT_URI, null,
                MediaStore.Images.Media._ID + " = ? ", new String[]{document_id}, null
        );
        cursor.moveToFirst();
        String path = cursor.getString(cursor.getColumnIndex(MediaStore.Images.Media.DATA));
        cursor.close();
        return path;
    }

    // fungsi resize image
    public Bitmap getResizedBitmap(Bitmap image, int maxSize) {
        int width = image.getWidth();
        int height = image.getHeight();

        float bitmapRatio = (float) width / (float) height;
        if (bitmapRatio > 1) {
            width = maxSize;
            height = (int) (width / bitmapRatio);
        } else {
            height = maxSize;
            width = (int) (height * bitmapRatio);
        }
        return Bitmap.createScaledBitmap(image, width, height, true);
    }
    //end kalo err picture


// ----------------------------------------------   end picture satu 1 -------------------------


    //Dibawah ini merupakan perintah untuk Menambahkan user (CREATE)
    private void addKajian() {

        final String namakajian = editTextNamakajian.getText().toString().trim();
        final String namapemateri = editTextNamapemateri.getText().toString().trim();
        final String alamat = editTextAlamat.getText().toString().trim();
        final String namatempat = editTextNamatempat.getText().toString().trim();
        final String kelurahan = editTextKelurahan.getText().toString().trim();
        final String kecamatan = editTextKecamatan.getText().toString().trim();
        final String tanggalkajian = editTextTanggalkajian.getText().toString().trim();
        final String waktumulai = editTextWaktumulai.getText().toString().trim();
        final String waktuselesai = editTextWaktuselesai.getText().toString().trim();
        final String kuotapeserta = editTextKuotapeserta.getText().toString().trim();
        final String statuspeserta = editTextStatuspeserta.getText().toString().trim();
        final String statusberbayar = editTextStatusberbayar.getText().toString().trim();
        final String pengelola = editTextPengelola.getText().toString().trim();
        final String kontakpengelola = editTextKontakpengelola.getText().toString().trim();
        final String informasi = editTextInformasi.getText().toString().trim();


        class addKajian extends AsyncTask<Void, Void, String> {

            ProgressDialog loading;

            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(TambahKajianActivity.this,"Menambahkan...","Tunggu...",false,false);

            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();

//                Intent i = new Intent(TambahKajianActivity.this,MainUserActivity.class);
                Toast.makeText(TambahKajianActivity.this,"Berhasil Menambah Kajian",Toast.LENGTH_LONG).show();
//                startActivity(i);
//                Log.e("sempak",s);
            }

            @Override
            protected String doInBackground(Void... v) {
                //err map encde
//                ByteArrayOutputStream baos = new ByteArrayOutputStream();
//                bitmap.compress(Bitmap.CompressFormat.JPEG, 100, baos);
//                byte[] imageBytes = baos.toByteArray();
//                final String imageString = Base64.encodeToString(imageBytes, Base64.DEFAULT);
//
//                ByteArrayOutputStream baos2 = new ByteArrayOutputStream();
//                bitmap2.compress(Bitmap.CompressFormat.JPEG, 100, baos2);
//                byte[] imageBytes2 = baos2.toByteArray();
//                final String imageString2 = Base64.encodeToString(imageBytes2, Base64.DEFAULT);

                BitmapDrawable drawable = (BitmapDrawable) imageView.getDrawable();
                Bitmap bit = drawable.getBitmap();
                String imageString = ImageUtils.BitMapToString(bit);

                BitmapDrawable drawable2 = (BitmapDrawable) imageView2.getDrawable();
                Bitmap bit2 = drawable2.getBitmap();
                String imageString2 = ImageUtils.BitMapToString(bit2);
// end nyoba


                SharedPreferences pref = getSharedPreferences("SP_USER",MODE_PRIVATE);
                String usernameUP = pref.getString("username",null);
                Log.e("username",usernameUP);


                String latlong = InfoLoc.getText().toString();
                String[] parts = latlong.split(",");
                String regex = "[^0-9-.]+";

                String lat = parts[0].replaceAll(regex,"");
                String lng = parts[1].replaceAll(regex,"");

                HashMap<String, String> params = new HashMap<>();

                params.put(Config.KEY_NAMA_KAJIAN, namakajian);
                Log.d("namakajian", namakajian);
                params.put(Config.KEY_NAMA_PEMATERI, namapemateri);
                Log.d("namapemateri", namapemateri);
                params.put(Config.KEY_NAMA_TEMPAT, namatempat);
                Log.d("namatempat", namatempat);
                params.put(Config.KEY_LAT_KAJIAN, lat);
                Log.d("latitude", lat);
                params.put(Config.KEY_LNG_KAJIAN, lng);
                Log.d("longtitude", lng);
                params.put(Config.KEY_ALAMAT_KAJIAN, alamat);
                Log.d("alamat", alamat);
                params.put(Config.KEY_KELURAHAN_KAJIAN, kelurahan);
                Log.d("kelurahan", kelurahan);
                params.put(Config.KEY_KECAMATAN_KAJIAN, kecamatan);
                Log.d("kecamatan", kecamatan);
                params.put(Config.KEY_TANGGAL_KAJIAN, Parameter1);
                Log.d("tanggalkajian", Parameter1);
                params.put(Config.KEY_WAKTUMULAI_KAJIAN, waktumulai);
                Log.d("waktumulai", waktumulai);
                params.put(Config.KEY_WAKTUSELESAI_KAJIAN, waktuselesai);
                Log.d("waktuselesai", waktuselesai);
                params.put(Config.KEY_KUOTAPESERTA_KAJIAN, kuotapeserta);
                Log.d("kuotapeserta", kuotapeserta);
                params.put(Config.KEY_STATUSPESERTA_KAJIAN, statuspeserta);
                Log.d("statuspeserta", statuspeserta);
                params.put(Config.KEY_STATUSBERBAYAR_KAJIAN, statusberbayar);
                Log.d("statusberbayar", statusberbayar);
                params.put(Config.KEY_PENGELOLA_KAJIAN, pengelola);
                Log.d("pengelola", pengelola);
                params.put(Config.KEY_KONTAKPENGELOLA_KAJIAN, kontakpengelola);
                Log.d("kontakpengelola", kontakpengelola);
                params.put(Config.KEY_INFORMASI_KAJIAN, informasi);
                Log.d("informasi", informasi);
                params.put(Config.KEY_USERNAME_KAJIAN,usernameUP);
                Log.d("username",usernameUP);
                params.put(Config.KEY_GAMBARTEMPAT_KAJIAN, imageString);
                Log.d("gambartempat", imageString);
                params.put(Config.KEY_GAMBARPOSTER_KAJIAN, imageString2);
                Log.d("gambarposter", imageString2);


                //lama
                RequestHandler rh = new RequestHandler();
                String res = rh.sendPostRequest(URL_ADD_KAJIAN, params);
                return res;
            }
        }

        addKajian ak = new addKajian();
        ak.execute();
    }

    @Override
    public void onClick(View v) {
        final String namakajian = editTextNamakajian.getText().toString().trim();
        final String namapemateri = editTextNamapemateri.getText().toString().trim();
        final String alamat = editTextAlamat.getText().toString().trim();
        final String kelurahan = editTextKelurahan.getText().toString().trim();
        final String kecamatan = editTextKecamatan.getText().toString().trim();
        final String tanggalkajian = editTextTanggalkajian.getText().toString().trim();
        final String waktumulai= editTextWaktumulai.getText().toString().trim();
        final String waktuselesai = editTextWaktuselesai.getText().toString().trim();
        final String kuotapeserta = editTextKuotapeserta.getText().toString().trim();
        final String statuspeserta = editTextStatuspeserta.getText().toString().trim();
        final String statusberbayar = editTextStatusberbayar.getText().toString().trim();
        final String pengelola = editTextPengelola.getText().toString().trim();
        final String kontakpengelola = editTextKontakpengelola.getText().toString().trim();
        final String informasi = editTextInformasi.getText().toString().trim();
        final String lokasi = editTextNamatempat.getText().toString().trim();
        if(v == buttonAddKajian){
            if (namakajian.isEmpty()) {
                Toast.makeText(TambahKajianActivity.this, "Harap isi Kolom Nama Kajian", Toast.LENGTH_LONG).show();
            }else if (namapemateri.isEmpty()) {
                Toast.makeText(TambahKajianActivity.this, "Harap isi Kolom Nama Pemateri", Toast.LENGTH_LONG).show();
            }else if (lokasi.isEmpty()){
                Toast.makeText(this,"Harap Isi Nama Tempat",Toast.LENGTH_LONG).show();
            }else if (alamat.isEmpty()) {
                Toast.makeText(TambahKajianActivity.this, "Harap isi Kolom Alamat", Toast.LENGTH_LONG).show();
            }else if (kelurahan.isEmpty()) {
                Toast.makeText(TambahKajianActivity.this, "Harap isi Kolom Kelurahan", Toast.LENGTH_LONG).show();
            }else if (kecamatan.isEmpty()) {
                Toast.makeText(TambahKajianActivity.this, "Harap isi Kolom Kecamatan", Toast.LENGTH_LONG).show();
            }else if (tanggalkajian.isEmpty()) {
                Toast.makeText(TambahKajianActivity.this, "Harap isi Kolom Tanggal Kajian", Toast.LENGTH_LONG).show();
            }else if (waktumulai.isEmpty()) {
                Toast.makeText(TambahKajianActivity.this, "Harap isi Kolom Waktu Mulai", Toast.LENGTH_LONG).show();
            }else if (waktuselesai.isEmpty()) {
                Toast.makeText(TambahKajianActivity.this, "Harap isi Kolom Waktu Selesai", Toast.LENGTH_LONG).show();
            }else if (kuotapeserta.isEmpty()) {
                Toast.makeText(TambahKajianActivity.this, "Harap isi Kolom Kuota Peserta", Toast.LENGTH_LONG).show();
            }else if (statuspeserta.isEmpty()) {
                Toast.makeText(TambahKajianActivity.this, "Harap isi Kolom Status Peserta", Toast.LENGTH_LONG).show();
            }else if (statusberbayar.isEmpty()) {
                Toast.makeText(TambahKajianActivity.this, "Harap isi Kolom Status Berbayar", Toast.LENGTH_LONG).show();
            }else if (pengelola.isEmpty()) {
                Toast.makeText(TambahKajianActivity.this, "Harap isi Kolom Pengelola", Toast.LENGTH_LONG).show();
            }else if (kontakpengelola.isEmpty()) {
                Toast.makeText(TambahKajianActivity.this, "Harap isi Kolom Kontak Pengelola", Toast.LENGTH_LONG).show();
            }else if (click == 0){
                Toast.makeText(this,"Harap Pilih Gambar ",Toast.LENGTH_LONG).show();
            }else if (click2 == 0){
                Toast.makeText(this,"Harap Pilih Gambar ",Toast.LENGTH_LONG).show();
            }
            else {
                addKajian();
                Toast.makeText(this,"Mohon tunggu sedang memasukkan data",Toast.LENGTH_LONG).show();
                Intent intent = new Intent(this, MainUserActivity.class);
                startActivity(intent); // nanti
            }
        }
//            }
//
////            Intent intent = new Intent(TambahUserActivity.this,MapsPublicActivity.class);
////            Toast.makeText(TambahUserActivity.this,"Berhasil Membuat",Toast.LENGTH_LONG).show();
////            startActivity(intent);
//            // fungsi simpan
//        }

        if(v == buttonBackKajian){
            finish();
            Intent intent = new Intent(this, MapsPublicActivity.class);
            this.startActivity(intent);
        }
    }
}
