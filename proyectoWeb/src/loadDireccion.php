

<?php 
function getConn(){
  $mysqli = mysqli_connect('localhost', 'root', '', "dbproyecto");
  return $mysqli;
}
?>

<?php 

function getDireccion(){
    $mysqli = getConn();
    $id = $_POST['id'];
    $query = "SELECT * FROM `lecturas` WHERE id = $id";
    $result = $mysqli->query($query);
    $direccion = '';
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      $direccion .= "<option value='$row[id]' >$row[direccion]</option>";
    }
    return $direccion;
  }
  
  echo getDireccion();