package com.example.appproyecto.data.models

import com.google.gson.annotations.SerializedName

data class PostList(
    @SerializedName("agente")
    var agente: String,

    @SerializedName("codvivienda")
    var codigo: String,

    @SerializedName("direccion")
    var direccion: String,

    @SerializedName("mz")
    var mz: Int,

    @SerializedName("villa")
    var villa: Int,

    @SerializedName("fecha")
    var fecha: String,
)
