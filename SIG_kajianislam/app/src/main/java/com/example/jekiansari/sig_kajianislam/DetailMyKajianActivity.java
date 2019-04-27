package com.example.jekiansari.sig_kajianislam;

import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.bumptech.glide.Glide;
import com.example.jekiansari.sig_kajianislam.services.AlarmReceiver;
import com.example.jekiansari.sig_kajianislam.services.Config;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.InputStream;
import java.net.URL;

public class DetailMyKajianActivity extends AppCompatActivity {
    ListView fruitsList;
    TextView NamaKajian, NamaPemateri, NamaTempat, Alamat, Kelurahan, Kecamatan, TanggalKajian, WaktuMulai, WaktuSelesai, KuotaPeserta, StatusPeserta, StatusBerbayar, Pengelola, KontakPengelola, Informasi, Posisi, urlgambarposter, urlgambartempat;
    ImageView GambarPoster, GambarTempat;
    //Button gps, notif;
    String id, namakajian = null, namapemateri = null, namatempat = null, alamat = null, lat = null, lng = null, kelurahan = null, kecamatan = null, tanggalkajian = null, waktumulai = null, waktuselesai = null, kuotapeserta = null, statuspeserta = null, statusberbayar = null, pengelola = null, kontakpengelola = null, informasi = null, gambarposter = null, gambartempat = null;
    String idKajian;
    //    TextView tvNamaBencana;
//    String datas;
//    String data;
//    String url = "https://www.thecrazyprogrammer.com/example_data/fruits_array.json";
    ProgressDialog dialog;
    String test;

    private AlarmReceiver alarmReceiver;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_my_kajian);

        alarmReceiver = new AlarmReceiver();

        //back buttonn
//        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        //end back button

        NamaKajian = (TextView) findViewById(R.id.namakajiandetailmykajian);
        NamaPemateri = (TextView) findViewById(R.id.namapemateridetailmykajian);
        NamaTempat = (TextView) findViewById(R.id.namatempatdetailmykajian);
        Alamat = (TextView) findViewById(R.id.alamatdetailmykajian);
        Kelurahan = (TextView) findViewById(R.id.kelurahandetailmykajian);
        Kecamatan = (TextView) findViewById(R.id.kecamatandetailmykajian);
        TanggalKajian = (TextView) findViewById(R.id.tanggalkajiandetailmykajian);
        WaktuMulai = (TextView) findViewById(R.id.waktumulaidetailmykajian);
        WaktuSelesai = (TextView) findViewById(R.id.waktuselesaidetailmykajian);
        KuotaPeserta = (TextView) findViewById(R.id.kuotapesertadetailmykajian);
        StatusPeserta = (TextView) findViewById(R.id.statuspesertadetailmykajian);
        StatusBerbayar = (TextView) findViewById(R.id.statusberbayardetailmykajian);
        Pengelola = (TextView) findViewById(R.id.pengeloladetailmykajian);
        KontakPengelola = (TextView) findViewById(R.id.kontakpengeloladetailmykajian);
        Informasi = (TextView) findViewById(R.id.informasidetailmykajian);
        Posisi = (TextView) findViewById(R.id.posisidetailmykajian);
        urlgambarposter = (TextView) findViewById(R.id.urlgambarpostermykajian);
        urlgambartempat = (TextView) findViewById(R.id.urlgambartempatmykajian);
        GambarPoster = (ImageView) findViewById(R.id.gambarposterdetailmykajian);
        GambarTempat = (ImageView) findViewById(R.id.gambartempatdetailmykajian);
//        gps = (Button) findViewById(R.id.btn_tunjuklokasimykajian);
//        notif = (Button) findViewById(R.id.btn_notifikasimykajian);

        dialog = new ProgressDialog(this);
        dialog.setMessage("Loading....");
        dialog.show();

        Button btnEdit = findViewById(R.id.btn_editkajian);
        btnEdit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(DetailMyKajianActivity.this, MapsTambahActivity.class)
                .putExtra(MapsTambahActivity.EXTRA_ISEDIT, true)
                .putExtra("id", idKajian)
                .putExtra("namakajian", namakajian)
                .putExtra("namapemateri", namapemateri)
                .putExtra("namatempat", namatempat)
                .putExtra("lat", lat)
                .putExtra("lng", lng)
                .putExtra("alamat", alamat)
                .putExtra("kelurahan", kelurahan)
                .putExtra("kecamatan", kecamatan)
                .putExtra("tanggalkajian", tanggalkajian)
                .putExtra("waktumulai", waktumulai)
                .putExtra("waktuselesai", waktuselesai)
                .putExtra("kuota", kuotapeserta)
                .putExtra("statuspeserta", statuspeserta)
                .putExtra("statusberbayar", statusberbayar)
                .putExtra("pengelola", pengelola)
                .putExtra("kontakpengelola", kontakpengelola)
                .putExtra("informasi", informasi)
                .putExtra("gambarposter", gambarposter)
                .putExtra("gambartempat", gambartempat)
                );
            }
        });

//        gps.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                // Create a Uri from an intent string. Use the result to create an Intent.
//                Uri gmmIntentUri = Uri.parse("google.navigation:q="+lat+","+lng);
//
//// Create an Intent from gmmIntentUri. Set the action to ACTION_VIEW
//                Intent mapIntent = new Intent(Intent.ACTION_VIEW, gmmIntentUri);
//// Make the Intent explicit by setting the Google Maps package
//                mapIntent.setPackage("com.google.android.apps.maps");
//
//// Attempt to start an activity that can handle the Intent
//                if (mapIntent.resolveActivity(getPackageManager()) != null) {
//                    startActivity(mapIntent);
//                }
//
//
//            }
//        });
//
//        notif.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                alarmReceiver.setalarm(DetailMyKajianActivity.this, tanggalkajian, waktumulai, "Kajian sebentar lagi akan dimulai", id);
//            }
//        });
        //button
//        edit.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                Intent addId = getIntent();
//                final String id = addId.getStringExtra("Value");
////                final String loc = addId.getStringExtra("loc");
//                String loc = posisi.getText().toString().trim();
//                Intent i = new Intent(NewDetailActivity.this,NewEditActivity.class);
//                i.putExtra("Value",id);
//                i.putExtra("loc",loc);
//                startActivity(i);
//            }
//        });


//        hapus.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                AskOption();
////                Toast.makeText(DetailActivity.this,"hapus",Toast.LENGTH_LONG).show();
//            }
//        });
//        //end Button
        Intent addId = getIntent();
        idKajian = addId.getStringExtra("id_kajian");
        String combine = Config.URL_SHOW_DETAIL_KAJIAN.concat(idKajian).toString();
        Log.e("sempak", id + "{" + combine + "}");
        StringRequest request = new StringRequest(combine, new Response.Listener<String>() {
            @Override
            public void onResponse(String string) {
                parseJsonData(string);
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError volleyError) {
                Toast.makeText(getApplicationContext(), "Some error occurred!!", Toast.LENGTH_SHORT).show();
                dialog.dismiss();
                finish();
            }
        });

        RequestQueue rQueue = Volley.newRequestQueue(DetailMyKajianActivity.this);
        rQueue.add(request);
    }

    //header button
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.homeAsUp) {
            finish();
            return true;
        } else if (id == R.id.refresh) {
//            Intent intent = new Intent(MapsActivity.this, AddActivity.class);
//            MapsActivity.this.startActivity(intent);


            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    //back menu
    @Override
    public boolean onSupportNavigateUp() {
        finish();
        return true;
    }
// end back menu
    // end header Buton

    void parseJsonData(String jsonString) {
        try {
            JSONObject object = new JSONObject(jsonString);
            JSONArray dben = object.getJSONArray("data");

            Log.v("objek", dben.toString());
            String[] namanya = new String[dben.length()];



            for (int i = 0; i < dben.length(); i++) {
                JSONObject c = dben.getJSONObject(i);

                id = c.getString("id_kajian");
                namakajian = c.getString("namakajian");
                namapemateri = c.getString("namapemateri");
                namatempat = c.getString("namatempat");
                lat = c.getString("lat");
                lng = c.getString("lng");
                alamat = c.getString("alamat");
                kelurahan = c.getString("kelurahan");
                kecamatan = c.getString("kecamatan");
                tanggalkajian = c.getString("tanggalkajian");
                waktumulai = c.getString("waktumulai");
                waktuselesai = c.getString("waktuselesai");
                kuotapeserta = c.getString("kuota");
                statuspeserta = c.getString("statuspeserta");
                statusberbayar = c.getString("statusberbayar");
                pengelola = c.getString("pengelola");
                kontakpengelola = c.getString("kontakpengelola");
                informasi = c.getString("informasi");
                gambarposter = c.getString("gambarposter");
                gambartempat = c.getString("gambartempat");

            }

//          set Text bencana
            NamaKajian.setText(namakajian);
            Posisi.setText("lat/lng:(" + lat + "," + lng + ")");
            NamaTempat.setText(namatempat);
            NamaPemateri.setText(namapemateri);
            Alamat.setText(alamat);
            Kelurahan.setText(kelurahan);
            Kecamatan.setText(kecamatan);
            TanggalKajian.setText(tanggalkajian);
            WaktuMulai.setText(waktumulai);
            WaktuSelesai.setText(waktuselesai);
            KuotaPeserta.setText(kuotapeserta);
            StatusPeserta.setText(statuspeserta);
            StatusBerbayar.setText(statusberbayar);
            Pengelola.setText(pengelola);
            KontakPengelola.setText(kontakpengelola);
            Informasi.setText(informasi);
            urlgambartempat.setText(gambartempat);
            urlgambarposter.setText(gambarposter);
            String gbrPoster = urlgambarposter.getText().toString();
            String gbrTempat = urlgambartempat.getText().toString();
            // glide fungsi on
//            Log.i("gambar",gbrBncana);
//            Glide.with(NewDetailActivity.this).load(gbrBncana).into(ivGambar);
            Log.e("dancok", gbrPoster);
            Log.e("dancok", gbrTempat);
            Glide.with(this)
                    .load(gbrPoster)
                    .into(GambarPoster);

            Glide.with(this)
                    .load(gbrTempat)
                    .into(GambarTempat);
//            new ShowImage(GambarPoster).execute(gbrPoster);
//            new ShowImage(GambarTempat).execute(gbrTempat);

            // err nya
//            String korbanall = tvKorbanTewas.getText().toString();
//            StringTokenizer stringTokenizer = new StringTokenizer(korbanall,";");
//            String tewas = stringTokenizer.nextToken();
//            String berat = stringTokenizer.nextToken();
//            String ringan = stringTokenizer.nextToken();

//            Log.e("silit",tewas+";"+berat+";"+ringan);
//            Log.e("silit",korbanall);
////
//            tvKorbanTewas.setText("Korban Tewas : "+tewas);
//            tvKorbanLBerat.setText("Luka Berat : "+berat);
//            tvKorbanLRingan.setText("Luka Ringan : "+ringan);
            // end errnya
//end settextBencana

        } catch (JSONException e) {
            e.printStackTrace();
        }

        dialog.dismiss();
    }

    // hapus
//    private AlertDialog AskOption(){
//        AlertDialog.Builder ad = new AlertDialog.Builder(NewDetailActivity.this)
//                .setTitle("Delete")
//                .setMessage("Anda Yakin Mau Menghapus.?")
//                .setIcon(R.drawable.common_google_signin_btn_icon_dark)
//                .setPositiveButton("Yes", new DialogInterface.OnClickListener() {
//                    @Override
//                    public void onClick(DialogInterface dialogInterface, int i) {
//                        hapusBencana();
//                        dialogInterface.dismiss();
//                        finish();
//                        Intent next = new Intent(NewDetailActivity.this,MapsActivity.class);
//                        startActivity(next);
//                    }
//                })
//                .setNegativeButton("No", new DialogInterface.OnClickListener() {
//                    @Override
//                    public void onClick(DialogInterface dialogInterface, int i) {
//                        dialogInterface.dismiss();
//                    }
//                });
//        ad.show();
//        return null;
//    }

//    private void hapusBencana(){
//        Intent addId = getIntent();
//        final String id = addId.getStringExtra("Value");
//
//
//        class HapusBencana extends AsyncTask<String,String,String> {
//
//
//            ProgressDialog loading;
//
//            @Override
//            protected void onPreExecute() {
//                super.onPreExecute();
//                loading = ProgressDialog.show(NewDetailActivity.this,"Menghapus...","Tunggu...",false,false);
//            }
//
//            @Override
//            protected void onPostExecute(String s) {
//                super.onPostExecute(s);
//                loading.dismiss();
//                Toast.makeText(NewDetailActivity.this,s,Toast.LENGTH_LONG).show();
//
//            }
//
//            @Override
//            protected String doInBackground(String... args) {
//
//                HashMap<String,String> params = new HashMap<>();
//
//                params.put(Config.TAG_ID_BENCANA,id);
//                Log.d("id_bencana",id);
//
//                //lama
//                RequestHandler rh = new RequestHandler();
//                String res = rh.sendPostRequest(URL_HAPUS, params);
//                return res;
////                return null;
//            }
//        }
//
//        HapusBencana hb = new HapusBencana();
//        hb.execute();
//    }
    // end hapus

    private class ShowImage extends AsyncTask<String, Void, Bitmap> {
        ImageView imageView;
        ImageView imageView2;


        public ShowImage(ImageView imageView) {
            this.imageView = imageView;
            this.imageView2 = imageView;
        }

        /*
            doInBackground(Params... params)
                Override this method to perform a computation on a background thread.
         */
        protected Bitmap doInBackground(String... urls) {
            String urlOfImage = urls[0];
            Bitmap logo = null;
            try {
                InputStream is = new URL(urlOfImage).openStream();
                /*
                    decodeStream(InputStream is)
                        Decode an input stream into a bitmap.
                 */
                logo = BitmapFactory.decodeStream(is);
            } catch (Exception e) { // Catch the download exception
                e.printStackTrace();
            }
            return logo;
        }

        protected void onPostExecute(Bitmap result) {
            imageView.setImageBitmap(result);
            imageView2.setImageBitmap(result);
        }
    }

}
