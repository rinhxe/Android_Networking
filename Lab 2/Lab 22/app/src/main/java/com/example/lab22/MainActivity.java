package com.example.lab22;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {
    public static final String SERVER_NAME = "http://192.168.0.105/vutt_ph28295/rectangle_POST.php";

    private EditText edW,edL;
    private Button btnSend;
    String stW,stL;
    private TextView tvResult;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        edW = findViewById(R.id.id_width);
        edL = findViewById(R.id.id_length);
        btnSend = findViewById(R.id.id_button);
        tvResult = findViewById(R.id.id_result);
        btnSend.setOnClickListener(this);

    }

    @Override
    public void onClick(View v) {
        stL = edL.getText().toString();
        stW = edW.getText().toString();
        BackgroundTask_POST backgroundTask_POST = new BackgroundTask_POST(this,stW,stL,tvResult);
        backgroundTask_POST.execute();

    }
}