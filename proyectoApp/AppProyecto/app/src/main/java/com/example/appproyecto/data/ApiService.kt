package com.example.appproyecto.data

import com.example.appproyecto.data.models.Post
import com.example.appproyecto.data.responses.DefaultResponse
import com.example.appproyecto.data.responses.LoginResponse
import com.example.appproyecto.data.responses.PostsResponse
import com.example.appproyecto.data.resquests.LoginRequest
import com.example.appproyecto.data.resquests.UserRequest
import com.example.appproyecto.util.Constants
import retrofit2.Call
import retrofit2.http.*

interface ApiService {
    @POST(Constants.LOGIN_URL)
    fun login(@Body request: LoginRequest): Call<LoginResponse>
    @GET(Constants.POSTS_URL)
    fun fetchPosts(): Call<PostsResponse>
    @POST(Constants.ADD_URL)
    fun addUser(@Body request: UserRequest): Call<DefaultResponse>
    @DELETE(Constants.DELETE_URL)
    fun deleteUser(@Path("id") id : Int): Call<DefaultResponse>
    @PUT(Constants.EDIT_URL)
    fun editUser(@Path("id") id : Int, @Body request: Post): Call<DefaultResponse>
}