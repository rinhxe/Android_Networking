package com.example.store2nd;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;

public class listviewAdapter extends BaseAdapter {
    ArrayList<Room> liRoom ;
    Context context;
    int[] imageId;


    public listviewAdapter(Context context,ArrayList<Room> liRoom) {
        this.liRoom = liRoom;
        this.context = context;
    }

    @Override
    public int getCount() {
        return liRoom.size();
    }
    @Override
    public Object getItem(int position) {
        return position;
    }
    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        LayoutInflater inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
        View rowView = inflater.inflate(R.layout.listview_item, parent, false);

        TextView tvID = (TextView) rowView.findViewById(R.id.tvRoomID);
        tvID.setText("Room ID: "+String.valueOf(liRoom.get(position).getRoom_id()));
        TextView tvName = (TextView) rowView.findViewById(R.id.tvRoomName);
        tvName.setText("Room Name: "+String.valueOf(liRoom.get(position).getName_room()));
        TextView tvType = (TextView) rowView.findViewById(R.id.tvRoomType);
        tvType.setText("Room Slot: "+String.valueOf(liRoom.get(position).getKind_of_room_id()));
        TextView tvStatus = (TextView) rowView.findViewById(R.id.tvRoomStatuss);
        tvStatus.setText("Room Status: "+String.valueOf(liRoom.get(position).getStatus()));



        return rowView;
    }


}