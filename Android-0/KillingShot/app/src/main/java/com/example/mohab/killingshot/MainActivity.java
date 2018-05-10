package com.example.mohab.killingshot;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

public class MainActivity extends AppCompatActivity {
    EditText EmailET , PasswordET;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        EmailET = (EditText)findViewById(R.id.Email);
        PasswordET = (EditText)findViewById(R.id.Password);
    }
    public void Login(View view)
    {
        String EmailValue = EmailET.getText().toString();
        String PasswordValue = PasswordET.getText().toString();
        String type = "login";
        BackgroundWorker BackgroundWorkerObject = new BackgroundWorker(this);
        BackgroundWorkerObject.execute(type,EmailValue,PasswordValue);
    }
}
