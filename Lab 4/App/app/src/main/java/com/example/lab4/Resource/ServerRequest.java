package com.example.lab4.Resource;

import com.example.lab4.Resource.User;

public class ServerRequest {
    private String operation;
    private User user;
    public void setOperation(String operation) {
        this.operation = operation;
    }
    public void setUser(User user) {
        this.user = user;
    }
}
