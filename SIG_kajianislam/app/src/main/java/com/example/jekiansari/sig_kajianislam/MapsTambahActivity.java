package com.example.jekiansari.sig_kajianislam;

import android.content.Context;
import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.WindowManager;
import android.widget.TextView;
import android.widget.Toast;

import com.example.jekiansari.sig_kajianislam.Model.LocationModel;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.MapView;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

import java.util.ArrayList;
import java.util.List;

public class MapsTambahActivity extends AppCompatActivity implements OnMapReadyCallback,GoogleMap.OnMapLongClickListener,GoogleMap.OnMapClickListener {

    public static final String EXTRA_ISEDIT = "isEdit";

    private MapView map = null;
    //private MyLocationOverlay me=null
    Context mContext = this;
    private GoogleMap mMap;
    TextView Infoloc;
    String latlong;
    boolean markerClicked;
    //    private LatLngBounds Smd = new LatLngBounds(new LatLng(-0.542573,117.081245),new LatLng(-0.493729,117.149688));
    private List<LocationModel> mListMarker = new ArrayList<>();
    private static final int MY_PERMISSION_ACCESS_COARSE_LOCATION = 11;

    private Boolean isEdit;
    private String idKajian, namakajian = null, namapemateri = null, namatempat = null, alamat = null, lat = null, lng = null, kelurahan = null, kecamatan = null, tanggalkajian = null, waktumulai = null, waktuselesai = null, kuotapeserta = null, statuspeserta = null, statusberbayar = null, pengelola = null, kontakpengelola = null, informasi = null, gambarposter = null, gambartempat = null;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        if (Build.VERSION.SDK_INT < 16){
            getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN);
        }
        setContentView(R.layout.activity_maptambah);
        setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
        Infoloc = (TextView)findViewById(R.id.latlng_add);

        isEdit = getIntent().getBooleanExtra(EXTRA_ISEDIT, false);
        idKajian = getIntent().getStringExtra("id");
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





//        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager().findFragmentById(R.id.map_add);
//        mapFragment.getMapAsync(this);
//        MapView mapView = new MapView(this);
//        mapView.setClickable(true);
//        setContentView(mapView);

        //google
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager().findFragmentById(R.id.map_add);
        mapFragment.getMapAsync(this);
//        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        // end google
//        if (ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED)
//        {
//            android.support.v4.app.ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.ACCESS_COARSE_LOCATION}, MY_PERMISSION_ACCESS_COARSE_LOCATION);
//        }

//        FragmentManager myFragmentManager = getFragmentManager();
//        MapFragment myMapFragment  = (MapFragment)myFragmentManager.findFragmentById(R.id.map);
//        myMapFragment.getMapAsync(this);

//        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager().findFragmentById(R.id.map);
//        mapFragment.getMapAsync();



//        mMap.setMyLocationEnabled(true);


//        mMap.setMapType(GoogleMap.MAP_TYPE_HYBRID);

//        mMap.setOnMapClickListener(this);
//        mMap.setOnMapLongClickListener(this);
//        mMap.setOnMarkerDragListener(this);
//          mMap.setOnMapLongClickListener(this);
//
//        markerClicked = false;
//        mMap.setOnMapLongClickListener(this);
    }
    //
    //icon header
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_tambahmapkajian, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();
//        double latlng = mMap.

        //noinspection SimplifiableIfStatement
        if (id == R.id.check) {
            if (isEdit){
                startActivity(new Intent(MapsTambahActivity.this, EditKajianActivity.class)
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
            } else {
                String pos = Infoloc.getText().toString();
                Intent intent = new Intent(getApplicationContext(), TambahKajianActivity.class);
                intent.putExtra("Value",pos);
                startActivity(intent);
            }

//            AddActivity.this.startActivity(intent);
//            String posisi = tvLocInfo.getText().toString();
//
//            intent.putExtra("posisi",posisi);

//            if ( point != null) {
////                Intent intent = new Intent(AddActivity.this, MapsActivity.class);
////                AddActivity.this.startActivity(intent);
//                Toast.makeText(this, "ndak null", Toast.LENGTH_LONG).show();
//            }else {
//                Toast.makeText(this, "null", Toast.LENGTH_LONG).show();
//            }return true;
        }

        return super.onOptionsItemSelected(item);
    }
    // end icon header
    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;
        mMap.setOnMapLongClickListener(this);
        mMap.setOnMapClickListener(this);

        if (isEdit){
            Double latkajian = Double.parseDouble(lat);
            Double lngkajian = Double.parseDouble(lng);
            mMap.addMarker(new MarkerOptions()
            .position(new LatLng(latkajian, lngkajian))
            .title(namakajian));

            mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(new LatLng(latkajian,lngkajian), 13.5f));
        } else {
            mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(new LatLng(-0.494823,117.143615), 13.5f));
        }
//        mMap.setLatLngBoundsForCameraTarget(Smd);

        //timer hide
        final Handler handler = new Handler();
        handler.postDelayed(new Runnable() {

            public void run() {
                getSupportActionBar().hide();
            }
        },6500);
        //end timer hide
//        LatLng sydney = new LatLng(-33.852,151.211);
//        googleMap.addMarker(new MarkerOptions().position(sydney).title("Marker in Sdyney").draggable(true));
//        googleMap.moveCamera(CameraUpdateFactory.newLatLng(sydney));
        // mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(new LatLng(-0.49216898046869356, 117.13616082342526), 13.5f));

    }
    //back menu
    @Override
    public boolean onSupportNavigateUp(){
        finish();
        return true;
    }
// end back menu


//    @Override
//    public void onMapLongClick(LatLng point){
////        tvLocInfo.setText("New marker added@" + point.toString());
//        mMap.addMarker(new MarkerOptions()
//                        .position(point)
//                        .title("aaaaa")
//                        .draggable(true)
//                        .icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_RED)));
//        markerClicked = false;
//    }

    //
    @Override
    public void onMapClick(LatLng point) {
//        tvLocInfo.setText("New marker added@" + point.toString());
//        tvLocInfo.setText(point.toString());
//        getActionBar().hide();
        getSupportActionBar().show();
        //timer hide
        final Handler handler = new Handler();
        handler.postDelayed(new Runnable() {

            public void run() {
                getSupportActionBar().hide();
            }
        },4000);
        //end timer hide

//        mMap.animateCamera(CameraUpdateFactory.newLatLng(point));

//        markerClicked = false;
    }

    @Override
    public void onMapLongClick(LatLng point) {
        mMap.clear();
        if (mMap != null)
        {
            Infoloc.setText(point.toString());
            getSupportActionBar().show();
            mMap.addMarker(new MarkerOptions()
                    .position(point)
                    .draggable(true));

            if (isEdit){
                lat = String.valueOf(point.latitude);
                lng = String.valueOf(point.longitude);
            }


        }
        //timer hide
        final Handler handler = new Handler();
        handler.postDelayed(new Runnable() {

            public void run() {
                getSupportActionBar().hide();
            }
        },6500);
        //end timer hide

        String latlong = point.toString();

//    String[] latlong = point.toString().split(",");
//    Double latitude = Double.parseDouble(latlong[0]);
//    Double longtitude = Double.parseDouble(latlong[1]);
//
//    LatLng posisi = new LatLng(latitude,longtitude);

//    latlong.replace(null, point.toString());
//    latlong


//    tvLocInfo.setText(point.toString());
//    String latlng = String.valueOf(point);
//        mMap.clear();
//    getActionBar().hide();
//        mMap.addMarker(new MarkerOptions()
//                .position(point)
//                .draggable(true));

//    Toast.makeText(this, "New marker added@"+point.toString(), Toast.LENGTH_LONG).show();



    }
//    @Override
//    public void onMarkerDrag(Marker marker) {
//        tvLocInfo.setText("Marker " + marker.getId() + " Drag@" + marker.getPosition());
//    }
//
//    @Override
//    public void onMarkerDragEnd(Marker marker) {
//        tvLocInfo.setText("Marker " + marker.getId() + " DragEnd");
//    }
//
//    @Override
//    public void onMarkerDragStart(Marker marker) {
//        tvLocInfo.setText("Marker " + marker.getId() + " DragStart");
//
//    }
//

}