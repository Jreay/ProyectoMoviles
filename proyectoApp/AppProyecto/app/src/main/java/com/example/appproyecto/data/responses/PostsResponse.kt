package com.example.appproyecto.data.responses

import com.example.appproyecto.data.models.Post
import com.example.appproyecto.data.models.PostList
import com.google.gson.annotations.SerializedName

data class PostsResponse(
    @SerializedName("status_code")
    var status: Int,

    @SerializedName("message")
    var message: String,

    @SerializedName("employees")
    var posts: List<PostList>
)
