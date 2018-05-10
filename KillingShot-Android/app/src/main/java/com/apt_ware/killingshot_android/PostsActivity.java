package com.apt_ware.killingshot_android;

import android.content.Context;
import android.support.design.widget.TabLayout;
import android.support.v4.content.ContextCompat;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

public class PostsActivity extends AppCompatActivity {
private TabLayout tab_layout;
    private ViewPager view_pager;
    private ViewPageAdapter adapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_posts);

        tab_layout = (TabLayout) findViewById(R.id.tab_layout);
        view_pager = (ViewPager) findViewById(R.id.viewpaper);

        adapter = new ViewPageAdapter(getSupportFragmentManager());
        view_pager.setAdapter(adapter);

        final TabLayout.Tab tab_public = tab_layout.newTab();
        final TabLayout.Tab tab_private = tab_layout.newTab();
        final TabLayout.Tab tab_notification = tab_layout.newTab();

        tab_public.setText("Public");
        tab_private.setText("Private");
        tab_notification.setText("Notification");


        tab_layout.addTab(tab_public,0);
        tab_layout.addTab(tab_private,1);
        tab_layout.addTab(tab_notification,2);

        tab_layout.setTabTextColors(ContextCompat.getColorStateList(this,R.color.tab_selector));
        tab_layout.setSelectedTabIndicatorColor(ContextCompat.getColor(this,R.color.colorAccent));

        view_pager.addOnPageChangeListener(new TabLayout.TabLayoutOnPageChangeListener(tab_layout));
    }
}
