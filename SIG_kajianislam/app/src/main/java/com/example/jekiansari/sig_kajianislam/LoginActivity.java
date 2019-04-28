package com.example.jekiansari.sig_kajianislam;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.example.jekiansari.sig_kajianislam.handler.RequestHandler;
import com.example.jekiansari.sig_kajianislam.services.Config;
import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.messaging.FirebaseMessaging;

import java.util.HashMap;

import static com.example.jekiansari.sig_kajianislam.services.Config.URL_LOGIN;

public class LoginActivity extends AppCompatActivity{

    ProgressDialog pDialog;
    Button btn_register, btn_login;
    EditText txt_username, txt_password;
    Intent intent;

    int success;
    ConnectivityManager conMgr;

    private String url = Config.URL_SERVER + "Login.php";

    private static final String TAG = LoginActivity.class.getSimpleName();

    private static final String TAG_SUCCESS = "success";
    private static final String TAG_MESSAGE = "message";

    public final static String TAG_USERNAME = "username";
    public final static String TAG_ID = "id";

    String tag_json_obj = "json_obj_req";

    private Context context;


    SharedPreferences sharedpreferences;
    Boolean session = false;
    String pass, username;
    public static final String my_shared_preferences = "my_shared_preferences";
    public static final String session_status = "session_status";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        context = LoginActivity.this;
        pDialog = new ProgressDialog(context);

        Log.e("urlnya",url);

        conMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        {
            if (conMgr.getActiveNetworkInfo() != null
                    && conMgr.getActiveNetworkInfo().isAvailable()
                    && conMgr.getActiveNetworkInfo().isConnected()) {
            } else {
                Toast.makeText(getApplicationContext(), "No Internet Connection",
                        Toast.LENGTH_LONG).show();
            }
        }

//        FirebaseMessaging.getInstance().subscribeToTopic("test");
//        FirebaseInstanceId.getInstance().getToken();
//
//        String token = new String(FirebaseInstanceId.getInstance().getToken());
//
//        Log.d("token = ",token);

        btn_login = (Button) findViewById(R.id.btn_login);
        //btn_register = (Button) findViewById(R.id.btn_register);
        txt_username = (EditText) findViewById(R.id.txt_username);
        txt_password = (EditText) findViewById(R.id.txt_password);

        btn_login.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // TODO Auto-generated method stub
                String username = txt_username.getText().toString();
                String password = txt_password.getText().toString();

                // mengecek kolom yang kosong
                if (username.trim().length() > 0 && password.trim().length() > 0) {
                    if (conMgr.getActiveNetworkInfo() != null
                            && conMgr.getActiveNetworkInfo().isAvailable()
                            && conMgr.getActiveNetworkInfo().isConnected()) {
//                        checkLogin(username, password);
                        LoginIn();
                    } else {
                        Toast.makeText(getApplicationContext() ,"No Internet Connection", Toast.LENGTH_LONG).show();
                    }
                } else {
                    // Prompt user to enter credentials
                    Toast.makeText(getApplicationContext() ,"Kolom tidak boleh kosong", Toast.LENGTH_LONG).show();
                }
            }
        });

//        btn_register.setOnClickListener(new View.OnClickListener() {
//
//            @Override
//            public void onClick(View v) {
//                // TODO Auto-generated method stub
//                Intent intent = new Intent(LoginActivity.this, TambahUserActivity.class);
////                finish();
//                startActivity(intent);
//            }
//        });

    }

//    private void login() {
//        //Getting values from edit texts
//        final String username = txt_username.getText().toString().trim();
//        final String password = txt_password.getText().toString().trim();
//        pDialog.setMessage("Login Process...");
//        showDialog();
//        //Creating a string request
//        StringRequest stringRequest = new StringRequest(Request.Method.POST, Config.URL_LOGIN,
//                new Response.Listener<String>() {
//                    @Override
//                    public void onResponse(String response) {
//                    Log.i("poli",response);
//
//                        //If we are getting success from server
////                        if (response.contains(Config.LOGIN_SUCCESS)) {
////                            hideDialog();
////                            gotoCourseActivity();
////
////                        } else {
////                            hideDialog();
////                            //Displaying an error message on toast
////                            Toast.makeText(context, "Invalid username or password", Toast.LENGTH_LONG).show();
////                        }
//                    }
//                },
//                new Response.ErrorListener() {
//                    @Override
//                    public void onErrorResponse(VolleyError error) {
//                        //You can handle error here if you want
//                        hideDialog();
//                        Toast.makeText(context, "The server unreachable", Toast.LENGTH_LONG).show();
//
//                    }
//                }) {
//            @Override
//            protected Map<String, String> getParams() throws AuthFailureError {
//                Map<String, String> params = new HashMap<>();
//                //Adding parameters to request
//                params.put(Config.KEY_USERNAME, username);
//                params.put(Config.KEY_PASSWORD, password);
//
//                //returning parameter
//                return params;
//            }
//        };
//
//        //Adding the string request to the queue
//        Volley.newRequestQueue(this).add(stringRequest);
//
//    }
//
//    private void gotoCourseActivity() {
//        Intent intent = new Intent(context, MapsActivity.class);
//        startActivity(intent);
//        finish();
//    }
//
//    private void showDialog() {
//        if (!pDialog.isShowing())
//            pDialog.show();
//    }
//
//    private void hideDialog() {
//        if (pDialog.isShowing())
//            pDialog.dismiss();
//    }

    //Dibawah ini merupakan perintah untuk Login
    private void LoginIn(){

        final String username = txt_username.getText().toString();
        final String pass = txt_password.getText().toString().trim();

//        FirebaseMessaging.getInstance().subscribeToTopic("test");
//        FirebaseInstanceId.getInstance().getToken();

//        final String token = new String(FirebaseInstanceId.getInstance().getToken());


        class LoginIn extends AsyncTask<String,String,String> {

            ProgressDialog loading;

            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(LoginActivity.this,"Memuat...","Tunggu...",false,false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
//                loading.dismiss();
//                Toast.makeText(LoginActivity.this,s,Toast.LENGTH_LONG).show();
                // dari sini
                if (s.equals(TAG_SUCCESS)){
                    loading.dismiss();
//                    Log.i("token = ",token);

                    Log.e("user/pass","Username = ("+username+") Password = ("+pass+")");
                    Intent i = new Intent(LoginActivity.this,MainUserActivity.class);
                    SharedPreferences.Editor editor = getSharedPreferences("SP_USER", MODE_PRIVATE).edit();
                    editor.putString("username",username);
                    editor.apply();
                    startActivity(i);
                    Log.i("status","ok");
                }else {
                    loading.dismiss();
                    Toast.makeText(LoginActivity.this,s,Toast.LENGTH_LONG).show();
                    Log.i("status","fail");
                }
                // yg baru
            }

            @Override
            protected String doInBackground(String... args) {

                HashMap<String,String> params = new HashMap<>();

                params.put(Config.KEY_USERNAME,username);
                Log.d("username", username);
                params.put(Config.KEY_PASSWORD,pass);
                Log.d("password", pass);
//                params.put(Config.KEY_TOKEN,token);
//                Log.d("Token", token);


                //lama
                RequestHandler rh = new RequestHandler();
                String res = rh.sendPostRequest(URL_LOGIN, params);
                Log.e("url",URL_LOGIN);
                Log.i("poli",res);
                return res;
            }
        }

        LoginIn au = new LoginIn();
        au.execute();
    }
    // back butonn
    @Override
    public void onBackPressed(){
        finish();
        System.exit(0);
//        intent = new Intent(LoginActivity.this, AnonymousMapsActivity.class);
////                finish();
//        startActivity(intent);
    }
}
