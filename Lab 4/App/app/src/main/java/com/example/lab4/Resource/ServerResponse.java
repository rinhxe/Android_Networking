package com.example.lab4.Resource;

import com.example.lab4.Resource.User;

public class ServerResponse {
    private String result;
    private String message;
    private User user;
    public String getResult() {
        return result;
    }
    public String getMessage() {
        return message;
    }
    public User getUser() {
        return user;
    }
}
