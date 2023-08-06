package com.example.store2nd;

import android.os.AsyncTask;
import android.util.Log;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class DeleteRoomTask extends AsyncTask<String, Void, String> {

    private static final String TAG = "DeleteRoomTask";

    @Override
    protected String doInBackground(String... params) {
        String result = "";
        int roomId = Integer.parseInt(params[0]);

        try {
            String mainUrl = MainActivity.url;
            String apiUrl = mainUrl+"/delete?room_id=" + roomId;

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

        // Handle the response from the server here
        // You might want to update your UI or perform other actions based on the response
    }
}