package com.example.store2nd;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.BaseAdapter;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Spinner;
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

        ImageView imgV = rowView.findViewById(R.id.imgAvatatr);
        imgV.setImageResource(liRoom.get(position).getRoomImage());
        TextView tvID = (TextView) rowView.findViewById(R.id.tvRoomID);
        tvID.setText("ID: "+String.valueOf(liRoom.get(position).getRoom_id()));
        TextView tvName = (TextView) rowView.findViewById(R.id.tvRoomName);
        tvName.setText("Name: "+String.valueOf(liRoom.get(position).getName_room()));
        TextView tvType = (TextView) rowView.findViewById(R.id.tvRoomType);
        tvType.setText("Type: "+String.valueOf(liRoom.get(position).getRoomType()));
        TextView tvStatus = (TextView) rowView.findViewById(R.id.tvRoomStatuss);
        tvStatus.setText("Status: "+String.valueOf(liRoom.get(position).getStatus()));

        ImageView edit = rowView.findViewById(R.id.li_edit);
        ImageView delete = rowView.findViewById(R.id.li_delete);
        edit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog.Builder builder = new AlertDialog.Builder(context);

                LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
                View customLayout = inflater.inflate(R.layout.dialog_item, null);
                builder.setView(customLayout);
                builder.setTitle("Thêm mới");


                EditText edname =(EditText) customLayout.findViewById(R.id.dl_roomName);
                final String[] rname = new String[1];
                final int[] rtype = {1};
                {
                    ArrayList<String> Roomtype = new ArrayList<String>();
                    Roomtype.add("Phòng Đơn");
                    Roomtype.add("Phòng Đôi");
                    Roomtype.add("Phòng Gia Đình");
                    Roomtype.add("Phòng Tổng Thống");
                    Roomtype.add("Phòng Thủ Tướng");
                    ArrayAdapter arrayAdapter = new ArrayAdapter(context, androidx.appcompat.R.layout.support_simple_spinner_dropdown_item, Roomtype);

                    Spinner rtSpinner = (Spinner) customLayout.findViewById(R.id.dl_roomType);
                    rtSpinner.setAdapter(arrayAdapter);
                    rtSpinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                        @Override
                        public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                            Toast.makeText(context, i + ":" + l, Toast.LENGTH_SHORT).show();
                            rtype[0] =i+1;
                        }

                        @Override
                        public void onNothingSelected(AdapterView<?> adapterView) {

                        }
                    });
                }//spinner
                CheckBox cb= (CheckBox) customLayout.findViewById(R.id.dl_status);
                final String[] rStatus = new String[1];

                builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        if (cb.isChecked()) {
                            rStatus[0] ="Có%20thể%20sử%20dụng";} else rStatus[0] ="Bảo%20trì";
                        rname[0] = edname.getText().toString();
                        if (rname[0] !=null && rStatus[0] !=null && rtype!=null){
                            new EditRoomTask().execute(String.valueOf(liRoom.get(position).getRoom_id()),rname[0], String.valueOf(rtype[0]), rStatus[0]);

                            Toast.makeText(context,"Edit Done",Toast.LENGTH_SHORT).show();
                        }else Toast.makeText(context,"Edit Error",Toast.LENGTH_SHORT).show();
                    }
                });
                builder.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {


                    }
                });
                AlertDialog ad = builder.show();
            }
        });
        delete.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Log.i("Press","Deleting");
                new DeleteRoomTask().execute(String.valueOf(liRoom.get(position).getRoom_id()));
                liRoom.remove(liRoom.get(position));
                notifyDataSetChanged();
            }
        });


        return rowView;
    }


}