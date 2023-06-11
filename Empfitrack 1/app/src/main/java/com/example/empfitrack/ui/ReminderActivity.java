 package com.example.empfitrack.ui;

import android.content.Intent;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.RequestQueue;
import com.example.empfitrack.MainActivity;
import com.example.empfitrack.R;
import com.example.empfitrack.SharedPrefManager;
import com.google.android.material.bottomnavigation.BottomNavigationView;

import java.util.ArrayList;

public class ReminderActivity extends AppCompatActivity implements View.OnClickListener {

    public static ArrayAdapter<String> adapter;
    private EditText editTextTaskname, editTextTasktime, editTextTaskdescription;
    private Button buttonSetreminder;
    public static String tasknameinput, tasktimeinput, taskdescriptioninput;
    public static String st1,st2,st3;
    public static int textviewcount;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reminder);

        editTextTaskname = (EditText) findViewById(R.id.TaskName_edittext);
        editTextTasktime = (EditText) findViewById(R.id.TaskTime_edittext);
        editTextTaskdescription = (EditText) findViewById(R.id.TaskDescription_edittext);
        buttonSetreminder = (Button) findViewById(R.id.SetReminder_button);

        buttonSetreminder.setOnClickListener(this);

        editTextTaskname.addTextChangedListener(setreminder);
        editTextTasktime.addTextChangedListener(setreminder);
        editTextTaskdescription.addTextChangedListener(setreminder);


        BottomNavigationView mainnavbar = (BottomNavigationView) findViewById(R.id.nav_view);
        mainnavbar.setSelectedItemId(R.id.navigation_home);
        mainnavbar.setOnNavigationItemSelectedListener((item) ->
        {
            switch (item.getItemId()) {
                case R.id.navigation_home:
                    startActivity(new Intent(ReminderActivity.this, HomeActivity.class));
                    break;

                case R.id.navigation_Reminder:
                    startActivity(new Intent(ReminderActivity.this, ReminderActivity.class));
                    break;

                case R.id.navigation_Profile:
                    startActivity(new Intent(ReminderActivity.this, ProfileActivity.class));
                    break;
            }

            return false;
        });

    }

    public void backbutton_reminder(View v)
    {
        startActivity(new Intent(ReminderActivity.this, HomeActivity.class));
    }


    private TextWatcher setreminder=new TextWatcher() {
        @Override
        public void beforeTextChanged(CharSequence s, int start, int count, int after)
        {

        }

        @Override
        public void onTextChanged(CharSequence s, int start, int before, int count)
        {
            tasknameinput = editTextTaskname.getText().toString().trim();
            tasktimeinput = editTextTasktime.getText().toString().trim();
            taskdescriptioninput = editTextTaskdescription.getText().toString().trim();

            buttonSetreminder.setEnabled(!tasknameinput.isEmpty() && !tasktimeinput.isEmpty() && !taskdescriptioninput.isEmpty());

        }

        @Override
        public void afterTextChanged(Editable s) {

        }
    };

    @Override
        public void onClick(View v)
    {

        st1=tasknameinput;
        st2=tasktimeinput;
        st3=taskdescriptioninput;

        if(textviewcount==0)
        {
            SharedPrefManager.getInstance(getApplicationContext())
                    .task1details(st1, st2, st3);
        }
        if(textviewcount==1)
        {

            SharedPrefManager.getInstance(getApplicationContext())
                    .task2details(st1, st2, st3);
        }
        if(textviewcount==2)
        {
            SharedPrefManager.getInstance(getApplicationContext())
                    .task3details(st1, st2, st3);
        }
        if(textviewcount==3)
        {
            SharedPrefManager.getInstance(getApplicationContext())
                    .task4details(st1, st2, st3);
        }

        editTextTaskname.setText("");
        editTextTasktime.setText("");
        editTextTaskdescription.setText("");

        textviewcount++;

    }

}

