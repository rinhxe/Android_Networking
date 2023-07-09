package com.example.lab22;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.widget.ProgressBar;
import android.widget.TextView;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

public class BackgroundTask_POST extends AsyncTask<Void,Void,Void> {
    String link = MainActivity.SERVER_NAME;
    Context context;
    String stW,stL;
    TextView tvResult;
    ProgressDialog pDialog;
    String strResult;

    public BackgroundTask_POST(Context context, String stW, String stL, TextView tvResult) {
        this.context = context;
        this.stW = stW;
        this.stL = stL;
        this.tvResult = tvResult;
    }

    @Override
    protected Void doInBackground(Void... voids) {
        try {
            URL url = new URL(link);
            String param = "chieurong=" + URLEncoder.encode(stW,"utf-8") + "&chieudai="
                    + URLEncoder.encode(stL,"utf-8");
            HttpURLConnection urlConnection = (HttpURLConnection) url.openConnection();
            urlConnection.setDoOutput(true);
            urlConnection.setRequestMethod("POST");
            urlConnection.setFixedLengthStreamingMode(param.getBytes().length);
            urlConnection.setRequestProperty("Content-Type","application/x-www-form-urlencoded");

            PrintWriter print = new PrintWriter(urlConnection.getOutputStream());
            print.print(param);
            print.close();
            String line ="";
            BufferedReader bfr = new BufferedReader(new InputStreamReader(urlConnection.getInputStream()));
            StringBuffer sb = new StringBuffer();
            while((line=bfr.readLine())!=null){
                sb.append(line);

            }
            strResult = sb.toString();
            urlConnection.disconnect();

        }catch (Exception e){
            e.printStackTrace();
        }


        return null;


    }

    @Override
    protected void onPreExecute() {
        super.onPreExecute();
        pDialog = new ProgressDialog(context);
        pDialog.setMessage("Calculating...");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(false);
        pDialog.show();
    }

    @Override
    protected void onPostExecute(Void unused) {
        super.onPostExecute(unused);
        if (pDialog.isShowing()){
            pDialog.dismiss();
        }
        tvResult.setText(strResult);
    }
}
