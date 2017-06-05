<?php
class MyDB extends SQLite3
   {

      function __construct()
      {
         $this->open('Test.db');
      }
   }
// check for submission
// retrieve value from posted data
if ($_POST['id_del'])
{
//echo "You entered the number " . $_POST['id_del'];
$id_del = test_input($_POST["id_del"]);
$db = new MyDB();
$sql = "UPDATE COMPANY SET DELETE_F='DEL' WHERE ID = $id_del";
echo "$sql";
$res = $db->query($sql);

}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>


<script type="text/javascript">
window.location.href="http://192.168.3.21";
</script>