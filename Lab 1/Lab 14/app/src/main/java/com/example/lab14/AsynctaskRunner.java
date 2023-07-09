package com.example.lab14;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.widget.EditText;
import android.widget.TextView;

public class AsynctaskRunner  extends AsyncTask<String,String,String> {
    private String resp;
    ProgressDialog dialog;
    TextView res;
    EditText time;
    Context context;

    public AsynctaskRunner (Context context, TextView tvResult, EditText time) {
        this.res = tvResult;
        this.context =  context;
        this.time = time;
    }

    @Override
    protected void onPreExecute() {
        super.onPreExecute();
        super.onPreExecute();
        dialog = ProgressDialog.show(context, "ProgressDialog", "Wait for "
                       + time.getText().toString() + " seconds");

    }

    @Override
    protected String doInBackground(String... strings) {
        publishProgress ("Sleeping...");
        try {
            int time = Integer.parseInt(strings[0]) * 1000; Thread.sleep(time);
            resp = "Slept for " + strings[0]+" seconds"; }
        catch (Exception e) {
            e.printStackTrace();
            resp= e.getMessage();
        }
        return resp;

    }

    @Override
    protected void onPostExecute(String s) {
        super.onPostExecute(s);
        if (dialog.isShowing()){
            dialog.dismiss();
        }
      //  res.setText(s);
    }
}
