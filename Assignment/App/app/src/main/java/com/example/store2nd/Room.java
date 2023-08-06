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
    public String getRoomType(){
        switch (kind_of_room_id){
            case 1:{
                return "Phòng đơn";
            }
            case 2:{
                return "Phòng đôi";
            }
            case 3:{
                return "Phòng Gia Đình";
            }
            case 4:{
                return "Phòng Tổng Thống";
            }
            case 5:{
                return "Phòng Thủ Tướng";
            }
        }
        return null;
    }
    public int getRoomImage(){
        switch (kind_of_room_id){
            case 1:{
                return R.drawable.khachsan1;
            }
            case 2:{
                return R.drawable.khachsan2;
            }
            case 3:{
                return R.drawable.khachsan3;
            }
            case 4:{
                return R.drawable.khachsan4;
            }
            case 5:{
                return R.drawable.khachsan5;
            }
        }
        return 0;
    }

}
