package com.example.lab4;

import com.example.lab4.Resource.ServerRequest;
import com.example.lab4.Resource.ServerResponse;

import retrofit.Call;
import retrofit.http.Body;
import retrofit.http.POST;

public interface RequestInterface {
    @POST("learn-login-register/")
    Call<ServerResponse> operation(@Body ServerRequest request);
}
