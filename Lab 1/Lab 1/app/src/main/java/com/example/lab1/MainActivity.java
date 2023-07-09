package com.example.lab1;

import androidx.appcompat.app.AppCompatActivity;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import java.io.IOException;
import java.net.URL;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    private TextView tViewMessage;
    private ImageView iView;
    private Button button;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        tViewMessage = findViewById(R.id.actMain_tView2);
        iView = findViewById(R.id.actMain_iView);
        button = findViewById(R.id.actMain_button);

        button.setOnClickListener(this);


    }

    @Override
    public void onClick(View v) {
        final Thread thread = new Thread(new Runnable() {
            @Override
            public void run() {
                final  Bitmap bitmap = loadImageInternet("https://inkythuatso.com/uploads/thumbnails/800/2021/11/logo-fpt-inkythuatso-1-01-01-14-33-35.jpg");
                iView.post(new Runnable() {
                    @Override
                    public void run() {
                        tViewMessage.setText("Image loaded");
                        iView.setImageBitmap(bitmap);
                    }
                });
            }
        });
    thread.start();

    }

    private Bitmap loadImageInternet(String link){
        Bitmap bitmap= null;
        URL url;
        try {
            url = new URL(link);
            bitmap = BitmapFactory.decodeStream(url.openConnection().getInputStream());
        }catch (IOException e){
            e.printStackTrace();
        }


        return bitmap;
    }
}