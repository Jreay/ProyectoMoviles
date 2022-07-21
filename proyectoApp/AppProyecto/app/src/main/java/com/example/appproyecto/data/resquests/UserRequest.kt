package com.example.appproyecto.data.resquests

import com.google.gson.annotations.SerializedName

data class UserRequest(
    @SerializedName("codigo")
    var codigo: Int,

    @SerializedName("direccion")
    var direccion: String,

    @SerializedName("mz")
    var mz: Int,

    @SerializedName("villa")
    var villa: Int,
)
