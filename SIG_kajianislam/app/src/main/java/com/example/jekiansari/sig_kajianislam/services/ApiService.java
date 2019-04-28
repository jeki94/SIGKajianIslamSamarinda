package com.example.jekiansari.sig_kajianislam.services;

import com.example.jekiansari.sig_kajianislam.Model.BaseResponse;
import com.example.jekiansari.sig_kajianislam.Model.ListLocationModel;
import com.example.jekiansari.sig_kajianislam.Model.SearchKajianResponse;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
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

//    @Multipart
    @POST("EditKajian.php")
    @FormUrlEncoded
    Call<BaseResponse> editKajian(
            @Field("id_kajian") String idKajian,
            @Field("username") String username,
            @Field("namakajian") String namakajian,
            @Field("namapemateri") String namapemateri,
            @Field("namatempat") String namatempat,
            @Field("latitude") String latitude,
            @Field("longtitude") String longtitude,
            @Field("alamat") String alamat,
            @Field("kelurahan") String kelurahan,
            @Field("kecamatan") String kecamatan,
            @Field("tanggalkajian") String tanggalkajian,
            @Field("waktumulai") String waktumulai,
            @Field("waktuselesai") String waktuselesai,
            @Field("kuotapeserta") String kuotapeserta,
            @Field("statuspeserta") String statuspeserta,
            @Field("statusberbayar") String statusberbayar,
            @Field("pengelola") String pengelola,
            @Field("kontakpengelola") String kontakpengelola,
            @Field("informasi") String informasi,
            @Field("gambarposter") String gambarposter,
            @Field("gambartempat") String gambartempat

    );

    @POST("UpdateStatusKajian.php")
    @FormUrlEncoded
    Call<BaseResponse> gantiStatus(
            @Field("statuskajian") String statuskajian,
            @Field("id_kajian") String id_kajian,
            @Field("username") String username
    );
}
