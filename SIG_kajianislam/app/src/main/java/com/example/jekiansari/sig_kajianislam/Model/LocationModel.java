package com.example.jekiansari.sig_kajianislam.Model;
import com.google.gson.annotations.SerializedName;
public class LocationModel {
    @SerializedName("id_kajian")
    private String idkajian;
    @SerializedName("namakajian")
    private String namakajian;
    @SerializedName("latitude")
    private String latitude;
    @SerializedName("longitude")
    private String longitude;
    @SerializedName("username")
    private String username;

    public LocationModel(String idkajian, String namakajian, String latitude, String longitude, String username) {
        this.idkajian = idkajian;
        this.namakajian = namakajian;
        this.latitude = latitude;
        this.longitude = longitude;
        this.username = username;
    }

    public String getIdkajian(){
        return idkajian;
    }
    public LocationModel() {
    }

    public String getNamakajian() {
        return namakajian;
    }
    public String getUsername() {
        return username;
    }

    public void setNamakajian(String namakajian) {
        this.namakajian = namakajian;
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
