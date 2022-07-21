package com.example.appproyecto.ui

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.widget.Toast
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.example.appproyecto.MainActivity
import com.example.appproyecto.R
import com.example.appproyecto.data.ApiClient
import com.example.appproyecto.data.models.Post
import com.example.appproyecto.data.models.PostList
import com.example.appproyecto.data.rec.ListAdapter
import com.example.appproyecto.data.responses.PostsResponse
import com.example.appproyecto.util.Constants
import com.example.appproyecto.util.SessionManager
import com.google.android.material.bottomnavigation.BottomNavigationView
import com.google.gson.Gson
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class HomeActivity : AppCompatActivity() {

    private lateinit var apiClient: ApiClient
    private lateinit var sessionManager: SessionManager
    private lateinit var btn1: BottomNavigationView
    private lateinit var recView: RecyclerView

    override fun onResume() {
        super.onResume()
        CoroutineScope(Dispatchers.IO).launch {
            fetchPosts()
        }
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_home)
        btn1 = findViewById(R.id.bnv)
        recView = findViewById(R.id.recview)
        apiClient = ApiClient()
        sessionManager = SessionManager(this)


        btn1.setOnItemSelectedListener { item ->
            when (item.itemId) {
                R.id.naviRever -> {
                    val frm1 = Intent(this@HomeActivity, LoginActivity::class.java)
                    startActivity(frm1)
                    true
                }
                R.id.naviNew -> {
                    val frm1 = Intent(this@HomeActivity, NewRegistroActivity::class.java)
                    startActivity(frm1)
                    true
                }
                else -> false
            }
        }
    }

    private suspend fun fetchPosts() {


        apiClient.getApiService(this).fetchPosts()
            .enqueue(object : Callback<PostsResponse> {
                override fun onFailure(call: Call<PostsResponse>, t: Throwable) {
                    t?.printStackTrace()
                }

                override fun onResponse(call: Call<PostsResponse>, response: Response<PostsResponse>) {
                    val lista_personas = response?.body()
                    val valor = Gson().toJson(lista_personas);
                    if (lista_personas != null){
                        Log.i(Constants.TAG_LOGS, valor)
                        datos(lista_personas!!.posts)
                    }else{
                        Toast.makeText(applicationContext, "No existen datos", Toast.LENGTH_SHORT)
                    }
                }
            })
    }
    private fun datos(listAdapter: List<PostList>){
        recView.apply{
            layoutManager = LinearLayoutManager(this@HomeActivity)
            adapter = ListAdapter(listAdapter)
        }
    }

}