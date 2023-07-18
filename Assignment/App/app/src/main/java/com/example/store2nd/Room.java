package com.example.store2nd;

public class Room {
    private int room_id;
    private String name_room;
    private int kind_of_room_id;
    private String status;

    public Room(int room_id, String name_room, int kind_of_room_id, String status) {
        this.room_id = room_id;
        this.name_room = name_room;
        this.kind_of_room_id = kind_of_room_id;
        this.status = status;
    }

    public int getRoom_id() {
        return room_id;
    }

    public void setRoom_id(int room_id) {
        this.room_id = room_id;
    }

    public String getName_room() {
        return name_room;
    }

    public void setName_room(String name_room) {
        this.name_room = name_room;
    }

    public int getKind_of_room_id() {
        return kind_of_room_id;
    }

    public void setKind_of_room_id(int kind_of_room_id) {
        this.kind_of_room_id = kind_of_room_id;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}
