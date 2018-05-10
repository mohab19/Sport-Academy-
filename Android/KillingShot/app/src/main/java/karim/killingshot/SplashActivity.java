package karim.killingshot;

import android.content.Intent;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.ImageView;
import android.widget.TextView;

import karim.killingshot.LoginActivity;
import karim.killingshot.R;

public class SplashActivity extends AppCompatActivity {
    private ImageView logo;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);
        logo = (ImageView) findViewById(R.id.logo);
        Animation splash_animation = AnimationUtils.loadAnimation(this, R.anim.transitions);
        logo.startAnimation(splash_animation);
        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                Intent login_intent = new Intent(SplashActivity.this,LoginActivity.class);
                startActivity(login_intent);
                finish();
            }
        },4000);




    }
}
