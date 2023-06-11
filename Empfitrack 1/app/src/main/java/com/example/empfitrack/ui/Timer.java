package com.example.empfitrack.ui;

import android.Manifest;
import android.annotation.SuppressLint;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.icu.util.TimeZone;
import android.location.Location;
import android.location.LocationManager;
import android.os.Bundle;
import android.os.Looper;
import android.provider.Settings;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

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
import java.util.HashMap;
import java.util.Map;
import java.util.TimerTask;

import kotlin.collections.LongIterator;

public class Timer extends AppCompatActivity
{
    TextView timerText;
    FusedLocationProviderClient mFusedLocationClient;
    int PERMISSION_ID = 44;
    Button stopStartButton;
    public int hours;
    public int seconds;
    public int minutes;
    public int rounded;
    public static Double Latitude,Longitude;
    public int Regularhours, Overtimehours,HoursWorked;
    java.util.Timer timer;
    TimerTask timerTask;
    Double time = 0.0;
    boolean timerStarted = false;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_timer);
        timerText = (TextView) findViewById(R.id.timerText);
        stopStartButton = (Button) findViewById(R.id.Button_startstop);
        timer = new java.util.Timer();
        mFusedLocationClient = LocationServices.getFusedLocationProviderClient(this);
    }

    public void backbutton_timer(View v)
    {
        startActivity(new Intent(Timer.this, HomeActivity.class));
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


    public void resetTapped(View view) {
        AlertDialog.Builder resetAlert = new AlertDialog.Builder(this);
        resetAlert.setTitle("Reset Timer");
        resetAlert.setMessage("Are you sure you want to reset the timer?");
        resetAlert.setPositiveButton("Reset", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                if (timerTask != null) {
                    timerTask.cancel();
                    setButtonUI("START", R.color.green); //we need green color
                    time = 0.0;
                    timerStarted = false;
                    timerText.setText(formatTime(0, 0, 0));
                }
            }
        });

        resetAlert.setNeutralButton("Cancel", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                //do nothing
            }
        });

        resetAlert.show();

    }

    public void startStopTapped(View view) {
        if (timerStarted == false)
        {
            timerStarted = true;
            setButtonUI("STOP", R.color.red);
            startTimer();
        }
        else
        {
            AlertDialog.Builder resetAlert1 = new AlertDialog.Builder(this);
            resetAlert1.setTitle("Stop timer");
            resetAlert1.setMessage("Are you sure you want to stop the timer?");
            resetAlert1.setPositiveButton("STOP", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            timerStarted = false;
                            setButtonUI("START", R.color.green);
                           // System.out.println("Fucnion called");
                           // getLastLocation();
                         //   System.out.println("Fucnion executed");
                            System.out.println(Latitude);
                            System.out.println(Longitude);
                            submit2(view);
                            hours();
                            submit(view);
                            timerTask.cancel();
                        }
                    });
                    resetAlert1.setNeutralButton("Cancel", new DialogInterface.OnClickListener()
                    {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            dialog.cancel();
                        }
                    });

                    resetAlert1.create();
                    resetAlert1.show();
        }
    }

    private void setButtonUI(String start, int color) {
        stopStartButton.setText(start);
        stopStartButton.setTextColor(ContextCompat.getColor(this, color));
    }

    private void startTimer() {
        timerTask = new TimerTask() {
            @Override
            public void run() {
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        time++;
                        timerText.setText(getTimerText());
                    }
                });
            }

        };
        timer.scheduleAtFixedRate(timerTask, 0, 1000);
    }


    private String getTimerText() {
         rounded = (int) Math.round(time);
         seconds = ((rounded % 86400) % 3600) % 60;
         minutes = ((rounded % 86400) % 3600) / 60;
         hours = ((rounded % 86400) / 3600);

        return formatTime(seconds, minutes, hours);

    }

    private String formatTime(int seconds, int minutes, int hours) {
        return String.format("%02d", hours) + " : " + String.format("%02d", minutes) + " : " + String.format("%02d", seconds);
    }


    public void hours()
    {
            HoursWorked = minutes;
        if (HoursWorked >= 8)
        {
            HoursWorked = HoursWorked - 8;
             Overtimehours = HoursWorked;
             Regularhours = 8;
        }
        else if (HoursWorked < 8)
        {
            Regularhours = HoursWorked;
            Overtimehours = 0;
        }

     }


    public void submit(View view) {
        String url = "http://192.168.43.109/Android/includes/Timer.php";
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

                String ovrHR = String.valueOf(Overtimehours);
                String regHR = String.valueOf(Regularhours);
                String cv = String.valueOf(HomeActivity.buttoncount);
                Map<String, String> map = new HashMap<>();
                map.put("RegularHR", regHR);
                map.put("OvertimeHR",ovrHR);
                map.put("EmployeeID", MainActivity.timerusername);
                map.put("CV",cv);
                System.out.println(map);
                return map;
            }
        };
        myrequest.add(stringRequest);
       // return void;
    }

    public void submit2(View v) {
        String url = "http://192.168.43.109/Android/includes/Location.php";
        RequestQueue myrequest = Volley.newRequestQueue(this);
        // StringRequest stringRequest = new StringRequest(Request.Method.POST, url, new Response.Listener<String>()
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
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {

                String latitude = String.valueOf(Latitude);
                String longitude = String.valueOf(Longitude);
                String cv = String.valueOf(HomeActivity.buttoncount);
                Map<String, String> map = new HashMap<>();
                map.put("Latitude", latitude);
                map.put("Longitude", longitude);
                map.put("EmployeeID", MainActivity.timerusername);
                map.put("CV", cv);
                System.out.println(map);
                return map;
            }
        };
        myrequest.add(stringRequest);
        // return void;
    }

}
