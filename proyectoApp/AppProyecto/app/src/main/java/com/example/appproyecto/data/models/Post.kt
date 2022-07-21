package com.example.appproyecto.data.models

import com.google.gson.annotations.SerializedName

data class Post (
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
