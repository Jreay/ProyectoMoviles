package com.example.appproyecto.data.models

import com.google.gson.annotations.SerializedName

data class Usuario(
    @SerializedName("id")
    var id: Int,

    @SerializedName("codigo")
    var codigo: Int,

    @SerializedName("direccion")
    var direccion: String,

    @SerializedName("mz")
    var mz: Int,

    @SerializedName("villa")
    var villa: Int,
)