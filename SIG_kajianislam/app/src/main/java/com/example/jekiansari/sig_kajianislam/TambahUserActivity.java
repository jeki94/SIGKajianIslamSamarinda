package com.example.jekiansari.sig_kajianislam;

import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.provider.MediaStore;
import android.support.v7.app.AppCompatActivity;
import android.util.Base64;
import android.util.JsonReader;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.Toast;

import com.example.jekiansari.sig_kajianislam.Adapter.Kelurahan;
import com.example.jekiansari.sig_kajianislam.handler.HttpHandler;
import com.example.jekiansari.sig_kajianislam.handler.JSONParser;
import com.example.jekiansari.sig_kajianislam.handler.RequestHandler;
import com.example.jekiansari.sig_kajianislam.services.Config;

import org.apache.http.NameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.HashMap;
import java.util.List;

import static com.example.jekiansari.sig_kajianislam.services.Config.TAG_SUCCESS;
import static com.example.jekiansari.sig_kajianislam.services.Config.URL_ADD_USER;
import static com.example.jekiansari.sig_kajianislam.services.Config.URL_SERVER;

public class TambahUserActivity extends AppCompatActivity implements View.OnClickListener {
    //Dibawah ini merupakan perintah untuk mendefinikan View
    private EditText editTextUsername;
    private EditText editTextPassword;
    private EditText editTextNama;
    private EditText editTextTanggallahir;
    private EditText editTextTempatlahir;
    private EditText editTextAlamat;
    private EditText editTextKelurahan;
    private EditText editTextKecamatan;
    private EditText editTextEmail;
    private EditText editTextSosialmedia;
    private EditText editTextKTP;
    private EditText editTextTelp;


    private DatePickerDialog.OnDateSetListener mDateSetListener1;
    String Parameter1="";

    private Button buttonAdd;
    private Button buttonBack;
    Button buttonChoose, buttonChoose2;
    int click = 0;
    int click2 = 0;
    Spinner spinKecamatan, spinKelurahan;
    private ProgressDialog pDialog;

    ArrayList<Kelurahan> kelurahanArrayList = new ArrayList<Kelurahan>();
    ArrayList<HashMap<String, String>> AarayList;

    ImageView imageView, imageView2;
    Bitmap bitmap;
    int PICK_IMAGE_REQUEST = 1;
    int PICK_IMAGE_REQUEST2 = 2;

    JSONParser jParser = new JSONParser();
    JSONArray daftarKelurahan = null;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tambahuser);
//        getdata();
        editTextUsername = (EditText) findViewById(R.id.username);
        editTextPassword = (EditText) findViewById(R.id.pass);
        editTextNama = (EditText) findViewById(R.id.namalengkap);
        editTextTanggallahir = (EditText) findViewById(R.id.tanggallahir);
        editTextTempatlahir = (EditText) findViewById(R.id.tempatlahir);
        editTextAlamat = (EditText) findViewById(R.id.alamatuser);
        editTextKelurahan = (EditText) findViewById(R.id.kelurahanuser);
        editTextKecamatan = (EditText) findViewById(R.id.kecamatanuser);
        editTextEmail = (EditText) findViewById(R.id.email);
        editTextSosialmedia = (EditText) findViewById(R.id.sosialmedia);
        editTextKTP = (EditText) findViewById(R.id.noktp);
        editTextTelp = (EditText) findViewById(R.id.nomortelepon);


        imageView = (ImageView) findViewById(R.id.imageView);
//        imageView2 = (ImageView) findViewById(R.id.imageView2);
        buttonAdd = (Button) findViewById(R.id.buttonAdd);
        buttonBack = (Button) findViewById(R.id.buttonBack);
        buttonChoose = (Button) findViewById(R.id.buttonChoose);
//        buttonChoose2 = (Button) findViewById(R.id.buttonChoose2);


        //Setting listeners to button
        buttonAdd.setOnClickListener(this);
        buttonBack.setOnClickListener(this);
// date
        editTextTanggallahir.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Calendar cal = Calendar.getInstance();
                int year = cal.get(Calendar.YEAR);
                int month = cal.get(Calendar.MONTH);
                int day = cal.get(Calendar.DAY_OF_MONTH);

                DatePickerDialog dialog = new DatePickerDialog(
                        TambahUserActivity.this,
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
                day = day + 1;
                String monthConverted = ""+month;
                String dayConverted = ""+day;
                if(month<10 && day <10){
                    monthConverted = "0"+monthConverted;
                    dayConverted = "0"+dayConverted;
                }
                Log.d("Isinya ", "onDateSet: dd/mm/yyy: " + dayConverted + "/" + monthConverted + "/" + year);

                String date = dayConverted + "/" + monthConverted + "/" + year;
                editTextTanggallahir.setText(date);

                String sendParameter1 = year + "-" + dayConverted + "-" + monthConverted;
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
        buttonChoose.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showFileChooser();
            }
        });

//        buttonChoose2.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                showFileChooser2();
//            }
//        });


    }

//--------------------------------------------------    picture 1 mulainya ----------------------------------------

    private void showFileChooser() {
        Intent intent = new Intent();
        intent.setType("image/*");
        intent.setAction(Intent.ACTION_GET_CONTENT);
        startActivityForResult(Intent.createChooser(intent, "Select Picture"), PICK_IMAGE_REQUEST);
    }

//    private void showFileChooser2() {
//        Intent intent = new Intent();
//        intent.setType("image/*");
//        intent.setAction(Intent.ACTION_GET_CONTENT);
//        startActivityForResult(Intent.createChooser(intent, "Select Picture"), PICK_IMAGE_REQUEST2);
//    }

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
                    bitmap = MediaStore.Images.Media.getBitmap(getContentResolver(), filePath);
                    imageView2.setImageBitmap(getResizedBitmap(bitmap, 512));
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
    private void addUser() {

        final String username = editTextUsername.getText().toString().trim();
        final String pass = editTextPassword.getText().toString().trim();
        final String nama = editTextNama.getText().toString().trim();
        final String tempatlahir = editTextTempatlahir.getText().toString().trim();
        final String tanggallahir = editTextTanggallahir.getText().toString().trim();
        final String alamat = editTextAlamat.getText().toString().trim();
        final String kelurahan = editTextKelurahan.getText().toString().trim();
        final String kecamatan = editTextKecamatan.getText().toString().trim();
        final String email = editTextEmail.getText().toString().trim();
        final String sosialmedia = editTextSosialmedia.getText().toString().trim();
        final String noKTP = editTextKTP.getText().toString().trim();
        final String telp = editTextTelp.getText().toString().trim();


        class addUser extends AsyncTask<Void, Void, String> {

            ProgressDialog loading;

            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(TambahUserActivity.this,"Menambahkan...","Tunggu...",false,false);

            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                Toast.makeText(TambahUserActivity.this,"Berhasil Menambah Anggota",Toast.LENGTH_LONG).show();
//                Log.e("sempak",s);
            }

            @Override
            protected String doInBackground(Void... args) {
                //naru
                ByteArrayOutputStream baos = new ByteArrayOutputStream();
                bitmap.compress(Bitmap.CompressFormat.JPEG, 100, baos);
                byte[] imageBytes = baos.toByteArray();
                final String imageString = Base64.encodeToString(imageBytes, Base64.DEFAULT);

//                ByteArrayOutputStream baos2 = new ByteArrayOutputStream();
//                bitmap.compress(Bitmap.CompressFormat.JPEG, 100, baos);
//                byte[] imageBytes2 = baos2.toByteArray();
//                final String imageString2 = Base64.encodeToString(imageBytes2, Base64.DEFAULT);

                HashMap<String, String> params = new HashMap<>();

                params.put(Config.KEY_USERNAME, username);
                Log.d("username", username);
                params.put(Config.KEY_PASSWORD, pass);
                Log.d("password", pass);
                params.put(Config.KEY_NAMA, nama);
                Log.d("nama lengkap", nama);
                params.put(Config.KEY_TEMPATLAHIR, tempatlahir);
                Log.d("tempatlahir", tempatlahir);
                params.put(Config.KEY_TANGGALLAHIR, Parameter1);
                Log.d("tanggallahir", Parameter1);
                params.put(Config.KEY_ALAMAT, alamat);
                Log.d("alamat", alamat);
                params.put(Config.KEY_KELURAHAN, kelurahan);
                Log.d("namakelurahan", kelurahan);
                params.put(Config.KEY_KECAMATAN, kecamatan);
                Log.d("namakecamatan", kecamatan);
                params.put(Config.KEY_EMAIL, email);
                Log.d("emaill", email);
                params.put(Config.KEY_SOSIALMEDIA, sosialmedia);
                Log.d("sosialmedia", sosialmedia);
                params.put(Config.KEY_TELP, telp.toString().trim());
                Log.d("no_telepon", telp);
                params.put(Config.KEY_NO_IDEN, noKTP.toString().trim());
                Log.d("noktp", noKTP);
                params.put(Config.KEY_FOTOKTP, imageString);
                Log.d("fotoktp", imageString);

                //lama
                RequestHandler rh = new RequestHandler();
                String res = rh.sendPostRequest(URL_ADD_USER, params);
                return res;
            }
        }

        addUser au = new addUser();
        au.execute();
    }

    @Override
    public void onClick(View v) {
        final String username = editTextUsername.getText().toString().trim();
        final String pass = editTextPassword.getText().toString().trim();
        final String nama = editTextNama.getText().toString().trim();
        final String tempatlahir = editTextTempatlahir.getText().toString().trim();
        final String tanggallahir = editTextTanggallahir.getText().toString().trim();
        final String alamat = editTextAlamat.getText().toString().trim();
        final String kelurahan = editTextKelurahan.getText().toString().trim();
        final String kecamatan = editTextKecamatan.getText().toString().trim();
        final String email = editTextEmail.getText().toString().trim();
        final String sosialmedia = editTextSosialmedia.getText().toString().trim();
        final String noKTP = editTextKTP.getText().toString().trim();
        final String telp = editTextTelp.getText().toString().trim();
        if (v == buttonAdd) {
            //belum dapat buat response
            if (username.isEmpty()) {
                Toast.makeText(TambahUserActivity.this, "Harap isi Kolom Username", Toast.LENGTH_LONG).show();
            } else if (pass.isEmpty()) {
                Toast.makeText(TambahUserActivity.this, "Harap isi Kolom Password", Toast.LENGTH_LONG).show();
            } else if (nama.isEmpty()) {
                Toast.makeText(TambahUserActivity.this, "Harap isi Kolom Nama", Toast.LENGTH_LONG).show();
            } else if (tempatlahir.isEmpty()) {
                Toast.makeText(TambahUserActivity.this, "Harap isi Kolom Tempat Lahir", Toast.LENGTH_LONG).show();
            } else if (tanggallahir.isEmpty()) {
                Toast.makeText(TambahUserActivity.this, "Harap isi Kolom Tanggal Lahir", Toast.LENGTH_LONG).show();
            } else if (alamat.isEmpty()) {
                Toast.makeText(TambahUserActivity.this, "Harap isi Kolom Alamat", Toast.LENGTH_LONG).show();
            } else if (kelurahan.isEmpty()) {
                Toast.makeText(TambahUserActivity.this, "Harap isi Kolom Kelurahan", Toast.LENGTH_LONG).show();
            } else if (kecamatan.isEmpty()) {
                Toast.makeText(TambahUserActivity.this, "Harap isi Kolom Kecamatan", Toast.LENGTH_LONG).show();
            } else if (email.isEmpty()) {
                Toast.makeText(TambahUserActivity.this, "Harap isi Kolomm Email", Toast.LENGTH_LONG).show();
            } else if (sosialmedia.isEmpty()) {
                Toast.makeText(TambahUserActivity.this, "Harap isi Kolom Sosial Media", Toast.LENGTH_LONG).show();
            } else if (telp.isEmpty()) {
                Toast.makeText(TambahUserActivity.this, "Harap isi Kolom No.Telpon", Toast.LENGTH_LONG).show();
            } else if (noKTP.isEmpty()) {
                Toast.makeText(TambahUserActivity.this, "Harap isi Kolom No.Identitas", Toast.LENGTH_LONG).show();
            } else if (click == 0) {
                Toast.makeText(TambahUserActivity.this, "Harap Masukkan Foto KTP", Toast.LENGTH_LONG).show();
            } else {

                addUser();
//                Log.e("nama lengkap", nama );
//                Log.e("user", username );
//                Log.e("kelurahan", kelurahan );
//                Log.e("kecamatan", kecamatan );
//                Log.e("tanggal lahir", tanggallahir);
                finish();
                Intent intent = new Intent(TambahUserActivity.this, MainActivity.class);
                startActivity(intent);
            }

//            Intent intent = new Intent(TambahUserActivity.this,MapsPublicActivity.class);
//            Toast.makeText(TambahUserActivity.this,"Berhasil Membuat",Toast.LENGTH_LONG).show();
//            startActivity(intent);
            // fungsi simpan
        }

        if (v == buttonBack) {
            // startActivity(new Intent(this,TampilSemuaPgw.class));
//            AddsActivity.this.finish();
            finish();
            Intent intent = new Intent(TambahUserActivity.this, LoginActivity.class);
            startActivity(intent);
//            TambahUserActivity.this.startActivity(intent);
//            TambahUserActivity.this.isFinishing();

        }
    }
}


//    public String getKelurahanList() {
//
//        Kelurahan k = new Kelurahan();
//
//        List<NameValuePair> p = new ArrayList<NameValuePair>();
//        try {
//
//            JSONObject json = jParser.makeHttpRequest(URL_SERVER + "read_kelurahan.php", "POST", p);
//            int success = json.getInt(TAG_SUCCESS);
//            if (success == 1) {
//                daftarKelurahan = json.getJSONArray("kelurahan");
//                for (int i = 0; i < daftarKelurahan.length(); i++) {
//                    JSONObject c = daftarKelurahan.getJSONObject(i);
//                    k = new Kelurahan();
//                    k.setId_kelurahan(c.getString("id_kelurahan"));
//
//                    k.setNamakelurahan(c.getString("namakelurahan"));
//
//                    k.setId_kecamatan(c.getString("alamat_kampung"));
//
//                    kelurahanArrayList.add(k);
//
//                    Log.e("asasas",daftarKelurahan.toString());
//
//
//                }
//
//                return "ok";
//
//            } else {
//                return "no result";
//            }
//        } catch (Exception e) {
//            return "error";
//
//        }
//    }}

//    private void getdata(){
//
//        class getData extends AsyncTask<String,String,JSONObject>{
//
//
//            @Override
//            protected void onPreExecute() {
//                super.onPreExecute();
//                // Showing progress dialog
//                pDialog = new ProgressDialog(TambahUserActivity.this);
//                pDialog.setMessage("Please wait...");
//                pDialog.setCancelable(false);
//                pDialog.show();
//
//            }
//
////            @Override
////            protected JSONObject doInBackground(String... args) {
////                HttpHandler sh = new HttpHandler();
////
////                // Making a request to url and getting response
////                String jsonStr = sh.makeServiceCall(Config.URL_SERVER+"read_kelurahan.php");
////                Log.e("datanya",jsonStr);
////
//////            Log.e(TAG, "Response from url: " + jsonStr);
////
////                if (jsonStr != null) {
////                    try {
////                        JSONObject jsonObj = new JSONObject(jsonStr);
////
////                        // Getting JSON Array node
////                        JSONArray contacts = jsonObj.getJSONArray("kelurahan");
////
////                        // looping through All Contacts
////                        for (int i = 0; i < contacts.length(); i++) {
////                            JSONObject c = contacts.getJSONObject(i);
////
////                            String id_kelurahan = c.getString("id_kelurahan");
////                            String namakelurahan = c.getString("namakelurahan");
////                            String id_kecamatan = c.getString("id_kecamatan");
////
////
////
////                            // tmp hash map for single contact
////                            HashMap<String, String> contact = new HashMap<>();
////
////                            // adding each child node to HashMap key => value
////                            contact.put("id_kelurahan", id_kelurahan);
////                            contact.put("namakelurahan", namakelurahan);
////                            contact.put("id_kecamatan", id_kecamatan);
////
////                            Log.e("datanya",id_kelurahan+id_kecamatan+namakelurahan);
////
////                            // adding contact to contact list
////                            AarayList.add(contact);
////
////                        }
////                    } catch (final JSONException e) {
////                        Log.e("TAG", "Json parsing error: " + e.getMessage());
////                        runOnUiThread(new Runnable() {
////                            @Override
////                            public void run() {
////                                Toast.makeText(getApplicationContext(),
////                                        "Json parsing error: " + e.getMessage(),
////                                        Toast.LENGTH_LONG)
////                                        .show();
////                            }
////                        });
////
////                    }
////                } else {
////                    Log.e("TAG", "Couldn't get json from server.");
////                    runOnUiThread(new Runnable() {
////                        @Override
////                        public void run() {
////                            Toast.makeText(getApplicationContext(),
////                                    "Couldn't get json from server. Check LogCat for possible errors!",
////                                    Toast.LENGTH_LONG)
////                                    .show();
////                        }
////                    });
////
////                }
////
////                return null;
////            }
//
////            @Override
////            protected void onPostExecute(JSONObject result) {
////                super.onPostExecute(result);
////                // Dismiss the progress dialog
////                if (pDialog.isShowing())
////                    pDialog.dismiss();
////            }
////        }
//
//        getData gd = new getData();
//        gd.execute();
//    }
//
//
//}
