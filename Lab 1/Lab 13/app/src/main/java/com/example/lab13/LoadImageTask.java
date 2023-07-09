package com.example.lab13;

import android.app.ProgressDialog;
import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;

import java.io.InputStream;
import java.net.URL;

public class LoadImageTask extends AsyncTask<String,Void, Bitmap> {

    private Listener mListener;
    private ProgressDialog progressDialog;
    public LoadImageTask(Listener listener, Context context){
        mListener = listener;
        progressDialog = new ProgressDialog(context);

    }

    @Override
    protected void onPreExecute() {
        super.onPreExecute();
        progressDialog.setMessage("Downloading..");
        progressDialog.show();
    }

    @Override
    protected void onPostExecute(Bitmap bitmap) {
        super.onPostExecute(bitmap);
        if (progressDialog.isShowing()){
            progressDialog.dismiss();
        }
        if (bitmap!=null){
            mListener.onImgLoaded(bitmap);

        }else {
            mListener.onError();
        }
    }

    @Override
    protected Bitmap doInBackground(String... strings) {
        try {
            return BitmapFactory.decodeStream((InputStream) new URL(strings[0]).getContent());
        }catch (Exception e){
            e.printStackTrace();
        }

        return null;
    }
}
