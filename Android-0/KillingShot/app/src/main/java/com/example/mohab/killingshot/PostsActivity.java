package com.example.mohab.killingshot;

import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.EditText;

public class PostsActivity extends AppCompatActivity {
EditText body_et,user_id_et,group_id_et,post_type_id_et;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_posts);
        body_et = (EditText)findViewById(R.id.add_post_body);
        user_id_et = (EditText)findViewById(R.id.auth_user_id);
        group_id_et = (EditText)findViewById(R.id.add_post_group_id);
        post_type_id_et = (EditText)findViewById(R.id.add_post_post_type_id);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
            }
        });
    }
    public void AddPost(View view)
    {
        String body_value = body_et.getText().toString();
        String user_id_value = user_id_et.getText().toString();
        String group_id_value = group_id_et.getText().toString();
        String post_type_id_value = post_type_id_et.getText().toString();
        String type = "add_post";
        BackgroundWorker BackgroundWorkerObject = new BackgroundWorker(this);
        BackgroundWorkerObject.execute(type,body_value,user_id_value,group_id_value,post_type_id_value);
    }

}
