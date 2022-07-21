package com.example.appproyecto.data.responses

import com.example.appproyecto.data.models.Usuario
import com.google.gson.annotations.SerializedName

data class LoginResponse(
    var error: Boolean=false,
    var islogged: Boolean=false,
    var message:String? = null,
    var token: String,

    @SerializedName("user")
    var user: Usuario?
)
