package karim.killingshot;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

public class LoginActivity extends AppCompatActivity {
    EditText UsernameET , PasswordET;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        UsernameET = (EditText)findViewById(R.id.Username);
        PasswordET = (EditText)findViewById(R.id.Password);
    }
    public void Login(View view)
    {
        String UsernameValue = UsernameET.getText().toString();
        String PasswordValue = PasswordET.getText().toString();
        String type = "login";
        BackgroundWorker BackgroundWorkerObject = new BackgroundWorker(this);
        BackgroundWorkerObject.execute(type,UsernameValue,PasswordValue);
    }
}
