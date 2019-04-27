package com.example.jekiansari.sig_kajianislam.services;

import android.app.AlarmManager;
import android.app.Notification;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.app.Service;
import android.app.TaskStackBuilder;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.media.RingtoneManager;
import android.net.Uri;
import android.os.Build;
import android.os.IBinder;
import android.support.v4.app.NotificationCompat;
import android.support.v4.content.ContextCompat;
import android.util.Log;
import android.widget.Toast;

import com.example.jekiansari.sig_kajianislam.DetailPublicActivity;
import com.example.jekiansari.sig_kajianislam.MainActivity;
import com.example.jekiansari.sig_kajianislam.R;

import java.util.Calendar;

public class AlarmReceiver extends BroadcastReceiver {
    public static final String EXTRA_MESSAGE = "message";
    public static final String ID_KAJIAN = "idkajian";

    public static String id_kajian = "";


    private final int ID_ONETIME = 100;

    public AlarmReceiver() {
    }

    @Override
    public void onReceive(Context context, Intent intent) {

        String msg = intent.getStringExtra(EXTRA_MESSAGE);
//        String idKajian = intent.getStringExtra(ID_KAJIAN);
        Log.d("AlarmReceiver", "onReceive: id Kajian "+id_kajian);
        showAlarmNotification(context, "Kajian Islam Samarinda", msg, ID_ONETIME, id_kajian);
    }

    public void setalarm(Context context, String date, String time, String message, String idKajian) {
        String DATE_FORMAT = "yyyy-MM-dd";
        String TIME_FORMAT = "HH:mm";
        AlarmManager alarmManager = (AlarmManager)
                context.getSystemService(Context.ALARM_SERVICE);
        Intent intent = new Intent(context, AlarmReceiver.class);
        intent.putExtra(EXTRA_MESSAGE, message);
//        intent.putExtra(ID_KAJIAN, idKajian);
        id_kajian = idKajian;

        Log.d("AlarmReceiver", "setAlarm: id Kajian "+idKajian);

        Calendar cal = Calendar.getInstance();
        cal.set(Calendar.YEAR, Integer.valueOf(date.split("-")[0]));
        cal.set(Calendar.MONTH, Integer.valueOf(date.split("-")[1]) - 1);
        cal.set(Calendar.DAY_OF_MONTH, Integer.valueOf(date.split("-")[2]));
        cal.set(Calendar.HOUR_OF_DAY, Integer.valueOf(time.split(":")[0]));
        cal.set(Calendar.MINUTE, Integer.valueOf(time.split(":")[1]));
        cal.set(Calendar.SECOND, 0);

        PendingIntent pendingIntent =
                PendingIntent.getBroadcast(context, ID_ONETIME, intent, 0);
        if (alarmManager != null) {
            alarmManager.set(AlarmManager.RTC_WAKEUP, cal.getTimeInMillis(), pendingIntent);
        }

        Toast.makeText(context, "Alarm Telah di Set", Toast.LENGTH_SHORT).show();
    }

    private void showAlarmNotification(Context context, String title, String message, int notifId, String idKajian) {
        String CHANNEL_ID = "Channel_1";
        String CHANNEL_NAME = "AlarmManager channel";


        Intent intent = new Intent(context, DetailPublicActivity.class);
        intent.putExtra("id_kajian", idKajian);
        PendingIntent pendingIntent = PendingIntent.getActivity(context, 0, intent, PendingIntent.FLAG_UPDATE_CURRENT);


        NotificationManager notificationManagerCompat = (NotificationManager) context.getSystemService(Context.NOTIFICATION_SERVICE);
        Uri alarmSound = RingtoneManager.getDefaultUri(RingtoneManager.TYPE_NOTIFICATION);
        NotificationCompat.Builder builder = new NotificationCompat.Builder(context, CHANNEL_ID)
                .setSmallIcon(R.mipmap.ic_launcher)
                .setContentTitle(title)
                .setContentText(message)
                .setColor(ContextCompat.getColor(context, android.R.color.transparent))
                .setVibrate(new long[]{1000, 1000, 1000, 1000, 1000})
                .setSound(alarmSound)
                .setContentIntent(pendingIntent);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            NotificationChannel channel = new NotificationChannel(CHANNEL_ID,
                    CHANNEL_NAME,
                    NotificationManager.IMPORTANCE_DEFAULT);
            channel.enableVibration(true);
            channel.setVibrationPattern(new long[]{1000, 1000, 1000, 1000, 1000});
            builder.setChannelId(CHANNEL_ID);
            if (notificationManagerCompat != null) {
                notificationManagerCompat.createNotificationChannel(channel);
            }
        }
        Notification notification = builder.build();
        if (notificationManagerCompat != null) {
            notificationManagerCompat.notify(notifId, notification);
        }
    }
}