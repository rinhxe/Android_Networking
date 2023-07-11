package com.example.lab24;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {
    public static final String SERVER_NAME = "http://192.168.0.105/vutt_ph28295/giaiphuongtrinh_POST.php";
    private EditText etA,etB,etC;
    private Button btnSend;
    private TextView tvResult;
    String stA,stB,stC;
    BackgroundTask_POST bPost;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        etA = findViewById(R.id.id_a);
        etB = findViewById(R.id.id_b);
        etC = findViewById(R.id.id_c);
        tvResult = findViewById(R.id.id_result);
        btnSend = findViewById(R.id.id_button);
        btnSend.setOnClickListener(this);
    }

    @Override
    public void onClick(View v) {
        stA=etA.getText().toString();
        stB=etB.getText().toString();
        stC=etC.getText().toString();
        bPost = new BackgroundTask_POST(this,tvResult);
        bPost.execute(stA,stB,stC);


    }
}