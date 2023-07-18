package com.example.store2nd;

import androidx.appcompat.app.AppCompatActivity;

import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.widget.ListView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {
    public static String link = "http://192.168.0.105/duan/api.php";
    ListView listView;
    ArrayList<Room> liRoom = new ArrayList<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        String url = "http://192.168.0.105/duan/api.php";
        new GetDataTask().execute(url);
        Log.i("Send", String.valueOf(liRoom.size()));
        listView = (ListView) findViewById(R.id.id_listview);


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
                        Log.i("Data",data.getString("room_id"));
                        Log.i("Data",data.getString("name_room"));
                        Log.i("Data",data.getString("kind_of_room_id"));
                        Log.i("Data",data.getString("status"));

                        Room temp = new Room(Integer.parseInt(data.getString("room_id")),
                                data.getString("name_room"),
                                Integer.parseInt(data.getString("kind_of_room_id")),
                                data.getString("status"));

                        liRoom.add(temp);
                        Log.i("Send", String.valueOf(liRoom.size()));
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