package com.example.jekiansari.sig_kajianislam.Model;

public class BaseResponse {

    private String success;

    public BaseResponse() {
    }

    public String getSuccess() {
        return success;
    }

    public void setSuccess(String success) {
        this.success = success;
    }

    public BaseResponse(String success) {

        this.success = success;
    }
}
