package com.example.store2nd;

import androidx.appcompat.app.AppCompatActivity;

import android.app.AlertDialog;
import android.app.Dialog;
import android.content.DialogInterface;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Spinner;
import android.widget.Toast;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {
    ListView listView;
    ArrayList<Room> liRoom = new ArrayList<>();
    public static String url = "http://192.168.1.109/duan/api.php";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        String apiUrl = url+"/get";
        new GetDataTask().execute(apiUrl);
        listView = (ListView) findViewById(R.id.id_listview);
        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.btnadd);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog.Builder builder = new AlertDialog.Builder(MainActivity.this);

                LayoutInflater inflater = getLayoutInflater();
                View customLayout = inflater.inflate(R.layout.dialog_item, null);
                builder.setView(customLayout);
                builder.setTitle("Thêm mới");


                EditText edname =(EditText) customLayout.findViewById(R.id.dl_roomName);
                final String[] rname = new String[1];
                final int[] rtype = {1};
                {
                    ArrayList<String> Roomtype = new ArrayList<String>();
                    Roomtype.add("Phòng Đơn");
                    Roomtype.add("Phòng Đôi");
                    Roomtype.add("Phòng Gia Đình");
                    Roomtype.add("Phòng Tổng Thống");
                    Roomtype.add("Phòng Thủ Tướng");
                    ArrayAdapter arrayAdapter = new ArrayAdapter(MainActivity.this, androidx.appcompat.R.layout.support_simple_spinner_dropdown_item, Roomtype);

                    Spinner rtSpinner = (Spinner) customLayout.findViewById(R.id.dl_roomType);
                    rtSpinner.setAdapter(arrayAdapter);
                    rtSpinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                        @Override
                        public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                            Toast.makeText(getApplicationContext(), i + ":" + l, Toast.LENGTH_SHORT).show();
                            rtype[0] =i+1;
                        }

                        @Override
                        public void onNothingSelected(AdapterView<?> adapterView) {

                        }
                    });
                }//spinner
                CheckBox cb= (CheckBox) customLayout.findViewById(R.id.dl_status);
                final String[] rStatus = new String[1];

                builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        if (cb.isChecked()) {
                            rStatus[0] ="Có%20thể%20sử%20dụng";} else rStatus[0] ="Bảo%20trì";
                        rname[0] = edname.getText().toString();
                         if (rname[0] !=null && rStatus[0] !=null && rtype!=null){
                             new AddRoomTask().execute(rname[0], String.valueOf(rtype[0]), rStatus[0]);
                             new GetDataTask().execute(apiUrl);
                             Toast.makeText(getApplicationContext(),"Add Done",Toast.LENGTH_SHORT).show();
                         }else Toast.makeText(getApplicationContext(),"Add Error",Toast.LENGTH_SHORT).show();
                    }
                });
                builder.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {


                    }
                });
                AlertDialog ad = builder.show();
            }
        });

    }
    private class GetDataTask extends AsyncTask<String, Void, JSONArray> {


        @Override
        protected JSONArray doInBackground(String... urls) {
            JSONArray result = null;
            String url = urls[0];

            try {
                result = DataFetcher.fetchData(url);
            } catch (IOException | JSONException e) {
                e.printStackTrace();
            }
            return result;
        }

        @Override
        protected void onPostExecute(JSONArray jsonArray) {
            if (jsonArray != null) {
                liRoom.clear();
                for (int i = 0; i < jsonArray.length(); i++) {
                    try {
                        JSONObject data = jsonArray.getJSONObject(i);
                        Room temp = new Room(Integer.parseInt(data.getString("room_id")),
                                data.getString("name_room"),
                                Integer.parseInt(data.getString("kind_of_room_id")),
                                data.getString("status"));
                        liRoom.add(temp);

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }
                Log.i("Send","Get data done");
                listView.setAdapter(new listviewAdapter(MainActivity.this,liRoom));

            } else {
                Log.i("Send","Get data error");
            }
        }
    }
}