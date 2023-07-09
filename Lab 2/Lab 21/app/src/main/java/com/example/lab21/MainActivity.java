package com.example.lab21;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    public static final String SERVER_NAME = "http://192.168.0.105/vutt_ph28295/student_GET.php";

    private EditText edName,edScore;
    private Button btnSend;
    private TextView tvResult;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        edName = findViewById(R.id.id_name);
        edScore = findViewById(R.id.id_score);
        tvResult = findViewById(R.id.id_result);
        btnSend = findViewById(R.id.id_button);
        btnSend.setOnClickListener(this);


    }

    @Override
    public void onClick(View v) {
        String eName = edName.getText().toString();
        String eScore = edScore.getText().toString();
        BackgroundTask_GET backgroundTask = new BackgroundTask_GET(this,tvResult,eName,eScore);
        Log.d("NAME", eName);
        backgroundTask.execute();

    }
}