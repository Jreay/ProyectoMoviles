package com.example.appproyecto.data.rec

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.example.appproyecto.R
import com.example.appproyecto.data.models.Post
import com.example.appproyecto.data.models.PostList

class ListAdapter(private val listado: List<PostList>): RecyclerView.Adapter<ListAdapter.ViewHolder>() {

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val view = LayoutInflater.from(parent.context).inflate(R.layout.item,parent,false)
        return ViewHolder(view)
    }

    override fun getItemCount() = listado.size

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        val lista = listado[position]
        holder.agente.text=lista.agente
        holder.codigo.text=lista.codigo
        holder.direccion.text=lista.direccion
        holder.mz.text=lista.mz.toString()
        holder.villa.text=lista.villa.toString()
        holder.fecha.text=lista.fecha

    }

    class ViewHolder(val item: View): RecyclerView.ViewHolder(item){
        val agente: TextView = item.findViewById(R.id.txtAgente) as TextView
        val codigo: TextView = item.findViewById(R.id.txtCodigo) as TextView
        val direccion: TextView = item.findViewById(R.id.txtDireccion) as TextView
        val mz: TextView = item.findViewById(R.id.txtMz) as TextView
        val villa: TextView = item.findViewById(R.id.txtVilla) as TextView
        val fecha: TextView = item.findViewById(R.id.txtFecha) as TextView
    }

}