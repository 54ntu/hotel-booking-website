<?php
  //connect to database
  define('siteurl','http://localhost/BTR/');
  $hname='localhost';
  $uname='root';
  $pass='';
  $db='BTR_db';
  $conn = mysqli_connect($hname,$uname,$pass,$db);
  if(!$conn){

    die("cannot connect to database". mysqli_connect_errno());

  }

  function filteration($data){
    foreach($data as $key => $value){
        $data[$key]=trim($value);
        $data[$key]=stripslashes($value);
        $data[$key]=htmlspecialchars($value);
        $data[$key]=strip_tags($value);
    }
    return $data;
    
  }

  function select($sql,$values,$datatypes){

    $conn =$GLOBALS['conn'];
    if($stmt=mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $var1=mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $var1;
        }
        else{
            mysqli_stmt_close($stmt);
            die("query cannot be executed-select");
        }


    }
    else{
        die("query cannot be prepared-select");
    }

  }

  function update($sql,$values,$datatypes){
    $conn=$GLOBALS['conn'];
    if($stmt=mysqli_prepare($conn,$sql)){
      mysqli_stmt_bind_param($stmt,$datatypes,...$values);
      if(mysqli_stmt_execute($stmt)){
        $res=mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $res;
      }
      else{
        mysqli_stmt_close($stmt);
        die("query cannot be executed-update");
      }
    }
    else{
      die("query cannnot be prepared-update");
    }
  }


  function delete($sql,$values,$datatypes){
    $conn=$GLOBALS['conn'];
    if($stmt=mysqli_prepare($conn,$sql)){
      mysqli_stmt_bind_param($stmt,$datatypes,...$values);
      if(mysqli_stmt_execute($stmt)){
        $res=mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $res;
      }
      else{
        mysqli_stmt_close($stmt);
        die("query cannot be executed-delete");
      }
    }
    else{
      die("query cannnot be prepared-delete");
    }
  }

  function insert($sql,$values,$datatypes){
    $conn=$GLOBALS['conn'];
    if($stmt=mysqli_prepare($conn,$sql)){
      mysqli_stmt_bind_param($stmt,$datatypes,...$values);
      if(mysqli_stmt_execute($stmt)){
        $res=mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $res;
      }
      else{
        mysqli_stmt_close($stmt);
        die("query cannot be executed-insert");
      }
    }
    else{
      die("query cannnot be prepared-insert");
    }
  }


  function selectAll($table){
    $conn =$GLOBALS['conn'];
    $res=mysqli_query($conn,"select * from $table");
    return $res;
    
  }
?>