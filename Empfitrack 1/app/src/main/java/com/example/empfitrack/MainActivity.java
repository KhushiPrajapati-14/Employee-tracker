package com.example.empfitrack;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.example.empfitrack.ui.HomeActivity;
import com.example.empfitrack.ui.ProfileActivity;
import com.example.empfitrack.ui.ReminderActivity;
import com.example.empfitrack.ui.Timer;
import com.example.empfitrack.ui.constants;
import com.google.android.material.bottomnavigation.BottomNavigationItemView;
import com.google.android.material.bottomnavigation.BottomNavigationView;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity implements View.OnClickListener
{
    private EditText editTextUsername, editTextPassword;
    private Button buttonLogin;
    public static String employeename_put, gender_put, emailid_put, address_put;
    public static Integer username_put, phoneno_put;
    public static String timerusername;

    public static final String EXTRA_MESSAGE = "com.example.empfitrack.MESSAGE";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //   if(SharedPrefManager.getInstance(this).isLoggedIn())
          //  {
              //  finish();
               // startActivity(new Intent(this, ProfileActivity.class));
              //  return;
          //  }

            editTextUsername = (EditText) findViewById(R.id.Username);
            editTextPassword = (EditText) findViewById(R.id.Password);
            buttonLogin = (Button) findViewById(R.id.Login_button);
            buttonLogin.setOnClickListener(MainActivity.this);

        }

   private void userLogin() {
        final String username = editTextUsername.getText().toString().trim();
        timerusername = username;
        final String password = editTextPassword.getText().toString().trim();

        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                constants.URL_LOGIN,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject obj = new JSONObject(response);
                          //  Toast.makeText(getApplicationContext(), obj.getString("error"), Toast.LENGTH_LONG).show();
                         if (!obj.getBoolean("error")) {
                                    SharedPrefManager.getInstance(getApplicationContext())
                                            .userLogin(
                                                    obj.getString("username"), //response from php
                                                    obj.getString("password")
                                            );
                              Toast.makeText(getApplicationContext(), "you have successfully logged In", Toast.LENGTH_LONG).show();


                               startActivity(new Intent(MainActivity.this, HomeActivity.class));
                               // startActivity(home);   //Start home activity
                                Toast.makeText(getApplicationContext(), "now u have reached home page", Toast.LENGTH_LONG).show();


                                //storing values into public variables
                                //getting key values from php code
                               username_put= obj.getInt("username");
                               employeename_put=obj.getString("EmployeeName");
                               gender_put=obj.getString("Gender");
                               emailid_put=obj.getString("Email");
                               address_put=obj.getString("Address");
                               phoneno_put=obj.getInt("MobileNumber");


                            } else {
                                Toast.makeText(
                                        getApplicationContext(),
                                        obj.getString("message"),
                                        Toast.LENGTH_LONG
                                ).show();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                },

                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {

                     /*   Toast.makeText(
                                getApplicationContext(),
                                error.getMessage(),
                                Toast.LENGTH_LONG
                        ).show();

                      */
                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("EmployeeID", username); //puts the values in query
                params.put("Password", password);
                return params;
            }

        };

        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
    }

    @Override
    public void onClick(View v)
    {

            userLogin();

    }

}







