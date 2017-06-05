<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1495627054952&di=d6be4f79a5f6bf6efb4b2e6c81a09d6e&imgtype=0&src=http%3A%2F%2Fcdns2.freepik.com%2Ffree-photo%2Fadd-to-cart_318-33166.jpg">
<title>货期查询</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="../../home/orangepi/bootstrap-3.3.7/docs/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

<!-- Custom styles for this template -->
<!-- <link href="starter-template.css" rel="stylesheet"> -->

<!-- Custom styles for this template -->
<!-- <link href="navbar-fixed-top.css" rel="stylesheet"> -->
<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="/home/orangepi/bootstrap-3.3.7/docs/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="../../home/orangepi/bootstrap-3.3.7/docs/assets/js/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<style>
.error {color: #FF0000;}
.span3 {  
    height: 450px !important;
    overflow: scroll;
}​
</style>

<script type="text/javascript">
function refresh()
{
 window.location.href="http://192.168.3.21/mech_page.php";

 
 //window.setTimeout("fresh()",5000); 
}
function refresh_mech()
{
 window.location.href="http://192.168.3.21/mech_page.php";

 
 //window.setTimeout("fresh()",5000); 
}
function chenggong(){
var res = confirm("确认要删除么？");
if(res == true){
document.getElementById("del_form").submit();
} 
}
function submit_update(){

document.getElementById("update_form").submit();
} 

</script>
</head>
<body>

 <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://192.168.3.21"><span class="glyphicon glyphicon-shopping-cart"> </span>货期查询表</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="http://192.168.3.21"><span class="glyphicon glyphicon-flash"></span> 电子部</a></li>
            <li class="active"><a href="mech_page.php"> <span class="glyphicon glyphicon glyphicon-wrench"></span> 机械部</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<hr>
<div class="container">
<div class="well well-lg" >
<div class="span3">
<div class="row">
        <div class="col-lg-12">
        <table class="table table-bordered">
        <thead>
  <tr>
<!--     <th>编号</th> -->
    <th>名称</th>
    <th>厂家</th>
    <th>数量</th>
    <!-- <th>部门</th> -->
    <th>购买时间</th>
    <th>发货时间</th>
    <th>预计到货时间</th>
    <th>实际到货时间</th>
  </tr>
  </thead>
  <tbody>
<?php
class MyDB extends SQLite3
   {

      function __construct()
      {
         $this->open('Test.db');
      }
   }
$db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      //echo "Opened database successfully\n";
   }
 $date = date("Y-m-d");
 //echo $date;
 //$diff = diffBetweenTwoDays("2017-5-10", $date);
 //echo $diff;
 $sql = "SELECT * FROM COMPANY ORDER BY PURCHASE_DATE DESC";
 $datachunk = $db->query($sql);
 while($row = $datachunk->fetchArray(SQLITE3_ASSOC) ){
    if(diffBetweenTwoDays($date, $row['ACTUAL_DATE']) > 7 && $row['ACTUAL_DATE'] != '') {
      $sql = "UPDATE COMPANY SET DELETE_F = 'DEL' WHERE ID = {$row['ID']} ";
      //echo $sql;
      $db->query($sql);
    }
    if($row['DEPARTMENT'] == 'mech' && $row['DELETE_F'] != 'DEL') {
      //echo diffBetweenTwoDays($row['ACTUAL_DATE'], $date);
      echo "<tr>";
      // echo "<td>{$row['ID']}</td>";
      echo "<td>{$row['NAME']}</td>";
      echo "<td>{$row['BRAND']}</td>";
      echo "<td>{$row['AMOUNT']}</td>";
      //echo "<td>{$row['DEPARTMENT']}</td>";
      echo "<td>{$row['PURCHASE_DATE']}</td>";
      echo "<td>{$row['MAIL_DATE']}</td>";
      echo "<td>{$row['EXPECT_DATE']}</td>";
      echo "<td>{$row['ACTUAL_DATE']}</td>";
      echo "</tr>";
      ;
   }
 }
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

<hr>
<?php
// 定义变量并默认设置为空值
$nameErr = $amountErr = $departmentErr = "";
$name = $amount = $department = $comment = $purchaseYear = $purchaseMonth = $purchasedate = $expectYear = $expectMonth = $expectdate = $arriveYear = $maildate = "";
$realname = $realamount = $realdepartment = $comment = $website = $brand = $actualdate = "";
$idnum=1;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  if (!empty($_POST["id_update"]))
    {
      $id_update=test_input($_POST["id_update"]);  
      $sql = "SELECT * FROM COMPANY WHERE ID = $id_update";
      $ret_update = $db->query($sql);
      while($row = $ret_update->fetchArray(SQLITE3_ASSOC) ){
         $up_name = $row['NAME'];
         $up_idnum = $row['ID'];
          $up_amount = $row['AMOUNT'];
          $up_purchasedate = $row['PURCHASE_DATE'];
          $up_expectdate  = $row['EXPECT_DATE'];
          $up_department = $row['DEPARTMENT'];
          $up_actualdate = $row['ACTUAL_DATE'];
          $up_brand = $row['BRAND'];
          $up_maildate = $row['MAIL_DATE'];
          $up_department = $row['DEPARTMENT'];


      }
    } else {

    if (empty($_POST["name"]))
    {
        $nameErr = "名称是必需的";
    }
    else
    { 
        $name = test_input($_POST["name"]);
        $nameErr = "";
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
          $amountErr = "";
        }
    }
    
    if (empty($_POST["department"]))
    {
        $departmentErr = "部门是必需的";
        $errorCode = 1; 
    }
    else
    {
        $department = test_input($_POST["department"]);
        $departmentErr = "";
    }

    

    $purchasedate = test_input($_POST["purchasedate"]);

    $expectdate = test_input($_POST["expectdate"]);

    $department= test_input($_POST["department"]);

    $brand= test_input($_POST["brand"]);

    $actualdate= test_input($_POST["actualdate"]);
    
    $maildate= test_input($_POST["maildate"]);
   if (!empty($_POST["id_update_update"]))
    {
         $id_update_update = $_POST["id_update_update"];
    } 
}
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function diffBetweenTwoDays ($day1, $day2)
{
  $second1 = strtotime($day1);
  $second2 = strtotime($day2);
    
  return ($second1 - $second2) / 86400;
}

?>

<div class="container">
  <div class="col-lg-12">
          <table class="table table-striped">
<thead>
<tr>
    <th>新建历表</th>
    <th>更新列表</th>
    <th>删除列表</th>
  </tr>
  </thead>
  <tbody>
<tr>

<td>
<p><span class="error">* 必需字段。</span></p>
<form name = "new_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   名字: <input type="text" name="name" value="<?php echo $up_name;?>">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   厂家: <input type="text" name="brand" value="<?php echo $up_brand;?>">
   <br><br>
   数量: <input type="text" name="amount" value="<?php echo $up_amount;?>">
   <span class="error">* <?php echo $amountErr;?></span>
   <br><br>
   购买日期(年-月-日): <input type="date" name="purchasedate" min="2015-12-31" max="2100-12-31" value = "<?php echo $up_purchasedate ?>"><br>
   <br><br>
   发货日期(年-月-日): <input type="date" name="maildate" min="2015-12-31" max="2100-12-31" value = "<?php echo $up_maildate ?>"><br>
   <br><br>
   预计到达日期(年-月-日)：<input type="date" name="expectdate" min="2015-12-31" max="2100-12-31" value = "<?php echo $up_expectdate ?>"><br>
   <br><br>
   实际到达日期(年-月-日)：<input type="date" name="actualdate" min="2015-12-31" max="2100-12-31" value = "<?php echo $up_actualdate ?>"><br>
   <br><br>
    
   部门:
   <input type="radio" name="department" <?php if (isset($up_department) && $up_department=="electric") echo "checked";?>  value="electric">电子部
   <input type="radio" name="department" <?php if (isset($up_department) && $up_department=="mech") echo "checked";?>  value="mech">机械部
   <span class="error">* <?php echo $departmentErr;?></span>
   <br><br>
   <input type="submit" name="submit" id = "submitInput" value="提交"> 
     <span class="error">
    <?php
      if($id_update != NULL){
          echo "将要更新【 $up_name 】";
?>  <br><br> <input type="button" name="cancle_update" class="btn btn-sm btn-danger" value = "取消更新" onClick="return refresh()"> 
    <?php  }
    ?>

   </span>
   <input type="radio" name="id_update_update"<?php echo "checked";?> value="<?php echo $up_idnum?>" hidden = "hidden"><br>
</form>
</td>
<td>
<form name = "update_form" id = "update_form" method="post" action=""> 
请选择编号：<select name="id_update">
<?php  $sql = "SELECT ID , NAME FROM COMPANY WHERE DEPARTMENT = 'mech' AND DELETE_F IS NOT 'DEL' ";
       $idleft = $db->query($sql);
       while($row = $idleft->fetchArray(SQLITE3_ASSOC) ){
          echo "<option value={$row['ID']}>{$row['NAME']}</option>";
       }
?>
</select>
<br><br>
<input type="button" name="wocao" class="btn btn-sm btn-primary" value = "更新" onClick="return submit_update()"> 
</form>
</td>
<td>
<form name = "del_form"  id = "del_form" method="post" action="del_php.php"> 
请选择编号：<select name="id_del">
<?php  $sql = "SELECT ID,NAME FROM COMPANY WHERE DEPARTMENT = 'mech' AND DELETE_F IS NOT 'DEL' ";
       $idleft = $db->query($sql);
       while($row = $idleft->fetchArray(SQLITE3_ASSOC) ){
          echo "<option value={$row['ID']}>{$row['NAME']}</option>";
       }
?>
</select>
<br><br>
<!-- <input type="submit" name="submit_del" value="删除" onclick="refresh()"> -->
<input type="button" name="haha" class="btn btn-sm btn-danger" value = "删除" onClick="return chenggong()"> 
</form>
</td>
</tr>
</tbody>  
</table>  
</div>
</div>
</div>





<?php
// class MyDB extends SQLite3
//    {

//       function __construct()
//       {
//          $this->open('Test.db');
//       }
//    }

   if(($name && $amount && $department)) {
   // $db = new MyDB();
   // if(!$db){
   //    echo $db->lastErrorMsg();
   // } else {
   //    //echo "Opened database successfully\n";
   // }
//      $sql =<<<EOF
      // CREATE TABLE COMPANY
      // (ID INT PRIMARY KEY     NOT NULL,
      // NAME           TEXT    NOT NULL,
      // DEPARTMENT     TEXT    NOT NULL,
      // AMOUNT         INT     NOT NULL,
      // PURCHASE_DATE  DATE,
      // EXPECT_DATE    DATE,
      // ACTUAL_DATE    DATE,
      // BRAND          TEXT,
      // MAIL_DATE      DATE,
      // DELETE_F       TEXT);
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
    $sql = "SELECT MAX(ID) FROM COMPANY";
    
    $ret = $db->query($sql);

    //$row = $ret->fetchArray();
     if(!$ret){

      echo $db->lastErrorMsg();
      echo "<br>";
   } 
   $row = $ret->fetchArray();
   $idnum = $row['MAX(ID)'];
   if(empty($id_update_update)){
   $idnum = $idnum + 1;
   $sql = "INSERT INTO COMPANY VALUES ('$idnum','$name', '$department', '$amount', '$purchasedate', '$expectdate' , '$actualdate','$brand', '$maildate' , '', '')";
   $res = $db->exec($sql);
    //echo $sql;
   if(!$res){

      echo $db->lastErrorMsg();
      echo "<br>";
      
      //$ret = $db->exec($sql);
      //$idnum = $idnum + 1;
      echo "$idnum";
   }
   } else {
    echo $id_update_update;
     $sql = "UPDATE COMPANY SET NAME='$name', DEPARTMENT='$department', AMOUNT='$amount', PURCHASE_DATE='$purchasedate', EXPECT_DATE= '$expectdate',ACTUAL_DATE='$actualdate', BRAND = '$brand', MAIL_DATE = '$maildate' WHERE ID = $id_update_update";
     $ret = $db->query($sql);
   } 
//}
   
    if($department == 'electric') {
     echo  "<script type='text/javascript'>refresh();</script>";
   } else {
    echo  "<script type='text/javascript'>refresh_mech();</script>";
   }
}

?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/home/orangepi/bootstrap-3.3.7/docs/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/home/orangepi/bootstrap-3.3.7/docs/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/home/orangepi/bootstrap-3.3.7/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>

