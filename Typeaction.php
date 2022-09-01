<?php
require_once 'core.php';
$type_id = $_POST["type_id"];
$result = mysqli_query($conn,"SELECT * FROM product where type_id = $type_id");
?>
<option value="">--SELECT--</option>
<?php
while($row = mysqli_fetch_array($result)) {
 echo "<option value='".$row['type_id']."' id='changeType".$row['type_id']."'>".$row['type_name']."</option>";
}
?>