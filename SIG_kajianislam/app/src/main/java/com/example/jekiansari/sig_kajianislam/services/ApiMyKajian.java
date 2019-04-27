package com.example.jekiansari.sig_kajianislam.services;

import com.example.jekiansari.sig_kajianislam.Model.ListLocationModel;
import com.example.jekiansari.sig_kajianislam.MyKajianActivity;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Query;

public interface ApiMyKajian {
    @GET("My_marker.php")
    Call<ListLocationModel> getAllLocation(
            @Query("nama_user") String nama_user);

}
