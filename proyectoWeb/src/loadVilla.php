

<?php 
function getConn(){
  $mysqli = mysqli_connect('localhost', 'root', '', "dbproyecto"); 
  return $mysqli;
}
?>

<?php 

function getVilla(){
    $mysqli = getConn();
    $id = $_POST['id'];
    $query = "SELECT * FROM `lecturas` WHERE id = $id";
    $result = $mysqli->query($query);
    $villa = '';
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      $villa .= "<option value='$row[id]' >$row[villa]</option>";
    }
    return $villa;
  }
  
  echo getVilla();