package com.example.jekiansari.sig_kajianislam.Adapter;

public class Kelurahan {
    private String id_kelurahan,namakelurahan,id_kecamatan;

    public String getId_kelurahan(){return id_kelurahan;}
    public void setId_kelurahan(String id_kelurahan){this.id_kelurahan = id_kelurahan;}
    public String getNamakelurahan(){return namakelurahan;}
    public void setNamakelurahan(String namakelurahan){this.namakelurahan = namakelurahan;}
    public String getId_kecamatan(){return id_kecamatan;}
    public void setId_kecamatan(String id_kecamatan){this.id_kecamatan = id_kecamatan;}

    @Override
    public String toString() {return namakelurahan;}
}
