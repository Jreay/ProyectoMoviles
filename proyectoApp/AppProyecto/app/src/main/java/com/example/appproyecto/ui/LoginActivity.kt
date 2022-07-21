package com.example.appproyecto.ui

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.widget.ImageButton
import android.widget.TextView
import com.example.appproyecto.MainActivity
import com.example.appproyecto.R
import com.example.appproyecto.data.ApiClient
import com.example.appproyecto.data.responses.LoginResponse
import com.example.appproyecto.data.resquests.LoginRequest
import com.example.appproyecto.util.Constants
import com.example.appproyecto.util.MyMessage
import com.example.appproyecto.util.SessionManager
import com.google.gson.Gson
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.withContext
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class LoginActivity : AppCompatActivity() {
    private lateinit var txtU: TextView
    private lateinit var txtP: TextView
    private lateinit var apiClient: ApiClient
    private lateinit var sessionManager: SessionManager
    private lateinit var btnL: ImageButton
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)
        txtU= findViewById(R.id.txtUsuario)
        txtP= findViewById(R.id.txtPassword)
        btnL= findViewById(R.id.btnLogin)
        apiClient = ApiClient()
        sessionManager = SessionManager(this)
        btnL.setOnClickListener {
            CoroutineScope(Dispatchers.IO).launch {
                getlogin()
                //pruebas()
            }
        }
    }
    private suspend fun getlogin(){
        val user = txtU.text.toString().trim()
        val pass = txtP.text.toString().trim()
        if (user.isEmpty()){
            withContext(Dispatchers.Main){
                txtU.error= "Ingrese Usuario"
                txtU.requestFocus()
            }
            return
        }
        if (pass.isEmpty()){
            withContext(Dispatchers.Main){
                txtP.error= "Ingrese Password"
                txtP.requestFocus()
            }
            return
        }

        apiClient = ApiClient()
        sessionManager = SessionManager(this)

        apiClient.getApiService(this).login(LoginRequest(user = user, pwd = pass))
            .enqueue(object : Callback<LoginResponse> {
                override fun onFailure(call: Call<LoginResponse>, t: Throwable) {
                    // Error logging in
                    t?.printStackTrace()
                }

                override fun onResponse(call: Call<LoginResponse>, response: Response<LoginResponse>) {
                    val loginResponse = response.body()

                    if (response.code() == 200 && loginResponse?.user != null) {
                        sessionManager.saveAuthToken(loginResponse.token)

                        val lista_personas = response?.body()
                        //Log.i(Constants.TAG_LOGS, Gson().toJson(loginResponse.token))
                        Log.i(Constants.TAG_LOGS, Gson().toJson(lista_personas))
                        val frm2 = Intent(this@LoginActivity, HomeActivity::class.java)
                        startActivity(frm2)
                    } else {
                        // Error logging in
                        MyMessage.toast(applicationContext, "Usuario/Contraseña Incorrecta")
                    }
                }
            })
    }
}