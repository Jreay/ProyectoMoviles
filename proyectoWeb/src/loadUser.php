
<?php 
function getConn(){
  $mysqli = mysqli_connect('localhost', 'root', '', "dbproyecto");
  
  
  return $mysqli;
}
?>

  
<?php 

function GetUsuarios(){
  $mysqli = getConn();
  $query = "SELECT * FROM usuarios" ;
  $result = $mysqli->query($query);
  $usuarios = '<option value="" disabled selected>Seleccione: </option>';
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $usuarios .= "<option value='$row[id]'>$row[usuario]</option>";
  }
  return $usuarios;
}

echo GetUsuarios();
