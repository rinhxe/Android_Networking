package com.example.fb2;
import android.text.TextUtils;
import android.util.Log;

import androidx.annotation.NonNull;

import com.google.firebase.messaging.FirebaseMessaging;
import com.google.firebase.messaging.FirebaseMessagingService;

import java.util.concurrent.atomic.AtomicReference;

public class MyFirebaseInstanceIDService extends FirebaseMessagingService {
    private static final String TAG = "MyFirebaseIIDService";

    @Override
    public void onNewToken(@NonNull String token) {
        super.onNewToken(token);
        AtomicReference<String> refreshedToken= new AtomicReference<>("");
        FirebaseMessaging.getInstance().getToken().addOnSuccessListener(tokenn -> {
            if (!TextUtils.isEmpty(tokenn)) {
                Log.d(TAG, "retrieve token successful : " + tokenn);
                refreshedToken.set(tokenn);
            } else{
                Log.w(TAG, "token should not be null...");
            }
        });
        Log.e(TAG, "Refreshed token: " + refreshedToken);
        sendRegistrationToServer(refreshedToken.get());
    }

    private void sendRegistrationToServer(String token) {

    }
}
