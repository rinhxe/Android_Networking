package com.example.lab13;

import android.graphics.Bitmap;

public interface Listener {
    void onImgLoaded(Bitmap bitmap);
    void onError();
}
