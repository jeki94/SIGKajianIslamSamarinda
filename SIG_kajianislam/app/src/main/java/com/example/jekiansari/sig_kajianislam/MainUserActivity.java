package com.example.jekiansari.sig_kajianislam;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.TextView;
import android.widget.Toast;

import com.example.jekiansari.sig_kajianislam.Model.ListLocationModel;
import com.example.jekiansari.sig_kajianislam.Model.LocationModel;
import com.example.jekiansari.sig_kajianislam.services.ApiClient;
import com.example.jekiansari.sig_kajianislam.services.ApiService;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class MainUserActivity extends AppCompatActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    String warnaRAW = "";
    private List<LocationModel> mListMarker = new ArrayList<>();


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_mainuser);

        //manggil di atas header / butom 3
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map_user);
        mapFragment.getMapAsync(this);

        SharedPreferences pref = getSharedPreferences("SP_USER",MODE_PRIVATE);
        TextView TextUsername = (TextView)findViewById(R.id.username);
        String username = pref.getString("username",null);
        TextUsername.setText("Hello, "+pref.getString("username",null));
        Log.e("username",username);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main_user, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.Tambahkajian) {
            Intent intent = new Intent(MainUserActivity.this, MapsTambahActivity.class);
            startActivity(intent);
            return true;
        }else if (id == R.id.Cari){
            Intent intent = new Intent(MainUserActivity.this, CariKajianActivity.class);
            startActivity(intent);
            return true;
        }
        else if (id == R.id.kajianumum){
            Intent intent = new Intent(MainUserActivity.this, MainUserActivity.class);
            startActivity(intent);
            return true;
        }
        else if (id == R.id.Mykajian){
            Intent intent = new Intent(MainUserActivity.this, MyKajianActivity.class);
            startActivity(intent);
            return true;
        }
////        else if (id == R.id.Tambahkajian){
////            Intent intent = new Intent(MainActivity.this, MapsTambahActivity.class);
////            startActivity(intent);
////            return true;
////        }
        else if (id == R.id.Logout){
           SharedPreferences pref = getSharedPreferences("SP_USER",MODE_PRIVATE);
            SharedPreferences.Editor editor = pref.edit();

            Intent intent = new Intent(MainUserActivity.this, MainActivity.class);
            editor.clear();
            editor.commit();
            startActivity(intent);

            finish();
            return true;

//        }else if (id == R.id.refresh){
//
//            return true;
        }else if (id == R.id.refresh){
            getAllDataLocationLatLng();
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;
        mMap.getUiSettings().setZoomControlsEnabled(true);
        mMap.setOnMarkerClickListener(new GoogleMap.OnMarkerClickListener() {
            @Override
            public boolean onMarkerClick(Marker marker) {
                Intent i = new Intent(MainUserActivity.this,DetailPublicActivity.class);
                i.putExtra("id_kajian",marker.getTitle().toString());
                startActivity(i);
//                warnaRAW = marker.getSnippet().toString();
//                String id = marker.getTitle().toString();
//                String loc = marker.getSnippet().toString();
//                String authorRAW = marker.getSnippet().toString();
//
//                String username ="username";
//
//                // yg buat bencana
//                String authorFinal = authorRAW.substring(authorRAW.lastIndexOf("[")+1, authorRAW.indexOf("]"));
//                Log.e("regex", authorFinal);
//
//                if (username.equals(authorFinal)){
//                    Log.e("test","cakep");
//                    Intent i = new Intent(MainUserActivity.this,DetailPublicActivity.class);
//
//                    i.putExtra("loc",loc);
//                    i.putExtra("Value",id);
//                    startActivity(i);
//                    Log.i("-nya",id);
//                }else {
//                    Log.e("test","bosok");
//                    Intent i = new Intent(MainUserActivity.this,MainUserActivity.class);
//
//                    i.putExtra("loc",loc);
//                    i.putExtra("Value",id);
//                    startActivity(i);
//
//                    Log.i("-nya",id);
//                }

//                Intent i = new Intent(MapsActivity.this,NewDetailActivity.class);
////                i.putExtra("idBencana",id);
//                i.putExtra("loc",loc);
//                i.putExtra("Value",id);
//                startActivity(i);
////                String b = marker.getTitle().toString();
//                Log.i("-nya",id);
                return false;
            }
        });

        getAllDataLocationLatLng();

    }

    /**
     * method ini digunakan menampilkan data marker dari database
     */
    private void getAllDataLocationLatLng(){
        final ProgressDialog dialog = new ProgressDialog(this);
        dialog.setMessage("Menampilkan data marker ..");
        dialog.show();

        ApiService apiService = ApiClient.getClient().create(ApiService.class);
        Call<ListLocationModel> call = apiService.getAllLocation();
        call.enqueue(new Callback<ListLocationModel>() {
            @Override
            public void onResponse(Call<ListLocationModel> call, Response<ListLocationModel> response) {
                dialog.dismiss();
                mListMarker = response.body().getmData();
                initMarker(mListMarker);
            }

            @Override
            public void onFailure(Call<ListLocationModel> call, Throwable t) {
                dialog.dismiss();
                Toast.makeText(MainUserActivity.this, t.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });


    }

    /**
     * Method ini digunakan untuk menampilkan semua marker di maps dari data yang didapat dari database
     * @param listData
     */
    private void initMarker(List<LocationModel> listData ){
        //iterasi semua data dan tampilkan markernya
        for (int i=0; i<mListMarker.size(); i++){
            //set latlng nya
            LatLng location = new LatLng(Double.parseDouble(mListMarker.get(i).getLatitude()), Double.parseDouble(mListMarker.get(i).getLongitude()));
            //tambahkan markernya
//            mMap.addMarker(new MarkerOptions().position(location).title(mListMarker.get(i).getImageLocationName()).snippet(mListMarker.get(i).getImageLocationName()));
            mMap.addMarker(new MarkerOptions().position(location).title(mListMarker.get(i).getIdkajian()).snippet("("+mListMarker.get(i).getNamakajian()+")"+" ["+mListMarker.get(i).getUsername()+"]"));
            //set latlng index ke 0
            LatLng latLng = new LatLng(Double.parseDouble(mListMarker.get(0).getLatitude()), Double.parseDouble(mListMarker.get(0).getLongitude()));
            //lalu arahkan zooming ke marker index ke 0
            mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(new LatLng(latLng.latitude,latLng.longitude), 13.5f));

//            extraMarkerInfo.put(marker.getTitle(),);
        }

    }

    // back butonn
    @Override
    public void onBackPressed(){
        // disable back button
        android.os.Process.killProcess(android.os.Process.myPid());
        System.exit(0);
    }
}
