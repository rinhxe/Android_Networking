package com.example.lab12;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import java.io.IOException;
import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {
    private TextView tViewMessage;
    private ImageView iView;
    private Button button;
    private ProgressDialog progressDialog;
    private String url = "https://inkythuatso.com/uploads/thumbnails/800/2021/11/logo-fpt-inkythuatso-1-01-01-14-33-35.jpg";
    private Bitmap bitmap = null;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        tViewMessage = findViewById(R.id.actMain_tView2);
        iView = findViewById(R.id.actMain_iView);
        button = findViewById(R.id.actMain_button);

        button.setOnClickListener(this);
    }

    private Handler messageHandler = new Handler(){
      public void handleMessage(Message msg){
          super.handleMessage(msg);
          Bundle bundle = msg.getData();
          String message = bundle.getString("message");
          tViewMessage.setText(message);
          iView.setImageBitmap(bitmap);
          progressDialog.dismiss();

      }
    };

    @Override
    public void onClick(View v) {
        progressDialog = ProgressDialog.show(MainActivity.this,"","Downloading...");
        Runnable runnable = new Runnable() {
            @Override
            public void run() {
                bitmap = downloadImg(url);
                Message msg = messageHandler.obtainMessage();
                Bundle bundle = new Bundle();
                String threadMessage = "Image downloaded";
                msg.setData(bundle);
                messageHandler.sendMessage(msg);

            }


        };
        Thread thread = new Thread(runnable);
        thread.start();
    }

    private Bitmap downloadImg(String link){
        try {
            URL url = new URL(link);
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();
            connection.connect();
            InputStream inputStream = connection.getInputStream();
            Bitmap bmap = BitmapFactory.decodeStream(inputStream);
            return bmap;
        }catch (Exception e){
            e.printStackTrace();
        }


        return null;
    };
}