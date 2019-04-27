package com.example.jekiansari.sig_kajianislam.Model;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

import java.io.Serializable;

public class SearchKajian implements Serializable {

    @SerializedName("id_kajian")
    @Expose
    private String idKajian;
    @SerializedName("namakajian")
    @Expose
    private String namakajian;
    @SerializedName("tanggalkajian")
    @Expose
    private String tanggalkajian;
    @SerializedName("waktumulai")
    @Expose
    private String waktumulai;
    @SerializedName("latitude")
    @Expose
    private String latitude;
    @SerializedName("longitude")
    @Expose
    private String longitude;

    public String getIdKajian() {
        return idKajian;
    }

    public void setIdKajian(String idKajian) {
        this.idKajian = idKajian;
    }

    public String getNamakajian() {
        return namakajian;
    }

    public void setNamakajian(String namakajian) {
        this.namakajian = namakajian;
    }

    public String getTanggalkajian() {
        return tanggalkajian;
    }

    public void setTanggalkajian(String tanggalkajian) {
        this.tanggalkajian = tanggalkajian;
    }

    public String getWaktumulai() {
        return waktumulai;
    }

    public void setWaktumulai(String waktumulai) {
        this.waktumulai = waktumulai;
    }

    public String getLatitude() {
        return latitude;
    }

    public void setLatitude(String latitude) {
        this.latitude = latitude;
    }

    public String getLongitude() {
        return longitude;
    }

    public void setLongitude(String longitude) {
        this.longitude = longitude;
    }

}
