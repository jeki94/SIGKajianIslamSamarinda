package com.example.jekiansari.sig_kajianislam;

import android.content.Intent;
import android.support.v4.app.FragmentActivity;
import android.os.Bundle;
import android.widget.Toast;

import com.example.jekiansari.sig_kajianislam.Model.SearchKajian;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;

import java.util.List;

public class SearchResultMapsActivity extends FragmentActivity implements OnMapReadyCallback {

    private GoogleMap mMap;

    private List<SearchKajian> results = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search_result_maps);
        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);

        results = (List<SearchKajian>) getIntent().getSerializableExtra("results");
        Toast.makeText(this, "" + results.size(), Toast.LENGTH_SHORT).show();

    }


    /**
     * Manipulates the map once available.
     * This callback is triggered when the map is ready to be used.
     * This is where we can add markers or lines, add listeners or move the camera. In this case,
     * we just add a marker near Sydney, Australia.
     * If Google Play services is not installed on the device, the user will be prompted to install
     * it inside the SupportMapFragment. This method will only be triggered once the user has
     * installed Google Play services and returned to the app.
     */
    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;
        mMap.setOnMarkerClickListener(new GoogleMap.OnMarkerClickListener() {
            @Override
            public boolean onMarkerClick(Marker marker) {
                Intent i = new Intent(SearchResultMapsActivity.this, DetailPublicActivity.class);
                i.putExtra("id_kajian", marker.getTitle().toString());
                startActivity(i);

                return false;
            }
        });
        // Add a marker in Sydney and move the camera
        LatLng sydney = new LatLng(-34, 151);
//
//        for (int i=0;i>=results.size();i++){
//            mMap.addMarker(new MarkerOptions().position(sydney).title(""));
//        }

        for (SearchKajian kajian : results) {
            mMap.addMarker(new MarkerOptions().position(
                    new LatLng(Double.parseDouble(kajian.getLatitude()),
                            Double.parseDouble(kajian.getLongitude()))).title(kajian.getIdKajian()).snippet(kajian.getNamakajian()));
        }
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(new LatLng(
                Double.parseDouble(results.get(0).getLatitude()),
                Double.parseDouble(results.get(0).getLongitude()

                )), 13.5f));
    }
}
