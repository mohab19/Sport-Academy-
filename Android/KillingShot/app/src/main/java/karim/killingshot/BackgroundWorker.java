package karim.killingshot;

import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;

import karim.killingshot.MainActivity;

public class BackgroundWorker extends AsyncTask<String,Void,String> {

    Context context;
    AlertDialog AlertDialogObject;
    String type = "";
    BackgroundWorker(Context ctx)
    {
        context = ctx;
    }

    @Override
    protected String doInBackground(String... params) {
        type = params[0];
        String result = "";
        if(type.equals("login"))
        {
            String username = params[1];
            String password = params[2];
            String login_url = "http://kssquashacademy.com/android/login";
            try {
                URL url = new URL(login_url);
                HttpURLConnection HttpURLConnectionObject = (HttpURLConnection) url.openConnection();
                HttpURLConnectionObject.setRequestMethod("POST");
                HttpURLConnectionObject.setDoOutput(true);
                HttpURLConnectionObject.setDoInput(true);
                OutputStream OutputStreamObject = HttpURLConnectionObject.getOutputStream();
                BufferedWriter BufferedWriterObject = new BufferedWriter(new OutputStreamWriter(OutputStreamObject,"UTF-8"));
                String data = URLEncoder.encode("username","UTF-8")+"="+URLEncoder.encode(username,"UTF-8")+"&"
                        + URLEncoder.encode("password","UTF-8")+"="+URLEncoder.encode(password,"UTF-8") ;
                BufferedWriterObject.write(data);
                BufferedWriterObject.flush();
                BufferedWriterObject.close();
                OutputStreamObject.close();
                InputStream InputStreamObject = HttpURLConnectionObject.getInputStream();
                BufferedReader BufferReaderObject = new BufferedReader(new InputStreamReader(InputStreamObject,"UTF-8"));
                String line = "";
                while ((line = BufferReaderObject.readLine())!= null)
                {
                    result += line;
                }
                BufferReaderObject.close();
                InputStreamObject.close();
                HttpURLConnectionObject.disconnect();
            } catch (MalformedURLException e) {
                result = "MalformedURLException: " + e.getMessage();
            } catch (IOException e) {
                result = "IOException: " + e.getMessage();
            }
        }
        return result;
    }

    @Override
    protected void onPreExecute() {
        AlertDialogObject = new AlertDialog.Builder(context).create();
        AlertDialogObject.setTitle("Login Status");
    }

    @Override
    protected void onPostExecute(String result) {
String username = "";
        JSONArray jsonArray= null;
        try {
            jsonArray = new JSONArray(result);
            for(int i=0; i<jsonArray.length();i++){
                JSONObject jsonData=jsonArray.getJSONObject(i);
                //first_name=jsonData.getString("first_name");
                //last_name=jsonData.getString("last_name");
                username=jsonData.getString("username");
                //note=jsonData.getString("note");
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }

        AlertDialogObject.setMessage(username);
        AlertDialogObject.show();
//        if(type.equals("login"))
//        {
//            if(result.equals("1"))
//            {
//                context.startActivity(new Intent(context, PublicPostsActivity.class));
//            }
//            else
//            {
//                AlertDialogObject.setMessage("Wrong Username Or Password");
//                AlertDialogObject.show();
//            }
//        }
//        if(type.equals("add_post"))
//        {
//            if(result.equals("1"))
//            {
//                context.startActivity(new Intent(context, PostsActivity.class));
//            }
//            else
//            {
//                AlertDialogObject.setMessage("Please Fill All Fields Or Try Again");
//                AlertDialogObject.show();
//            }
//        }


    }

    @Override
    protected void onProgressUpdate(Void... values) {
        super.onProgressUpdate(values);
    }


}

