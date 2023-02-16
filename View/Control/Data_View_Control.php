<?php

class PrintAmeliaTables {

public function Print_wp_amelia_users_post($sname,$uname,$password,$db_name, $url){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		$this->url =$url; 
		

		$conn = mysqli_connect($sname, $uname, $password, $db_name);
				

		$sql_table_user="SELECT * FROM wp_amelia_users";
		$report_table_user=mysqli_query($conn,$sql_table_user);
		if($report_table_user== TRUE){ 
		while($row_table_user=mysqli_fetch_array($report_table_user) )
		{
			    $id = $row_table_user['id'];
				$status = $row_table_user['status'];
				$type = $row_table_user['type'];
				$externalId = $row_table_user['externalId'];
				$firstName = $row_table_user['firstName'];

				$lastName = $row_table_user['lastName'];
				$email = $row_table_user['email'];
				$birthday = $row_table_user['birthday'];
				$phone = $row_table_user['phone'];
				$gender = $row_table_user['gender'];
				$note = $row_table_user['note'];

				$description = $row_table_user['description'];
				$pictureFullPath = $row_table_user['pictureFullPath'];
				$pictureThumbPath = $row_table_user['pictureThumbPath'];
				$password = $row_table_user['password'];
				$usedTokens = $row_table_user['usedTokens'];

				$zoomUserId = $row_table_user['zoomUserId'];
				$countryPhoneIso = $row_table_user['countryPhoneIso'];
				$translations = $row_table_user['translations'];
				$timeZone = $row_table_user['timeZone'];
				$willOnHairId = $row_table_user['willOnHairColunm'];

				$postUser = [ 
					"id" => $willOnHairId,
					"ameliaId" => $id,
					"status" => strtoupper($status),
					"type" => strtoupper($type),
					"externalId" => $externalId,
					"firstName" => $firstName,
					"lastName" => $lastName,
					"email" => $email,
					"birthday" => $birthday,
					"phone" => $phone,
					"gender" => "MALE",
					"note" => $note,
					"description" => $description,
					"pictureFullPath" => $pictureFullPath,
					"pictureThumbPath" => $pictureThumbPath,
					"usedTokens" => $usedTokens,
					"zoomUserId" => $zoomUserId,
					"countryPhoneIso" => $countryPhoneIso,
					"translations" => $translations,
					"timeZone" => $timeZone,
					"username" => "",
					"accountNonExpired" => true,
					"accountNonLocked" => true,
					"credentialsNonExpired" => false,
					"enabled" => true
			];



$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "$url/api/v1/users",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS => json_encode($postUser),
CURLOPT_HTTPHEADER => array(
'Content-Type: application/json'
),
));

$response = curl_exec($curl);

curl_close($curl);
// echo "Sent User: $response<br>";
// echo "<br>";

		}

}


// $sql_deletecolumn="ALTER TABLE wp_amelia_users DROP willOnHairColunm";
// $report_deletecolumn=mysqli_query($conn,$sql_deletecolumn);

// if($report_deletecolumn !== FALSE)
// {
//    echo("The column has been deleted.");
// }else{
//    echo("The column has not been deleted.");
// }

}


public function Print_wp_amelia_users_insert($sname,$uname,$password,$db_name, $url){
	$this->sname= $sname;
	$this->uname=$uname;
	$this->password =$password;
	$this->db_name =$db_name;
	$this->url =$url;



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "$url/api/v1/users",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
$result = json_decode($response, true);
curl_close($curl);
// echo "<br>";
// echo "<br>";
// echo "Categories Inserted<br>";
// echo "$response<br>";
// echo "<br>";
// echo "<br>";

$i = 0;
while($i < count($result)) {
 
	           $willOnHairId = $result[$i]['id'];	
			   $ameliaId = $result[$i]['ameliaId'];
               $status = $result[$i]['status'];
				$type = $result[$i]['type'];
				$externalId = $result[$i]['externalId'];
				$firstName = $result[$i]['firstName'];

				$lastName = $result[$i]['lastName'];
				$email = $result[$i]['email'];
				$birthday = $result[$i]['birthday'];
				$phone = $result[$i]['phone'];
				$gender = $result[$i]['gender'];
				$note = $result[$i]['note'];

				$description = $result[$i]['description'];
				$pictureFullPath = $result[$i]['pictureFullPath'];
				$pictureThumbPath = $result[$i]['pictureThumbPath'];
				$usedTokens = $result[$i]['usedTokens'];

				$zoomUserId = $result[$i]['zoomUserId'];
				$countryPhoneIso = $result[$i]['countryPhoneIso'];
				$translations = $result[$i]['translations'];
				$timeZone = $result[$i]['timeZone'];

  $conn = mysqli_connect($sname, $uname, $password, $db_name);
							  
  $sql_userSend="SELECT * FROM wp_amelia_users WHERE id = '$ameliaId'";
  $report_userSend=mysqli_query($conn,$sql_userSend);
  
	  if(mysqli_num_rows($report_userSend) > 0){ 
	  
		

	  $checkColumnWill = "SELECT willOnHairColunm FROM wp_amelia_users WHERE id = '$ameliaId'";
	  $report_checkColumnWill=mysqli_query($conn,$checkColumnWill);
	  
	  if(mysqli_num_rows($report_checkColumnWill) > 0){
		  // $insertColumn = "INSERT INTO `wp_amelia_categories`(`willOnHairColunm`) VALUES ('$willOnHairId') WHERE id='$ameliaId'";
		  $updateColumn	= "UPDATE `wp_amelia_users` SET `willOnHairColunm`='$willOnHairId' WHERE id='$ameliaId'";
		  if (mysqli_query($conn,$updateColumn)){
	  
			  echo "<br>";
			  }
	  }
	  else{
	  $newCol	= "ALTER TABLE `wp_amelia_users` ADD `willOnHairColunm` INT(100) NOT NULL";
	  
	  if(mysqli_query($conn,$newCol)){
	  
		  $newUpdateColumn	= "UPDATE `wp_amelia_users` SET `willOnHairColunm`='$willOnHairId' WHERE id='$ameliaId'";
	  
		  if (mysqli_query($conn,$newUpdateColumn)){
		  
			  echo "<br>";
			  }
		  }
	  }

	    $updateUser	= "UPDATE `wp_amelia_users` SET `status`='$status',`type`='$type',`externalId`='$externalId',
		  `firstName`='$firstName',`lastName`='$lastName',`birthday`='$birthday',`phone`='$phone',`gender`='$gender',
		  `note`='$note',`description`='$description',`pictureFullPath`='$pictureFullPath',`pictureThumbPath`='$pictureThumbPath',`password`='$password',
		  `usedTokens`='$usedTokens',`zoomUserId`='$zoomUserId',`countryPhoneIso`='$countryPhoneIso',`translations`='$translations',`timeZone`='$timeZone', `email`='$email' WHERE id='$ameliaId'";

		  // $updateApp	= "UPDATE wp_amelia_appointments SET  bookingStart=$bookingStart, bookingEnd=$bookingEnd,	notifyParticipants=$notifyParticipants,	serviceId=$serviceId,	packageId=$packageId,	providerId=$providerId,	locationId=$locationId,	internalNotes=$internalNotes,	googleCalendarEventId=$googleCalendarEventId,	googleMeetUrl=$googleMeetUrl,	outlookCalendarEventId=$outlookCalendarEventId,	zoomMeeting=$zoomMeeting,	lessonSpace=$lessonSpace,	parentId=$parentId WHERE id = $id_get";
	  // $report_update = mysqli_query($conn,$updateApp);
	  if (mysqli_query($conn,$updateUser)){
		  
		  echo "<br> ";
	  }

  } else{

	$checkColumnWill1 = "SELECT willOnHairColunm FROM wp_amelia_users"; 
	$report_checkColumnWill1=mysqli_query($conn,$checkColumnWill1); 
	
	if(mysqli_num_rows($report_checkColumnWill1) > 0){ 
		$insertCat1 = "INSERT INTO `wp_amelia_users`(`id`, `status`, `type`, `externalId`, `firstName`, `lastName`, `birthday`, `phone`, `gender`, `note`,
		`description`, `pictureFullPath`, `pictureThumbPath`, `password`, `usedTokens`, `zoomUserId`, `countryPhoneIso`, `translations`, `timeZone`, `email`,`willOnHairColunm`) 
		VALUES ('','$status','$type','$externalId','$firstName','$lastName','$birthday','$phone','$gender','$note','$description',
		'$pictureFullPath','$pictureThumbPath','','$usedTokens','$zoomUserId','$countryPhoneIso','$translations','$timeZone','$email', '$willOnHairId')";
			if (mysqli_query($conn,$insertCat1)){ 
			echo "<br>"; 
			} 
     } 
      else{ 
	$newCol1  = "ALTER TABLE wp_amelia_users ADD willOnHairColunm INT(100) NOT NULL"; 
	 
	if(mysqli_query($conn,$newCol1)){ 
	   
			  if(mysqli_num_rows($report_checkColumnWill1) > 0){ 
				$insertCat2 = "INSERT INTO `wp_amelia_users`(`id`, `status`, `type`, `externalId`, `firstName`, `lastName`,  `birthday`, `phone`, `gender`, `note`,
				`description`, `pictureFullPath`, `pictureThumbPath`, `password`, `usedTokens`, `zoomUserId`, `countryPhoneIso`, `translations`, `timeZone`, `email`,`willOnHairColunm`) 
				VALUES ('','$status','$type','$externalId','$firstName','$lastName','$birthday','$phone','$gender','$note','$description',
				'$pictureFullPath','$pictureThumbPath','','$usedTokens','$zoomUserId','$countryPhoneIso','$translations','$timeZone', '$email', '$willOnHairId')";					if (mysqli_query($conn,$insertCat2)){ 
					echo "<br>"; 
					} 
			}  
	  } 
	} 



	  }


  $i++;
}

			//connect to database
			$conn = mysqli_connect($sname, $uname, $password, $db_name);
							
		
			$sql_table_user="SELECT * FROM wp_amelia_users";
			$report_table_user=mysqli_query($conn,$sql_table_user);
			if($report_table_user== TRUE){ 
			echo "TABLE NAME: wp_amelia_users";
			echo "<table border='5'>";
			echo "<tr>
			<th>id</th>
			<th>status</th>   <th>type</th>  <th>externalId</th>  
			<th>firstName</th>   <th>lastName</th>  <th>email</th> 
			<th>birthday</th>  <th>phone</th>  <th>gender</th>   <th>note</th>  
			<th>description</th>   <th>pictureFullPath</th>  <th>pictureThumbPath</th> 
			<th>password</th>  <th>usedTokens</th>  <th>zoomUserId</th>  <th>countryPhoneIso</th> 
			<th>translations</th>  <th>timeZone</th></tr>";

			while($row_table_user=mysqli_fetch_array($report_table_user) )
			{

			
				echo "<td>";									
				echo$row_table_user['id'];
				echo "</td><td>";
				echo$row_table_user['status'];
				echo "</td><td>";
				echo$row_table_user['type'];
				echo "</td><td>";									
				echo$row_table_user['externalId'];
				echo "</td><td>";
				echo$row_table_user['firstName'];
				echo "</td><td>";
				echo$row_table_user['lastName'];
				echo "</td><td>";
				echo$row_table_user['email'];
				echo "</td><td>";									
				echo$row_table_user['birthday'];
				echo "</td><td>";									
				echo$row_table_user['phone'];
				echo "</td><td>";									
				echo$row_table_user['gender'];
				echo "</td><td>";
				echo$row_table_user['note'];
				echo "</td><td>";
				echo$row_table_user['description'];
				echo "</td><td>";									
				echo$row_table_user['pictureFullPath'];
				echo "</td><td>";
				echo$row_table_user['pictureThumbPath'];
				echo "</td><td>";
				echo$row_table_user['password'];
				echo "</td><td>";
				echo$row_table_user['usedTokens'];
				echo "</td><td>";									
				echo$row_table_user['zoomUserId'];
				echo "</td><td>";									
				echo$row_table_user['countryPhoneIso'];
				echo "</td><td>";									
				echo$row_table_user['translations'];
				echo "</td><td>";									
				echo$row_table_user['timeZone'];
				echo "</td></tr>";
		
			
		}
		echo"</table>";
		
}
	
		}






		//Categories get and post
		//============= post to database ======================
		public function Print_wp_amelia_categories_post($sname,$uname,$password,$db_name, $url){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
			$this->url =$url;
			
			
						
						//connect to database
						$conn = mysqli_connect($sname, $uname, $password, $db_name);
						
						
						$sqlCreate = "CREATE TABLE willOnHairTableCat(
							`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
							`willOnHairCol` INT(100) NOT NULL DEFAULT 0,
							`ameliaCol` INT(100) NOT NULL,
	                        `status` enum('hidden','visible','disabled') NOT NULL DEFAULT 'visible',
	                        `name` varchar(255) NOT NULL DEFAULT '',
                         	`position` int(11) NOT NULL,
                         	`translations` text DEFAULT NULL
						)";
						
							$report_sqlCreate=mysqli_query($conn,$sqlCreate);
						
							if ($report_sqlCreate === TRUE) {
							  echo "Table willOnHairTableCat created successfully <br>";
							} else {
							  echo "Error creating table: <br>";
							}

							
							$sql_amelia_willOnHairTableCat="SELECT * FROM wp_amelia_categories";
							$report_amelia_willOnHairTableCat=mysqli_query($conn,$sql_amelia_willOnHairTableCat);

							if($report_amelia_willOnHairTableCat== TRUE){ 


							while($row_amelia_willOnHairTableCat=mysqli_fetch_array($report_amelia_willOnHairTableCat))
							{
							
									$ameliaId = $row_amelia_willOnHairTableCat['id'];

									$status = $row_amelia_willOnHairTableCat['status'];	
									$name = $row_amelia_willOnHairTableCat['name'];

									$position = $row_amelia_willOnHairTableCat['position'];
									$translations = $row_amelia_willOnHairTableCat['translations'];

									// echo "ameliaId: $row_amelia_willOnHairTableCa['id'] <br>";
									// echo "status: $row_amelia_willOnHairTableCa['status']<br>";
									// echo "name: $row_amelia_willOnHairTableCa['name'] <br>";
									// echo "position: $row_amelia_willOnHairTableCa['position'] <br>";
									// echo "translations: $row_amelia_willOnHairTableCa['translations'] <br>";
				 
									$conn = mysqli_connect($sname, $uname, $password, $db_name);
											   
				 
				 
									  $qry="SELECT * FROM willOnHairTableCat";
									  $rowCheck=mysqli_query($conn,$qry);
		  

										  if ($rowCheck ==TRUE) { 

											


											$qry = "INSERT INTO willOnHairTableCat (`ameliaCol`, `status`, `name`, `position`, `translations`)
											  VALUES ('$ameliaId','$status', '$name', '$position','$translations')"; 
											if (mysqli_query($conn,$qry)){ 
											echo "cat insert ELSE 1 <br>"; 
											}  
											 // insert the data if data is not exist
											 
										  }
							}
						}
			
								$sql_table3="SELECT * FROM willOnHairTableCat";
								$report_table3=mysqli_query($conn,$sql_table3);
								if($report_table3== TRUE ){ 
			
								while($row_table3=mysqli_fetch_array($report_table3) )
								{
							

			                        $willOnHairId = $row_table3['willOnHairCol'];
									$ameliaId = $row_table3['ameliaCol'];
									$statusC = $row_table3['status'];
									$nameC = $row_table3['name'];
									$positionC = $row_table3['position'];
									$translationsC = $row_table3['translations'];
			
									$postCat = [ 
										"id" => $willOnHairId,
										"ameliaId" => $ameliaId,
										"status" => strtoupper($statusC),
										"name" => $nameC,
										"position" => $positionC,
										"translations" => $translationsC,
										"image" => "string",
										"note" => "string"
								];
			
									$curl = curl_init();
									
									curl_setopt_array($curl, array(
									  CURLOPT_URL => "$url/api/v1/categories",
									  CURLOPT_RETURNTRANSFER => true,
									  CURLOPT_ENCODING => '',
									  CURLOPT_MAXREDIRS => 1,
									  CURLOPT_TIMEOUT => 0,
									  CURLOPT_FOLLOWLOCATION => true,
									  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									  CURLOPT_CUSTOMREQUEST => 'POST',
									  CURLOPT_POSTFIELDS => json_encode($postCat),
									  CURLOPT_HTTPHEADER => array(
										'Content-Type: application/json'
									  ),
									));
									
									$response = curl_exec($curl);
			
							 curl_close($curl);
							 echo "<br>";
			// echo "<br>";
			// echo "Categories post<br>";
			// echo json_encode($response);
			// echo "<br>";
			// echo "<br>";
			



							}

												
				}


				$sql_OUR="SELECT * FROM willOnHairTableCat";
				$report_OUR=mysqli_query($conn,$sql_OUR);
				if($report_OUR== TRUE){ 
				echo "<br>TABLE NAME: wp_OUR_TABLE_POST<br>";
				echo "<table border='5'>";
				echo "<tr><th>id</th>
				<th>willOnHairCol</th> <th>ameliaCol</th>  <th>status</th>  <th>name</th><th>position</th>
				<th>translations</th></tr>";
				
				while($row_OUR=mysqli_fetch_array($report_OUR) )
				{
				
				
					echo "<tr><td>";									
					echo$row_OUR['id'];
					echo "</td><td>";
					echo$row_OUR['willOnHairCol'];
					echo "</td><td>";
					echo$row_OUR['ameliaCol'];
					echo "</td><td>";
					echo$row_OUR['status'];
					echo "</td><td>";
					echo$row_OUR['name'];
					echo "</td><td>";
					echo$row_OUR['position'];
					echo "</td><td>";									
					echo$row_OUR['translations'];
					echo "</td></tr>";
					echo"<tr></tr>";
					echo"<tr></tr>";
					echo"<tr></tr>";
				
				}
				echo"</table>";
				
				}


				// $query = "DROP table willOnHairTableCat";
				// 			if (mysqli_multi_query($conn, $query)) {
				// 			  echo "Dropped Successfully";
				// 			} else {
				// 			  echo "Error:" . mysqli_error($conn);
				// 			}	

// 				$sql_willOnHairColunm="ALTER TABLE wp_amelia_categories DROP willOnHairColunm";
// $report_willOnHairColunm=mysqli_query($conn,$sql_willOnHairColunm);
// if($report_willOnHairColunm !== FALSE)
// {
//    echo("The column has been deleted.");
// }else{
//    echo("The column has not been deleted.");
// }
			}
			
			//=============get from databa and insert in amelia_categories ===============
			public function Print_wp_amelia_categories_insert($sname,$uname,$password,$db_name, $url){
				$this->sname= $sname;
				$this->uname=$uname;
				$this->password =$password;
				$this->db_name =$db_name;
				$this->url =$url;
			

				$conn = mysqli_connect($sname, $uname, $password, $db_name);			

				// $sqlCreate = "CREATE TABLE willOnHairTableCat(
				// 	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
				// 	`willOnHairCol` INT(100) NOT NULL DEFAULT 0,
				// 	`ameliaCol` INT(100) NOT NULL,
				// 	`status` enum('hidden','visible','disabled') NOT NULL DEFAULT 'visible',
				// 	`name` varchar(255) NOT NULL DEFAULT '',
				// 	 `position` int(11) NOT NULL,
				// 	 `translations` text DEFAULT NULL
				// )";
				
				// 	$report_sqlCreate=mysqli_query($conn,$sqlCreate);
				
				// 	if ($report_sqlCreate == TRUE) {
				// 	  echo "Table willOnHairTableCat created successfully <br>";
				// 	} else {
				// 	  echo "Error creating table: <br>";
				// 	}


			$curl = curl_init();
			
			curl_setopt_array($curl, array(
			CURLOPT_URL => "$url/api/v1/categories",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
			),
			));
			
			$response = curl_exec($curl);
			$result = json_decode($response, true);
			curl_close($curl);
			
			
			$i = 0;
			while($i < count($result)) {
			$willOnHairId = $result[$i]['id'];	
			$ameliaId = $result[$i]['ameliaId'];	
			$status = $result[$i]['status'];
			$name = $result[$i]['name'];
			$position = $result[$i]['position'];
			$translations = $result[$i]['translations'];
			
			
			$conn = mysqli_connect($sname, $uname, $password, $db_name);			
			$sql_catSend="SELECT * FROM willOnHairTableCat WHERE willOnHairCol=$willOnHairId";
			$report_catSend=mysqli_query($conn,$sql_catSend);
			
			if($report_catSend == FALSE){ 
					  $insertCat1 = "INSERT INTO willOnHairTableCat(`willOnHairCol`, `ameliaCol`, `status`, `name`, `position`, `translations`) 
					  VALUES ('$willOnHairId', '$ameliaId', '$status','$name','$position','$translations')"; 
						  if (mysqli_query($conn,$insertCat1)){ 
						  echo "cat insert ELSE 1 <br>"; 
						  }  
				 
				}
			
			
			
			
			$i++;
			}
			

			

			$conn = mysqli_connect($sname, $uname, $password, $db_name);			
			$sql_amelia_willOnHairTableCat="SELECT * FROM willOnHairTableCat";
			$report_amelia_willOnHairTableCat=mysqli_query($conn,$sql_amelia_willOnHairTableCat);

			if($report_amelia_willOnHairTableCat== TRUE ){ 
			while($row_amelia_willOnHairTableCat=mysqli_fetch_array($report_amelia_willOnHairTableCat))
			{

					$willOnHairId = $row_amelia_willOnHairTableCat['willOnHairCol'];	
					$ameliaId = $row_amelia_willOnHairTableCat['ameliaCol'];

					$status = $row_amelia_willOnHairTableCat['status'];	
					$name = $row_amelia_willOnHairTableCat['name'];

					$position = $row_amelia_willOnHairTableCat['position'];
					$translations = $row_amelia_willOnHairTableCat['translations'];


				$sql_amelia_insert="SELECT * FROM wp_amelia_categories WHERE id = '$ameliaId'";
				$report_amelia_insert=mysqli_query($conn,$sql_amelia_insert);
				
				if(mysqli_num_rows($report_amelia_insert) < 0){ 
					$insertamelia_insert = "INSERT INTO wp_amelia_categories(`status`, `name`, `position`, `translations`) VALUES ('$status','$name','$position','$translations')"; 
					if (mysqli_query($conn,$insertamelia_insert)){ 
					echo "cat insert ELSE 1 <br>"; 
                          
					$last_id = mysqli_insert_id($conn);
					if( $last_id ==TRUE ){
							$willOnHairTableCat_updateTable	= "UPDATE `willOnHairTableCat` SET `ameliaCol`='$last_id' WHERE willOnHairCol = '$willOnHairId'";
	
							if (mysqli_query($conn,$willOnHairTableCat_updateTable)){
							
							echo " cat update IF <br>";
                            


							$postCat = [ 
								"id" => $willOnHairId,
								"ameliaId" => $ameliaId,
								"status" => strtoupper($status),
								"name" => $name,
								"position" => $position,
								"translations" => $translations,
								"image" => "string",
								"note" => "string"
						];
	
							$curl = curl_init();
							
							curl_setopt_array($curl, array(
							  CURLOPT_URL => "$url/api/v1/categories",
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => '',
							  CURLOPT_MAXREDIRS => 1,
							  CURLOPT_TIMEOUT => 0,
							  CURLOPT_FOLLOWLOCATION => true,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => 'POST',
							  CURLOPT_POSTFIELDS => json_encode($postCat),
							  CURLOPT_HTTPHEADER => array(
								'Content-Type: application/json'
							  ),
							));
							
							$response = curl_exec($curl);
	
					 curl_close($curl);
					 echo "<br>";


							}


					}
					

				
					
					}  
	
			
	
				} 
				$i++;
				}
			}





			$sql_OUR="SELECT * FROM willOnHairTableCat";
			$report_OUR=mysqli_query($conn,$sql_OUR);
			if($report_OUR== TRUE){ 
			echo "<br>TABLE NAME: wp_OUR_TABLE_GET<br>";
			echo "<table border='5'>";
			echo "<tr><th>id</th>
			<th>willOnHairCol</th> <th>ameliaCol</th>  <th>status</th> <th>name</th><th>position</th>
			<th>translations</th></tr>";
			
			while($row_OUR=mysqli_fetch_array($report_OUR) )
			{
			
			
				echo "<tr><td>";									
				echo$row_OUR['id'];
				echo "</td><td>";
				echo$row_OUR['willOnHairCol'];
				echo "</td><td>";
				echo$row_OUR['ameliaCol'];
				echo "</td><td>";
				echo$row_OUR['status'];
				echo "</td><td>";
				echo$row_OUR['name'];
				echo "</td><td>";
				echo$row_OUR['position'];
				echo "</td><td>";									
				echo$row_OUR['translations'];
				echo "</td></tr>";
				echo"<tr></tr>";
				echo"<tr></tr>";
				echo"<tr></tr>";
			
			}
			echo"</table>";
			
			}


			// $query = "DROP table willOnHairTableCat";
			// if (mysqli_multi_query($conn, $query)) {
			//   echo "Dropped Successfully";
			// } else {
			//   echo "Error:" . mysqli_error($conn);
			// }	
			
			
			$sql_table3="SELECT * FROM wp_amelia_categories";
			$report_table3=mysqli_query($conn,$sql_table3);
			if($report_table3== TRUE){ 
			echo "TABLE NAME: wp_amelia_categories";
			echo "<table border='5'>";
			echo "<tr><th>id</th>
			<th>status</th><th>name</th><th>position</th>
			<th>translations</th></tr>";
			
			while($row_table3=mysqli_fetch_array($report_table3) )
			{
			
			
				echo "<tr><td>";									
				echo$row_table3['id'];
				echo "</td><td>";
				echo$row_table3['status'];
				echo "</td><td>";
				echo$row_table3['name'];
				echo "</td><td>";
				echo$row_table3['position'];
				echo "</td><td>";									
				echo$row_table3['translations'];
				echo "</td></tr>";
				echo"<tr></tr>";
				echo"<tr></tr>";
				echo"<tr></tr>";
			
			}
			echo"</table>";
			
			}
			
			}

			public function drop($sname,$uname,$password,$db_name, $url){
				$conn = mysqli_connect($sname, $uname, $password, $db_name);
				$sql_deletecolumn="ALTER TABLE wp_amelia_categories DROP willOnHairColunm";
				$report_deletecolumn=mysqli_query($conn,$sql_deletecolumn);
				
				if($report_deletecolumn !== FALSE)
				{
				   echo("The column has been deleted.");
				}else{
				   echo("The column has not been deleted.");
				}	
							}














//Services get and post
		//============= post Services to database ======================			


		public function Print_wp_amelia_services_post($sname,$uname,$password,$db_name, $url){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
			$this->url = $url; 
							
							//connect to database
							$conn = mysqli_connect($sname, $uname, $password, $db_name);
							
		
									$Print_services_Table="SELECT * FROM wp_amelia_services";
									$Print_services_Table=mysqli_query($conn,$Print_services_Table);
									if($Print_services_Table== TRUE){ 
									
		
									while($row_table_user=mysqli_fetch_array($Print_services_Table) )
									{
		
		
										$id = $row_table_user['id'];
										$name = $row_table_user['name'];
										$description = $row_table_user['description'];
										$color = $row_table_user['color'];
										$price = $row_table_user['price'];
		
										$status = $row_table_user['status'];
										$categoryId = $row_table_user['categoryId'];
										$minCapacity = $row_table_user['minCapacity'];
										$maxCapacity = $row_table_user['maxCapacity'];
										$duration = $row_table_user['duration'];
		
										$timeBefore = $row_table_user['timeBefore'];
										$timeAfter = $row_table_user['timeAfter'];
										$bringingAnyone = $row_table_user['bringingAnyone'];
										$priority = $row_table_user['priority'];
										$pictureFullPath = $row_table_user['pictureFullPath'];
		
										$pictureThumbPath = $row_table_user['pictureThumbPath'];
										$position = $row_table_user['position'];
										$show = $row_table_user['show'];
										$aggregatedPrice = $row_table_user['aggregatedPrice'];
										$settings = $row_table_user['settings'];
		
										$recurringCycle = $row_table_user['recurringCycle'];
										$recurringSub = $row_table_user['recurringSub'];
										$recurringPayment = $row_table_user['recurringPayment'];
										$translations = $row_table_user['translations'];
										$depositPayment = $row_table_user['depositPayment'];
		
										$depositPerPerson = $row_table_user['depositPerPerson'];
										$deposit = $row_table_user['deposit'];
										$fullPayment = $row_table_user['fullPayment'];
										$mandatoryExtra = $row_table_user['mandatoryExtra'];
										$minSelectedExtras = $row_table_user['minSelectedExtras'];
		
										$customPricing = $row_table_user['customPricing'];
										$maxExtraPeople = $row_table_user['maxExtraPeople'];
										$limitPerCustomer = $row_table_user['limitPerCustomer'];
		
		
										$postServices = [ 
											"id" => $id,
											"name" => $name,
											"description" => $description,
											"color" => $color,
											"price" => $price,
											"status" => strtoupper($status),
											"minCapacity" => $minCapacity,
											"maxCapacity" => $maxCapacity,
											"duration" => $duration,
											"timeBefore" => $timeBefore,
											"timeAfter" => $timeAfter,
											"bringingAnyone" => $bringingAnyone,
											"priority" => strtoupper($priority),
											"position" => $position,
											"show" => $show,
											"aggregatedPrice" => $aggregatedPrice,
											"settings" => $settings,
											"recurringCycle" => strtoupper($recurringCycle),
											"recurringSub" => strtoupper($recurringSub),
											"recurringPayment" => $recurringPayment,
											"translation" => $translations,
											"depositPayment" => strtoupper($depositPayment),
											"depositPerPerson" => $depositPerPerson,
											"deposit" => $deposit,
											"fullPayment" => $fullPayment,
											"mendatoryExtra" => $mandatoryExtra ,
											"minSelectedExtra" => $minSelectedExtras,
											"customPricing" => $customPricing,
											"maxExtraPeople" => $maxExtraPeople,
											"limitPerCustomer" => $limitPerCustomer,
											"imageUrl" => $pictureFullPath
		
										
											//"status" => strtoupper($statusC),
									];
		
		$curl = curl_init();
		
		curl_setopt_array($curl, array( 
		  CURLOPT_URL => "$url/api/v1/categories/$categoryId/services",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 1,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => json_encode($postServices),
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		  ),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		echo "<br>";
		echo "<br>";
		echo "Services post<br>";
		echo "$response<br>";
		echo "<br>";
		echo "<br>";
		
								}
								
					}
				}
		
		//============= get services and insert in amelia services ==============
		
				public function Print_wp_amelia_services_insert($sname,$uname,$password,$db_name, $url){
					$this->sname= $sname;
					$this->uname=$uname;
					$this->password =$password;
					$this->db_name =$db_name;
					$this->url = $url; 
		
		
			$curl = curl_init();
		
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "$url/api/v1/services",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			  ),
			));
			
			$response = curl_exec($curl);
			$result = json_decode($response, true);
			curl_close($curl);
			print_r ( "id: {$result[0]['category']['id']}<br>");
		
		
		
		  $i = 0;
		  while($i < count($result)) {
			$id = $result[$i]['id'];	
			$name = $result[$i]['name'];
			$description = $result[$i]['description'];
			$color = $result[$i]['color'];
			$price = $result[$i]['price'];
		
			$categoryId = $result[$i]['category']['id'];
			$status = $result[$i]['status'];
			$minCapacity = $result[$i]['minCapacity'];
			$maxCapacity = $result[$i]['maxCapacity'];
			$duration = $result[$i]['duration'];
			
			$timeBefore = $result[$i]['timeBefore'];	
			$timeAfter = $result[$i]['timeAfter'];
			$bringingAnyone = $result[$i]['bringingAnyone'];
			$priority = $result[$i]['priority'];
			$position = $result[$i]['position'];
			
			$show = $result[$i]['show'];	
			$aggregatedPrice = $result[$i]['aggregatedPrice'];
			$settings = $result[$i]['settings'];
			$recurringCycle = $result[$i]['recurringCycle'];
			$recurringSub = $result[$i]['recurringSub'];
		
			$recurringPayment = $result[$i]['recurringPayment'];	
			$translation = $result[$i]['translation'];
			$depositPayment = $result[$i]['depositPayment'];
			$depositPerPerson = $result[$i]['depositPerPerson'];
			$deposit = $result[$i]['deposit'];
			
			$fullPayment = $result[$i]['fullPayment'];	
			$mendatoryExtra = $result[$i]['mendatoryExtra'];
			$minSelectedExtra = $result[$i]['minSelectedExtra'];
			$customPricing = $result[$i]['customPricing'];
			$maxExtraPeople = $result[$i]['maxExtraPeople'];
			$limitPerCustomer = $result[$i]['limitPerCustomer'];
			$imageUrl = $result[$i]['imageUrl'];
		
			$conn = mysqli_connect($sname, $uname, $password, $db_name);
										
			$sql_catSend="SELECT * FROM wp_amelia_categories WHERE id = '$id'";
			$report_catSend=mysqli_query($conn,$sql_catSend);
			
				if(mysqli_num_rows($report_catSend) > 0){ 
				
					$updateCat	= "UPDATE `wp_amelia_services` SET `name`='$name',`description`='$description',
					`color`='$color,`price`='$price',`status`='$status',`categoryId`='$categoryId',`minCapacity`='$minCapacity',
					`maxCapacity`='$maxCapacity,`duration`='$nameduration',`timeBefore`='$ntimeBeforeame',`timeAfter`='$timeAfter',`bringingAnyone`='$bringingAnyone',
					`priority`='$priority',`pictureFullPath`='$pictureFullPath',`pictureThumbPath`='$pictureThumbPath',`position`='$position',`show`='$show',
					`aggregatedPrice`='$aggregatedPrice',`settings`='$settings',`recurringCycle`='$recurringCycle',`recurringSub`='$recurringSub',
					`recurringPayment`='$recurringPayment',`translations`='$translations',`depositPayment`='$depositPayment',`depositPerPerson`='$depositPerPerson',
					`deposit`='$deposit',`fullPayment`='$fullPayment',`mandatoryExtra`='$mandatoryExtra',
					`minSelectedExtras`='$name',`customPricing`='$customPricing',`maxExtraPeople`='$maxExtraPeople',`limitPerCustomer`='$limitPerCustomer' WHERE id='$id'";
		
					// $updateApp	= "UPDATE wp_amelia_appointments SET  bookingStart=$bookingStart, bookingEnd=$bookingEnd,	notifyParticipants=$notifyParticipants,	serviceId=$serviceId,	packageId=$packageId,	providerId=$providerId,	locationId=$locationId,	internalNotes=$internalNotes,	googleCalendarEventId=$googleCalendarEventId,	googleMeetUrl=$googleMeetUrl,	outlookCalendarEventId=$outlookCalendarEventId,	zoomMeeting=$zoomMeeting,	lessonSpace=$lessonSpace,	parentId=$parentId WHERE id = $id_get";
				// $report_update = mysqli_query($conn,$updateApp);
				if (mysqli_query($conn,$updateCat)){
					
					echo " update Services <br> ";
				}
			} else{
				  $insertCat = "INSERT INTO `wp_amelia_services`(`id`, `name`, `description`, `color`, `price`, `status`, `categoryId`, `minCapacity`,
				   `maxCapacity`, `duration`, `timeBefore`, `timeAfter`, `bringingAnyone`, `priority`, `pictureFullPath`, `pictureThumbPath`, `position`,
					`show`, `aggregatedPrice`, `settings`, `recurringCycle`, `recurringSub`, `recurringPayment`, `translations`, `depositPayment`,
					 `depositPerPerson`, `deposit`, `fullPayment`, `mandatoryExtra`, `minSelectedExtras`, `customPricing`, `maxExtraPeople`, `limitPerCustomer`)
					  VALUES ('$id','$name','$description','$color','$price','$status','$categoryId','$minCapacity','$maxCapacity','$duration',
					  '$timeBefore','$timeAfter','$bringingAnyone','$priority','$pictureFullPath','$pictureThumbPath','$position','$show','$aggregatedPrice','$settings',
					  '$recurringCycle','$recurringSub','$recurringPayment','$translations','$depositPayment','$depositPerPerson','$deposit','$fullPayment','$mandatoryExtra',
					  '$minSelectedExtras','$customPricing','$maxExtraPeople','$limitPerCustomer')";
				  if (mysqli_query($conn,$insertCat)){
					echo " insert Services <br>";
				}
		
				}
		
		
			$i++;
		  }
				
		  
		  $conn = mysqli_connect($sname, $uname, $password, $db_name);
							
		
		  $Print_services_Table="SELECT * FROM wp_amelia_services";
		  $Print_services_Table=mysqli_query($conn,$Print_services_Table);
		  if($Print_services_Table== TRUE){ 
		  echo "TABLE NAME: wp_amelia_services";
		  echo "<table border='5'>";
		  echo "<tr>
		  <th>id</th>
		  <th>name</th>   <th>description</th>  <th>color</th>  
		  <th>price</th>   <th>status</th>  <th>categoryId</th> 
		  <th>minCapacity</th>  <th>maxCapacity</th> 
		
		  <th>duration</th>   <th>timeBefore</th>  <th>timeAfter</th>  
		  <th>bringingAnyone</th>   <th>priority</th>  <th>pictureFullPath</th> 
		  <th>pictureThumbPath</th>  <th>position</th>
		  
		  <th>show</th>   <th>aggregatedPrice</th>  <th>settings</th>  
		  <th>recurringCycle</th>   <th>recurringSub</th>  <th>recurringPayment</th> 
		  <th>translations</th>  <th>depositPayment</th>
		  
		  <th>depositPerPerson</th>   <th>deposit</th>  <th>fullPayment</th>  
		  <th>mandatoryExtra</th>   <th>minSelectedExtras</th>  <th>customPricing</th> 
		  <th>maxExtraPeople</th>  <th>limitPerCustomer</th>
		  </tr>";
		
		  while($row_table_user=mysqli_fetch_array($Print_services_Table) )
		  {
		
		  
			  echo "<td>";									
			  echo$row_table_user['id'];
			  echo "</td><td>";
			  echo$row_table_user['name'];
			  echo "</td><td>";
			  echo$row_table_user['description'];
			  echo "</td><td>";									
			  echo$row_table_user['color'];
			  echo "</td><td>";
			  echo$row_table_user['price'];
			  echo "</td><td>";
			  echo$row_table_user['status'];
			  echo "</td><td>";
			  echo$row_table_user['categoryId'];
			  echo "</td><td>";									
			  echo$row_table_user['minCapacity'];
			  echo "</td><td>";									
			  echo$row_table_user['maxCapacity'];
			  echo "</td><td>";									
			  echo$row_table_user['duration'];
			  echo "</td><td>";
			  echo$row_table_user['timeBefore'];
			  echo "</td><td>";
			  echo$row_table_user['timeAfter'];
			  echo "</td><td>";									
			  echo$row_table_user['bringingAnyone'];
			  echo "</td><td>";
			  echo$row_table_user['priority'];
			  echo "</td><td>";
			  echo$row_table_user['pictureFullPath'];
			  echo "</td><td>";
			  echo$row_table_user['pictureThumbPath'];
			  echo "</td><td>";									
			  echo$row_table_user['position'];
			  echo "</td><td>";									
			  echo$row_table_user['show'];
			  echo "</td><td>";								
			  echo$row_table_user['aggregatedPrice'];
			  echo "</td><td>";
			  echo$row_table_user['settings'];
			  echo "</td><td>";
			  echo$row_table_user['recurringCycle'];
			  echo "</td><td>";									
			  echo$row_table_user['recurringSub'];
			  echo "</td><td>";
			  echo$row_table_user['recurringPayment'];
			  echo "</td><td>";
			  echo$row_table_user['translations'];
			  echo "</td><td>";
			  echo$row_table_user['depositPayment'];
			  echo "</td><td>";									
			  echo$row_table_user['depositPerPerson'];
			  echo "</td><td>";									
			  echo$row_table_user['deposit'];
			  echo "</td><td>";									
			  echo$row_table_user['fullPayment'];
			  echo "</td><td>";
			  echo$row_table_user['mandatoryExtra'];
			  echo "</td><td>";
			  echo$row_table_user['minSelectedExtras'];
			  echo "</td><td>";									
			  echo$row_table_user['customPricing'];
			  echo "</td><td>";
			  echo$row_table_user['maxExtraPeople'];
			  echo "</td><td>";
			  echo$row_table_user['limitPerCustomer'];
			  echo "</td></tr>";
		
		
		}
		echo"</table>";
		
				}		
		
			}
		
		




















































public function Print_wp_amelia_providers_to_weekdays($sname,$uname,$password,$db_name, $url){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		$this->url =$url;
		  
		  //connect to database
		  $conn = mysqli_connect($sname, $uname, $password, $db_name);
		  
		
		  $sql_table_wp_amelia_providers_to_weekdays="SELECT * FROM wp_amelia_providers_to_weekdays";
		  $report_table_wp_amelia_providers_to_weekdays=mysqli_query($conn,$sql_table_wp_amelia_providers_to_weekdays);
		  if($report_table_wp_amelia_providers_to_weekdays== TRUE){ 
		  echo "TABLE NAME: wp_amelia_providers_to_weekdays";
		  echo "<table border='5'>";
		  echo "<tr>
		  <th>id</th>
		  <th>userId</th>  <th>dayIndex</th>  <th>startTime</th> <th>endTime</th></tr>";
		
		  while($row_table_wp_amelia_providers_to_weekdays=mysqli_fetch_array($report_table_wp_amelia_providers_to_weekdays) )
		  {
		
		  
		  echo "<td>";									
		  echo$row_table_wp_amelia_providers_to_weekdays['id'];
		  echo "</td><td>";
		  echo$row_table_wp_amelia_providers_to_weekdays['userId'];
		  echo "</td><td>";
		  echo$row_table_wp_amelia_providers_to_weekdays['dayIndex'];
		  echo "</td><td>";
		  echo$row_table_wp_amelia_providers_to_weekdays['startTime'];
		  echo "</td><td>";
		  echo$row_table_wp_amelia_providers_to_weekdays['endTime'];
		  echo "</td></tr>";
		  
		  
		  }
		  echo"</table>";
		  
		  }
		  }	
	  

public function Print_wp_amelia_providers_to_services($sname,$uname,$password,$db_name, $url){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		$this->url =$url;
		  
		  //connect to database
		  $conn = mysqli_connect($sname, $uname, $password, $db_name);
		  
		
		  $sql_table_wp_amelia_providers_to_services="SELECT * FROM wp_amelia_providers_to_services";
		  $report_table_wp_amelia_providers_to_services=mysqli_query($conn,$sql_table_wp_amelia_providers_to_services);
		  if($report_table_wp_amelia_providers_to_services== TRUE){ 
		  echo "TABLE NAME: wp_amelia_providers_to_services";
		  echo "<table border='5'>";
		  echo "<tr>
		  <th>id</th>
		  <th>serviceId</th>  <th>price</th>  <th>minCapacity</th> <th>maxCapacity</th>  <th>customPricing</th></tr>";
		
		  while($row_table_wp_amelia_providers_to_services=mysqli_fetch_array($report_table_wp_amelia_providers_to_services) )
		  {
		
		  
		  echo "<td>";									
		  echo$row_table_wp_amelia_providers_to_services['id'];
		  echo "</td><td>";
		  echo$row_table_wp_amelia_providers_to_services['serviceId'];
		  echo "</td><td>";
		  echo$row_table_wp_amelia_providers_to_services['price'];
		  echo "</td><td>";
		  echo$row_table_wp_amelia_providers_to_services['minCapacity'];
		  echo "</td><td>";
		  echo$row_table_wp_amelia_providers_to_services['maxCapacity'];
		  echo "</td><td>";
		  echo$row_table_wp_amelia_providers_to_services['customPricing'];
		  echo "</td></tr>";
		  
		  
		  }
		  echo"</table>";
		  
		  }
		  }	

public function Print_wp_amelia_providers_to_periods($sname,$uname,$password,$db_name, $url){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		$this->url =$url;
		  
		  //connect to database
		  $conn = mysqli_connect($sname, $uname, $password, $db_name);
		  
		
		  $sql_table_wp_amelia_providers_to_periods="SELECT * FROM wp_amelia_providers_to_periods";
		  $report_table_wp_amelia_providers_to_periods=mysqli_query($conn,$sql_table_wp_amelia_providers_to_periods);
		  if($report_table_wp_amelia_providers_to_periods== TRUE){ 
		  echo "TABLE NAME: wp_amelia_providers_to_periods";
		  echo "<table border='5'>";
		  echo "<tr>
		  <th>id</th>
		  <th>weekDayId</th>  <th>locationId</th>  <th>startTime</th> <th>endTime</th></tr>";
		
		  while($row_table_wp_amelia_providers_to_periods=mysqli_fetch_array($report_table_wp_amelia_providers_to_periods) )
		  {
		
		  
		  echo "<td>";									
		  echo$row_table_wp_amelia_providers_to_periods['id'];
		  echo "</td><td>";
		  echo$row_table_wp_amelia_providers_to_periods['weekDayId'];
		  echo "</td><td>";
		  echo$row_table_wp_amelia_providers_to_periods['locationId'];
		  echo "</td><td>";
		  echo$row_table_wp_amelia_providers_to_periods['startTime'];
		  echo "</td><td>";
		  echo$row_table_wp_amelia_providers_to_periods['endTime'];
		  echo "</td></tr>";
		  
		  
		  }
		  echo"</table>";
		  
		  }
		  }	

public function Print_wp_amelia_providers_to_daysoff($sname,$uname,$password,$db_name, $url){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		$this->url =$url;
		  
		  //connect to database
		  $conn = mysqli_connect($sname, $uname, $password, $db_name);
		  
		
			$sql_table_wp_amelia_providers_to_daysoff="SELECT * FROM wp_amelia_providers_to_daysoff";
			$report_table_wp_amelia_providers_to_daysoff=mysqli_query($conn,$sql_table_wp_amelia_providers_to_daysoff);
			if($report_table_wp_amelia_providers_to_daysoff== TRUE){ 
			echo "TABLE NAME: wp_amelia_providers_to_daysoff";
			echo "<table border='5'>";
			echo "<tr>
			<th>id</th>
			<th>userId</th>   <th>name</th> <th>startDate</th>
			<th>endDate</th> <th>repeat</th></tr>";
		
			while($row_table_wp_amelia_providers_to_daysoff=mysqli_fetch_array($report_table_wp_amelia_providers_to_daysoff) )
			{
		
			
			echo "<td>";									
			echo$row_table_wp_amelia_providers_to_daysoff['id'];
			echo "</td><td>";
			echo$row_table_wp_amelia_providers_to_daysoff['userId'];
			echo "</td><td>";
			echo$row_table_wp_amelia_providers_to_daysoff['name'];
			echo "</td> <td>";									
			echo$row_table_wp_amelia_providers_to_daysoff['startDate'];
			echo "</td><td>";
			echo$row_table_wp_amelia_providers_to_daysoff['endDate'];
			echo "</td><td>";
			echo$row_table_wp_amelia_providers_to_daysoff['repeat'];
			echo "</td></tr>";
			
			
			}
			echo"</table>";
			
		  }
		  }	
public function Print_wp_amelia_extras($sname,$uname,$password,$db_name, $url){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		$this->url =$url;
			
			//connect to database
			$conn = mysqli_connect($sname, $uname, $password, $db_name);
			
		
			  $sql_table_wp_amelia_extras="SELECT * FROM wp_amelia_extras";
			  $report_table_wp_amelia_extras=mysqli_query($conn,$sql_table_wp_amelia_extras);
			  if($report_table_wp_amelia_extras== TRUE){ 
			  echo "TABLE NAME: wp_amelia_extras";
			  echo "<table border='5'>";
			  echo "<tr>
			  <th>id</th>
			  <th>name</th>   <th>description</th> <th>price</th>
			  <th>maxQuantity</th>   <th>duration</th> <th>serviceId</th>
			  <th>position</th>   <th>aggregatedPrice</th> <th>translations</th></tr>";
		
			  while($row_table_wp_amelia_extras=mysqli_fetch_array($report_table_wp_amelia_extras) )
			  {
		
			  
				echo "<td>";									
				echo$row_table_wp_amelia_extras['id'];
				echo "</td><td>";
				echo$row_table_wp_amelia_extras['name'];
				echo "</td><td>";
				echo$row_table_wp_amelia_extras['description'];
				echo "</td> <td>";									
				echo$row_table_wp_amelia_extras['price'];
				echo "</td><td>";
				echo$row_table_wp_amelia_extras['maxQuantity'];
				echo "</td><td>";
				echo$row_table_wp_amelia_extras['duration'];
				echo "</td> <td>";									
				echo$row_table_wp_amelia_extras['serviceId'];
				echo "</td><td>";
				echo$row_table_wp_amelia_extras['position'];
				echo "</td><td>";
				echo$row_table_wp_amelia_extras['aggregatedPrice'];
				echo "</td><td>";
				echo$row_table_wp_amelia_extras['translations'];
				echo "</td></tr>";
			  
			  
			  }
			  echo"</table>";
			  
		  }
		  }


public function Print_wp_amelia_galleries($sname,$uname,$password,$db_name, $url){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		$this->url =$url;
				
				//connect to database
				$conn = mysqli_connect($sname, $uname, $password, $db_name);
				
	  
					$sql_table_wp_amelia_galleries="SELECT * FROM wp_amelia_galleries";
					$report_table_wp_amelia_galleries=mysqli_query($conn,$sql_table_wp_amelia_galleries);
					if($report_table_wp_amelia_galleries== TRUE){ 
					echo "TABLE NAME: wp_amelia_galleries";
					echo "<table border='5'>";
					echo "<tr>
					<th>id</th>
					<th>entityId</th>   <th>entityType</th>  <th>pictureFullPath</th>  
					<th>pictureThumbPath</th>   <th>position</th></tr>";
	  
					while($row_table_wp_amelia_galleries=mysqli_fetch_array($report_table_wp_amelia_galleries) )
					{
	  
					
					  echo "<td>";									
					  echo$row_table_wp_amelia_galleries['id'];
					  echo "</td><td>";
					  echo$row_table_wp_amelia_galleries['entityId'];
					  echo "</td><td>";
					  echo$row_table_wp_amelia_galleries['entityType'];
					  echo "</td><td>";									
					  echo$row_table_wp_amelia_galleries['pictureFullPath'];
					  echo "</td><td>";
					  echo$row_table_wp_amelia_galleries['pictureThumbPath'];
					  echo "</td><td>";
					  echo$row_table_wp_amelia_galleries['position'];
					  echo "</td></tr>";
				  
					
				  }
				  echo"</table>";
				  
			}
		  }
public function Print_wp_amelia_providers_to_locations($sname,$uname,$password,$db_name, $url){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
			$this->url =$url;
					
					//connect to database
					$conn = mysqli_connect($sname, $uname, $password, $db_name);
					
		  
						$sql_table_wp_amelia_providers_to_locations="SELECT * FROM wp_amelia_providers_to_locations";
						$report_table_wp_amelia_providers_to_locations=mysqli_query($conn,$sql_table_wp_amelia_providers_to_locations);
						if($report_table_wp_amelia_providers_to_locations== TRUE){ 
						echo "TABLE NAME: wp_amelia_providers_to_locations";
						echo "<table border='5'>";
						echo "<tr>
						<th>id</th>
						<th>userId</th>   <th>locationId</th> </tr>";
		  
						while($row_table_wp_amelia_providers_to_locations=mysqli_fetch_array($report_table_wp_amelia_providers_to_locations) )
						{
		  
						
						  echo "<td>";									
						  echo$row_table_wp_amelia_providers_to_locations['id'];
						  echo "</td><td>";
						  echo$row_table_wp_amelia_providers_to_locations['userId'];
						  echo "</td><td>";
						  echo$row_table_wp_amelia_providers_to_locations['locationId'];
						  echo "</td></tr>";
					  
						
					  }
					  echo"</table>";
					  
				}
			  }
public function Print_wp_amelia_locations($sname,$uname,$password,$db_name, $url){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
			$this->url =$url;
					
					//connect to database
					$conn = mysqli_connect($sname, $uname, $password, $db_name);
					
		  
						$sql_table_wp_amelia_locations="SELECT * FROM wp_amelia_locations";
						$report_table_wp_amelia_locations=mysqli_query($conn,$sql_table_wp_amelia_locations);
						if($report_table_wp_amelia_locations== TRUE){ 
						echo "TABLE NAME: wp_amelia_locations";
						echo "<table border='5'>";
						echo "<tr>
						<th>id</th>
						<th>status</th>   <th>name</th>  <th>description</th>  
						<th>address</th>   <th>phone</th> <th>latitude</th>   <th>longitude</th>  <th>pictureFullPath</th>  
						<th>pictureThumbPath</th>   <th>pin</th>  <th>translations</th></tr>";
		  
						while($row_table_wp_amelia_locations=mysqli_fetch_array($report_table_wp_amelia_locations) )
						{
		  
						
						  echo "<td>";									
						  echo$row_table_wp_amelia_locations['id'];
						  echo "</td><td>";
						  echo$row_table_wp_amelia_locations['status'];
						  echo "</td><td>";
						  echo$row_table_wp_amelia_locations['name'];
						  echo "</td><td>";									
						  echo$row_table_wp_amelia_locations['description'];
						  echo "</td><td>";
						  echo$row_table_wp_amelia_locations['address'];
						  echo "</td><td>";
						  echo$row_table_wp_amelia_locations['phone'];
						  echo "</td><td>";
						  echo$row_table_wp_amelia_locations['latitude'];
						  echo "</td><td>";
						  echo$row_table_wp_amelia_locations['longitude'];
						  echo "</td><td>";									
						  echo$row_table_wp_amelia_locations['pictureFullPath'];
						  echo "</td><td>";
						  echo$row_table_wp_amelia_locations['pictureThumbPath'];
						  echo "</td><td>";
						  echo$row_table_wp_amelia_locations['pin'];
						  echo "</td><td>";
						  echo$row_table_wp_amelia_locations['translations'];
						  echo "</td></tr>";
					  
					  }
					  echo"</table>";
					  
				}
			  }
		  


public function Print_wp_amelia_customer_bookings($sname,$uname,$password,$db_name, $url){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		$this->url =$url;
						
						//connect to database
						$conn = mysqli_connect($sname, $uname, $password, $db_name);
						

								$sql_table_customer_bookings="SELECT * FROM wp_amelia_customer_bookings";
								$report_table_customer_bookings=mysqli_query($conn,$sql_table_customer_bookings);
								if($report_table_customer_bookings== TRUE){ 
								echo "TABLE NAME: wp_amelia_customer_bookings";
								echo "<table border='5'>";
								echo "<tr>
								<th>id</th>
								<th>appointmentId</th>   <th>customerId</th>  <th>status</th>  
								<th>price</th>   <th>persons</th>  <th>couponId</th> 
								<th>token</th>  <th>customFields</th>  <th>info</th>   <th>utcOffset</th>  
								<th>aggregatedPrice</th>   <th>packageCustomerServiceId</th>  <th>duration</th> 
								<th>created</th></tr>";

								while($row_table_customer_bookings=mysqli_fetch_array($report_table_customer_bookings) )
								{

								
									echo "<td>";									
									echo$row_table_customer_bookings['id'];
									echo "</td><td>";
									echo$row_table_customer_bookings['appointmentId'];
									echo "</td><td>";
									echo$row_table_customer_bookings['customerId'];
									echo "</td><td>";									
									echo$row_table_customer_bookings['status'];
									echo "</td><td>";
									echo$row_table_customer_bookings['price'];
									echo "</td><td>";
									echo$row_table_customer_bookings['persons'];
									echo "</td><td>";
									echo$row_table_customer_bookings['couponId'];
									echo "</td><td>";									
									echo$row_table_customer_bookings['token'];
									echo "</td><td>";									
									echo$row_table_customer_bookings['customFields'];
									echo "</td><td>";									
									echo$row_table_customer_bookings['info'];
									echo "</td><td>";
									echo$row_table_customer_bookings['utcOffset'];
									echo "</td><td>";
									echo$row_table_customer_bookings['aggregatedPrice'];
									echo "</td><td>";									
									echo$row_table_customer_bookings['packageCustomerServiceId'];
									echo "</td><td>";
									echo$row_table_customer_bookings['duration'];
									echo "</td><td>";
									echo$row_table_customer_bookings['created'];
									echo "</td></tr>";
							
								
							}
							echo"</table>";
							
				}
			}


			




			

			

public function Print_wp_amelia_appointments($sname,$uname,$password,$db_name, $url){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
			$this->url =$url;
				
			




			// $id_get = 7;	
			// $status = "approved";
			// $bookingStart = "2022-12-15 08:30:00";
			// $bookingEnd = "2023-01-06 08:00:00";
			// $notifyParticipants = 1;
			
			// $serviceId = 2;
			// $packageId = 2;
			// $providerId = 1;
			// $locationId = 1;
			
			// $internalNotes = "hh";
			// $googleCalendarEventId = "j";
			// $googleMeetUrl = "j";
			// $outlookCalendarEventId = "h";
			
			// $zoomMeeting = "b";
			// $lessonSpace = "h";
			// $parentId = 3;
			
			
			
			// $conn = mysqli_connect($sname, $uname, $password, $db_name);
										
			// $sql_appSend="SELECT * FROM wp_amelia_appointments WHERE id = '$id_get'";
			// $report_appSend=mysqli_query($conn,$sql_appSend);
			
			// 	if(mysqli_num_rows($report_appSend) > 0){ 
				
			// 		$updateApp	= "UPDATE `wp_amelia_appointments` SET `status`='$status',`bookingStart`='$bookingStart',`bookingEnd`='$bookingEnd',`notifyParticipants`=$notifyParticipants,`serviceId`='$serviceId',`packageId`='$packageId',`providerId`='$providerId',`locationId`='$locationId',`internalNotes`='$internalNotes',`googleCalendarEventId`='$googleCalendarEventId',`googleMeetUrl`='$googleMeetUrl',`outlookCalendarEventId`='$outlookCalendarEventId',`zoomMeeting`='$zoomMeeting',`lessonSpace`='$lessonSpace',`parentId`=$parentId WHERE id='$id_get'";

			// 		// $updateApp	= "UPDATE wp_amelia_appointments SET  bookingStart=$bookingStart, bookingEnd=$bookingEnd,	notifyParticipants=$notifyParticipants,	serviceId=$serviceId,	packageId=$packageId,	providerId=$providerId,	locationId=$locationId,	internalNotes=$internalNotes,	googleCalendarEventId=$googleCalendarEventId,	googleMeetUrl=$googleMeetUrl,	outlookCalendarEventId=$outlookCalendarEventId,	zoomMeeting=$zoomMeeting,	lessonSpace=$lessonSpace,	parentId=$parentId WHERE id = $id_get";
			// 	// $report_update = mysqli_query($conn,$updateApp);
			// 	if (mysqli_query($conn,$updateApp)){
					
			// 		echo " update";
			// 	}
			// } else{
			// 	  $insertApp = "INSERT INTO `wp_amelia_appointments`(`id`, `status`, `bookingStart`, `bookingEnd`, `notifyParticipants`, `serviceId`, `packageId`, `providerId`, `locationId`, `internalNotes`, `googleCalendarEventId`, `googleMeetUrl`, `outlookCalendarEventId`, `zoomMeeting`, `lessonSpace`, `parentId`) VALUES ('','$status','$bookingStart','$bookingEnd','$notifyParticipants','$serviceId','$packageId','$providerId ','$locationId','$internalNotes','$googleCalendarEventId','$googleMeetUrl','$outlookCalendarEventId','$zoomMeeting','$lessonSpace','$parentId ')";
			// 	  if (mysqli_query($conn,$insertApp)){
			// 		echo " insert";
			// 	}
			// 	}








							//connect to database
							$conn = mysqli_connect($sname, $uname, $password, $db_name);
							

									$sql_table1="SELECT * FROM wp_amelia_appointments";
									$report_table1=mysqli_query($conn,$sql_table1);
									if($report_table1== TRUE){ 
									echo "TABLE NAME: wp_amelia_appointments";
									echo "<table border='5'>";
									echo "<tr><th>id</th><th>status</th><th>bookingStart</th><th>bookingEnd</th>
									<th>notifyParticipants</th><th>serviceId</th><th>packageId</th>
									<th>providerId</th><th>locationId</th><th>internalNotes</th>
									<th>googleCalendarEventId</th><th>googleMeetUrl</th>
									<th>outlookCalendarEventId</th><th>zoomMeeting</th><th>lessonSpace</th><th>parentId</th></tr>";

									while($row_table1=mysqli_fetch_array($report_table1) )
									{

									
										echo "<tr><td>";									
										echo$row_table1['id'];
										echo "</td><td>";
										echo$row_table1['status'];
										echo "</td><td>";									
										echo$row_table1['bookingStart'];
										echo "</td><td>";									
										echo$row_table1['bookingEnd'];
										echo "</td><td>";									
										echo$row_table1['notifyParticipants'];
										echo "</td><td>";									
										echo$row_table1['serviceId'];
										echo "</td><td>";									
										echo$row_table1['packageId'];
										echo "</td><td>";									
										echo$row_table1['providerId'];
										echo "</td><td>";									
										echo$row_table1['locationId'];
										echo "</td><td>";									
										echo$row_table1['internalNotes'];
										echo "</td><td>";									
										echo$row_table1['googleCalendarEventId'];
										echo "</td><td>";									
										echo$row_table1['googleMeetUrl'];
										echo "</td><td>";									
										echo$row_table1['outlookCalendarEventId'];
										echo "</td><td>";									
										echo$row_table1['zoomMeeting'];
										echo "</td><td>";									
										echo$row_table1['lessonSpace'];
										echo "</td><td>";									
										echo$row_table1['parentId'];
										echo "</td></tr>";
										echo"<tr></tr>";
										echo"<tr></tr>";
										echo"<tr></tr>";
								
						
								}
								echo"</table>";



													
// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'http://192.168.16.112:3000/api/v1/appointments',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'GET',
//   CURLOPT_HTTPHEADER => array(
//     'Content-Type: application/json'
//   ),
// ));

// $response = curl_exec($curl);
// $result = json_decode($response, true);
// curl_close($curl);


// for($i = 0; $i < count($result); $i++) {
    
//   }

//   $i = 0;
//   while($i < count($result)) {
//     print_r ( "id: {$result[$i]['id']}"<br>);



// 	$i++;
//   }
// $i = 0;
// while($i != 17){

// 	$i++;
// }
					}



							
							
				}


		
		



	}
?>