package com.example.jekiansari.sig_kajianislam.services;

import com.example.jekiansari.sig_kajianislam.Model.EditResponse;
import com.example.jekiansari.sig_kajianislam.Model.ListLocationModel;
import com.example.jekiansari.sig_kajianislam.Model.SearchKajianResponse;

import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Multipart;
import retrofit2.http.POST;
import retrofit2.http.Part;
import retrofit2.http.Query;


public interface ApiService {
    @GET("Semua_marker.php")
    Call<ListLocationModel> getAllLocation();

    @GET("FilterKajian.php")
    Call<SearchKajianResponse> searchKajian(
            @Query("tanggalkajian") String tanggalkajian,
            @Query("waktumulai") String waktumulai,
            @Query("namakajian") String namakajian
    );

    @Multipart
    @POST("EditKajian.php")
    @FormUrlEncoded
    Call<EditResponse> editKajian(
            @Part("id_kajian") RequestBody idKajian,
            @Part("username") RequestBody username,
            @Part("namakajian") RequestBody namakajian,
            @Part("namapemateri")RequestBody namapemateri,
            @Part("namatempat") RequestBody namatempat,
            @Part("latitude") RequestBody latitude,
            @Part("longtitude") RequestBody longtitude,
            @Part("alamat") RequestBody alamat,
            @Part("kelurahan")RequestBody kelurahan,
            @Part("kecamatan")RequestBody kecamatan,
            @Part("tanggalkajian")RequestBody tanggalkajian,
            @Part("waktumulai") RequestBody waktumulai,
            @Part("waktuselesai") RequestBody waktuselesai,
            @Part("kuotapeserta") RequestBody kuotapeserta,
            @Part("statuspeserta") RequestBody statuspeserta,
            @Part("statusberbayar") RequestBody statusberbayar,
            @Part("pengelola") RequestBody pengelola,
            @Part("kontakpengelola") RequestBody kontakpengelola,
            @Part("informasi")RequestBody informasi,
            @Part MultipartBody.Part gambarposter,
            @Part MultipartBody.Part gambartempat

    );
}
