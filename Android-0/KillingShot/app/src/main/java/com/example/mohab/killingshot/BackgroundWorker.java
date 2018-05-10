package com.example.mohab.killingshot;

import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;

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

/**
 * Created by Mohab on 7/10/2017.
 */

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
            String email = params[1];
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
                String data = URLEncoder.encode("email","UTF-8")+"="+URLEncoder.encode(email,"UTF-8")+"&"
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
        else if(type.equals("add_post"))
        {
            String body = params[1];
            String group_id = params[2];
            String post_type_id = params[3];
            String user_id = params[4];
            String login_url = "http://kssquashacademy.com/android/login";
            try {
                URL url = new URL(login_url);
                HttpURLConnection HttpURLConnectionObject = (HttpURLConnection) url.openConnection();
                HttpURLConnectionObject.setRequestMethod("POST");
                HttpURLConnectionObject.setDoOutput(true);
                HttpURLConnectionObject.setDoInput(true);
                OutputStream OutputStreamObject = HttpURLConnectionObject.getOutputStream();
                BufferedWriter BufferedWriterObject = new BufferedWriter(new OutputStreamWriter(OutputStreamObject,"UTF-8"));
                String data = URLEncoder.encode("body","UTF-8")+"="+URLEncoder.encode(body,"UTF-8")+"&"
                        + URLEncoder.encode("user_id","UTF-8")+"="+URLEncoder.encode(user_id,"UTF-8") +"&"
                        + URLEncoder.encode("group_id","UTF-8")+"="+URLEncoder.encode(group_id,"UTF-8") +"&"
                        + URLEncoder.encode("post_type_id","UTF-8")+"="+URLEncoder.encode(post_type_id,"UTF-8")
                        ;
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
        if(type.equals("login"))
        {
            if(result.equals("1"))
            {
                context.startActivity(new Intent(context, PostsActivity.class));
            }
            else
            {
                AlertDialogObject.setMessage("Wrong Email Or Password");
                AlertDialogObject.show();
            }
        }
        if(type.equals("add_post"))
        {
            if(result.equals("1"))
            {
                context.startActivity(new Intent(context, PostsActivity.class));
            }
            else
            {
                AlertDialogObject.setMessage("Please Fill All Fields Or Try Again");
                AlertDialogObject.show();
            }
        }


    }

    @Override
    protected void onProgressUpdate(Void... values) {
        super.onProgressUpdate(values);
    }


}

