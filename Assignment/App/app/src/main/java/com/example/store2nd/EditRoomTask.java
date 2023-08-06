package com.example.store2nd;

import android.os.AsyncTask;
import android.util.Log;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class EditRoomTask extends AsyncTask<String, Void, String> {

    private static final String TAG = "ERoomTask";

    @Override
    protected String doInBackground(String... params) {
        String result = "";
        int id= Integer.parseInt(params[0]);
        String roomName = params[1];
        int roomType = Integer.parseInt(params[2]);
        String Status = params[3];
        try {
            String mainUrl = MainActivity.url;
            String apiUrl = mainUrl+"/edit?roomId="+id+"&roomName="+roomName+"&kindOfRoomId="+roomType+"&status="+Status;
            Log.e(TAG, apiUrl);
            URL url = new URL(apiUrl);
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();

            BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream()));
            String line;
            while ((line = reader.readLine()) != null) {
                result += line;
            }

            reader.close();
            connection.disconnect();
        } catch (Exception e) {
            Log.e(TAG, "Error: " + e.getMessage());
        }

        return result;
    }

    @Override
    protected void onPostExecute(String result) {
        Log.d(TAG, "Response: " + result);
    }
}