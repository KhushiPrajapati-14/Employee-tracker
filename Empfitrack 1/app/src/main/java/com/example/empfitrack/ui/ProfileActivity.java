package com.example.empfitrack.ui;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;

import android.Manifest;
import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationManager;
import android.os.Bundle;
import android.os.Looper;
import android.provider.Settings;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.empfitrack.MainActivity;
import com.example.empfitrack.R;
import com.google.android.gms.location.FusedLocationProviderClient;
import com.google.android.gms.location.LocationCallback;
import com.google.android.gms.location.LocationRequest;
import com.google.android.gms.location.LocationResult;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.android.material.bottomnavigation.BottomNavigationView;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.HashMap;
import java.util.Map;

import static com.example.empfitrack.ui.Timer.Latitude;
import static com.example.empfitrack.ui.Timer.Longitude;

public class ProfileActivity extends AppCompatActivity implements View.OnClickListener {


    private TextView textViewEmployeeID, textViewEmployeeName, textViewGender, textViewEmailID, textViewAddress, textViewPhoneNo;
    private Button buttonlogout;
    private Button markattendance;
    public View v3;
    public String dateTime;
    FusedLocationProviderClient mFusedLocationClient;
    int PERMISSION_ID = 44;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);  //set content of activity

        //Create textviews to display details
        textViewEmployeeID = (TextView) findViewById(R.id.EmployeeID_textview1);
        textViewEmployeeName = (TextView) findViewById(R.id.Employeename_textview1);
        textViewGender = (TextView) findViewById(R.id.Gender_textview1);
        textViewEmailID = (TextView) findViewById(R.id.EmailID_textview1);
        textViewAddress = (TextView) findViewById(R.id.Address_textview1);
        textViewPhoneNo = (TextView) findViewById(R.id.PhoneNo_edittext);

        buttonlogout = (Button) findViewById(R.id.Logout_button);
        buttonlogout.setOnClickListener(ProfileActivity.this);

        mFusedLocationClient = LocationServices.getFusedLocationProviderClient(this);
        markattendance = (Button) findViewById(R.id.MarkAttendance_button);
        markattendance.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)

            {
                getLastLocation();
                System.out.println(Latitude);
                System.out.println(Longitude);
                submit3(v3);
            }
        });

        Calendar calendar = Calendar.getInstance();
        SimpleDateFormat simpleDateFormat = new SimpleDateFormat( "hh:mm:ss");
        dateTime = simpleDateFormat.format(calendar.getTime());


        //Display content on textview
        textViewEmployeeID.setText(MainActivity.username_put.toString());
        textViewEmployeeName.setText(MainActivity.employeename_put);
        textViewEmailID.setText(MainActivity.emailid_put);
        textViewGender.setText(MainActivity.gender_put);
        textViewAddress.setText(MainActivity.address_put);
        textViewPhoneNo.setText(MainActivity.phoneno_put.toString());

        BottomNavigationView mainnavbar = (BottomNavigationView) findViewById(R.id.nav_view);
        mainnavbar.setSelectedItemId(R.id.navigation_Profile);
        mainnavbar.setOnNavigationItemSelectedListener((item) ->
        {
            switch (item.getItemId()) {
                    case R.id.navigation_home:
                        startActivity(new Intent(ProfileActivity.this, HomeActivity.class));
                        break;

                    case R.id.navigation_Reminder:
                        startActivity(new Intent(ProfileActivity.this, ReminderActivity.class));
                        break;

                    case R.id.navigation_Profile:
                        startActivity(new Intent(ProfileActivity.this, ProfileActivity.class));
                        break;
            }

            return false;
        });


    }

    @SuppressLint("MissingPermission")
    public void getLastLocation()
    {
        if (checkPermissions())
        {
            if (isLocationEnabled())
            {
                mFusedLocationClient.getLastLocation().addOnCompleteListener(new OnCompleteListener<Location>()
                {
                    @Override
                    public void onComplete(@NonNull Task<Location> task)
                    {
                        Location location = task.getResult();
                        if (location == null)
                        {
                            requestNewLocationData();
                        } else
                        {
                            Latitude= location.getLatitude();
                            Longitude  =location.getLongitude();
                            System.out.println(Latitude);
                            System.out.println(Longitude);
                        }
                    }
                });
            } else {
                Toast.makeText(this, "Please turn on" + " your location...", Toast.LENGTH_LONG).show();
                Intent intent = new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
                startActivity(intent);
            }
        } else {
            requestPermissions();
        }
    }

    @SuppressLint("MissingPermission")
    private void requestNewLocationData() {
        LocationRequest mLocationRequest = new LocationRequest();
        mLocationRequest.setPriority(LocationRequest.PRIORITY_HIGH_ACCURACY);
        mLocationRequest.setInterval(5);
        mLocationRequest.setFastestInterval(0);
        mLocationRequest.setNumUpdates(1);

        // setting LocationRequest
        // on FusedLocationClient
        mFusedLocationClient = LocationServices.getFusedLocationProviderClient(this);
        mFusedLocationClient.requestLocationUpdates(mLocationRequest, mLocationCallback, Looper.myLooper());
    }

    private LocationCallback mLocationCallback = new LocationCallback() {

        @Override
        public void onLocationResult(LocationResult locationResult) {
            Location mLastLocation = locationResult.getLastLocation();
            //  longitTextView.setText("Longitude: " + mLastLocation.getLongitude() + "");
        }
    };

    // method to check for permissions
    private boolean checkPermissions() {
        return ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) == PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED;
    }

    // method to request for permissions
    private void requestPermissions() {
        ActivityCompat.requestPermissions(this, new String[]{
                Manifest.permission.ACCESS_COARSE_LOCATION,
                Manifest.permission.ACCESS_FINE_LOCATION}, PERMISSION_ID);
    }

    // method to check
    // if location is enabled
    private boolean isLocationEnabled() {
        LocationManager locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        return locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER) || locationManager.isProviderEnabled(LocationManager.NETWORK_PROVIDER);
    }

    // If everything is alright then
    @Override
    public void
    onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);

        if (requestCode == PERMISSION_ID) {
            if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                getLastLocation();
            }
        }
    }

    @Override
    public void onResume() {
        super.onResume();
        if (checkPermissions()) {
            getLastLocation();
        }
    }


    public void submit3(View v3)
    {
        String url = "http://192.168.43.109/Android/includes/SODLocation.php";
        RequestQueue myrequest = Volley.newRequestQueue(this);
        StringRequest stringRequest = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Toast.makeText(getApplicationContext(), response, Toast.LENGTH_LONG).show();
            }
        },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), error.getMessage().toString(), Toast.LENGTH_LONG).show();
                    }
                })


        {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {

                String latitude = String.valueOf(Latitude);
                String longitude = String.valueOf(Longitude);
                String time = String.valueOf(dateTime);
                Map<String, String> map = new HashMap<>();
                map.put("LocationLatitude",latitude); //put the values in php file and file will send it to the database
                map.put("LocationLongitude",longitude);
                map.put("Time",time);
                map.put("EmployeeID", MainActivity.timerusername);
                System.out.println(map);
                return map;
            }
        };


        myrequest.add(stringRequest);
        // return void;
    }
    public void backbutton_profile(View v)
    {
        startActivity(new Intent(ProfileActivity.this, ReminderActivity.class));
    }

        @Override
        public void onClick (View v) //for logout button
        {
            Intent in = new Intent(ProfileActivity.this, MainActivity.class);
            startActivity(in);
        }

      //  public static class Reminder {
            // Set the reminder
       // }


}
