<!DOCTYPE html>
<html>
  <head>
    <title>VIEW BEST CUSTOMERS</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css" />
  </head>
  <body>
    <form name="form1" method="post" action="">
    <div class="container">
      <div class="row col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading text-center">
            <h1>ENTER DATABASE PARAMETERS</h1>
</div>    

        </div>

        <div id="server">
              <p class="description"><?php echo __( 'Enter Database server (URL) ', 'myplugin' ); ?></p>
              <label><input class="regular-text" type="text" name="server" value="<?php echo $server; ?>"></label>
      </div>
      <div id="username">
              <p class="description"><?php echo __( 'Enter Username ', 'myplugin' ); ?></p>
              <label><input class="regular-text" type="text" name="username" value="<?php echo $username; ?>"></label>
      </div>
      <div id="password">
              <p class="description"><?php echo __( 'Enter Password ', 'myplugin' ); ?></p>
              <label><input class="regular-text" type="text" name="password" value="<?php echo $password; ?>"></label>
      </div>
        <div id="DB_Name">
              <p class="description"><?php echo __( 'Enter Database name ', 'myplugin' ); ?></p>
              <label><input class="regular-text" type="text" name="DB_Name" value="<?php echo $DB_Name; ?>"></label>
            <p class="submit"><input type="submit" name="Submit" class="button-primary" value="<?php echo __( 'PRINT TABLES', 'myplugin' ); ?>" /></p>
      </div>
    </div> 
  </form>

<?php 


if($_POST['Submit']){
if( (empty($_POST['server'])) ){
      echo '<div class="updated"><p><strong>'. __( 'Wrong settings: Please enter server (URL).', 'myplugin' ) .'</strong></p></div>';  
  }

else{
if( (empty($_POST['username'])) ){
      echo '<div class="updated"><p><strong>'. __( 'Wrong settings: Please enter username.', 'myplugin' ) .'</strong></p></div>';  
  }
  
else{
  if( (empty($_POST['DB_Name'])) ){
      echo '<div class="updated"><p><strong>'. __( 'Wrong settings: Please enter username.', 'myplugin' ) .'</strong></p></div>';  
  }
  
else{

  $conn = mysqli_connect($_POST['server'], $_POST['username'], $_POST['password'], $_POST['DB_Name']);
if($conn == FALSE){

 echo '<div class="updated"><p><strong>'. __( 'CONNECTION FAILED: Database server or Username or Password or Database name is/are INCORRECT', 'myplugin' ) .'</strong></p></div>'; 

}
else{

echo '<div class="updated"><p><strong>'. __( 'CONNECTION SUCCESSFUL.', 'myplugin' ) .'</strong></p></div>';

include('Data_View.php');



} 
}
}
}
}
?>




  </body>
</html>

