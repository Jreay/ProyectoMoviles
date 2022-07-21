package com.example.appproyecto.ui

import android.Manifest
import android.content.Intent
import android.content.pm.PackageManager
import android.graphics.Bitmap
import android.icu.text.SimpleDateFormat
import android.net.Uri
import android.os.Build
import android.os.Bundle
import android.os.Environment
import android.provider.MediaStore
import android.util.Base64
import android.view.View
import android.widget.Button
import android.widget.ImageView
import android.widget.TextView
import android.widget.Toast
import androidx.activity.result.contract.ActivityResultContracts
import androidx.appcompat.app.AppCompatActivity
import androidx.core.content.ContextCompat
import com.example.appproyecto.R
import com.example.appproyecto.data.ApiClient
import com.example.appproyecto.data.responses.DefaultResponse
import com.example.appproyecto.data.resquests.UserRequest
import com.example.appproyecto.databinding.ActivityMainBinding
import com.example.appproyecto.util.MyMessage
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.withContext
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import java.io.ByteArrayOutputStream
import java.io.File
import java.io.IOException
import java.util.*


class NewRegistroActivity : AppCompatActivity() {
    private lateinit var binding: ActivityMainBinding
    private lateinit var txtC: TextView
    private lateinit var txtD: TextView
    private lateinit var txtM: TextView
    private lateinit var txtV: TextView
    private lateinit var txtF: TextView
    private lateinit var btnC: Button
    private lateinit var btnG: Button
    private lateinit var btnV: Button
    private lateinit var apiClient: ApiClient
    private lateinit var imageView: ImageView

    //var imagen = getStringImagen(bitmap)




    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        //setContentView(R.layout.activity_new_registro)
        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)
        apiClient = ApiClient()
        txtC = findViewById(R.id.txtCodigo)
        txtD = findViewById(R.id.txtDireccion)
        txtM = findViewById(R.id.txtMz)
        txtV = findViewById(R.id.txtVilla)
        btnC = findViewById(R.id.btnFoto)
        btnG = findViewById(R.id.btnGuardar)
        btnV = findViewById(R.id.btnVolver)
        imageView = findViewById(R.id.imgUser)


        btnC.setOnClickListener {
            CoroutineScope(Dispatchers.IO).launch {
                //guardar()
                tomarFoto()
            }
        }
        btnV.setOnClickListener {
            CoroutineScope(Dispatchers.IO).launch {
                volver()
            }
        }
        binding.btnGuardar.setOnClickListener { requestPermission() }
    }


    private val requestPermissionLauncher = registerForActivityResult(
        ActivityResultContracts.RequestPermission()
    ){ isGranted ->

        if (isGranted){
            buscarFoto()
        }else{
            Toast.makeText(
                this,
                "Permission denied",
                Toast.LENGTH_SHORT).show()
        }
    }

    private fun requestPermission() {
        // Verificaremos el nivel de API para solicitar los permisos
        // en tiempo de ejecución
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            when {

                ContextCompat.checkSelfPermission(
                    this,
                    Manifest.permission.READ_EXTERNAL_STORAGE
                ) == PackageManager.PERMISSION_GRANTED -> {
                    buscarFoto()
                }

                else -> requestPermissionLauncher.launch(Manifest.permission.READ_EXTERNAL_STORAGE)
            }
        }else {
            // Se llamará a la función para APIs 22 o inferior
            // Esto debido a que se aceptaron los permisos
            // al momento de instalar la aplicación
            buscarFoto()
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


     private fun buscarFoto() {
        val intent = Intent(Intent.ACTION_GET_CONTENT)
        intent.type = "image/*"
        startForResult.launch(intent)
    }

    fun getStringImagen(bmp: Bitmap): String? {
        val baos = ByteArrayOutputStream()
        bmp.compress(Bitmap.CompressFormat.JPEG, 100, baos)
        val imageBytes: ByteArray = baos.toByteArray()
        return Base64.encodeToString(imageBytes, Base64.DEFAULT)
    }

    private val startForResult = registerForActivityResult(
        ActivityResultContracts.StartActivityForResult()
    ){ result ->
        if (result.resultCode == RESULT_OK){
            val data = result.data?.data
            binding.imgUser.setImageURI(data)
            Toast.makeText(applicationContext, "${imageView.toString()}", Toast.LENGTH_SHORT).show()
        }
    }


    val REQUEST_IMAGE_CAPTURE = 1

    private fun tomarFoto() {
        Intent(MediaStore.ACTION_IMAGE_CAPTURE).also { takePictureIntent ->
            takePictureIntent.resolveActivity(packageManager)?.also {
                startActivityForResult(takePictureIntent, REQUEST_IMAGE_CAPTURE)
            }
        }
        createImageFile()
    }

    lateinit var currentPhotoPath: String

    @Throws(IOException::class)
    private fun createImageFile(): File {
        // Create an image file name
        val timeStamp: String = SimpleDateFormat("yyyyMMdd_HHmmss").format(Date())
        val storageDir: File = getExternalFilesDir(Environment.DIRECTORY_PICTURES)!!
        return File.createTempFile(
            "JPEG_${timeStamp}_", /* prefix */
            ".jpg", /* suffix */
            storageDir /* directory */
        ).apply {
            // Save a file: path for use with ACTION_VIEW intents
            currentPhotoPath = absolutePath
        }
        galleryAddPic()
    }

    private fun galleryAddPic() {
        Intent(Intent.ACTION_MEDIA_SCANNER_SCAN_FILE).also { mediaScanIntent ->
            val f = File(currentPhotoPath)
            mediaScanIntent.data = Uri.fromFile(f)
            sendBroadcast(mediaScanIntent)
        }
    }

}