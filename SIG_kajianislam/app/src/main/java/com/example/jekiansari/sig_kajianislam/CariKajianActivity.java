package com.example.jekiansari.sig_kajianislam;

import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Toast;

import com.example.jekiansari.sig_kajianislam.Model.ListLocationModel;
import com.example.jekiansari.sig_kajianislam.Model.SearchKajianResponse;
import com.example.jekiansari.sig_kajianislam.services.ApiClient;
import com.example.jekiansari.sig_kajianislam.services.ApiService;

import java.io.Serializable;
import java.util.Calendar;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class CariKajianActivity extends AppCompatActivity {

    private DatePickerDialog.OnDateSetListener mDateSetListener1;
    String Parameter1="";
    private EditText edtNama, edtTanggal, edtWaktu;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cari_kajian);

        edtNama = findViewById(R.id.edt_namakajian);
        edtTanggal = findViewById(R.id.edt_tanggalkajian);
        edtWaktu = findViewById(R.id.edt_waktumulai);

        findViewById(R.id.btn_cari).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                searchKajian();
            }
        });

        edtTanggal.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Calendar cal = Calendar.getInstance();
                int year = cal.get(Calendar.YEAR);
                int month = cal.get(Calendar.MONTH);
                int day = cal.get(Calendar.DAY_OF_MONTH);

                DatePickerDialog dialog = new DatePickerDialog(
                        CariKajianActivity.this,
                        android.R.style.Theme_Holo_Light_Dialog_MinWidth,
                        mDateSetListener1,
                        year,month,day);
                dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
                dialog.show();
            }
        });

        mDateSetListener1 = new DatePickerDialog.OnDateSetListener() {
            @Override
            public void onDateSet(DatePicker datePicker, int year, int month, int day) {
                month = month + 1;
                String monthConverted = ""+month;
                String dayConverted = ""+day;
                if(month<10){
                    monthConverted = "0"+month;
                }
                if (day<10){
                    dayConverted = "0"+day;
                }
                Log.d("Isinya ", "onDateSet: dd/mm/yyy: " + dayConverted + "/" + monthConverted + "/" + year);

//                String date = dayConverted + "-" + monthConverted + "-" + year;
//                edtTanggal.setText(date);

                String date = year + "-" + monthConverted + "-" + dayConverted;
//                Parameter1 = sendParameter1;
                edtTanggal.setText(date);
//                Log.e("parameter",sendParameter1);
            }
        };
    }

    private void searchKajian(){
        final ProgressDialog dialog = new ProgressDialog(this);
        dialog.setMessage("Menampilkan data marker ..");
        dialog.show();

        String namakajian = edtNama.getText().toString();
        String tglkajian = edtTanggal.getText().toString();
        String waktukajian = edtWaktu.getText().toString();

        ApiService apiService = ApiClient.getClient().create(ApiService.class);
        Call<SearchKajianResponse> call = apiService.searchKajian(tglkajian, waktukajian, namakajian);
        call.enqueue(new Callback<SearchKajianResponse>() {
            @Override
            public void onResponse(Call<SearchKajianResponse> call, Response<SearchKajianResponse> response) {
                dialog.dismiss();
                SearchKajianResponse body = response.body();
                if (body.getData().size() != 0){
                    Toast.makeText(CariKajianActivity.this, "Ada "+body.getData().size()+" ditemukan", Toast.LENGTH_SHORT).show();
                    startActivity(new Intent(CariKajianActivity.this, SearchResultMapsActivity.class)
                    .putExtra("results", (Serializable) body.getData()));

                } else {
                    Toast.makeText(CariKajianActivity.this, "Data tidak ditemukan", Toast.LENGTH_SHORT).show();
                }

            }

            @Override
            public void onFailure(Call<SearchKajianResponse> call, Throwable t) {
                dialog.dismiss();
                Toast.makeText(CariKajianActivity.this, t.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });


    }
}
