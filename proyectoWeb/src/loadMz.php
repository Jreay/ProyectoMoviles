

<?php 
function getConn(){
  $mysqli = mysqli_connect('localhost', 'root', '', "dbproyecto"); 
  return $mysqli;
}
?>
  
<?php 

function getMz(){
    $mysqli = getConn();
    $id = $_POST['id'];
    $query = "SELECT * FROM `lecturas` WHERE id = $id";
    $result = $mysqli->query($query);
    $mz = '';
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      $mz .= "<option value='$row[id]' >$row[mz]</option>";
    }
    return $mz;
  }
  
  echo getMz();