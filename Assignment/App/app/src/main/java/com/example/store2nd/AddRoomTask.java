package com.example.store2nd;

import android.os.AsyncTask;
import android.util.Log;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class AddRoomTask extends AsyncTask<String, Void, String> {

    private static final String TAG = "AddRoomTask";

    @Override
    protected String doInBackground(String... params) {
        String result = "";
        String roomName = params[0];
        int roomType = Integer.parseInt(params[1]);
        String Status = params[2];
        try {
            String mainUrl = MainActivity.url;
            String apiUrl = mainUrl+"/add?roomName="+roomName+"&kindOfRoomId="+roomType+"&status="+Status;
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