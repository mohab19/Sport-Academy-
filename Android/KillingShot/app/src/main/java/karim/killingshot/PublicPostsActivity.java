package karim.killingshot;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;

public class PublicPostsActivity extends AppCompatActivity {
String JSON_STRING;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_public_posts);
    }

    public void GetJson(View view) {
    }
}
