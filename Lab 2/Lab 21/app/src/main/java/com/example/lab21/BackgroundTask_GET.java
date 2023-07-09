package com.example.lab21;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.widget.TextView;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class BackgroundTask_GET extends AsyncTask<Void,Void,Void> {
    String link = MainActivity.SERVER_NAME;
    TextView tvResult;
    String strName,strScore;
    String str;
    ProgressDialog pDialog;
    Context context;

    public BackgroundTask_GET( Context context,TextView tvResult, String strName, String strScore) {
        this.tvResult = tvResult;
        this.strName = strName;
        this.strScore = strScore;
        this.context = context;
    }

    @Override
    protected Void doInBackground(Void... voids) {
        link += "?name=" + this.strName +"&score="+this.strScore;
        try {
            URL url = new URL(link);
            HttpURLConnection urlConnection = (HttpURLConnection) url.openConnection();
            BufferedReader bfr = new BufferedReader(new InputStreamReader(urlConnection.getInputStream()));
            String line = "";
            StringBuffer sb = new StringBuffer();
            while ((line=bfr.readLine())!=null){
                sb.append(line);
            }
            str = sb.toString();
            urlConnection.disconnect();
        }catch (Exception e){
            e.printStackTrace();
        };

        return null;
    }

    @Override
    protected void onPreExecute() {
        super.onPreExecute();
        pDialog = new ProgressDialog(context);
        pDialog.setMessage("Sending");
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
        tvResult.setText(str);

    }
}
