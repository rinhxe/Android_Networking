package com.example.lab13;

import androidx.appcompat.app.AppCompatActivity;

import android.graphics.Bitmap;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity implements View.OnClickListener,Listener {
    private TextView tViewMessage;
    private ImageView iView;
    private Button button;
    private String IMG_URL = "https://inkythuatso.com/uploads/thumbnails/800/2021/11/logo-fpt-inkythuatso-1-01-01-14-33-35.jpg";
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

                new LoadImageTask(this,this).execute(IMG_URL);

    }

    @Override
    public void onImgLoaded(Bitmap bitmap) {
        iView.setImageBitmap(bitmap);
        tViewMessage.setText("Loaded");
    }

    @Override
    public void onError() {
    tViewMessage.setText("Error");
    }
}