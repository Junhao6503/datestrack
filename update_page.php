<!DOCTYPE HTML> 
<head>
<meta charset="utf-8">
<title>更新表单</title>
<style>
.error {color: #FF0000;}
</style>
<script type="text/javascript">
function refresh()
{
//window.location.href="index.php?backurl="+window.location.href;
window.location.href="http://192.168.3.21";

 
}
</script>
</head>
<body> 

<?php
// 定义变量并默认设置为空值
class MyDB extends SQLite3
   {

      function __construct()
      {
         $this->open('Test.db');
      }
   }
$db = new MyDB();
$nameErr = $amountErr = $departmentErr = "";
$name = $amount = $department = $comment = $purchaseYear = $purchaseMonth = $purchasedate = $expectYear = $expectMonth = $expectdate = $arriveYear = "";
$realname = $realamount = $realdepartment = $comment = $website = $realpurchasedate = $realexpectdate = "";
$brand = $actualdate = "";
$idnum=1;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (!empty($_POST["id_update"]))
    {
      $id_update=test_input($_POST["id_update"]);  
      $sql = "SELECT * FROM COMPANY WHERE ID = $id_update";
      $ret_update = $db->query($sql);
      while($row = $ret_update->fetchArray(SQLITE3_ASSOC) ){
         $name = $row['NAME'];
         //$idnum = $row['ID'];
          $amount = $row['AMOUNT'];
          $purchasedate = $row['PURCHASE_DATE'];
          $expectdate  = $row['EXPECT_DATE'];
          $department = $row['DEPARTMENT'];
          $actualdate = $row['ACTUAL_DATE'];
          $brand = $row['BRAND'];


      }
    }

 if (empty($_POST["name"]))
    {
        $nameErr = "名称是必需的";
    }
    else
    { 
        $name = test_input($_POST["name"]);
        // 检测名字是否只包含字母跟空格
    }
    
    if (empty($_POST["amount"]))
    {
      $amountErr = "数量是必需的";
    }
    else
    {
        $amount = test_input($_POST["amount"]);
        // 检测数量是否合法
        if (!is_numeric($amount))
        {
            $amountErr = "数量必须是纯数字";
        } else {
          $realamount = $amount;
        }
    }
    
    if (empty($_POST["department"]))
    {
        $departmentErr = "部门是必需的";
    }
    else
    {
        $department = test_input($_POST["department"]);
        $departmentErr = "";
    }

    if (!empty($_POST["purchasedate"]))
    {
       $purchasedate = test_input($_POST["purchasedate"]);

    }


    if (!empty($_POST["expectdate"]))
    {
       $expectdate = test_input($_POST["expectdate"]);

    }

    if (!empty($_POST["brand"]))
    {
       $brand = test_input($_POST["brand"]);

    }

    if (!empty($_POST["actualdate"]))
    {
       $actualdate = test_input($_POST["actualdate"]);

    }



    

    
    
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>更新表单</h2>
<p><span class="error">* 必需字段。</span></p>
<form method="post" action=""> 
   序号：<input type="radio" name="id_update"<?php echo "checked";?> value="<?php echo $id_update?>"><?php echo $id_update?><br>
   名字: <input type="text" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   厂家: <input type="text" name="brand" value="<?php echo $brand;?>">
   <br><br>
   数量: <input type="text" name="amount" value="<?php echo $amount;?>">
   <span class="error">* <?php echo $amountErr;?></span>
   <br><br>
   购买日期: <input type="date" name="purchasedate" min="2015-12-31" max="2100-12-31" value = "<?php echo $purchasedate ?>"><br>
   <br><br>
   预计到达日期：<input type="date" name="expectdate" min="2015-12-31" max="2100-12-31" value = "<?php echo $expectdate ?>"><br>
   <br><br>
   实际到达日期：<input type="date" name="actualdate" min="2015-12-31" max="2100-12-31" value = "<?php echo $actualdate ?>"><br>
   <br><br>
    
   部门:
   <input type="radio" name="department" <?php if (isset($department) && $department=="electric") echo "checked";?>  value="electric">电子部
   <input type="radio" name="department" <?php if (isset($department) && $department=="mech") echo "checked";?>  value="mech">机械部
   <span class="error">* <?php echo $departmentErr;?></span>
   <br><br>
   <input type="submit" name="submit" id = "submitInput" value="提交"> 
</form>

<?php

   if(($name && $realamount && $department)) {

//      $sql =<<<EOF
//       CREATE TABLE COMPANY
//       (ID INT PRIMARY KEY     NOT NULL,
//       NAME           TEXT    NOT NULL,
//       DEPARTMENT     TEXT    NOT NULL,
//       AMOUNT         INT     NOT NULL,
//       PURCHASE_DATE  DATE,
//       EXPECT_DATE    DATE);
// EOF;

//    $ret = $db->exec($sql);
//    if(!$ret){
//       echo $db->lastErrorMsg();
//       echo "<br>";
//    } else {
//       //echo "Table created successfully\n";
//    }

    
    //$ret = $db->query('INSERT INTO COMPANY VALUES (4,'hahaha', 22, 22, 201711, 201711 ');
    //$ret = $db->query('SELECT * FROM COMPANY');

// while ($row = $ret->fetchArray()) {
//    var_dump($row);
// } 
   //  $sql = "SELECT MAX(ID) FROM COMPANY";
    
   //  $ret = $db->query($sql);

   //  //$row = $ret->fetchArray();
   //   if(!$ret){

   //    echo $db->lastErrorMsg();
   //    echo "<br>";
   // } 
   // $row = $ret->fetchArray();
   // $idnum = $row['MAX(ID)'];
   // $idnum = $idnum + 1;


    
    $sql = "UPDATE COMPANY SET NAME='$name', DEPARTMENT='$department', AMOUNT='$amount', PURCHASE_DATE='$purchasedate', EXPECT_DATE= '$expectdate',ACTUAL_DATE='$actualdate', BRAND = '$brand' WHERE ID = $id_update";
    echo "$sql";
    $ret = $db->query($sql);

   if(!$ret){

      echo $db->lastErrorMsg();
      echo "<br>";
      
      //$ret = $db->exec($sql);
      //$idnum = $idnum + 1;
      //echo "$idnum";
   } 
   $db->close();
   echo  "<script type='text/javascript'>refresh();</script>";

;

}

?>

</body>
</html>