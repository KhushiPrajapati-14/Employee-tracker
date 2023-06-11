package com.example.empfitrack.ui;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import androidx.appcompat.app.AppCompatActivity;

import com.example.empfitrack.MainActivity;
import com.example.empfitrack.R;
import com.example.empfitrack.SharedPrefManager;
import com.google.android.material.bottomnavigation.BottomNavigationView;

public class HomeActivity extends AppCompatActivity
{

    private Button task1,task2,task3,task4;
    private Button homebackbutton;
    public static TextView textviewtask1,textViewtask2,textviewtask3,textviewtask4;
    public static int buttoncount=0;
    String display1_1,display1_2,display1_3,display2_1,display2_2,display2_3,display3_1,display3_2,display3_3,
           display4_1,display4_2,display4_3;
    ReminderActivity get =  new ReminderActivity();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        task1 = (Button) findViewById(R.id.Task1_button);
        task2 = (Button) findViewById(R.id.Task2_button);
        task3 = (Button) findViewById(R.id.Task3_button);
        task4 = (Button) findViewById(R.id.Task4_button);

        textviewtask1 = (TextView) findViewById(R.id.Task1_textview);
        textViewtask2 = (TextView) findViewById(R.id.Task2_textview);
        textviewtask3 = (TextView) findViewById(R.id.Task3_textview);
        textviewtask4 = (TextView) findViewById(R.id.Task4_textview);

       display1_1= SharedPrefManager.getInstance(this).gettask1name();
       display1_2= SharedPrefManager.getInstance(this).gettask1time();
       display1_3= SharedPrefManager.getInstance(this).gettask1description();
       display2_1= SharedPrefManager.getInstance(this).gettask2name();
       display2_2= SharedPrefManager.getInstance(this).gettask2time();
       display2_3= SharedPrefManager.getInstance(this).gettask2description();
       display3_1= SharedPrefManager.getInstance(this).gettask3name();
       display3_2= SharedPrefManager.getInstance(this).gettask3time();
       display3_3= SharedPrefManager.getInstance(this).gettask3description();
       display4_1= SharedPrefManager.getInstance(this).gettask4name();
       display4_2= SharedPrefManager.getInstance(this).gettask4time();
       display4_3= SharedPrefManager.getInstance(this).gettask4description();

            if (get.textviewcount==1)
            {
            String ts1 = display1_1 + "\n" + display1_2 + "\n" + display1_3;
            textviewtask1.setText(ts1);
            }

            if (get.textviewcount == 2)
            {
                String ts1 = display1_1 + "\n" + display1_2 + "\n" + display1_3;
                textviewtask1.setText(ts1);
                String ts2 = display2_1 + "\n" + display2_2 + "\n" + display2_3;
                textViewtask2.setText(ts2);
            }

            if (get.textviewcount == 3)
            {
                String ts1 = display1_1 + "\n" + display1_2 + "\n" + display1_3;
                textviewtask1.setText(ts1);
                String ts2 = display2_1 + "\n" + display2_2 + "\n" + display2_3;
                textViewtask2.setText(ts2);
                String ts3 = display3_1 + "\n" + display3_2 + "\n" + display3_3;
                textviewtask3.setText(ts3);
            }

            if (get.textviewcount == 4)
            {
                String ts1 = display1_1 + "\n" + display1_2 + "\n" + display1_3;
                textviewtask1.setText(ts1);
                String ts2 = display2_1 + "\n" + display2_2 + "\n" + display2_3;
                textViewtask2.setText(ts2);
                String ts3 = display3_1 + "\n" + display3_2 + "\n" + display3_3;
                textviewtask3.setText(ts3);
                String ts4 = display4_1 + "\n" + display4_2 + "\n" + display4_3;
                textviewtask4.setText(ts4);
                get.textviewcount=0;
            }


        BottomNavigationView mainnavbar = (BottomNavigationView) findViewById(R.id.nav_view);
        mainnavbar.setSelectedItemId(R.id.navigation_home);
        mainnavbar.setOnNavigationItemSelectedListener((item) ->
        {
            switch (item.getItemId()) {
                case R.id.navigation_home:
                    startActivity(new Intent(HomeActivity.this, HomeActivity.class));
                    break;

                case R.id.navigation_Reminder:
                    startActivity(new Intent(HomeActivity.this, ReminderActivity.class));
                    break;

                case R.id.navigation_Profile:
                    startActivity(new Intent(HomeActivity.this, ProfileActivity.class));
                    break;
            }
            return false;
        });
    }
    public void backbutton_home(View v)
    {
        startActivity(new Intent(HomeActivity.this, MainActivity.class));
    }

    public void task(View view)
    {
        buttoncount++;
        Intent i = new Intent(HomeActivity.this,Timer.class);
        startActivity(i);
    }

}



