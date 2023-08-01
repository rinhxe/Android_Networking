package com.example.socketio;

import androidx.appcompat.app.AppCompatActivity;

import android.net.Uri;
import android.os.Bundle;
import android.util.Log;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;

import org.json.JSONObject;

import java.net.URISyntaxException;
import java.util.ArrayList;

import io.socket.client.IO;
import io.socket.client.Socket;
import io.socket.emitter.Emitter;

public class MainActivity extends AppCompatActivity {
    Button btnLogin,btnChat;
    EditText edMessage;
    ArrayList<String> chatArr = new ArrayList<>();
    private String serverURL="https://192.168.0.103:3000/";
    private Socket _socket;
    {
        try {
            _socket = IO.socket(serverURL);
        }catch (URISyntaxException e){
            throw new RuntimeException(e);
        }
    }

    public Socket get_socket(){
        return _socket;
    }


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        btnLogin=findViewById(R.id.btnLogin);
        btnChat=findViewById(R.id.btnChat);
        _socket.connect();
        _socket.on("receiver_message",onNewMessage);
        LinearLayout linearLayoutList = findViewById(R.id.linear_layout_list);
        for (String item : chatArr) {
            TextView textView = new TextView(this);
            textView.setText(item);
            linearLayoutList.addView(textView);
        }
    }
    public void chat(){
        _socket.emit("",edMessage.getText().toString());
    }

    public void login(){
        _socket.emit("user_login",edMessage.getText().toString());
    }

    private Emitter.Listener onNewMessage = new Emitter.Listener() {
        @Override
        public void call(Object... args) {
            runOnUiThread(new Runnable() {
                @Override
                public void run() {
                    JSONObject data = (JSONObject) args[0];
                    String message;
                    message = data.optString("data");
                    chatArr.add(message);
                    Log.d("Chat","==> "+message);
                }
            });
        }
    };

}