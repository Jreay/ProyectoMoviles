

<?php 
function getConn(){
  $mysqli = mysqli_connect('localhost', 'root', '', "dbproyecto");
  
  
  return $mysqli;
}
?>

  
<?php 

function getCode(){
    $mysqli = getConn();
    $query = "SELECT * FROM `lecturas`";
    $result = $mysqli->query($query);
    $codvivienda = '<option  value="" disabled selected>Seleccione: </option>';
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      $codvivienda .= "<option value='$row[id]'>$row[codvivienda]</option>";
      
    }
    return $codvivienda;
}
  
echo getCode();


