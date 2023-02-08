

        <div class="panel panel-primary">
          <div class="panel-heading text-center">
            <h1>LIST OF ALL TABLES OF AMELIA</h1>
</div>    

        </div>



<?php 
$url = 'http://192.168.16.122:3000';

include('Control/Data_View_Control.php');
$get_data =new PrintAmeliaTables;

$get_data->Print_wp_amelia_categories($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

$get_data->Print_wp_amelia_users($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

$get_data->Print_wp_amelia_appointments($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 





$get_data->Print_wp_amelia_customer_bookings($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

$get_data->Print_wp_amelia_galleries($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

$get_data->Print_wp_amelia_locations($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

$get_data->Print_wp_amelia_providers_to_locations($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

$get_data->Print_wp_amelia_extras($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

$get_data->Print_wp_amelia_providers_to_daysoff($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

$get_data->Print_wp_amelia_providers_to_periods($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

$get_data->Print_wp_amelia_providers_to_services($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

$get_data->Print_wp_amelia_providers_to_weekdays($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

$get_data->Print_wp_amelia_services($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

?>






