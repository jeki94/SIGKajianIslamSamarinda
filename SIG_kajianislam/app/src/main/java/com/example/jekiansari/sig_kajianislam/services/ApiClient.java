package com.example.jekiansari.sig_kajianislam.services;

import com.example.jekiansari.sig_kajianislam.LoggingInterceptor;

import okhttp3.OkHttpClient;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

import static com.example.jekiansari.sig_kajianislam.services.Config.URL_MAPS;

public class ApiClient {
    //    public static final String URL      = "http://192.168.1.18/MenampilkanDataKetablephp/";
//    public static final String URL      = "http://192.168.1.5/mapbencana/";
    public static Retrofit RETROFIT     = null;

    public static Retrofit getClient(){
        if(RETROFIT==null){
            OkHttpClient client = new OkHttpClient.Builder()
                    .addInterceptor(new LoggingInterceptor())
                    .build();
            RETROFIT = new Retrofit.Builder()
                    .baseUrl(URL_MAPS)
                    .client(client)
                    .addConverterFactory(GsonConverterFactory.create())
                    .build();
        }
        return RETROFIT;
    }
}