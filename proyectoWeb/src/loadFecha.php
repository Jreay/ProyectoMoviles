

<?php 
function getConn(){
  $mysqli = mysqli_connect('localhost', 'root', '', "dbproyecto");
  
  
  return $mysqli;
}
?>
  
<?php 

function getFecha(){
    $mysqli = getConn();
    $id = $_POST['id'];
    $query = "SELECT * FROM `lecturas` WHERE id = $id";
    $result = $mysqli->query($query);
    $fecha = '';
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      $fecha .= "<option value='$row[id]' >$row[fecha]</option>";
    }
    return $fecha;
  }
  
  echo getFecha();