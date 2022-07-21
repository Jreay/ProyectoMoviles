package com.example.appproyecto

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import android.widget.ImageView
import android.widget.TextView
import com.example.appproyecto.data.ApiClient
import com.example.appproyecto.data.responses.DefaultResponse
import com.example.appproyecto.data.resquests.UserRequest
import com.example.appproyecto.util.MyMessage
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.withContext
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class MainActivity : AppCompatActivity() {

    private lateinit var txtC: TextView
    private lateinit var txtD: TextView
    private lateinit var txtM: TextView
    private lateinit var txtV: TextView
    private lateinit var btnC: Button
    private lateinit var imgF: ImageView
    private lateinit var btnG: Button
    private lateinit var btnV: Button
    private lateinit var apiClient: ApiClient


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        apiClient = ApiClient()
        txtC = findViewById(R.id.txtCodigo)
        txtD = findViewById(R.id.txtDireccion)
        txtM = findViewById(R.id.txtMz)
        txtV = findViewById(R.id.txtVilla)
        btnC = findViewById(R.id.btnFoto)
        btnG = findViewById(R.id.btnGuardar)
        btnV = findViewById(R.id.btnVolver)

        btnG.setOnClickListener {
            CoroutineScope(Dispatchers.IO).launch {
                guardar()
            }
        }
        btnV.setOnClickListener {
            CoroutineScope(Dispatchers.IO).launch {
                volver()
            }
        }
    }

    private suspend fun volver(){
        finish()
    }

    private suspend fun guardar(){
        val codigo = txtC.text.toString().trim()
        val direccion = txtD.text.toString().trim()
        val mz = txtM.text.toString().trim()
        val villa = txtV.text.toString().trim()
        if (codigo.isEmpty()){
            withContext(Dispatchers.Main){
                txtC.error= "Ingrese Codigo"
                txtC.requestFocus()
            }
            return
        }
        if (direccion.isEmpty()){
            withContext(Dispatchers.Main){
                txtD.error= "Ingrese Direccion"
                txtD.requestFocus()
            }
            return
        }
        if (mz.isEmpty()){
            withContext(Dispatchers.Main){
                txtM.error= "Ingrese Manzana"
                txtM.requestFocus()
            }
            return
        }
        if (villa.isEmpty()){
            withContext(Dispatchers.Main){
                txtV.error= "Ingrese Villa"
                txtV.requestFocus()
            }
            return
        }
        apiClient.getApiService(this)
            .addUser(UserRequest(codigo.toInt(), direccion, mz.toInt(), villa.toInt()))
            .enqueue(object : Callback<DefaultResponse> {
                override fun onResponse(
                    call: Call<DefaultResponse>,
                    response: Response<DefaultResponse>
                ) {
                    val defaultResponse = response.body()
                    if (defaultResponse != null) {
                        if (defaultResponse.error == false) {
                            MyMessage.toast(applicationContext, defaultResponse.message)
                            finish()
                        }
                    }
                    MyMessage.toast(applicationContext, "Vivienda Creada")
                }

                override fun onFailure(call: Call<DefaultResponse>, t: Throwable) {
                    MyMessage.toast(applicationContext, t.toString())
                }

            });

    }
}