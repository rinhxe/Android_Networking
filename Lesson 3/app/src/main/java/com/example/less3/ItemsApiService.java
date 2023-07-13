package com.example.less3;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.GET;

public interface ItemsApiService {
    @GET("photos")
    Call<List<Items>> getItems();
}
