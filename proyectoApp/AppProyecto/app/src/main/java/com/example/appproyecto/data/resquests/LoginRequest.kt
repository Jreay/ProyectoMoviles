package com.example.appproyecto.data.resquests

import com.google.gson.annotations.SerializedName

data class LoginRequest (
    @SerializedName("email")
    var user: String,

    @SerializedName("pwd")
    var pwd: String
)