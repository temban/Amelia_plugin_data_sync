<div class="panel panel-primary">
        <div class="panel-heading text-center">
                <h1>LIST OF ALL TABLES OF AMELIA</h1>
        </div>

</div>



<?php
$url = 'http://192.168.43.7:3000';


include('Control/Data_View_Control.php');
$get_data = new PrintAmeliaTables;

$get_data->Print_wp_amelia_users_post($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

$get_data->Print_wp_amelia_users_insert($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 


$get_data->Print_wp_amelia_location_post($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

$get_data->Print_wp_amelia_location_insert($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 



$get_data->Print_wp_amelia_categories_post($_POST['server'], $_POST['username'], $_POST['password'], $_POST['DB_Name'], $url);

$get_data->Print_wp_amelia_categories_insert($_POST['server'], $_POST['username'], $_POST['password'], $_POST['DB_Name'], $url);



// $get_data->drop($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 



// $get_data->Print_wp_amelia_services_post($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

// $get_data->Print_wp_amelia_services_insert($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 





// $get_data->Print_wp_amelia_appointments($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

// $get_data->Print_wp_amelia_customer_bookings($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 



// $get_data->Print_wp_amelia_galleries($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

// $get_data->Print_wp_amelia_users($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 




// $get_data->Print_wp_amelia_providers_to_daysoff($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

// $get_data->Print_wp_amelia_providers_to_periods($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 


// $get_data->Print_wp_amelia_providers_to_services($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 

// $get_data->Print_wp_amelia_providers_to_weekdays($_POST['server'],$_POST['username'],$_POST['password'],$_POST['DB_Name'], $url); 





?>


