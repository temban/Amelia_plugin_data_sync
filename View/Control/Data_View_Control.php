

<?php

class PrintAmeliaTables {

	//Users get and post
		//============= post to database ======================
	public function Print_wp_amelia_users_post($sname, $uname, $password, $db_name, $url)
	{
			$this->sname = $sname;
			$this->uname = $uname;
			$this->password = $password;
			$this->db_name = $db_name;
			$this->url = $url;
	
	
	
			//connect to database
			$conn = mysqli_connect($sname, $uname, $password, $db_name);
	
			//Create New Table for categories sync
			$sqlCreate = "CREATE TABLE willOnHairTableUsers(
							`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
							`willOnHairCol` INT NOT NULL DEFAULT 0,
							`ameliaCol` INT NOT NULL,
							`status` enum('hidden','visible','disabled') NOT NULL DEFAULT 'visible',
							`type` enum('customer','provider','manager','admin') NOT NULL,
							`externalId` int DEFAULT NULL,
							`firstName` varchar(255) NOT NULL DEFAULT '',
							`lastName` varchar(255) NOT NULL DEFAULT '',
							`email` varchar(255) DEFAULT NULL,
							`birthday` date DEFAULT NULL,
							`phone` varchar(63) DEFAULT NULL,
							`gender` enum('male','female') DEFAULT NULL,
							`note` text DEFAULT NULL,
							`description` text DEFAULT NULL,
							`pictureFullPath` varchar(767) DEFAULT NULL,
							`pictureThumbPath` varchar(767) DEFAULT NULL,
							`usedTokens` text DEFAULT NULL,
							`zoomUserId` varchar(255) DEFAULT NULL,
							`countryPhoneIso` varchar(2) DEFAULT NULL,
							`translations` text DEFAULT NULL,
							`timeZone` varchar(255) DEFAULT NULL
											)";
	
			$report_sqlCreate = mysqli_query($conn, $sqlCreate);
			//Verify if Table has been created
			if ($report_sqlCreate === TRUE) {
			}
	
			// Select and collect data from table: wp_amelia_users
			$sql_send_to_amelia = "SELECT * FROM wp_amelia_users";
			$report_send_to_amelia = mysqli_query($conn, $sql_send_to_amelia);
	
			if ($report_send_to_amelia == TRUE) {
	
	
					while ($row_second_post = mysqli_fetch_array($report_send_to_amelia)) {
							// store each data from table: wp_amelia_users in variables
							$ameliaId = $row_second_post['id'];
							$status = $row_second_post['status']; 
							$type = $row_second_post['type'];
							$externalId = $row_second_post['externalId'];
							$firstName = $row_second_post['firstName'];
	
	
							$lastName = $row_second_post['lastName'];
							$email = $row_second_post['email'];
							$birthday = $row_second_post['birthday'];
							$phone = $row_second_post['phone'];
							$gender = $row_second_post['gender'];
							$note = $row_second_post['note'];
	
	
							$description = $row_second_post['description'];
							$pictureFullPath = $row_second_post['pictureFullPath'];
							$pictureThumbPath = $row_second_post['pictureThumbPath'];
							$usedTokens = $row_second_post['usedTokens'];
	
	
							$zoomUserId = $row_second_post['zoomUserId'];
							$countryPhoneIso = $row_second_post['countryPhoneIso'];
							$translations = $row_second_post['translations'];
							$timeZone = $row_second_post['timeZone'];
	
	
	
	
							// Select Table: willOnHairTableUsers and isnert records coming from table: wp_amelia_users
							$conn = mysqli_connect($sname, $uname, $password, $db_name);
							$qry = "SELECT * FROM willOnHairTableUsers WHERE ameliaCol='$ameliaId'";
							$rowCheck = mysqli_query($conn, $qry);
							if ( mysqli_num_rows($rowCheck) > 0) {
									
							} else {
									$qry = "INSERT INTO willOnHairTableUsers (`ameliaCol`, `status`, `type`, `externalId`,
									`firstName`, `lastName`, `email`, `birthday`, `phone`, `gender`, `note`, 
									`description`, `pictureFullPath`, `pictureThumbPath`, 
									`usedTokens`, `zoomUserId`, `countryPhoneIso`, `translations`, `timeZone`) 
									VALUES ('$ameliaId','$status', '$type', '$externalId','$firstName', 
									'$lastName','$email', '$birthday', '$phone','$gender','$note','$description',
									'$pictureFullPath','$pictureThumbPath', '$usedTokens','$zoomUserId','$countryPhoneIso','$translations','$timeZone')";
											if (mysqli_query($conn, $qry)) {
											}
	
							}
					}
			}
	
	
			//After receiving data from table: wp_amelia_users, next process to send it to the backend
			$sql_table3 = "SELECT * FROM willOnHairTableUsers";
			$report_table3 = mysqli_query($conn, $sql_table3);
			if ($report_table3 == TRUE) {
	
					while ($row_table3 = mysqli_fetch_array($report_table3)) {
	
							// select and store all records of table: willOnHairTableUsers in variables
	
					$willOnHairIdS = $row_table3['willOnHairCol'];
					$ameliaIdS = $row_table3['ameliaCol'];
					$statusS = $row_table3['status']; 
					$typeS = $row_table3['type'];
					$externalIdS = $row_table3['externalId'];
					$firstNameS = $row_table3['firstName'];
	
	
					$lastNameS = $row_table3['lastName'];
					$emailS = $row_table3['email'];
					$birthdayS = $row_table3['birthday'];
					$phoneS = $row_table3['phone'];
					$genderS = $row_table3['gender'];
					$noteS = $row_table3['note'];
	
	
					$descriptionS = $row_table3['description'];
					$pictureFullPathS = $row_table3['pictureFullPath'];
					$pictureThumbPathS = $row_table3['pictureThumbPath'];
					$usedTokensS = $row_table3['usedTokens'];
	
	
					$zoomUserIdS = $row_table3['zoomUserId'];
					$countryPhoneIsoS = $row_table3['countryPhoneIso'];
					$translationsS = $row_table3['translations'];
					$timeZoneS = $row_table3['timeZone'];
	
							// we bind fields from the backend with our variables of the Table: willOnHairTableUsers in an array
							$postCat = [
									"id" => $willOnHairIdS,
									"ameliaId" => $ameliaIdS,
									"status" => strtoupper($statusS),
									"type" => strtoupper($typeS),
									"externalId" => $externalIdS,
									"firstName" => $firstNameS,
									"lastName" => $lastNameS,
									"email" => $emailS,
									"birthday" => $birthdayS,
									"phone" => $phoneS,
									"gender" => "MALE",
									"note" => $noteS,
									"description" => $descriptionS,
									"pictureFullPath" => $pictureFullPathS,
									"pictureThumbPath" => $pictureThumbPathS,
									"usedTokens" => $usedTokensS,
									"zoomUserId" => $zoomUserIdS,
									"countryPhoneIso" => $countryPhoneIsoS,
									"translations" => $translationsS,
									"timeZone" => $timeZoneS,
									"username" => "",
									"accountNonExpired" => true,
									"accountNonLocked" => true,
									"credentialsNonExpired" => false,
									"enabled" => true
							];
	
							// request header of our post to the backend
	
							$curl = curl_init();
	
							curl_setopt_array($curl, array(
									CURLOPT_URL => "$url/api/v1/users",
									CURLOPT_RETURNTRANSFER => true,
									CURLOPT_ENCODING => '',
									CURLOPT_MAXREDIRS => 1,
									CURLOPT_TIMEOUT => 0,
									CURLOPT_FOLLOWLOCATION => true,
									CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									CURLOPT_CUSTOMREQUEST => 'POST',
									CURLOPT_POSTFIELDS => json_encode($postCat),
									//here we convert our array to a json format
									CURLOPT_HTTPHEADER => array(
											'Content-Type: application/json'
									),
							)
							);
	
							$response = curl_exec($curl);
	
							curl_close($curl);
					}
			}
	}
	
	//=============get from database and insert in amelia_users ===============
	public function Print_wp_amelia_users_insert($sname, $uname, $password, $db_name, $url)
	{
			$this->sname = $sname;
			$this->uname = $uname;
			$this->password = $password;
			$this->db_name = $db_name;
			$this->url = $url;
	
			// we creat a connection
			$conn = mysqli_connect($sname, $uname, $password, $db_name);
	
			// request header of our get from the backend
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
			)
			);
	
			$response = curl_exec($curl);
			$result = json_decode($response, true); // here we decode data coming from backend and store it as an array
			curl_close($curl);
	
			// we loop through our array and store eacch into variables
			$i = 0;
			while ($i < count($result)) {
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
	
					//we select all records from table: willOnHairTableUsers with the particular key:ameliaCol
					$conn = mysqli_connect($sname, $uname, $password, $db_name);
					$sql_First_get = "SELECT * FROM willOnHairTableUsers WHERE ameliaCol=$ameliaId";
					$report_First_get = mysqli_query($conn, $sql_First_get);
	
	
	
					if ($report_First_get == TRUE) {
							// if the above key exist we update the records that concerns the key
							$sql_updat_wilID = "UPDATE `willOnHairTableUsers` SET `willOnHairCol`='$willOnHairId' WHERE ameliaCol = '$ameliaId'";
							$report_updat_wilID = mysqli_query($conn, $sql_updat_wilID);
							if (mysqli_query($conn, $report_updat_wilID)) {
							}
					} else {
							//if the above key does not exist we insert a new record of the non existing key
							$insert_First_get = "INSERT INTO willOnHairTableUsers(`willOnHairCol`, `ameliaCol`, 
							`status`, `type`, `externalId`,`firstName`, `lastName`, `email`, `birthday`, 
							`phone`, `gender`, `note`, `description`, `pictureFullPath`, `pictureThumbPath`,
							 `usedTokens`, `zoomUserId`, `countryPhoneIso`, `translations`, `timeZone`) 
									VALUES ('$willOnHairId', '$ameliaId', '$status', '$type', '$externalId','$firstName', 
									'$lastName','$email', '$birthday', '$phone','$gender','$note','$description',
									'$pictureFullPath','$pictureThumbPath', '$usedTokens','$zoomUserId',
									'$countryPhoneIso','$translations','$timeZone')";
							if (mysqli_query($conn, $insert_First_get)) {
							}
					}
	
	
	
	
					$i++;
			}

	
			// we select table: willOnHairTableUsers for the process of 
			//generating amelia ids for the records coming from the backend by 
			//inserting them into the table: wp_amelia_users
			$conn = mysqli_connect($sname, $uname, $password, $db_name);
			$sql_send_to_amelia = "SELECT * FROM willOnHairTableUsers";
			$report_send_to_amelia = mysqli_query($conn, $sql_send_to_amelia);
	
			if (mysqli_num_rows($report_send_to_amelia) > 0) {
					while ($row_second_post = mysqli_fetch_array($report_send_to_amelia)) {
							// we store all its records into variables
							$willOnHairId = $row_second_post['willOnHairCol'];
							$ameliaId = $row_second_post['ameliaCol'];
	


							$status = $row_second_post['status']; 
							$type = $row_second_post['type'];
							$externalId = $row_second_post['externalId'];
							$firstName = $row_second_post['firstName'];
	
	
							$lastName = $row_second_post['lastName'];
							$email = $row_second_post['email'];
							$birthday = $row_second_post['birthday'];
							$phone = $row_second_post['phone'];
							$gender = $row_second_post['gender'];
							$note = $row_second_post['note'];
	
	
							$description = $row_second_post['description'];
							$pictureFullPath = $row_second_post['pictureFullPath'];
							$pictureThumbPath = $row_second_post['pictureThumbPath'];
							$usedTokens = $row_second_post['usedTokens'];
	
	
							$zoomUserId = $row_second_post['zoomUserId'];
							$countryPhoneIso = $row_second_post['countryPhoneIso'];
							$translations = $row_second_post['translations'];
							$timeZone = $row_second_post['timeZone'];
	
	
							// check the record ameliaId if null or equal to 0 we insert the whole record into tablle:wp_amelia_users
							if ($ameliaId == NULL || $ameliaId == 0) {

									$send_to_amelia_category = "INSERT INTO wp_amelia_users(`status`, `type`, `externalId`,
									`firstName`, `lastName`, `email`, `birthday`, `phone`, `gender`, `note`, 
									`description`, `pictureFullPath`, `pictureThumbPath`, `password`, 
									`usedTokens`, `zoomUserId`, `countryPhoneIso`, `translations`, `timeZone`) 
									VALUES ('$status', '$type', '$externalId','$firstName', 
									'$lastName','$email', '$birthday', '$phone','$gender','$note','$description',
									'$pictureFullPath','$pictureThumbPath', NULL,'$usedTokens','$zoomUserId',
									'$countryPhoneIso','$translations','$timeZone')";
									if (mysqli_query($conn, $send_to_amelia_category)) {

										
											//during each insert of each records form the while loop and the above 
											//contion we collect the last id that was inserted into the table:wp_amelia_users so as to
											//up the column: ameliaCol in th Table: willOnHairTableUsers
											$last_id = mysqli_insert_id($conn);
											if ($last_id == TRUE) {

													$willOnHairTableUsers_updateTable = "UPDATE `willOnHairTableUsers` SET `ameliaCol`='$last_id' WHERE willOnHairCol = '$willOnHairId'";
	
													if (mysqli_query($conn, $willOnHairTableUsers_updateTable)) {
															$sql_second_post = "SELECT * FROM willOnHairTableUsers WHERE willOnHairCol = '$willOnHairId'";
															$report_second_post = mysqli_query($conn, $sql_second_post);
	
															if ($row_second_post = mysqli_fetch_array($report_second_post)) {
	
																	$ameliaId_send = $row_second_post['ameliaCol'];
	
																	$status_send = $row_second_post['status']; 
																	$type_send = $row_second_post['type'];
																	$externalId_send = $row_second_post['externalId'];
																	$firstName_send = $row_second_post['firstName'];
											
											
																	$lastName_send = $row_second_post['lastName'];
																	$email_send = $row_second_post['email'];
																	$birthday_send = $row_second_post['birthday'];
																	$phone_send = $row_second_post['phone'];
																	$gender_send = $row_second_post['gender'];
																	$note_send = $row_second_post['note'];
											
											
																	$description_send = $row_second_post['description'];
																	$pictureFullPath_send = $row_second_post['pictureFullPath'];
																	$pictureThumbPath_send = $row_second_post['pictureThumbPath'];
																	$usedTokens_send = $row_second_post['usedTokens'];
											
											
																	$zoomUserId_send = $row_second_post['zoomUserId'];
																	$countryPhoneIso_send = $row_second_post['countryPhoneIso'];
																	$translations_send = $row_second_post['translations'];
																	$timeZone_send = $row_second_post['timeZone'];
	
																	//After the column: ameliaCol in th Table: willOnHairTableUsers is up to date
																	// we send the updated table:willOnHairTableUsers to the backend
																	$postCategory = [
																					 "id" => $willOnHairId,
																					"ameliaId" => $ameliaId_send,
																					"status" => strtoupper($status_send),
																					"type" => strtoupper($type_send),
																					"externalId" => $externalId_send,
																					"firstName" => $firstName_send,
																					"lastName" => $lastName_send,
																					"email" => $email_send,
																					"birthday" => $birthday_send,
																					"phone" => $phone_send,
																					"gender" => "MALE",
																					"note" => $note_send,
																					"description" => $description_send,
																					"pictureFullPath" => $pictureFullPath_send,
																					"pictureThumbPath" => $pictureThumbPath_send,
																					"usedTokens" => $usedTokens_send,
																					"zoomUserId" => $zoomUserId_send,
																					"countryPhoneIso" => $countryPhoneIso_send,
																					"translations" => $translations_send,
																					"timeZone" => $timeZone_send,
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
																			CURLOPT_MAXREDIRS => 1,
																			CURLOPT_TIMEOUT => 0,
																			CURLOPT_FOLLOWLOCATION => true,
																			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
																			CURLOPT_CUSTOMREQUEST => 'POST',
																			CURLOPT_POSTFIELDS => json_encode($postCategory),
																			CURLOPT_HTTPHEADER => array(
																					'Content-Type: application/json'
																			),
																	)
																	);
	
																	$response = curl_exec($curl);
	
																	curl_close($curl);
															}
													}
											}
									}
							}
					}
			}
	
	
	
			// we display the final results of the table: wp_amelia_users 
			//which now contains a sync data of wp_amelia_users and the backend 
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
			// $query = "DROP table willOnHairTableUsers";
			// if (mysqli_multi_query($conn, $query)) {
			// }
	}
	
		//locations get and post
		//============= post to database ======================
	public function Print_wp_amelia_providers_to_locations_post($sname,$uname,$password,$db_name, $url){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
			$this->url =$url;
			
			
									
									//connect to database
									$conn = mysqli_connect($sname, $uname, $password, $db_name);
									
									//Create New Table for locations sync
									$sqlCreate = "CREATE TABLE willOnHairTableProvidersToLocations(
											`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
											`willOnHairCol` INT NOT NULL DEFAULT 0,
											`ameliaCol` INT NOT NULL,
											`userId` int NOT NULL,
											`locationId` int NOT NULL
									)";
									
											$report_sqlCreate=mysqli_query($conn,$sqlCreate);
									//Verify if Table has been created
											if ($report_sqlCreate === TRUE) {
											}

											// Select and collect data from table: wp_amelia_providers_to_locations
											$sql_send_to_amelia="SELECT * FROM wp_amelia_providers_to_locations";
											$report_send_to_amelia=mysqli_query($conn,$sql_send_to_amelia);

											if($report_send_to_amelia== TRUE){ 


											while($row_send_to_amelia=mysqli_fetch_array($report_send_to_amelia))
											{
													// store each data from table: wp_amelia_providers_to_locations in variables
															$ameliaId = $row_send_to_amelia['id'];

															$userId = $row_send_to_amelia['userId'];	
															$locationId = $row_send_to_amelia['locationId'];

															// Select Table: willOnHairTableProvidersToLocations and isnert records coming from table: wp_amelia_providers_to_locations
															$conn = mysqli_connect($sname, $uname, $password, $db_name);
																	$qry="SELECT * FROM willOnHairTableProvidersToLocations WHERE ameliaCol='$ameliaId'";
																	$rowCheck=mysqli_query($conn,$qry);
																	if (mysqli_num_rows($rowCheck) > 0) { 
																			
																					
																			} else{
																			$qry = "INSERT INTO willOnHairTableProvidersToLocations (`ameliaCol`, `userId`, `locationId`)
																			VALUES ('$ameliaId','$userId', '$locationId')"; 
																			if (mysqli_query($conn,$qry)){ 
																			
																			}  
															}
											}
									}
			

									//After receiving data from table: wp_amelia_providers_to_locations, next process to send it to the backend
													$sql_table3="SELECT * FROM willOnHairTableProvidersToLocations";
													$report_table3=mysqli_query($conn,$sql_table3);
													if($report_table3== TRUE ){ 
			
													while($row_table3=mysqli_fetch_array($report_table3) )
													{
											
															// select and store all records of table: willOnHairTableProvidersToLocations in variables

															$willOnHairId = $row_table3['willOnHairCol'];
															$ameliaId = $row_table3['ameliaCol'];
															$userIdC = $row_table3['userId'];
															$locationIdC = $row_table3['locationId'];
			
															// we bind fields from the backend with our variables of the Table: willOnHairTableProvidersToLocations in an array


													// request header of our post to the backend
													$curl = curl_init();

													curl_setopt_array($curl, array(
													  CURLOPT_URL => "$url/api/v1/users/$userIdC/locations/amelia?locationId=$locationIdC",
													  CURLOPT_RETURNTRANSFER => true,
													  CURLOPT_ENCODING => '',
													  CURLOPT_MAXREDIRS => 10,
													  CURLOPT_TIMEOUT => 0,
													  CURLOPT_FOLLOWLOCATION => true,
													  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
													  CURLOPT_CUSTOMREQUEST => 'POST',
													  CURLOPT_HTTPHEADER => array(
														'Content-Type: application/json'
													  ),
													));
													
													$response = curl_exec($curl);
													
													curl_close($curl);
													// echo "<br> PL 1st post: $response<br>";


											}

																					
					}
	}
	
	//=============get from database and insert in amelia_locations ===============
    public function Print_wp_amelia_providers_to_locations_insert($sname,$uname,$password,$db_name, $url){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
			$this->url =$url;
	
// we creat a connection
	$conn = mysqli_connect($sname, $uname, $password, $db_name);			

	// request header of our get from the backend
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "$url/api/v1/employees/provider/location",
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
	$result = json_decode($response, true); // here we decode data coming from backend and store it as an array
	curl_close($curl);
	// echo "<br> PL 1st get: $response<br>";
	
	// we loop through our array and store eacch into variables
	$i = 0;
	while($i < count($result)) {
	$willOnHairId = $result[$i]['id'];	
	$ameliaId = $result[$i]['ameliaId'];
	$locationId = $result[$i]['location']['ameliaId'];
	
	//we select all records from table: willOnHairTableProvidersToLocations with the particular key:ameliaCol
	$conn = mysqli_connect($sname, $uname, $password, $db_name);			
	$sql_First_get="SELECT * FROM willOnHairTableProvidersToLocations WHERE ameliaCol=$ameliaId";
	$report_First_get=mysqli_query($conn,$sql_First_get);
	

	
	if($report_First_get == TRUE){ 
			// if the above key exist we update the records that concerns the key
							$sql_updat_wilID="UPDATE `willOnHairTableProvidersToLocations` SET `willOnHairCol`='$willOnHairId' WHERE ameliaCol = '$ameliaId'";
							$report_updat_wilID=mysqli_query($conn,$sql_updat_wilID);
							if (mysqli_query($conn,$report_updat_wilID)){ 
							
							}  
					
			} else{
					//if the above key does not exist we insert a new record of the non existing key
					$insert_First_get = "INSERT INTO willOnHairTableProvidersToLocations(`willOnHairCol`, `ameliaCol`, `userId`, `locationId`) 
					VALUES ('$willOnHairId', '$ameliaId', '$ameliaId','$locationId')"; 
							if (mysqli_query($conn,$insert_First_get)){ 
							}  
			}
	
	
	
	
	$i++;
	}
	
	// we select table: willOnHairTableProvidersToLocations for the process of 
	//generating amelia ids for the records coming from the backend by 
	//inserting them into the table: wp_amelia_providers_to_locations
	$conn = mysqli_connect($sname, $uname, $password, $db_name);			
	$sql_send_to_amelia="SELECT * FROM willOnHairTableProvidersToLocations";
	$report_send_to_amelia=mysqli_query($conn,$sql_send_to_amelia);

	if($report_send_to_amelia== TRUE ){ 
	while($row_send_to_amelia=mysqli_fetch_array($report_send_to_amelia))
	{
					// we store all its records into variables
					$id = $row_send_to_amelia['id'];
					$willOnHairId = $row_send_to_amelia['willOnHairCol'];	
					$ameliaId = $row_send_to_amelia['ameliaCol'];

					$userId = $row_send_to_amelia['userId'];	
					$locationId = $row_send_to_amelia['locationId'];
	
			// check the record ameliaId if null or equal to 0 we insert the whole record into tablle:wp_amelia_providers_to_locations
			if($ameliaId == NULL || $ameliaId == 0){ 
					$send_to_amelia_category = "INSERT INTO wp_amelia_providers_to_locations(`userId`, `locationId`) 
					VALUES ('$userId','$locationId')"; 
					if (mysqli_query($conn,$send_to_amelia_category)){ 

							//during each insert of each records form the while loop and the above 
							//contion we collect the last id that was inserted into the table:wp_amelia_providers_to_locations so as to
							//up the column: ameliaCol in th Table: willOnHairTableProvidersToLocations
					$last_id = mysqli_insert_id($conn);
					if( $last_id ==TRUE ){
									$willOnHairTableProvidersToLocations_updateTable = "UPDATE `willOnHairTableProvidersToLocations` SET `ameliaCol`='$last_id' WHERE willOnHairCol = '$willOnHairId'";

									if (mysqli_query($conn,$willOnHairTableProvidersToLocations_updateTable)){
									$sql_second_post="SELECT * FROM willOnHairTableProvidersToLocations WHERE willOnHairCol = '$willOnHairId'";
									$report_second_post=mysqli_query($conn,$sql_second_post);
			
									if($row_second_post=mysqli_fetch_array($report_second_post)){ 

											$ameliaId_send = $row_second_post['ameliaCol'];
	
											$userId_send = $row_second_post['userId'];	
											$locationId_send = $row_second_post['locationId'];

									//After the column: ameliaCol in th Table: willOnHairTableProvidersToLocations is up to date
									// we send the updated table:willOnHairTableProvidersToLocations to the backend
									// $curl = curl_init();

									// curl_setopt_array($curl, array(
									//   CURLOPT_URL => "$url/api/v1/users/$userId_send/locations/amelia?locationId=$locationId_send",
									//   CURLOPT_RETURNTRANSFER => true,
									//   CURLOPT_ENCODING => '',
									//   CURLOPT_MAXREDIRS => 10,
									//   CURLOPT_TIMEOUT => 0,
									//   CURLOPT_FOLLOWLOCATION => true,
									//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									//   CURLOPT_CUSTOMREQUEST => 'POST',
									//   CURLOPT_HTTPHEADER => array(
									// 	'Content-Type: application/json'
									//   ),
									// ));
									
									// $response = curl_exec($curl);
									
									// curl_close($curl);
									// echo "<br> PL 2st post: $response<br>";


									}


					}
					

					}
					
					}  


			}
			
			}
	}


	// $query = "DROP table willOnHairTableProvidersToLocations";
	// if (mysqli_multi_query($conn, $query)) {
	//   echo "Dropped Successfully";
	// } else {
	//   echo "Error:" . mysqli_error($conn);
	// }	
	
	// we display the final results of the table: wp_amelia_providers_to_locations 
	//which now contains a sync data of wp_amelia_providers_to_locations and the backend 
	$sql_table3="SELECT * FROM wp_amelia_providers_to_locations";
	$report_table3=mysqli_query($conn,$sql_table3);
	if($report_table3== TRUE){ 
	echo "TABLE NAME: wp_amelia_providers_to_locations";
	echo "<table border='5'>";
	echo "<tr><th>id</th>
	<th>userId</th><th>locationId</th></tr>";
	
	while($row_table3=mysqli_fetch_array($report_table3) )
	{
	
	
			echo "<tr><td>";									
			echo$row_table3['id'];
			echo "</td><td>";
			echo$row_table3['userId'];
			echo "</td><td>";
			echo$row_table3['locationId'];
			echo "</td></tr>";
			echo"<tr></tr>";
			echo"<tr></tr>";
			echo"<tr></tr>";
	
	}
	echo"</table>";
	
	}
	
	}

        //Categories get and post
        //============= post to database ======================
	public function Print_wp_amelia_providers_to_weekdays_post($sname,$uname,$password,$db_name, $url){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		$this->url =$url;
		
		
				
				//connect to database
				$conn = mysqli_connect($sname, $uname, $password, $db_name);
				
				//Create New Table for categories sync
				$sqlCreate = "CREATE TABLE willOnHairTableWeeksdays(
						`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
						`willOnHairCol` INT NOT NULL DEFAULT 0,
						`ameliaCol` INT NOT NULL,
						`name` varchar(255) NOT NULL DEFAULT 'Amelia',
						`userId` int NOT NULL,
						`dayIndex` tinyint(2) NOT NULL,
						`startTime` time NOT NULL,
						`endTime` time NOT NULL
				)";
				
						$report_sqlCreate=mysqli_query($conn,$sqlCreate);
				//Verify if Table has been created
						if ($report_sqlCreate === TRUE) {
						}

						// Select and collect data from table: wp_amelia_providers_to_weekdays
						$sql_send_to_amelia="SELECT * FROM wp_amelia_providers_to_weekdays";
						$report_send_to_amelia=mysqli_query($conn,$sql_send_to_amelia);
		
						if($report_send_to_amelia== TRUE){ 
		
		
						while($row_send_to_amelia=mysqli_fetch_array($report_send_to_amelia))
						{
								// store each data from table: wp_amelia_providers_to_weekdays in variables
										$ameliaId = $row_send_to_amelia['id'];
		
										$userId = $row_send_to_amelia['userId'];	
										$dayIndex = $row_send_to_amelia['dayIndex'];
		
										$startTime = $row_send_to_amelia['startTime'];
										$endTime = $row_send_to_amelia['endTime'];
		
		
										// Select Table: willOnHairTableWeeksdays and isnert records coming from table: wp_amelia_providers_to_weekdays
										$conn = mysqli_connect($sname, $uname, $password, $db_name);
												$qry="SELECT * FROM willOnHairTableWeeksdays WHERE ameliaCol='$ameliaId'";
												$rowCheck=mysqli_query($conn,$qry);
												if (mysqli_num_rows($rowCheck) > 0) { 
														
																
														} else{
														$qry = "INSERT INTO willOnHairTableWeeksdays (`ameliaCol`, `userId`, `dayIndex`, `startTime`, `endTime`)
														VALUES ('$ameliaId', '$userId', '$dayIndex', '$startTime','$endTime')"; 
														if (mysqli_query($conn,$qry)){ 
														
														}  
										}
						}
				}
		
		
				//After receiving data from table: wp_amelia_providers_to_weekdays, next process to send it to the backend
								$sql_table3="SELECT * FROM willOnHairTableWeeksdays";
								$report_table3=mysqli_query($conn,$sql_table3);
								if($report_table3== TRUE ){ 
		
								while($row_table3=mysqli_fetch_array($report_table3) )
								{
						
										// select and store all records of table: willOnHairTableWeeksdays in variables
		
										$willOnHairId = $row_table3['willOnHairCol'];
										$ameliaId = $row_table3['ameliaCol'];
										$name = $row_table3['name'];
										$userId = $row_table3['userId'];
										
										if( $row_table3['dayIndex'] == 1 ){
											$dayIndex = 0;
										} elseif( $row_table3['dayIndex'] == 2 ){
												$dayIndex = 1;
										} elseif( $row_table3['dayIndex'] == 3 ){
												$dayIndex = 2;
										} elseif( $row_table3['dayIndex'] == 4 ){
												$dayIndex = 3;
										} elseif( $row_table3['dayIndex'] == 5 ){
												$dayIndex = 4;
										} elseif( $row_table3['dayIndex'] == 6 ){
												$dayIndex = 5;
										} elseif( $row_table3['dayIndex'] == 7 ){
												$dayIndex = 6;
										}
										$startTime = $row_table3['startTime'];
										$endTime = $row_table3['endTime'];
		
										// we bind fields from the backend with our variables of the Table: willOnHairTableWeeksdays in an array
										$postWeekdays = [ 
												"id" => $willOnHairId,
												"ameliaId" => $ameliaId,
												"name" =>  $name,
												"day" =>  $dayIndex,
												"start" => strval($startTime),
												"end" => strval($endTime)
								];
		
		
								// request header of our post to the backend
		
								$curl = curl_init();
		
								curl_setopt_array($curl, array(
								  CURLOPT_URL => "$url/api/v1/employees/$userId/week-days/amelia",
								  CURLOPT_RETURNTRANSFER => true,
								  CURLOPT_ENCODING => '',
								  CURLOPT_MAXREDIRS => 10,
								  CURLOPT_TIMEOUT => 0,
								  CURLOPT_FOLLOWLOCATION => true,
								  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								  CURLOPT_CUSTOMREQUEST => 'POST',
								  CURLOPT_POSTFIELDS => json_encode($postWeekdays),
								  CURLOPT_HTTPHEADER => array(
								    'Content-Type: application/json'
								  ),
								));
								
								$response = curl_exec($curl);
								
								
								curl_close($curl);
		
		
						}
		
																
		}
		}
			
	//=============get from database and insert in wp_amelia_providers_to_weekdays ===============

	public function Print_wp_amelia_providers_to_weekdays_insert($sname,$uname,$password,$db_name, $url){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		$this->url =$url;
	  
	  // we creat a connection
	  $conn = mysqli_connect($sname, $uname, $password, $db_name);			
	  
	  // request header of our get from the backend
	  $curl = curl_init();
	  
	  curl_setopt_array($curl, array(
		CURLOPT_URL => "$url/api/v1/employees/week-days/amelia",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
	  ));
	  
	  $response = curl_exec($curl);
	  $result = json_decode($response, true); // here we decode data coming from backend and store it as an array
	  curl_close($curl);


	  
	  // we loop through our array and store eacch into variables
	  $i = 0;
	  while($i < count($result)) {
	  $willOnHairId = $result[$i]['id'];	
	  $ameliaId = $result[$i]['ameliaId'];	
	  $userId = $result[$i]['user']['ameliaId'];
	  $name = $result[$i]['name'];
	  // $day = $result[$i]['day'];
	  
	  if( $result[$i]['day'] == "MONDAY" ){
		$dayIndex = 1;
	  } elseif( $result[$i]['day'] == "TUESDAY" ){
		  $dayIndex = 2;
	  } elseif( $result[$i]['day'] == "WEDNESDAY" ){
		  $dayIndex = 3;
	  } elseif( $result[$i]['day'] == "THURSDAY" ){
		  $dayIndex = 4;
	  } elseif( $result[$i]['day'] == "FRIDAY" ){
		  $dayIndex = 5;
	  } elseif( $result[$i]['day'] == "SATURDAY" ){
		  $dayIndex = 6;
	  } elseif( $result[$i]['day'] == "SUNDAY" ){
		  $dayIndex = 7;
	  }
	  
	  $start = $result[$i]['start'];
	  $end = $result[$i]['end'];
	  
	  //we select all records from table: willOnHairTableWeeksdays with the particular key:ameliaCol
	  $conn = mysqli_connect($sname, $uname, $password, $db_name);			
	  $sql_First_get="SELECT * FROM willOnHairTableWeeksdays WHERE ameliaCol=$ameliaId";
	  $report_First_get=mysqli_query($conn,$sql_First_get);
	  
	  
	  
	  if($report_First_get == TRUE){ 
		// if the above key exist we update the records that concerns the key
				$sql_updat_wilID="UPDATE `willOnHairTableWeeksdays` SET `willOnHairCol`='$willOnHairId' WHERE ameliaCol = '$ameliaId'";
				$report_updat_wilID=mysqli_query($conn,$sql_updat_wilID);
				if (mysqli_query($conn,$report_updat_wilID)){ 
				
				}  
			
		} else{
			//if the above key does not exist we insert a new record of the non existing key
			$insert_First_get = "INSERT INTO willOnHairTableWeeksdays(`willOnHairCol`, `ameliaCol`, `name`, `userId`, `dayIndex`, `startTime`, `endTime`) 
			VALUES ('$willOnHairId', '$ameliaId', '$name', '$userId','$dayIndex','$start','$end')"; 
				if (mysqli_query($conn,$insert_First_get)){ 
				}  
		}
	  
	  
	  
	  
	  $i++;
	  }
	  
	  // we select table: willOnHairTableWeeksdays for the process of 
	  //generating amelia ids for the records coming from the backend by 
	  //inserting them into the table: wp_amelia_providers_to_weekdays
	  $conn = mysqli_connect($sname, $uname, $password, $db_name);			
	  $sql_send_to_amelia="SELECT * FROM willOnHairTableWeeksdays";
	  $report_send_to_amelia=mysqli_query($conn,$sql_send_to_amelia);
	  
	  if($report_send_to_amelia== TRUE ){ 
	  while($row_send_to_amelia=mysqli_fetch_array($report_send_to_amelia))
	  {
			// we store all its records into variables
			$id = $row_send_to_amelia['id'];
			$willOnHairId = $row_send_to_amelia['willOnHairCol'];	
			$ameliaId = $row_send_to_amelia['ameliaCol'];
	  
			$userId = $row_send_to_amelia['userId'];	
			$dayIndex = $row_send_to_amelia['dayIndex'];
	  
			$start = $row_send_to_amelia['startTime'];
			$end = $row_send_to_amelia['endTime'];
	  
	  
		// check the record ameliaId if null or equal to 0 we insert the whole record into tablle:wp_amelia_providers_to_weekdays
		if($ameliaId == NULL || $ameliaId == 0){ 
			$send_to_amelia_category = "INSERT INTO wp_amelia_providers_to_weekdays(`userId`, `dayIndex`, `startTime`, `endTime`) 
			VALUES ('$userId','$dayIndex','$start','$end')"; 
			if (mysqli_query($conn,$send_to_amelia_category)){ 
	  
				//during each insert of each records form the while loop and the above 
				//contion we collect the last id that was inserted into the table:wp_amelia_providers_to_weekdays so as to
				//up the column: ameliaCol in th Table: willOnHairTableWeeksdays
			$last_id = mysqli_insert_id($conn);
			if( $last_id ==TRUE ){
					$willOnHairTableWeeksdays_updateTable	= "UPDATE `willOnHairTableWeeksdays` SET `ameliaCol`='$last_id' WHERE willOnHairCol = '$willOnHairId'";
	  
					if (mysqli_query($conn,$willOnHairTableWeeksdays_updateTable)){
					$sql_second_post="SELECT * FROM willOnHairTableWeeksdays WHERE willOnHairCol = '$willOnHairId'";
					$report_second_post=mysqli_query($conn,$sql_second_post);
		
					if($row_second_post=mysqli_fetch_array($report_second_post)){ 
	  
						$ameliaId_send = $row_second_post['ameliaCol'];
	  
						$userId_send = $row_second_post['userId'];	
	  
						if( $row_second_post['dayIndex'] == 1 ){
						  $dayIndex = 0;
						} elseif( $row_second_post['dayIndex'] == 2 ){
							$dayIndex_send = 1;
						} elseif( $row_second_post['dayIndex'] == 3 ){
							$dayIndex_send = 2;
						} elseif( $row_second_post['dayIndex'] == 4 ){
							$dayIndex_send = 3;
						} elseif( $row_second_post['dayIndex'] == 5 ){
							$dayIndex_send = 4;
						} elseif( $row_second_post['dayIndex'] == 6 ){
							$dayIndex_send = 5;
						} elseif( $row_second_post['dayIndex'] == 7 ){
							$dayIndex_send = 6;
						}
	  
						$startTime_send = $row_second_post['startTime'];
						$endTime_send = $row_second_post['endTime'];
	  
					//After the column: ameliaCol in th Table: willOnHairTableWeeksdays is up to date
					// we send the updated table:willOnHairTableWeeksdays to the backend
					$secondPostWeekdays = [ 
						"id" => $willOnHairId,
						"ameliaId" => $ameliaId_send,
						"name" =>  $name,
						"day" =>  $dayIndex_send,
						"start" => strval($startTime_send),
						"end" => strval($endTime_send)
				];
	  
					$curl = curl_init();
					
					curl_setopt_array($curl, array(
					  CURLOPT_URL => "$url/api/v1/employees/$userId_send/week-days/amelia",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'POST',
					  CURLOPT_POSTFIELDS => json_encode($secondPostWeekdays),
					  CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json'
					  ),
					));

					
					$response = curl_exec($curl);
	  
				curl_close($curl);
	  
	  
					}
	  
	  
			}
			
	  
			}
			
			}  
	  
	  
		}
		
		}
	  }
	  
	  
	  // $query = "DROP table willOnHairTableWeeksdays";
	  // if (mysqli_multi_query($conn, $query)) {
	  //   echo "Dropped Successfully";
	  // } else {
	  //   echo "Error:" . mysqli_error($conn);
	  // }	
	  
	  // we display the final results of the table: wp_amelia_providers_to_weekdays 
	  //which now contains a sync data of wp_amelia_providers_to_weekdays and the backend 
	  $sql_table3="SELECT * FROM wp_amelia_providers_to_weekdays";
	  $report_table3=mysqli_query($conn,$sql_table3);
	  if($report_table3== TRUE){ 
	  echo "TABLE NAME: wp_amelia_providers_to_weekdays";
	  echo "<table border='5'>";
	  echo "<tr><th>id</th>
	  <th>userId</th><th>dayIndex</th><th>startTime</th>
	  <th>endTime</th></tr>";
	  
	  while($view_table3=mysqli_fetch_array($report_table3) )
	  {
	  
	  
		echo "<tr><td>";									
		echo$view_table3['id'];
		echo "</td><td>";
		echo$view_table3['userId'];
		echo "</td><td>";
		echo$view_table3['dayIndex'];
		echo "</td><td>";
		echo$view_table3['startTime'];
		echo "</td><td>";									
		echo$view_table3['endTime'];
		echo "</td></tr>";
		echo"<tr></tr>";
		echo"<tr></tr>";
		echo"<tr></tr>";
	  
	  }
	  echo"</table>";
	  
	  }
	  
	  }
			

	  		//Categories get and post
		//============= post to database ======================
	 	public function Print_wp_amelia_providers_to_periods_post($sname,$uname,$password,$db_name, $url){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
			$this->url =$url;
			
			
									
									//connect to database
									$conn = mysqli_connect($sname, $uname, $password, $db_name);
									
									//Create New Table for categories sync
									$sqlCreate = "CREATE TABLE willOnHairTableProviderToPeriod(
											`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
											`willOnHairCol` INT NOT NULL DEFAULT 0,
											`ameliaCol` INT NOT NULL,
											`weekDayId` int NOT NULL,
											`locationId` int DEFAULT NULL,
											`startTime` time NOT NULL,
											`endTime` time NOT NULL
									)";
									
											$report_sqlCreate=mysqli_query($conn,$sqlCreate);
									//Verify if Table has been created
											if ($report_sqlCreate === TRUE) {
											}

											// Select and collect data from table: wp_amelia_providers_to_periods
											$sql_send_to_amelia="SELECT * FROM wp_amelia_providers_to_periods";
											$report_send_to_amelia=mysqli_query($conn,$sql_send_to_amelia);

											if($report_send_to_amelia== TRUE){ 


											while($row_send_to_amelia=mysqli_fetch_array($report_send_to_amelia))
											{
													// store each data from table: wp_amelia_providers_to_periods in variables
															$ameliaId = $row_send_to_amelia['id'];

															$weekDayId = $row_send_to_amelia['weekDayId'];	
															$locationId = $row_send_to_amelia['locationId'];

															$startTime = $row_send_to_amelia['startTime'];
															$endTime = $row_send_to_amelia['endTime'];
							

															// Select Table: willOnHairTableProviderToPeriod and isnert records coming from table: wp_amelia_providers_to_periods
															$conn = mysqli_connect($sname, $uname, $password, $db_name);
																	$qry="SELECT * FROM willOnHairTableProviderToPeriod WHERE ameliaCol='$ameliaId'";
																	$rowCheck=mysqli_query($conn,$qry);
																	if (mysqli_num_rows($rowCheck) > 0) { 
																			
																					
																			} else{
																			$qry = "INSERT INTO willOnHairTableProviderToPeriod (`ameliaCol`,  `weekDayId`, `locationId`, `startTime`, `endTime`)
																			VALUES ('$ameliaId','$weekDayId', '$locationId', '$startTime','$endTime')"; 
																			if (mysqli_query($conn,$qry)){ 
																			
																			}  
															}
											}
									}
			

									//After receiving data from table: wp_amelia_providers_to_periods, next process to send it to the backend
													$sql_table3="SELECT * FROM willOnHairTableProviderToPeriod";
													$report_table3=mysqli_query($conn,$sql_table3);
													if($report_table3== TRUE ){ 
			
													while($row_table3=mysqli_fetch_array($report_table3) )
													{
											
															// select and store all records of table: willOnHairTableProviderToPeriod in variables

															$willOnHairId = $row_table3['willOnHairCol'];
															$ameliaId = $row_table3['ameliaCol'];
															$weekDayIdC = $row_table3['weekDayId'];
															$locationIdC = $row_table3['locationId'];
															$startTimeC = $row_table3['startTime'];
															$endTimeC = $row_table3['endTime'];
															// echo "<br> loceeeeeeeeeeeeeeeeeee: $locationIdC<br>";

			
															// we bind fields from the backend with our variables of the Table: willOnHairTableProviderToPeriod in an array
															
															
															$postPP = [ 
																	"id" => $willOnHairId,
																	"ameliaId" => $ameliaId,
																	"startTime" => $startTimeC,
																	"endTime" => $endTimeC,
													];

													// request header of our post to the backend

													if($locationIdC == 0 || $locationIdC == null) {


														//  echo "<br> if: $locationIdC<br>";


														$curl = curl_init();
															
														curl_setopt_array($curl, array(
																CURLOPT_URL => "$url/api/v1/employees/week-days/$weekDayIdC/periods/amelia?locationId=",
																CURLOPT_RETURNTRANSFER => true,
																CURLOPT_ENCODING => '',
																CURLOPT_MAXREDIRS => 1,
																CURLOPT_TIMEOUT => 0,
																CURLOPT_FOLLOWLOCATION => true,
																CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
																CURLOPT_CUSTOMREQUEST => 'POST',
																CURLOPT_POSTFIELDS => json_encode($postPP),//here we convert our array to a json format
																CURLOPT_HTTPHEADER => array(
																'Content-Type: application/json'
																),
														));
														
														$response = curl_exec($curl);
		
												curl_close($curl);

												// echo "<br> if: $response<br>";
													} else {

														// echo "<br> else: $locationIdC<br>";

														$curl = curl_init();
															
														curl_setopt_array($curl, array(
																CURLOPT_URL => "$url/api/v1/employees/week-days/$weekDayIdC/periods/amelia?locationId=$locationIdC",
																CURLOPT_RETURNTRANSFER => true,
																CURLOPT_ENCODING => '',
																CURLOPT_MAXREDIRS => 1,
																CURLOPT_TIMEOUT => 0,
																CURLOPT_FOLLOWLOCATION => true,
																CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
																CURLOPT_CUSTOMREQUEST => 'POST',
																CURLOPT_POSTFIELDS => json_encode($postPP),//here we convert our array to a json format
																CURLOPT_HTTPHEADER => array(
																'Content-Type: application/json'
																),
														));
														
														$response = curl_exec($curl);
		
												curl_close($curl);
												// echo "<br> else: $response<br>";
														
													}

															


											}

																					
					}
	}
	
	//=============get from database and insert in amelia_categories ===============
	public function Print_wp_amelia_providers_to_periods_insert($sname,$uname,$password,$db_name, $url){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
			$this->url =$url;
	
// we creat a connection
	$conn = mysqli_connect($sname, $uname, $password, $db_name);			

	// request header of our get from the backend
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "$url/api/v1/employees/periods",
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
	$result = json_decode($response, true); // here we decode data coming from backend and store it as an array
	curl_close($curl);
	
	// we loop through our array and store eacch into variables
	$i = 0;
	while($i < count($result)) {
	$willOnHairId = $result[$i]['id'];	
	$ameliaId = $result[$i]['ameliaId'];	
	$weekDayId = $result[$i]['weekDays']['ameliaId'];
	$locationId = $result[$i]['location']['ameliaId'];
	$startTime = $result[$i]['startTime'];
	$endTime = $result[$i]['endTime'];
	
	//we select all records from table: willOnHairTableProviderToPeriod with the particular key:ameliaCol
	$conn = mysqli_connect($sname, $uname, $password, $db_name);			
	$sql_First_get="SELECT * FROM willOnHairTableProviderToPeriod WHERE ameliaCol=$ameliaId";
	$report_First_get=mysqli_query($conn,$sql_First_get);
	

	
	if($report_First_get == TRUE){ 
			// if the above key exist we update the records that concerns the key
							$sql_updat_wilID="UPDATE `willOnHairTableProviderToPeriod` SET `willOnHairCol`='$willOnHairId' WHERE ameliaCol = '$ameliaId'";
							$report_updat_wilID=mysqli_query($conn,$sql_updat_wilID);
							if (mysqli_query($conn,$report_updat_wilID)){ 
							
							}  
					
			} else{
					//if the above key does not exist we insert a new record of the non existing key
					$insert_First_get = "INSERT INTO willOnHairTableProviderToPeriod(`willOnHairCol`, `ameliaCol`, `weekDayId`, `locationId`, `startTime`, `endTime`) 
					VALUES ('$willOnHairId', '$ameliaId', '$weekDayId','$locationId','$startTime','$endTime')"; 
							if (mysqli_query($conn,$insert_First_get)){ 
							}  
			}
	
	
	
	
	$i++;
	}
	
	// we select table: willOnHairTableProviderToPeriod for the process of 
	//generating amelia ids for the records coming from the backend by 
	//inserting them into the table: wp_amelia_providers_to_periods
	$conn = mysqli_connect($sname, $uname, $password, $db_name);			
	$sql_send_to_amelia="SELECT * FROM willOnHairTableProviderToPeriod";
	$report_send_to_amelia=mysqli_query($conn,$sql_send_to_amelia);

	if($report_send_to_amelia== TRUE ){ 
	while($row_send_to_amelia=mysqli_fetch_array($report_send_to_amelia))
	{
					// we store all its records into variables
					$id = $row_send_to_amelia['id'];
					$willOnHairId = $row_send_to_amelia['willOnHairCol'];	
					$ameliaId = $row_send_to_amelia['ameliaCol'];

					$weekDayId = $row_send_to_amelia['weekDayId'];	
					$locationId = $row_send_to_amelia['locationId'];

					$startTime = $row_send_to_amelia['startTime'];
					$endTime = $row_send_to_amelia['endTime'];

	
			// check the record ameliaId if null or equal to 0 we insert the whole record into tablle:wp_amelia_providers_to_periods
			if($ameliaId == NULL || $ameliaId == 0){ 
					$send_to_amelia_category = "INSERT INTO wp_amelia_providers_to_periods (`weekDayId`, `locationId`, `startTime`, `endTime`) 
					VALUES ('$weekDayId','$locationId','$startTime','$endTime')"; 
					if (mysqli_query($conn,$send_to_amelia_category)){ 

							//during each insert of each records form the while loop and the above 
							//contion we collect the last id that was inserted into the table:wp_amelia_providers_to_periods so as to
							//up the column: ameliaCol in th Table: willOnHairTableProviderToPeriod
					$last_id = mysqli_insert_id($conn);
					if( $last_id ==TRUE ){
									$willOnHairTableProviderToPeriod_updateTable	= "UPDATE `willOnHairTableProviderToPeriod` SET `ameliaCol`='$last_id' WHERE willOnHairCol = '$willOnHairId'";

									if (mysqli_query($conn,$willOnHairTableProviderToPeriod_updateTable)){
									$sql_second_post="SELECT * FROM willOnHairTableProviderToPeriod WHERE willOnHairCol = '$willOnHairId'";
									$report_second_post=mysqli_query($conn,$sql_second_post);
			
									if($row_second_post=mysqli_fetch_array($report_second_post)){ 

											$ameliaId_send = $row_second_post['ameliaCol'];
	
											$weekDayId_send = $row_second_post['weekDayId'];	
											$locationId_send = $row_second_post['locationId'];
	
											$startTime_send = $row_second_post['startTime'];
											$endTime_send = $row_second_post['endTime'];

									//After the column: ameliaCol in th Table: willOnHairTableProviderToPeriod is up to date
									// we send the updated table:willOnHairTableProviderToPeriod to the backend
									$secondPostPP = [ 
											"id" => $willOnHairId,
											"ameliaId" => $ameliaId_send,
											"startTime" => $startTime_send,
											"endTime" => $endTime_send
							];

								if($locationId_send == 0 || $locationId_send == null ) {
										$curl = curl_init();
											
										curl_setopt_array($curl, array(
												CURLOPT_URL => "$url/api/v1/employees/week-days/$weekDayId_send/periods/amelia?locationId=",
												CURLOPT_RETURNTRANSFER => true,
												CURLOPT_ENCODING => '',
												CURLOPT_MAXREDIRS => 1,
												CURLOPT_TIMEOUT => 0,
												CURLOPT_FOLLOWLOCATION => true,
												CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
												CURLOPT_CUSTOMREQUEST => 'POST',
												CURLOPT_POSTFIELDS => json_encode($secondPostPP),//here we convert our array to a json format
												CURLOPT_HTTPHEADER => array(
												'Content-Type: application/json'
												),
										));
										
										$response = curl_exec($curl);

								curl_close($curl);
								// echo "<br> if : $response<br>";
									} else {
										$curl = curl_init();
											
										curl_setopt_array($curl, array(
												CURLOPT_URL => "$url/api/v1/employees/week-days/$weekDayId_send/periods/amelia?locationId=$locationId_send",
												CURLOPT_RETURNTRANSFER => true,
												CURLOPT_ENCODING => '',
												CURLOPT_MAXREDIRS => 1,
												CURLOPT_TIMEOUT => 0,
												CURLOPT_FOLLOWLOCATION => true,
												CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
												CURLOPT_CUSTOMREQUEST => 'POST',
												CURLOPT_POSTFIELDS => json_encode($secondPostPP),//here we convert our array to a json format
												CURLOPT_HTTPHEADER => array(
												'Content-Type: application/json'
												),
										));
										
										$response = curl_exec($curl);

								curl_close($curl);
								// echo "<br> else : $response<br>";

										
									}



									}


					}
					

					}
					
					}  


			}
			
			}
	}


	// $query = "DROP table willOnHairTableProviderToPeriod";
	// if (mysqli_multi_query($conn, $query)) {
	//   echo "Dropped Successfully";
	// } else {
	//   echo "Error:" . mysqli_error($conn);
	// }	
	
	// we display the final results of the table: wp_amelia_providers_to_periods 
	//which now contains a sync data of wp_amelia_providers_to_periods and the backend 
	$sql_table3="SELECT * FROM wp_amelia_providers_to_periods";
	$report_table3=mysqli_query($conn,$sql_table3);
	if($report_table3== TRUE){ 
	echo "TABLE locationId: wp_amelia_providers_to_periods";
	echo "<table border='5'>";
	echo "<tr><th>id</th>
	<th>weekDayId</th><th>locationId</th><th>startTime</th>
	<th>endTime</th></tr>";
	
	while($row_table3=mysqli_fetch_array($report_table3) )
	{
	
	
			echo "<tr><td>";									
			echo$row_table3['id'];
			echo "</td><td>";
			echo$row_table3['weekDayId'];
			echo "</td><td>";
			echo$row_table3['locationId'];
			echo "</td><td>";
			echo$row_table3['startTime'];
			echo "</td><td>";									
			echo$row_table3['endTime'];
			echo "</td></tr>";
			echo"<tr></tr>";
			echo"<tr></tr>";
			echo"<tr></tr>";
	
	}
	echo"</table>";
	
	}
	
	}



		//Locations get and post
		//============= post to database ======================
     public function Print_wp_amelia_location_post($sname, $uname, $password, $db_name, $url)
	{
		$this->sname = $sname;
		$this->uname = $uname;
		$this->password = $password;
		$this->db_name = $db_name;
		$this->url = $url;



		//connect to database
		$conn = mysqli_connect($sname, $uname, $password, $db_name);

		//Create New Table for categories sync
		$sqlCreate = "CREATE TABLE willOnHairTableLocations(
				`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
				`willOnHairCol` INT NOT NULL DEFAULT 0,
				`ameliaCol` INT NOT NULL,
				`status` enum('hidden','visible','disabled') NOT NULL DEFAULT 'visible',
				`name` varchar(255) NOT NULL DEFAULT '',
				`description` text DEFAULT NULL,
				`address` varchar(255) NOT NULL,
				`phone` varchar(63) NOT NULL,
				`latitude` decimal(8,6) NOT NULL,
				`longitude` decimal(9,6) NOT NULL,
				`pictureFullPath` varchar(767) DEFAULT NULL,
				`pictureThumbPath` varchar(767) DEFAULT NULL,
				`pin` mediumtext DEFAULT NULL,
				`translations` text DEFAULT NULL
						)";

		$report_sqlCreate = mysqli_query($conn, $sqlCreate);
		//Verify if Table has been created
		if ($report_sqlCreate === TRUE) {
		}

		// Select and collect data from table: wp_amelia_locations
		$sql_send_to_amelia = "SELECT * FROM wp_amelia_locations";
		$report_send_to_amelia = mysqli_query($conn, $sql_send_to_amelia);

		if ($report_send_to_amelia == TRUE) {


			while ($row_send_to_amelia = mysqli_fetch_array($report_send_to_amelia)) {
				// store each data from table: wp_amelia_locations in variables
				$ameliaId = $row_send_to_amelia['id'];

				$status = $row_send_to_amelia['status'];
				$name = $row_send_to_amelia['name'];
        
                                $description = $row_send_to_amelia['description'];
                                $address = $row_send_to_amelia['address'];
        
        
                                $phone = $row_send_to_amelia['phone'];
        
                                $latitude = $row_send_to_amelia['latitude'];
                                $longitude = $row_send_to_amelia['longitude'];
        
                                $pictureFullPath = $row_send_to_amelia['pictureFullPath'];
                                $pictureThumbPath = $row_send_to_amelia['pictureThumbPath'];
        
                                $pin = $row_send_to_amelia['pin'];
                                $translations = $row_send_to_amelia['translations'];
        
        

				// Select Table: willOnHairTableLocations and isnert records coming from table: wp_amelia_locations
				$conn = mysqli_connect($sname, $uname, $password, $db_name);
				$qry = "SELECT * FROM willOnHairTableLocations WHERE ameliaCol='$ameliaId'";
				$rowCheck = mysqli_query($conn, $qry);
				if ( mysqli_num_rows($rowCheck) > 0) {
					
				} else {
					$qry = "INSERT INTO willOnHairTableLocations (`ameliaCol`, `status`, `name`, `description`, 
					`address`, `phone`, `latitude`, `longitude`, `pictureFullPath`, `pictureThumbPath`, `pin`, `translations`) 
					VALUES ('$ameliaId','$status', '$name', '$description','$address', 
					'$phone','$latitude', '$longitude', '$pictureFullPath','$pictureThumbPath','$pin','$translations')";
						if (mysqli_query($conn, $qry)) {
						}

				}
			}
		}


		//After receiving data from table: wp_amelia_locations, next process to send it to the backend
		$sql_table3 = "SELECT * FROM willOnHairTableLocations";
		$report_table3 = mysqli_query($conn, $sql_table3);
		if ($report_table3 == TRUE) {

			while ($row_table3 = mysqli_fetch_array($report_table3)) {

				// select and store all records of table: willOnHairTableLocations in variables

			$willOnHairId = $row_table3['willOnHairCol'];
			$ameliaId = $row_table3['ameliaCol'];
			$statusC = $row_table3['status'];
			$nameC = $row_table3['name'];
			$descriptionC = $row_table3['description'];
			$addressC = $row_table3['address'];

			$phoneC = $row_table3['phone'];
			$latitudeC = $row_table3['latitude'];
			$longitudeC = $row_table3['longitude'];
			$pictureFullPathC = $row_table3['pictureFullPath'];
			$pictureThumbPathC = $row_table3['pictureThumbPath'];
			$pinC = $row_table3['pin'];
			$translationsC = $row_table3['translations'];

				// we bind fields from the backend with our variables of the Table: willOnHairTableLocations in an array
				$postCat = [
                                        "id" => $willOnHairId,
                                        "ameliaId" => $ameliaId,
                                        "statusC" => strtoupper($statusC),
                                        "name" => $nameC,
                                        "description" => $descriptionC,
                                        "address" => $addressC,
                                        "phone" => $phoneC,
                                        "latitude" => $latitudeC,
                                        "longitude" => $longitudeC,
                                        "pictureFullPath" => $pictureFullPathC,
                                        "pictureThumbPath" => $pictureThumbPathC,
                                        "pin" => $pinC,
                                        "translations" => $translationsC,
				];

				// request header of our post to the backend

				$curl = curl_init();

				curl_setopt_array($curl, array(
                                        CURLOPT_URL => "$url/api/v1/locations",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 1,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => json_encode($postCat),
					//here we convert our array to a json format
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json'
					),
				)
				);

				$response = curl_exec($curl);

				curl_close($curl);
			}
		}
	}

	//=============get from database and insert in amelia_locations ===============
	public function Print_wp_amelia_location_insert($sname, $uname, $password, $db_name, $url)
	{
		$this->sname = $sname;
		$this->uname = $uname;
		$this->password = $password;
		$this->db_name = $db_name;
		$this->url = $url;

		// we creat a connection
		$conn = mysqli_connect($sname, $uname, $password, $db_name);

		// request header of our get from the backend
		$curl = curl_init();
		curl_setopt_array($curl, array(
                        CURLOPT_URL => "$url/api/v1/locations",
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
		)
		);

		$response = curl_exec($curl);
		$result = json_decode($response, true); // here we decode data coming from backend and store it as an array
		curl_close($curl);
//  echo "get cat <br> ======= $response ======= <br>";

		// we loop through our array and store eacch into variables
		$i = 0;
		while ($i < count($result)) {
			$willOnHairId = $result[$i]['id'];
			$ameliaId = $result[$i]['ameliaId'];
			$status = $result[$i]['status'];
			$name = $result[$i]['name'];

			$description = $result[$i]['description'];
			$address = $result[$i]['address'];
			$phone = $result[$i]['phone'];
			$latitude = $result[$i]['latitude'];

			$longitude = $result[$i]['longitude'];
			$pictureFullPath = $result[$i]['pictureFullPath'];
			$pictureThumbPath = $result[$i]['pictureThumbPath'];
            $pin = $result[$i]['pin'];
			$translations = $result[$i]['translations'];

			//we select all records from table: willOnHairTableLocations with the particular key:ameliaCol
			$conn = mysqli_connect($sname, $uname, $password, $db_name);
			$sql_First_get = "SELECT * FROM willOnHairTableLocations WHERE ameliaCol=$ameliaId";
			$report_First_get = mysqli_query($conn, $sql_First_get);



			if ($report_First_get == TRUE) {
				// if the above key exist we update the records that concerns the key
				$sql_updat_wilID = "UPDATE `willOnHairTableLocations` SET `willOnHairCol`='$willOnHairId' WHERE ameliaCol = '$ameliaId'";
				$report_updat_wilID = mysqli_query($conn, $sql_updat_wilID);
				if (mysqli_query($conn, $report_updat_wilID)) {
				}
			} else {
				//if the above key does not exist we insert a new record of the non existing key
				$insert_First_get = "INSERT INTO willOnHairTableLocations(`willOnHairCol`, `ameliaCol`, `status`, `name`, `description`, `address`, `phone`, `latitude`, `longitude`, `pictureFullPath`, 
                                `pictureThumbPath`, `pin`, `translations`) 
					VALUES ('$willOnHairId', '$ameliaId', '$status','$name','$description',
						'$address', '$phone','$latitude','$longitude','$pictureFullPath',
                                                '$pictureThumbPath','$pin','$translations')";
				if (mysqli_query($conn, $insert_First_get)) {
				}
			}




			$i++;
		}

		// we select table: willOnHairTableLocations for the process of 
		//generating amelia ids for the records coming from the backend by 
		//inserting them into the table: wp_amelia_locations
		$conn = mysqli_connect($sname, $uname, $password, $db_name);
		$sql_send_to_amelia = "SELECT * FROM willOnHairTableLocations";
		$report_send_to_amelia = mysqli_query($conn, $sql_send_to_amelia);

		if ($report_send_to_amelia == TRUE) {
			while ($row_send_to_amelia = mysqli_fetch_array($report_send_to_amelia)) {
				// we store all its records into variables
				$willOnHairId = $row_send_to_amelia['willOnHairCol'];
				$ameliaId = $row_send_to_amelia['ameliaCol'];

				$status = $row_send_to_amelia['status'];
				$name = $row_send_to_amelia['name'];

				$description = $row_send_to_amelia['description'];
				$address = $row_send_to_amelia['address'];

				$phone = $row_send_to_amelia['phone'];
				$latitude = $row_send_to_amelia['latitude'];

				$longitude = $row_send_to_amelia['longitude'];
				$pictureFullPath = $row_send_to_amelia['pictureFullPath'];

				$pictureThumbPath = $row_send_to_amelia['pictureThumbPath'];				
				$pin = $row_send_to_amelia['pin'];
				$translations = $row_send_to_amelia['translations'];


				// check the record ameliaId if null or equal to 0 we insert the whole record into tablle:wp_amelia_locations
				if ($ameliaId == NULL || $ameliaId == 0) {
					$send_to_amelia_category = "INSERT INTO wp_amelia_locations(`status`, `name`, `description`, `address`, `phone`, `latitude`, `longitude`, `pictureFullPath`, 
                                        `pictureThumbPath`, `pin`, `translations`) 
					VALUES ('$status','$name','$description',
					'$address', '$phone','$latitude','$longitude','$pictureFullPath','$pictureThumbPath','$pin','$translations')";
					if (mysqli_query($conn, $send_to_amelia_category)) {

						//during each insert of each records form the while loop and the above 
						//contion we collect the last id that was inserted into the table:wp_amelia_locations so as to
						//up the column: ameliaCol in th Table: willOnHairTableLocations
						$last_id = mysqli_insert_id($conn);
						if ($last_id == TRUE) {
							$willOnHairTableLocations_updateTable = "UPDATE `willOnHairTableLocations` SET `ameliaCol`='$last_id' WHERE willOnHairCol = '$willOnHairId'";

							if (mysqli_query($conn, $willOnHairTableLocations_updateTable)) {
								$sql_second_post = "SELECT * FROM willOnHairTableLocations WHERE willOnHairCol = '$willOnHairId'";
								$report_second_post = mysqli_query($conn, $sql_second_post);

								if ($row_second_post = mysqli_fetch_array($report_second_post)) {

									$ameliaId_send = $row_second_post['ameliaCol'];

									$status_send = $row_second_post['status'];
									$name_send = $row_second_post['name'];


									$description_send = $row_second_post['description'];
									$address_send = $row_second_post['address'];


									$phone_send = $row_second_post['phone'];

									$latitude_send = $row_second_post['latitude'];
									$longitude_send = $row_second_post['longitude'];

									$pictureFullPath_send = $row_second_post['pictureFullPath'];
									$pictureThumbPath_send = $row_second_post['pictureThumbPath'];

									$pin_send = $row_second_post['pin'];
									$translations_send = $row_second_post['translations'];

									//After the column: ameliaCol in th Table: willOnHairTableLocations is up to date
									// we send the updated table:willOnHairTableLocations to the backend
									$postCategory = [
												"id" => $willOnHairId,
											"ameliaId" => $ameliaId_send,
											"status" => strtoupper($status_send),
											"name" => $name_send,
											"description" => $description_send,
											"address" => $address_send,
											"phone" => $phone_send,
											"latitude" => $latitude_send,
											"longitude" => $longitude_send,
											"pictureFullPath" => $pictureFullPath_send,
											"pictureThumbPath" => $pictureThumbPath_send,
											"pin" => $pin_send,
											"translations" => $translations_send,
									];

									$curl = curl_init();

									curl_setopt_array($curl, array(
                                                                                CURLOPT_URL => "$url/api/v1/locations",
										CURLOPT_RETURNTRANSFER => true,
										CURLOPT_ENCODING => '',
										CURLOPT_MAXREDIRS => 1,
										CURLOPT_TIMEOUT => 0,
										CURLOPT_FOLLOWLOCATION => true,
										CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
										CURLOPT_CUSTOMREQUEST => 'POST',
										CURLOPT_POSTFIELDS => json_encode($postCategory),
										CURLOPT_HTTPHEADER => array(
											'Content-Type: application/json'
										),
									)
									);

									$response = curl_exec($curl);

									curl_close($curl);
								}
							}
						}
					}
				}
			}
		}




		// we display the final results of the table: wp_amelia_locations 
		//which now contains a sync data of wp_amelia_locations and the backend 
		$sql_table_wp_amelia_locations = "SELECT * FROM wp_amelia_locations";
		$report_table_wp_amelia_locations = mysqli_query($conn, $sql_table_wp_amelia_locations);
		if ($report_table_wp_amelia_locations == TRUE) {
				echo "TABLE NAME: wp_amelia_locations";
				echo "<table border='5'>";
				echo "<tr>
										<th>id</th>
										<th>status</th>   <th>name</th>  <th>description</th>  
										<th>address</th>   <th>phone</th> <th>latitude</th>   <th>longitude</th>  <th>pictureFullPath</th>  
										<th>pictureThumbPath</th>   <th>pin</th>  <th>translations</th></tr>";

				while ($row_table_wp_amelia_locations = mysqli_fetch_array($report_table_wp_amelia_locations)) {


						echo "<td>";
						echo $row_table_wp_amelia_locations['id'];
						echo "</td><td>";
						echo $row_table_wp_amelia_locations['status'];
						echo "</td><td>";
						echo $row_table_wp_amelia_locations['name'];
						echo "</td><td>";
						echo $row_table_wp_amelia_locations['description'];
						echo "</td><td>";
						echo $row_table_wp_amelia_locations['address'];
						echo "</td><td>";
						echo $row_table_wp_amelia_locations['phone'];
						echo "</td><td>";
						echo $row_table_wp_amelia_locations['latitude'];
						echo "</td><td>";
						echo $row_table_wp_amelia_locations['longitude'];
						echo "</td><td>";
						echo $row_table_wp_amelia_locations['pictureFullPath'];
						echo "</td><td>";
						echo $row_table_wp_amelia_locations['pictureThumbPath'];
						echo "</td><td>";
						echo $row_table_wp_amelia_locations['pin'];
						echo "</td><td>";
						echo $row_table_wp_amelia_locations['translations'];
						echo "</td></tr>";
				}
				echo "</table>";
		}

		// $query = "DROP table willOnHairTableLocations";
		// if (mysqli_multi_query($conn, $query)) {
		// }
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
					
					//Create New Table for categories sync
					$sqlCreate = "CREATE TABLE willOnHairTableCat(
						`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
						`willOnHairCol` INT NOT NULL DEFAULT 0,
						`ameliaCol` INT NOT NULL,
						`status` enum('hidden','visible','disabled') NOT NULL DEFAULT 'visible',
						`name` varchar(2555) NOT NULL DEFAULT '',
						`position` int NOT NULL,
						`translations` text DEFAULT NULL
					)";
					
						$report_sqlCreate=mysqli_query($conn,$sqlCreate);
					//Verify if Table has been created
						if ($report_sqlCreate === TRUE) {
						}

						// Select and collect data from table: wp_amelia_categories
						$sql_send_to_amelia="SELECT * FROM wp_amelia_categories";
						$report_send_to_amelia=mysqli_query($conn,$sql_send_to_amelia);

						if($report_send_to_amelia== TRUE){ 


						while($row_send_to_amelia=mysqli_fetch_array($report_send_to_amelia))
						{
							// store each data from table: wp_amelia_categories in variables
								$ameliaId = $row_send_to_amelia['id'];

								$status = $row_send_to_amelia['status'];	
								$name = $row_send_to_amelia['name'];

								$position = $row_send_to_amelia['position'];
								$translations = $row_send_to_amelia['translations'];
				

								// Select Table: willOnHairTableCat and isnert records coming from table: wp_amelia_categories
								$conn = mysqli_connect($sname, $uname, $password, $db_name);
									$qry="SELECT * FROM willOnHairTableCat WHERE ameliaCol='$ameliaId'";
									$rowCheck=mysqli_query($conn,$qry);
									if (mysqli_num_rows($rowCheck) > 0) { 
										
											
										} else{
										$qry = "INSERT INTO willOnHairTableCat (`ameliaCol`, `status`, `name`, `position`, `translations`)
										VALUES ('$ameliaId','$status', '$name', '$position','$translations')"; 
										if (mysqli_query($conn,$qry)){ 
										
										}  
								}
						}
					}
		

					//After receiving data from table: wp_amelia_categories, next process to send it to the backend
							$sql_table3="SELECT * FROM willOnHairTableCat";
							$report_table3=mysqli_query($conn,$sql_table3);
							if($report_table3== TRUE ){ 
		
							while($row_table3=mysqli_fetch_array($report_table3) )
							{
						
								// select and store all records of table: willOnHairTableCat in variables

								$willOnHairId = $row_table3['willOnHairCol'];
								$ameliaId = $row_table3['ameliaCol'];
								$statusC = $row_table3['status'];
								$nameC = $row_table3['name'];
								$positionC = $row_table3['position'];
								$translationsC = $row_table3['translations'];
		
								// we bind fields from the backend with our variables of the Table: willOnHairTableCat in an array
								$postCat = [ 
									"id" => $willOnHairId,
									"ameliaId" => $ameliaId,
									"status" => strtoupper($statusC),
									"name" => $nameC,
									"position" => $positionC,
									"translations" => $translationsC,
									"image" => "string33333",
									"note" => "string33333"
							];

							// request header of our post to the backend
		
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
									CURLOPT_POSTFIELDS => json_encode($postCat),//here we convert our array to a json format
									CURLOPT_HTTPHEADER => array(
									'Content-Type: application/json'
									),
								));
								
								$response = curl_exec($curl);
		
							curl_close($curl);


						}

											
			}
	}
	
	//=============get from database and insert in amelia_categories ===============
	public function Print_wp_amelia_categories_insert($sname,$uname,$password,$db_name, $url){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		$this->url =$url;
	
// we creat a connection
	$conn = mysqli_connect($sname, $uname, $password, $db_name);			

	// request header of our get from the backend
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
	$result = json_decode($response, true); // here we decode data coming from backend and store it as an array
	curl_close($curl);
	
	// we loop through our array and store eacch into variables
	$i = 0;
	while($i < count($result)) {
	$willOnHairId = $result[$i]['id'];	
	$ameliaId = $result[$i]['ameliaId'];	
	$status = $result[$i]['status'];
	$name = $result[$i]['name'];
	$position = $result[$i]['position'];
	$translations = $result[$i]['translations'];
	
	//we select all records from table: willOnHairTableCat with the particular key:ameliaCol
	$conn = mysqli_connect($sname, $uname, $password, $db_name);			
	$sql_First_get="SELECT * FROM willOnHairTableCat WHERE ameliaCol=$ameliaId";
	$report_First_get=mysqli_query($conn,$sql_First_get);
	

	
	if($report_First_get == TRUE){ 
		// if the above key exist we update the records that concerns the key
				$sql_updat_wilID="UPDATE `willOnHairTableCat` SET `willOnHairCol`='$willOnHairId' WHERE ameliaCol = '$ameliaId'";
				$report_updat_wilID=mysqli_query($conn,$sql_updat_wilID);
				if (mysqli_query($conn,$report_updat_wilID)){ 
				
				}  
			
		} else{
			//if the above key does not exist we insert a new record of the non existing key
			$insert_First_get = "INSERT INTO willOnHairTableCat(`willOnHairCol`, `ameliaCol`, `status`, `name`, `position`, `translations`) 
			VALUES ('$willOnHairId', '$ameliaId', '$status','$name','$position','$translations')"; 
				if (mysqli_query($conn,$insert_First_get)){ 
				}  
		}
	
	
	
	
	$i++;
	}
	
	// we select table: willOnHairTableCat for the process of 
	//generating amelia ids for the records coming from the backend by 
	//inserting them into the table: wp_amelia_categories
	$conn = mysqli_connect($sname, $uname, $password, $db_name);			
	$sql_send_to_amelia="SELECT * FROM willOnHairTableCat";
	$report_send_to_amelia=mysqli_query($conn,$sql_send_to_amelia);

	if($report_send_to_amelia== TRUE ){ 
	while($row_send_to_amelia=mysqli_fetch_array($report_send_to_amelia))
	{
			// we store all its records into variables
			$id = $row_send_to_amelia['id'];
			$willOnHairId = $row_send_to_amelia['willOnHairCol'];	
			$ameliaId = $row_send_to_amelia['ameliaCol'];

			$status = $row_send_to_amelia['status'];	
			$name = $row_send_to_amelia['name'];

			$position = $row_send_to_amelia['position'];
			$translations = $row_send_to_amelia['translations'];

	
		// check the record ameliaId if null or equal to 0 we insert the whole record into tablle:wp_amelia_categories
		if($ameliaId == NULL || $ameliaId == 0){ 
			$send_to_amelia_category = "INSERT INTO wp_amelia_categories(`status`, `name`, `position`, `translations`) 
			VALUES ('$status','$name','$id','$translations')"; 
			if (mysqli_query($conn,$send_to_amelia_category)){ 

				//during each insert of each records form the while loop and the above 
				//contion we collect the last id that was inserted into the table:wp_amelia_categories so as to
				//up the column: ameliaCol in th Table: willOnHairTableCat
			$last_id = mysqli_insert_id($conn);
			if( $last_id ==TRUE ){
					$willOnHairTableCat_updateTable	= "UPDATE `willOnHairTableCat` SET `ameliaCol`='$last_id' WHERE willOnHairCol = '$willOnHairId'";

					if (mysqli_query($conn,$willOnHairTableCat_updateTable)){
					$sql_second_post="SELECT * FROM willOnHairTableCat WHERE willOnHairCol = '$willOnHairId'";
					$report_second_post=mysqli_query($conn,$sql_second_post);
		
					if($row_second_post=mysqli_fetch_array($report_second_post)){ 

						$ameliaId_send = $row_second_post['ameliaCol'];
	
						$status_send = $row_second_post['status'];	
						$name_send = $row_second_post['name'];
	
						$position_send = $row_second_post['position'];
						$translations_send = $row_second_post['translations'];

					//After the column: ameliaCol in th Table: willOnHairTableCat is up to date
					// we send the updated table:willOnHairTableCat to the backend
					$postCategory = [ 
						"id" => $willOnHairId,
						"ameliaId" => $ameliaId_send,
						"status" => strtoupper($status_send),
						"name" => $name_send,
						"position" => $position_send,
						"translations" => $translations_send,
						"image" => "string33333",
						"note" => "string33333"
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
						CURLOPT_POSTFIELDS => json_encode($postCategory),
						CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json'
						),
					));
					
					$response = curl_exec($curl);

				curl_close($curl);


					}


			}
			

			}
			
			}  


		}
		
		}
	}


	// $query = "DROP table willOnHairTableCat";
	// if (mysqli_multi_query($conn, $query)) {
	//   echo "Dropped Successfully";
	// } else {
	//   echo "Error:" . mysqli_error($conn);
	// }	
	
	// we display the final results of the table: wp_amelia_categories 
	//which now contains a sync data of wp_amelia_categories and the backend 
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



	//services get and post
		//============= post to database ======================
		public function Print_wp_amelia_services_post($sname, $uname, $password, $db_name, $url)
		{
						$this->sname = $sname;
						$this->uname = $uname;
						$this->password = $password;
						$this->db_name = $db_name;
						$this->url = $url;
		
		
		
						//connect to database
						$conn = mysqli_connect($sname, $uname, $password, $db_name);
		
						//Create New Table for categories sync
						$sqlCreate = "CREATE TABLE willOnHairTableServices(
														`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
														`willOnHairCol` INT NOT NULL DEFAULT 0,
														`ameliaCol` INT NOT NULL,
														`name` varchar(255) NOT NULL DEFAULT '',
														`description` text DEFAULT NULL,
														`color` varchar(255) NOT NULL DEFAULT '',
														`price` double NOT NULL,
														`status` enum('hidden','visible','disabled') NOT NULL DEFAULT 'visible',
														`categoryId` int(11) NOT NULL,
														`minCapacity` int(11) NOT NULL,
														`maxCapacity` int(11) NOT NULL,
														`duration` int(11) NOT NULL,
														`timeBefore` int(11) DEFAULT 0,
														`timeAfter` int(11) DEFAULT 0,
														`bringingAnyone` tinyint(1) DEFAULT 1,
														`priority` enum('least_expensive','most_expensive','least_occupied','most_occupied') NOT NULL,
														`pictureFullPath` varchar(767) DEFAULT NULL,
														`pictureThumbPath` varchar(767) DEFAULT NULL,
														`position` int(11) DEFAULT 0,
														`show` tinyint(1) DEFAULT 1,
														`aggregatedPrice` tinyint(1) DEFAULT 1,
														`settings` text DEFAULT NULL,
														`recurringCycle` enum('disabled','all','daily','weekly','monthly') DEFAULT 'disabled',
														`recurringSub` enum('disabled','past','future','both') DEFAULT 'future',
														`recurringPayment` int(3) DEFAULT 0,
														`translations` text DEFAULT NULL,
														`depositPayment` enum('disabled','fixed','percentage') DEFAULT 'disabled',
														`depositPerPerson` tinyint(1) DEFAULT 1,
														`deposit` double DEFAULT 0,
														`fullPayment` tinyint(1) DEFAULT 0,
														`mandatoryExtra` tinyint(1) DEFAULT 0,
														`minSelectedExtras` int(11) DEFAULT 0,
														`customPricing` text DEFAULT NULL,
														`maxExtraPeople` int(11) DEFAULT NULL,
														`limitPerCustomer` text DEFAULT NULL)";
		
						$report_sqlCreate = mysqli_query($conn, $sqlCreate);
						//Verify if Table has been created
						if ($report_sqlCreate === TRUE) {
						}
		
						// Select and collect data from table: wp_amelia_services
						$sql_send_to_amelia = "SELECT * FROM wp_amelia_services";
						$report_send_to_amelia = mysqli_query($conn, $sql_send_to_amelia);
		
						if ($report_send_to_amelia == TRUE) {
		
								while ($row_send_to_amelia = mysqli_fetch_array($report_send_to_amelia)) {
										// store each data from table: wp_amelia_services in variables
										$ameliaId = $row_send_to_amelia['id'];
										$name = $row_send_to_amelia['name']; 
										$description = $row_send_to_amelia['description'];
										$color = $row_send_to_amelia['color'];
										$price = $row_send_to_amelia['price'];
										$status = $row_send_to_amelia['status'];


										$categoryId = $row_send_to_amelia['categoryId'];
										$minCapacity = $row_send_to_amelia['minCapacity'];
										$maxCapacity = $row_send_to_amelia['maxCapacity'];
										$duration = $row_send_to_amelia['duration'];
										$timeBefore = $row_send_to_amelia['timeBefore'];
										$timeAfter = $row_send_to_amelia['timeAfter'];


										$bringingAnyone = $row_send_to_amelia['bringingAnyone'];
										$priority = $row_send_to_amelia['priority'];
										$pictureFullPath = $row_send_to_amelia['pictureFullPath'];
										$pictureThumbPath = $row_send_to_amelia['pictureThumbPath'];
										$position = $row_send_to_amelia['position'];


										$show = $row_send_to_amelia['show'];
										$aggregatedPrice = $row_send_to_amelia['aggregatedPrice'];
										$settings = $row_send_to_amelia['settings'];
										$recurringCycle = $row_send_to_amelia['recurringCycle'];



										$recurringSub = $row_send_to_amelia['recurringSub'];
										$recurringPayment = $row_send_to_amelia['recurringPayment'];
										$translations = $row_send_to_amelia['translations'];
										$depositPayment = $row_send_to_amelia['depositPayment'];
										$depositPerPerson = $row_send_to_amelia['depositPerPerson'];


										$deposit = $row_send_to_amelia['deposit'];
										$fullPayment = $row_send_to_amelia['fullPayment'];
										$mandatoryExtra = $row_send_to_amelia['mandatoryExtra'];
										$minSelectedExtras = $row_send_to_amelia['minSelectedExtras'];

										$customPricing = $row_send_to_amelia['customPricing'];
										$maxExtraPeople = $row_send_to_amelia['maxExtraPeople'];
										$limitPerCustomer = $row_send_to_amelia['limitPerCustomer'];
		
		
														// Select Table: willOnHairTableServices and isnert records coming from table: wp_amelia_services
														$conn = mysqli_connect($sname, $uname, $password, $db_name);
														$qry = "SELECT * FROM willOnHairTableServices WHERE ameliaCol='$ameliaId'";
														$rowCheck = mysqli_query($conn, $qry);
														if ( mysqli_num_rows($rowCheck) > 0) {
																		
														} else {
																		$qry = "INSERT INTO willOnHairTableServices (`ameliaCol`, `name`, `description`, `color`, 
																		`price`, `status`, `categoryId`, `minCapacity`, `maxCapacity`, `duration`, `timeBefore`, 
																		`timeAfter`, `bringingAnyone`, `priority`, `pictureFullPath`, `pictureThumbPath`, `position`, 
																		`show`, `aggregatedPrice`, `settings`, `recurringCycle`, `recurringSub`, `recurringPayment`, 
																		`translations`, `depositPayment`, `depositPerPerson`, `deposit`, `fullPayment`, `mandatoryExtra`, 
																		`minSelectedExtras`, `customPricing`, `maxExtraPeople`, `limitPerCustomer`) VALUES 
																		('$ameliaId', '$name', '$description', '$color', 
																		'$price', '$status', '$categoryId', '$minCapacity', '$maxCapacity', '$duration', '$timeBefore', 
																		'$timeAfter', '$bringingAnyone', '$priority', '$pictureFullPath', '$pictureThumbPath', '$position', 
																		'$show', '$aggregatedPrice', '$settings', '$recurringCycle', '$recurringSub', '$recurringPayment', 
																		'$translations', '$depositPayment', '$depositPerPerson', '$deposit', '$fullPayment', '$mandatoryExtra', 
																		'$minSelectedExtras', '$customPricing', '$maxExtraPeople', '$limitPerCustomer')";
																						if (mysqli_query($conn, $qry)) {
																						}
		
														}
										}
						}
		
		
						//After receiving data from table: wp_amelia_services, next process to send it to the backend
						$sql_row_table_services = "SELECT * FROM willOnHairTableServices";
						$report_table_services = mysqli_query($conn, $sql_row_table_services);
						if ($report_table_services == TRUE) {
		
										while ($row_table_services = mysqli_fetch_array($report_table_services)) {
		
														// select and store all records of table: willOnHairTableServices in variables
		
										$willOnHairIdServices = $row_table_services['willOnHairCol'];
										$ameliaIdServices = $row_table_services['ameliaCol'];
										
										$id = $row_table_services['id'];
										$nameServices = $row_table_services['name'];
										$descriptionServices = $row_table_services['description'];
										$colorServices = $row_table_services['color'];
										$priceServices = $row_table_services['price'];

										$statusServices = $row_table_services['status'];
										$categoryIdServices = $row_table_services['categoryId'];
										$minCapacityServices = $row_table_services['minCapacity'];
										$maxCapacityServices = $row_table_services['maxCapacity'];
										$durationServices = $row_table_services['duration'];

										$timeBeforeServices = $row_table_services['timeBefore'];
										$timeAfterServices = $row_table_services['timeAfter'];
										$bringingAnyoneServices = $row_table_services['bringingAnyone'];
										$priorityServices = $row_table_services['priority'];
										$pictureFullPathServices = $row_table_services['pictureFullPath'];

										$pictureThumbPathServices = $row_table_services['pictureThumbPath'];
										$positionServices = $row_table_services['position'];
										$showServices = $row_table_services['show'];
										$aggregatedPriceServices = $row_table_services['aggregatedPrice'];
										$settingsServices = $row_table_services['settings'];

										$recurringCycleServices = $row_table_services['recurringCycle'];
										$recurringSubServices = $row_table_services['recurringSub'];
										$recurringPaymentServices = $row_table_services['recurringPayment'];
										$translationsServices = $row_table_services['translations'];
										$depositPaymentServices = $row_table_services['depositPayment'];

										$depositPerPersonServices = $row_table_services['depositPerPerson'];
										$depositServices = $row_table_services['deposit'];
										$fullPaymentServices = $row_table_services['fullPayment'];
										$mandatoryExtraServices = $row_table_services['mandatoryExtra'];
										$minSelectedExtrasServices = $row_table_services['minSelectedExtras'];

										$customPricingServices = $row_table_services['customPricing'];
										$maxExtraPeopleServices = $row_table_services['maxExtraPeople'];
										$limitPerCustomerServices = $row_table_services['limitPerCustomer'];
		
														// we bind fields from the backend with our variables of the Table: willOnHairTableServices in an array
														$postSer = [
															"id" => $willOnHairIdServices,
															"ameliaId" => $ameliaIdServices,
															"name" => $nameServices,
															"description" => $descriptionServices,
															"color" => $colorServices,
															"price" => $priceServices,
															"status" => strtoupper($statusServices),
															"minCapacity" => $minCapacityServices,
															"maxCapacity" => $maxCapacityServices,
															"duration" => $durationServices,
															"timeBefore" => $timeBeforeServices,
															"timeAfter" => $timeAfterServices,
															"bringingAnyone" => $bringingAnyoneServices,
															"priority" => strtoupper($priorityServices),
															"pictureFullPath" => $pictureFullPathServices,
															"pictureThumbPath" => $pictureThumbPathServices,
															"position" => $positionServices,
															"show" => $showServices,
															"aggregatedPrice" => $aggregatedPriceServices,
															"settings" => $settingsServices,
															"recurringCycle" => strtoupper($recurringCycleServices),
															"recurringSub" => strtoupper($recurringSubServices),
															"recurringPayment" => $recurringPaymentServices,
															"translation" => $translationsServices,
															"depositPayment" => strtoupper($depositPaymentServices),
															"depositPerPerson" => $depositPerPersonServices,
															"deposit" => $depositServices,
															"fullPayment" => $fullPaymentServices,
															"mendatoryExtra" => $mandatoryExtraServices,
															"minSelectedExtra" => $minSelectedExtrasServices,
															"customPricing" => $customPricingServices,
															"maxExtraPeople" => $maxExtraPeopleServices,
															"limitPerCustomer" => $limitPerCustomerServices
											];
		
														// request header of our post to the backend
		
														$curl = curl_init();

														curl_setopt_array($curl, array(
														  CURLOPT_URL => "$url/api/v1/categories/services?ameliaCategoryId=$categoryIdServices",
														  CURLOPT_RETURNTRANSFER => true,
														  CURLOPT_ENCODING => '',
														  CURLOPT_MAXREDIRS => 10,
														  CURLOPT_TIMEOUT => 0,
														  CURLOPT_FOLLOWLOCATION => true,
														  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
														  CURLOPT_CUSTOMREQUEST => 'POST',
														  CURLOPT_POSTFIELDS => json_encode($postSer),
														  CURLOPT_HTTPHEADER => array(
															'Content-Type: application/json'
														  ),
														));
														
														$response = curl_exec($curl);
														
														curl_close($curl);
														
										}
						}
		}
		
		//=============get from database and insert in amelia_services ===============
		public function Print_wp_amelia_services_insert($sname, $uname, $password, $db_name, $url)
		{
						$this->sname = $sname;
						$this->uname = $uname;
						$this->password = $password;
						$this->db_name = $db_name;
						$this->url = $url;
		
						// we creat a connection
						$conn = mysqli_connect($sname, $uname, $password, $db_name);
		
						// request header of our get from the backend
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
														'Content-description: application/json'
										),
						)
						);
		
						$response = curl_exec($curl);
						$result = json_decode($response, true); // here we decode data coming from backend and store it as an array
						curl_close($curl);

		
						// we loop through our array and store eacch into variables
						$i = 0;
						while ($i < count($result)) {
										$willOnHairId = $result[$i]['id'];
										$ameliaId = $result[$i]['ameliaId'];
										
										$name = $result[$i]['name'];
										$description = $result[$i]['description'];
										$color = $result[$i]['color'];
										$price = $result[$i]['price'];
								
										$categoryId = $result[$i]['category']['ameliaId'];
										$status = $result[$i]['status'];
										$minCapacity = $result[$i]['minCapacity'];
										$maxCapacity = $result[$i]['maxCapacity'];
										$duration = $result[$i]['duration'];
										
										$timeBefore = $result[$i]['timeBefore'];	
										$timeAfter = $result[$i]['timeAfter'];
										$bringingAnyone = $result[$i]['bringingAnyone'];
										$priority = $result[$i]['priority'];
										$pictureFullPath = $result[$i]['pictureFullPath'];
										$pictureThumbPath = $result[$i]['pictureThumbPath'];
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
										$mandatoryExtra = $result[$i]['mendatoryExtra'];
										$minSelectedExtras = $result[$i]['minSelectedExtra'];
										$customPricing = $result[$i]['customPricing'];
										$maxExtraPeople = $result[$i]['maxExtraPeople'];
										$limitPerCustomer = $result[$i]['limitPerCustomer'];
		
										//we select all records from table: willOnHairTableServices with the particular key:ameliaCol
										$conn = mysqli_connect($sname, $uname, $password, $db_name);
										$sql_First_get = "SELECT * FROM willOnHairTableServices WHERE ameliaCol=$ameliaId";
										$report_First_get = mysqli_query($conn, $sql_First_get);
		
		
		
										if ($report_First_get == TRUE) {
														// if the above key exist we update the records that concerns the key
														$sql_updat_wilID = "UPDATE `willOnHairTableServices` SET `willOnHairCol`='$willOnHairId' WHERE ameliaCol = '$ameliaId'";
														$report_updat_wilID = mysqli_query($conn, $sql_updat_wilID);
														if (mysqli_query($conn, $report_updat_wilID)) {
														}
										} else {
														//if the above key does not exist we insert a new record of the non existing key
														$insert_First_get = "INSERT INTO willOnHairTableServices(`willOnHairCol`, `ameliaCol`,`name`, `description`, `color`, 
																		`price`, `status`, `categoryId`, `minCapacity`, `maxCapacity`, `duration`, `timeBefore`, 
																		`timeAfter`, `bringingAnyone`, `priority`, `pictureFullPath`, `pictureThumbPath`, `position`, 
																		`show`, `aggregatedPrice`, `settings`, `recurringCycle`, `recurringSub`, `recurringPayment`, 
																		`translations`, `depositPayment`, `depositPerPerson`, `deposit`, `fullPayment`, `mandatoryExtra`, 
																		`minSelectedExtras`, `customPricing`, `maxExtraPeople`, `limitPerCustomer`) 
																		VALUES ('$willOnHairId', '$ameliaId', '$name', '$description', '$color', 
																		'$price', '$status', '$categoryId', '$minCapacity', '$maxCapacity', '$duration', '$timeBefore', 
																		'$timeAfter', '$bringingAnyone', '$priority', '$pictureFullPath', '$pictureThumbPath', '$position', 
																		'$show', '$aggregatedPrice', '$settings', '$recurringCycle', '$recurringSub', '$recurringPayment', 
																		'$translation', '$depositPayment', '$depositPerPerson', '$deposit', '$fullPayment', '$mandatoryExtra', 
																		'$minSelectedExtras', '$customPricing', '$maxExtraPeople', '$limitPerCustomer')";
														if (mysqli_query($conn, $insert_First_get)) {
														}
										}
		
		
		
		
										$i++;
						}

		
						// we select table: willOnHairTableServices for the process of 
						//generating amelia ids for the records coming from the backend by 
						//inserting them into the table: wp_amelia_services
						$conn = mysqli_connect($sname, $uname, $password, $db_name);
						$sql_send_to_amelia = "SELECT * FROM willOnHairTableServices";
						$report_send_to_amelia = mysqli_query($conn, $sql_send_to_amelia);
		
						if (mysqli_num_rows($report_send_to_amelia) > 0) {
										while ($row_send_to_amelia = mysqli_fetch_array($report_send_to_amelia)) {
														// we store all its records into variables
														$willOnHairIdSend = $row_send_to_amelia['willOnHairCol'];
														$ameliaIdSend  = $row_send_to_amelia['ameliaCol'];
														$idSend = $row_send_to_amelia['id'];
														$nameSend  = $row_send_to_amelia['name'];
														$descriptionSend  = $row_send_to_amelia['description'];
														$colorSend  = $row_send_to_amelia['color'];
														$priceSend  = $row_send_to_amelia['price'];
														
														$statusSend  = $row_send_to_amelia['status'];
														$categoryIdSend  = $row_send_to_amelia['categoryId'];
														$minCapacitySend  = $row_send_to_amelia['minCapacity'];
														$maxCapacitySend  = $row_send_to_amelia['maxCapacity'];
														$durationSend  = $row_send_to_amelia['duration'];
														
														$timeBeforeSend  = $row_send_to_amelia['timeBefore'];
														$timeAfterSend  = $row_send_to_amelia['timeAfter'];
														$bringingAnyoneSend  = $row_send_to_amelia['bringingAnyone'];
														$prioritySend  = $row_send_to_amelia['priority'];
														$pictureFullPathSend  = $row_send_to_amelia['pictureFullPath'];
														
														$pictureThumbPathSend  = $row_send_to_amelia['pictureThumbPath'];
														$positionSend  = $row_send_to_amelia['position'];
														$showSend  = $row_send_to_amelia['show'];
														$aggregatedPriceSend  = $row_send_to_amelia['aggregatedPrice'];
														$settingsSend  = $row_send_to_amelia['settings'];
														
														$recurringCycleSend  = $row_send_to_amelia['recurringCycle'];
														$recurringSubSend  = $row_send_to_amelia['recurringSub'];
														$recurringPaymentSend  = $row_send_to_amelia['recurringPayment'];
														$translationsSend  = $row_send_to_amelia['translations'];
														$depositPaymentSend  = $row_send_to_amelia['depositPayment'];
														
														$depositPerPersonSend  = $row_send_to_amelia['depositPerPerson'];
														$depositSend  = $row_send_to_amelia['deposit'];
														$fullPaymentSend  = $row_send_to_amelia['fullPayment'];
														$mandatoryExtraSend  = $row_send_to_amelia['mandatoryExtra'];
														$minSelectedExtrasSend  = $row_send_to_amelia['minSelectedExtras'];
														
														$customPricingSend  = $row_send_to_amelia['customPricing'];
														$maxExtraPeopleSend  = $row_send_to_amelia['maxExtraPeople'];
														$limitPerCustomerSend = $row_send_to_amelia['limitPerCustomer'];
														
														
														
		
		
														// check the record ameliaId if null or equal to 0 we insert the whole record into tablle:wp_amelia_services
														if ($ameliaIdSend == NULL || $ameliaIdSend == 0) {

																		$send_to_amelia_category = "INSERT INTO wp_amelia_services (`name`, `description`, `color`, 
																		`price`, `status`, `categoryId`, `minCapacity`, `maxCapacity`, `duration`, `timeBefore`, 
																		`timeAfter`, `bringingAnyone`, `priority`, `pictureFullPath`, `pictureThumbPath`, `position`, 
																		`show`, `aggregatedPrice`, `settings`, `recurringCycle`, `recurringSub`, `recurringPayment`, 
																		`translations`, `depositPayment`, `depositPerPerson`, `deposit`, `fullPayment`, `mandatoryExtra`, 
																		`minSelectedExtras`, `customPricing`, `maxExtraPeople`, `limitPerCustomer`) 
																		VALUES ('$nameSend ', '$descriptionSend ', '$colorSend', 
																		'$priceSend', '$statusSend', '$categoryIdSend', '$minCapacitySend', '$maxCapacitySend', '$durationSend', '$timeBeforeSend', 
																		'$timeAfterSend', '$bringingAnyoneSend', '$prioritySend', '$pictureFullPathSend', '$pictureThumbPathSend', '$idSend', 
																		'$showSend', '$aggregatedPriceSend', '$settingsSend', '$recurringCycleSend', '$recurringSubSend', '$recurringPaymentSend', 
																		'$translationsSend', '$depositPaymentSend', '$depositPerPersonSend', '$depositSend', '$fullPaymentSend', '$mandatoryExtraSend', 
																		'$minSelectedExtrasSend', '$customPricingSend', '$maxExtraPeopleSend', '$limitPerCustomerSend')";
																		if (mysqli_query($conn, $send_to_amelia_category)) {

																				
																						//during each insert of each records form the while loop and the above 
																						//contion we collect the last id that was inserted into the table:wp_amelia_services so as to
																						//up the column: ameliaCol in th Table: willOnHairTableServices
																						$last_id = mysqli_insert_id($conn);
																						if ($last_id == TRUE) {

																										$willOnHairTableServices_updateTable = "UPDATE `willOnHairTableServices` SET `ameliaCol`='$last_id' WHERE willOnHairCol = '$willOnHairIdSend'";
		
																										if (mysqli_query($conn, $willOnHairTableServices_updateTable)) {
																														$sql_second_post = "SELECT * FROM willOnHairTableServices WHERE willOnHairCol = '$willOnHairIdSend'";
																														$report_second_post = mysqli_query($conn, $sql_second_post);
		
																														if ($row_table_services = mysqli_fetch_array($report_second_post)) {
																																$willOnHairIdS = $row_table_services['willOnHairCol'];
																																$ameliaIdS = $row_table_services['ameliaCol'];
																																$id = $row_table_services['id'];
																																$nameS = $row_table_services['name'];
																																$descriptionS = $row_table_services['description'];
																																$colorS = $row_table_services['color'];
																																$priceS = $row_table_services['price'];
																				
																																$statusS = $row_table_services['status'];
																																$categoryIdS = $row_table_services['categoryId'];
																																$minCapacityS = $row_table_services['minCapacity'];
																																$maxCapacityS = $row_table_services['maxCapacity'];
																																$durationS = $row_table_services['duration'];
																				
																																$timeBeforeS = $row_table_services['timeBefore'];
																																$timeAfter = $row_table_services['timeAfter'];
																																$bringingAnyoneS = $row_table_services['bringingAnyone'];
																																$priorityS = $row_table_services['priority'];
																																$pictureFullPathS = $row_table_services['pictureFullPath'];
																				
																																$pictureThumbPathS = $row_table_services['pictureThumbPath'];
																																$positionS = $row_table_services['position'];
																																$showS = $row_table_services['show'];
																																$aggregatedPriceS = $row_table_services['aggregatedPrice'];
																																$settingsS = $row_table_services['settings'];
																				
																																$recurringCycleS = $row_table_services['recurringCycle'];
																																$recurringSubS = $row_table_services['recurringSub'];
																																$recurringPaymentS = $row_table_services['recurringPayment'];
																																$translationsS = $row_table_services['translations'];
																																$depositPaymentS = $row_table_services['depositPayment'];
																				
																																$depositPerPersonS = $row_table_services['depositPerPerson'];
																																$depositS = $row_table_services['deposit'];
																																$fullPaymentS = $row_table_services['fullPayment'];
																																$mandatoryExtraS = $row_table_services['mandatoryExtra'];
																																$minSelectedExtrasS = $row_table_services['minSelectedExtras'];
																				
																																$customPricingS = $row_table_services['customPricing'];
																																$maxExtraPeopleS = $row_table_services['maxExtraPeople'];
																																$limitPerCustomerS = $row_table_services['limitPerCustomer'];
		
																																		//After the column: ameliaCol in th Table: willOnHairTableServices is up to date
																																		// we send the updated table:willOnHairTableServices to the backend
																																		$secondServicePost= [
																																										
																																									
																																	"id" => $willOnHairIdS,
																																	"ameliaId" => $ameliaIdS,
																																	"name" => $nameS,
																																	"description" => $descriptionS,
																																	"color" => $colorS,
																																	"price" => $priceS,
																																	"status" => strtoupper($statusS),
																																	"minCapacity" => $minCapacityS,
																																	"maxCapacity" => $maxCapacityS,
																																	"duration" => $durationS,
																																	"timeBefore" => $timeBeforeS,
																																	"timeAfter" => $timeAfterS,
																																	"bringingAnyone" => $bringingAnyoneS,
																																	"priority" => strtoupper($priorityS),
																																	"pictureFullPath" => $pictureFullPathS,
																																	"pictureThumbPath" => $pictureThumbPathS,
																																	"position" => $positionS,
																																	"show" => $showS,
																																	"aggregatedPrice" => $aggregatedPriceS,
																																	"settings" => $settingsS,
																																	"recurringCycle" => strtoupper($recurringCycleS),
																																	"recurringSub" => strtoupper($recurringSubS),
																																	"recurringPayment" => $recurringPaymentS,
																																	"translation" => $translationsS,
																																	"depositPayment" => strtoupper($depositPaymentS),
																																	"depositPerPerson" => $depositPerPersonS,
																																	"deposit" => $depositS,
																																	"fullPayment" => $fullPaymentS,
																																	"mendatoryExtra" => $mandatoryExtraS,
																																	"minSelectedExtra" => $minSelectedExtrasS,
																																	"customPricing" => $customPricingS,
																																	"maxExtraPeople" => $maxExtraPeopleS,
																																	"limitPerCustomer" => $limitPerCustomerS
																																];
																																$curl = curl_init();

														curl_setopt_array($curl, array(
														  CURLOPT_URL => "$url/api/v1/categories/services?ameliaCategoryId=$categoryIdS",
														  CURLOPT_RETURNTRANSFER => true,
														  CURLOPT_ENCODING => '',
														  CURLOPT_MAXREDIRS => 10,
														  CURLOPT_TIMEOUT => 0,
														  CURLOPT_FOLLOWLOCATION => true,
														  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
														  CURLOPT_CUSTOMREQUEST => 'POST',
														  CURLOPT_POSTFIELDS => json_encode($secondServicePost),
														  CURLOPT_HTTPHEADER => array(
															'Content-Type: application/json'
														  ),
														));
														
														$response = curl_exec($curl);
														
														curl_close($curl);
																														}
																										}
																						}
																		}
														}
										}
						}
		
		
		
						// we display the final results of the table: wp_amelia_services 
						//which now contains a sync data of wp_amelia_services and the backend 
						$sql_table_service="SELECT * FROM wp_amelia_services";
						$report_table_service=mysqli_query($conn,$sql_table_service);
						if($report_table_service== TRUE){ 
						echo "TABLE NAME: wp_amelia_services";
						echo "<table border='5'>";
						echo "<tr>
						<th>id</th>
						<th>name</th>   <th>description</th>  <th>color</th>  
						<th>price</th>   <th>categoryId</th>  <th>minCapacity</th> 
						<th>maxCapacity</th>  <th>duration</th>  <th>timeBefore</th>   <th>timeAfter</th>  
						<th>description</th>   <th>pictureFullPath</th>  <th>pictureThumbPath</th> 
						<th>password</th>  <th>position</th>  <th>show</th>  <th>aggregatedPrice</th> 
						<th>settings</th>  <th>recurringCycle</th></tr>";
		
						while($row_services=mysqli_fetch_array($report_table_service) )
						{
		
						
										echo "<td>";									
										echo$row_services['id'];
										echo "</td><td>";
										echo$row_services['name'];
										echo "</td><td>";
										echo$row_services['description'];
										echo "</td><td>";									
										echo$row_services['color'];
										echo "</td><td>";
										echo$row_services['price'];
										echo "</td><td>";
										echo$row_services['categoryId'];
										echo "</td><td>";
										echo$row_services['minCapacity'];
										echo "</td><td>";									
										echo$row_services['maxCapacity'];
										echo "</td><td>";									
										echo$row_services['duration'];
										echo "</td><td>";									
										echo$row_services['timeBefore'];
										echo "</td><td>";
										echo$row_services['timeAfter'];
										echo "</td><td>";
										echo$row_services['description'];
										echo "</td><td>";									
										echo$row_services['pictureFullPath'];
										echo "</td><td>";
										echo$row_services['pictureThumbPath'];
										echo "</td><td>";
										echo$row_services['password'];
										echo "</td><td>";
										echo$row_services['position'];
										echo "</td><td>";									
										echo$row_services['show'];
										echo "</td><td>";									
										echo$row_services['aggregatedPrice'];
										echo "</td><td>";									
										echo$row_services['settings'];
										echo "</td><td>";									
										echo$row_services['recurringCycle'];
										echo "</td></tr>";
		
						
		}
		echo"</table>";
		
		}
						// $query = "DROP table willOnHairTableServices";
						// if (mysqli_multi_query($conn, $query)) {
						// }
		}



	//providers_to_services get and post
		//============= post to database ======================
		public function Print_wp_amelia_providers_to_services_post($sname,$uname,$password,$db_name, $url){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
			$this->url =$url;
			
			
				  
				  //connect to database
				  $conn = mysqli_connect($sname, $uname, $password, $db_name);
				  
				  //Create New Table for providers_to_services sync
				  $sqlCreate = "CREATE TABLE willOnHairTableProviderToServices(
					`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
					`willOnHairCol` INT NOT NULL DEFAULT 0,
					`ameliaCol` INT NOT NULL,
					`userId` int(11) NOT NULL,
					`serviceId` int(11) NOT NULL,
					`price` double NOT NULL,
					`minCapacity` int(11) NOT NULL,
					`maxCapacity` int(11) NOT NULL,
					`customPricing` text DEFAULT NULL
				  )";
				  
					$report_sqlCreate=mysqli_query($conn,$sqlCreate);
				  //Verify if Table has been created
					if ($report_sqlCreate === TRUE) {
					}
		
					// Select and collect data from table: wp_amelia_providers_to_services
					$sql_send_to_amelia="SELECT * FROM wp_amelia_providers_to_services";
					$report_send_to_amelia=mysqli_query($conn,$sql_send_to_amelia);
		
					if($report_send_to_amelia== TRUE){ 
		
		
					while($row_send_to_amelia=mysqli_fetch_array($report_send_to_amelia))
					{
					  // store each data from table: wp_amelia_providers_to_services in variables
						$ameliaId = $row_send_to_amelia['id'];
		
						$userId = $row_send_to_amelia['userId'];	
						$serviceId = $row_send_to_amelia['serviceId'];
		
						$price = $row_send_to_amelia['price'];
						$minCapacity = $row_send_to_amelia['minCapacity'];
	  
						$maxCapacity = $row_send_to_amelia['maxCapacity'];
						$customPricing = $row_send_to_amelia['customPricing'];
				
				
		
						// Select Table: willOnHairTableProviderToServices and isnert records coming from table: wp_amelia_providers_to_services
						$conn = mysqli_connect($sname, $uname, $password, $db_name);
						  $qry="SELECT * FROM willOnHairTableProviderToServices WHERE ameliaCol='$ameliaId'";
						  $rowCheck=mysqli_query($conn,$qry);
						  if (mysqli_num_rows($rowCheck) > 0) { 
							
							  
							} else{
							$qry = "INSERT INTO willOnHairTableProviderToServices (`ameliaCol`, `userId`, `serviceId`, `price`, `minCapacity`, `maxCapacity`, `customPricing`)
							VALUES ('$ameliaId','$userId', '$serviceId', '$price','$minCapacity', '$maxCapacity','$customPricing')"; 
							if (mysqli_query($conn,$qry)){ 
							
							}  
						}
					}
				  }
			
		
				  //After receiving data from table: wp_amelia_providers_to_services, next process to send it to the backend
					  $sql_table3="SELECT * FROM willOnHairTableProviderToServices";
					  $report_table3=mysqli_query($conn,$sql_table3);
					  if($report_table3== TRUE ){ 
			
					  while($row_table3=mysqli_fetch_array($report_table3) )
					  {
					
						// select and store all records of table: willOnHairTableProviderToServices in variables
		
						$willOnHairId = $row_table3['willOnHairCol'];
						$ameliaId = $row_table3['ameliaCol'];
						$userIdC = $row_table3['userId'];
						$serviceIdC = $row_table3['serviceId'];
						$priceC = $row_table3['price'];
						$minCapacityC = $row_table3['minCapacity'];
						$maxCapacityC = $row_table3['maxCapacity'];
						$customPricingC = $row_table3['customPricing'];
			
						// we bind fields from the backend with our variables of the Table: willOnHairTableProviderToServices in an array
						$postProviderServices = [ 
						  "id" => $willOnHairId,
						  "ameliaId" => $ameliaId,
						  "price" => $priceC,
						  "minCapacity" => $minCapacityC,
						  "maxCapacity" => $maxCapacityC,
						  "customPricing" => $customPricingC
					  ];
		
					  // request header of our post to the backend
	  
					  $curl = curl_init();
	  
					  curl_setopt_array($curl, array(
						CURLOPT_URL => "$url/api/v1/amelia/services/$serviceIdC/providers?userId=$userIdC",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'POST',
						CURLOPT_POSTFIELDS => json_encode($postProviderServices),
						CURLOPT_HTTPHEADER => array(
						  'Content-Type: application/json'
						),
					  ));
					  
					  $response = curl_exec($curl);
					  
					  curl_close($curl);
		
					}
		
							  
			  }
		  }
		  
		  //=============get from database and insert in amelia_providers_to_services ===============
		  public function Print_wp_amelia_providers_to_services_insert($sname,$uname,$password,$db_name, $url){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
			$this->url =$url;
		  
		// we creat a connection
		  $conn = mysqli_connect($sname, $uname, $password, $db_name);			
		
		  // request header of our get from the backend
		  $curl = curl_init();
		  curl_setopt_array($curl, array(
			CURLOPT_URL => "$url/api/v1/services/providers",
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
		  $result = json_decode($response, true); // here we decode data coming from backend and store it as an array
		  curl_close($curl);
		  
		  // we loop through our array and store eacch into variables
		  $i = 0;
		  while($i < count($result)) {
		  $willOnHairId = $result[$i]['id'];	
		  $ameliaId = $result[$i]['ameliaId'];	
		  $userId = $result[$i]['user']['ameliaId'];
		  $serviceId = $result[$i]['service']['ameliaId'];
		  $price = $result[$i]['price'];
		  $minCapacity = $result[$i]['minCapacity'];
		  $maxCapacity = $result[$i]['price'];
		  $customPricing = $result[$i]['minCapacity'];
		  
		  //we select all records from table: willOnHairTableProviderToServices with the particular key:ameliaCol
		  $conn = mysqli_connect($sname, $uname, $password, $db_name);			
		  $sql_First_get="SELECT * FROM willOnHairTableProviderToServices WHERE ameliaCol=$ameliaId";
		  $report_First_get=mysqli_query($conn,$sql_First_get);
		  
		
		  
		  if($report_First_get == TRUE){ 
			// if the above key exist we update the records that concerns the key
				$sql_updat_wilID="UPDATE `willOnHairTableProviderToServices` SET `willOnHairCol`='$willOnHairId' WHERE ameliaCol = '$ameliaId'";
				$report_updat_wilID=mysqli_query($conn,$sql_updat_wilID);
				if (mysqli_query($conn,$report_updat_wilID)){ 
				
				}  
			  
			} else{
			  //if the above key does not exist we insert a new record of the non existing key
			  $insert_First_get = "INSERT INTO willOnHairTableProviderToServices(`willOnHairCol`, `ameliaCol`, `userId`, `serviceId`, `price`, `minCapacity`, `maxCapacity`, `customPricing`) 
			  VALUES ('$willOnHairId', '$ameliaId', '$userId','$serviceId','$price','$minCapacity','$maxCapacity','$customPricing')"; 
				if (mysqli_query($conn,$insert_First_get)){ 
				}  
			}
		  
		  
		  
		  
		  $i++;
		  }
		  
		  // we select table: willOnHairTableProviderToServices for the process of 
		  //generating amelia ids for the records coming from the backend by 
		  //inserting them into the table: wp_amelia_providers_to_services
		  $conn = mysqli_connect($sname, $uname, $password, $db_name);			
		  $sql_send_to_amelia="SELECT * FROM willOnHairTableProviderToServices";
		  $report_send_to_amelia=mysqli_query($conn,$sql_send_to_amelia);
		
		  if($report_send_to_amelia== TRUE ){ 
		  while($row_send_to_amelia=mysqli_fetch_array($report_send_to_amelia))
		  {
			  // we store all its records into variables
			  $id = $row_send_to_amelia['id'];
			  $willOnHairId = $row_send_to_amelia['willOnHairCol'];	
			  $ameliaId = $row_send_to_amelia['ameliaCol'];
		
			  $userId = $row_send_to_amelia['userId'];	
			  $serviceId = $row_send_to_amelia['serviceId'];
		
			  $price = $row_send_to_amelia['price'];
			  $minCapacity = $row_send_to_amelia['minCapacity'];
	  
			  $maxCapacity = $row_send_to_amelia['price'];
			  $customPricing = $row_send_to_amelia['minCapacity'];
		
		  
			// check the record ameliaId if null or equal to 0 we insert the whole record into tablle:wp_amelia_providers_to_services
			if($ameliaId == NULL || $ameliaId == 0){ 
			  $send_to_amelia_category = "INSERT INTO wp_amelia_providers_to_services(`userId`, `serviceId`, `price`, `minCapacity`, `maxCapacity`, `customPricing`) 
			  VALUES ('$userId','$serviceId','$price','$minCapacity','$maxCapacity','$customPricing')"; 
			  if (mysqli_query($conn,$send_to_amelia_category)){ 
		
				//during each insert of each records form the while loop and the above 
				//contion we collect the last id that was inserted into the table:wp_amelia_providers_to_services so as to
				//up the column: ameliaCol in th Table: willOnHairTableProviderToServices
			  $last_id = mysqli_insert_id($conn);
			  if( $last_id ==TRUE ){
				  $willOnHairTableProviderToServices_updateTable	= "UPDATE `willOnHairTableProviderToServices` SET `ameliaCol`='$last_id' WHERE willOnHairCol = '$willOnHairId'";
		
				  if (mysqli_query($conn,$willOnHairTableProviderToServices_updateTable)){
				  $sql_second_post="SELECT * FROM willOnHairTableProviderToServices WHERE willOnHairCol = '$willOnHairId'";
				  $report_second_post=mysqli_query($conn,$sql_second_post);
			
				  if($row_second_post=mysqli_fetch_array($report_second_post)){ 
		
					$ameliaId_send = $row_second_post['ameliaCol'];
		  
					$userId_send = $row_second_post['userId'];	
					$serviceId_send = $row_second_post['serviceId'];
		  
					$price_send = $row_second_post['price'];
					$minCapacity_send = $row_second_post['minCapacity'];
		
					$maxCapacity_send = $row_second_post['maxCapacity'];
					$customPricing_send = $row_second_post['customPricing'];
	  
				  //After the column: ameliaCol in th Table: willOnHairTableProviderToServices is up to date
				  // we send the updated table:willOnHairTableProviderToServices to the backend
				  $secondPostProviderServices = [ 
					"id" => $willOnHairId,
					"ameliaId" => $ameliaId_send,
					"price" => $price_send,
					"minCapacity" => $minCapacity_send,
					"maxCapacity" => $maxCapacity_send,
					"customPricing" => $customPricing_send
				];
		
				  $curl = curl_init();
				  curl_setopt_array($curl, array(
					CURLOPT_URL => "$url/api/v1/amelia/services/$serviceId_send/providers?userId=$userId_send",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => json_encode($secondPostProviderServices),
					CURLOPT_HTTPHEADER => array(
					  'Content-Type: application/json'
					),
				  ));
				  
				  $response = curl_exec($curl);
				  
				  curl_close($curl);
				  echo $response;
		
				  }
		
		
			  }
			  
		
			  }
			  
			  }  
		
		
			}
			
			}
		  }
		
		
		  // $query = "DROP table willOnHairTableProviderToServices";
		  // if (mysqli_multi_query($conn, $query)) {
		  //   echo "Dropped Successfully";
		  // } else {
		  //   echo "Error:" . mysqli_error($conn);
		  // }	
		  
		  // we display the final results of the table: wp_amelia_providers_to_services 
		  //which now contains a sync data of wp_amelia_providers_to_services and the backend 
		  $sql_table3="SELECT * FROM wp_amelia_providers_to_services";
		  $report_table3=mysqli_query($conn,$sql_table3);
		  if($report_table3== TRUE){ 
		  echo "TABLE serviceId: wp_amelia_providers_to_services";
		  echo "<table border='5'>";
		  echo "<tr><th>id</th>
		  <th>userId</th><th>serviceId</th><th>price</th>
		  <th>minCapacity</th><th>maxCapacity</th><th>customPricing</th></tr>";
		  
		  while($row_table3=mysqli_fetch_array($report_table3) )
		  {
		  
		  
			echo "<tr><td>";									
			echo$row_table3['id'];
			echo "</td><td>";
			echo$row_table3['userId'];
			echo "</td><td>";
			echo$row_table3['serviceId'];
			echo "</td><td>";
			echo$row_table3['price'];
			echo "</td><td>";									
			echo$row_table3['minCapacity'];
			echo "</td><td>";									
			echo$row_table3['maxCapacity'];
			echo "</td><td>";									
			echo$row_table3['customPricing'];
			echo "</td></tr>";
			echo"<tr></tr>";
			echo"<tr></tr>";
			echo"<tr></tr>";
		  
		  }
		  echo"</table>";
		  
		  }
		  
		  }




		//Locations get and post
		//============= post to database ======================
		public function Print_wp_amelia_appointments_post($sname, $uname, $password, $db_name, $url)
		{
		  $this->sname = $sname;
		  $this->uname = $uname;
		  $this->password = $password;
		  $this->db_name = $db_name;
		  $this->url = $url;
	  
	  
	  
		  //connect to database
		  $conn = mysqli_connect($sname, $uname, $password, $db_name);
	  
		  //Create New Table for categories sync
		  $sqlCreate = "CREATE TABLE willOnHairTableAppointments(
			  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			  `willOnHairCol` INT NOT NULL DEFAULT 0,
			  `ameliaCol` INT NOT NULL,
			  `status` enum('approved','pending','canceled','rejected') DEFAULT NULL,
			  `bookingStart` datetime NOT NULL,
			  `bookingEnd` datetime NOT NULL,
			  `notifyParticipants` tinyint(1) NOT NULL,
			  `serviceId` int NOT NULL,
			  `packageId` int DEFAULT NULL,
			  `providerId` int NOT NULL,
			  `locationId` int DEFAULT NULL,
			  `internalNotes` text DEFAULT NULL,
			  `googleCalendarEventId` varchar(255) DEFAULT NULL,
			  `googleMeetUrl` varchar(255) DEFAULT NULL,
			  `outlookCalendarEventId` varchar(255) DEFAULT NULL,
			  `zoomMeeting` text DEFAULT NULL,
			  `lessonSpace` text DEFAULT NULL,
			  `parentId` int DEFAULT NULL
				  )";
	  
		  $report_sqlCreate = mysqli_query($conn, $sqlCreate);
		  //Verify if Table has been created
		  if ($report_sqlCreate === TRUE) {
		  }
	  
		  // Select and collect data from table: wp_amelia_locations
		  $sql_send_to_amelia = "SELECT * FROM wp_amelia_appointments";
		  $report_send_to_amelia = mysqli_query($conn, $sql_send_to_amelia);
	  
		  if ($report_send_to_amelia == TRUE) {
	  
	  
			while ($row_send_to_amelia = mysqli_fetch_array($report_send_to_amelia)) {
			  // store each data from table: wp_amelia_locations in variables
			  $ameliaId = $row_send_to_amelia['id'];
	  
			  $status = $row_send_to_amelia['status'];
			  $bookingStart = $row_send_to_amelia['bookingStart'];
			  $bookingEnd = $row_send_to_amelia['bookingEnd'];
			  $notifyParticipants = $row_send_to_amelia['notifyParticipants'];
	
	
			  $serviceId = $row_send_to_amelia['serviceId'];
			  $packageId = $row_send_to_amelia['packageId'];
			  $providerId = $row_send_to_amelia['providerId'];
			  $locationId = $row_send_to_amelia['locationId'];
			  $internalNotes = $row_send_to_amelia['pictureThumbPath'];
	
			  $googleCalendarEventId = $row_send_to_amelia['googleCalendarEventId'];
			  $googleMeetUrl = $row_send_to_amelia['googleMeetUrl'];
			  $outlookCalendarEventId = $row_send_to_amelia['outlookCalendarEventId'];
			  $zoomMeeting = $row_send_to_amelia['zoomMeeting'];          
			  $lessonSpace = $row_send_to_amelia['lessonSpace'];
			  $parentId = $row_send_to_amelia['parentId'];
			  
	  
			  // Select Table: willOnHairTableAppointments and isnert records coming from table: wp_amelia_locations
			  $conn = mysqli_connect($sname, $uname, $password, $db_name);
			  $qry = "SELECT * FROM willOnHairTableAppointments WHERE ameliaCol='$ameliaId'";
			  $rowCheck = mysqli_query($conn, $qry);
			  if ( mysqli_num_rows($rowCheck) > 0) {
				
			  } else {
				$qry = "INSERT INTO willOnHairTableAppointments (`ameliaCol`, `status`, `bookingStart`, 
				`bookingEnd`, `notifyParticipants`, `serviceId`, `packageId`, `providerId`, `locationId`, `internalNotes`, 
				`googleCalendarEventId`, `googleMeetUrl`, `outlookCalendarEventId`, `zoomMeeting`, `lessonSpace`, `parentId`)  
				VALUES ('$ameliaId','$status', '$bookingStart',
				 '$bookingEnd','$notifyParticipants', '$serviceId','$packageId', '$providerId', '$locationId','$internalNotes',
				 '$googleCalendarEventId','$googleMeetUrl','$outlookCalendarEventId','$zoomMeeting','$lessonSpace','$parentId')";
				  if (mysqli_query($conn, $qry)) {
				  }
	  
			  }
			}
		  }
	  
	  
		  //After receiving data from table: wp_amelia_locations, next process to send it to the backend
		  $sql_table3 = "SELECT * FROM willOnHairTableAppointments";
		  $report_table3 = mysqli_query($conn, $sql_table3);
		  if ($report_table3 == TRUE) {
	  
			while ($row_table3 = mysqli_fetch_array($report_table3)) {
	  
			  // select and store all records of table: willOnHairTableAppointments in variables
	  
			$willOnHairId = $row_table3['willOnHairCol'];
			$ameliaId = $row_table3['ameliaCol'];
	
			$statusC = $row_table3['status'];
			$bookingStartC = $row_table3['bookingStart'];
			$bookingEndC = $row_table3['bookingEnd'];
			$notifyParticipantsC = $row_table3['notifyParticipants'];
	  
			$internalNotesC = $row_table3['internalNotes'];
			$googleCalendarEventIdC = $row_table3['googleCalendarEventId'];
			$googleMeetUrlC = $row_table3['googleMeetUrl']; 
	
	  
			$outlookCalendarEventIdC = $row_table3['outlookCalendarEventId'];
			$zoomMeetingC = $row_table3['zoomMeeting'];
			$lessonSpaceC = $row_table3['lessonSpace'];
	
	
			$parentIdC = $row_table3['parentId'];
			$serviceIdC = $row_table3['serviceId'];
			$packageIdC = $row_table3['packageId'];
			$providerIdC = $row_table3['providerId'];
			$locationIdC = $row_table3['locationId'];
	
	
	
			$date = date('d-m-y h:i:s');
	
			  // we bind fields from the backend with our variables of the Table: willOnHairTableAppointments in an array
			  $postApp = [
											  "id" => $willOnHairId,
											  "ameliaId" => $ameliaId,
											  "status"=> strtoupper($statusC),
											  "bookingStart"=> $bookingStartC,
											  "bookingEnd"=> $bookingEndC,
											  "notifyParticipants"=> $notifyParticipantsC,
											  "packageId" => $packageIdC,
											  "internalNotes"=> $internalNotesC,
											  "googleCalendarEventId"=> $googleCalendarEventIdC,
											  "googleMeetUrl"=> $googleMeetUrlC,
											  "outlookCalendarEventId"=> $outlookCalendarEventIdC,
											  "zoomMeeting"=> $zoomMeetingC,
											  "lessonSpace"=> $lessonSpaceC,
											];
	  
			  // request header of our post to the backend
	  
			  $curl = curl_init();
	  
			  curl_setopt_array($curl, array(
				CURLOPT_URL => "$url/api/v1/employees/$providerIdC/appointments/amelia?locationId=$locationIdC&servicesId=$serviceIdC",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => json_encode($postApp),
				//here we convert our array to a json format
				CURLOPT_HTTPHEADER => array(
				  'Content-Type: application/json'
				),
			  )
			  );
	  
			  $response = curl_exec($curl);
	  
			  curl_close($curl);
			//   echo "<br>1st POST<br> --------- $response ----------- <br>";

			}
		  }
		}
	  
		//=============get from database and insert in amelia_locations ===============
		public function Print_wp_amelia_appointments_insert($sname, $uname, $password, $db_name, $url)
		{
		  $this->sname = $sname;
		  $this->uname = $uname;
		  $this->password = $password;
		  $this->db_name = $db_name;
		  $this->url = $url;
	  
		  // we creat a connection
		  $conn = mysqli_connect($sname, $uname, $password, $db_name);
	  
		  // request header of our get from the backend
		  $curl = curl_init();
		  curl_setopt_array($curl, array(
			CURLOPT_URL => "$url/api/v1/appointments",
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
		  )
		  );
	  
		  $response = curl_exec($curl);
		  $result = json_decode($response, true); // here we decode data coming from backend and store it as an array
		  curl_close($curl);

		//   echo "<br>Getttt <br> --------- $response ----------- <br>";

	  
		  // we loop through our array and store eacch into variables
		  $i = 0;
		  while ($i < count($result)) {
			$willOnHairId = $result[$i]['id'];
			$ameliaId = $result[$i]['ameliaId'];
			$status = $result[$i]['status'];
			$bookingStart = $result[$i]['bookingStart'];
			$bookingEnd = $result[$i]['bookingEnd'];
	
	  
			$notifyParticipants = $result[$i]['notifyParticipants'];
			$packageId = $result[$i]['packageId'];
			$internalNotes = $result[$i]['internalNotes'];
			$googleCalendarEventId = $result[$i]['googleCalendarEventId'];
	  
			$googleMeetUrl = $result[$i]['googleMeetUrl'];
			$outlookCalendarEventId = $result[$i]['outlookCalendarEventId'];
			$zoomMeeting = $result[$i]['zoomMeeting'];
			$lessonSpace = $result[$i]['lessonSpace'];
	
			$providerId = $result[$i]['employee']['ameliaId'];
			$locationId = $result[$i]['location']['ameliaId'];
			$serviceId = $result[$i]['service']['ameliaId'];
	
	
			//we select all records from table: willOnHairTableAppointments with the particular key:ameliaCol
			$conn = mysqli_connect($sname, $uname, $password, $db_name);
			$sql_First_get = "SELECT * FROM willOnHairTableAppointments WHERE ameliaCol=$ameliaId";
			$report_First_get = mysqli_query($conn, $sql_First_get);
	  
	  
	  
			if ($report_First_get == TRUE) {
			  // if the above key exist we update the records that concerns the key
			  $sql_updat_wilID = "UPDATE `willOnHairTableAppointments` SET `willOnHairCol`='$willOnHairId' WHERE ameliaCol = '$ameliaId'";
			  $report_updat_wilID = mysqli_query($conn, $sql_updat_wilID);
			  if (mysqli_query($conn, $report_updat_wilID)) {
			  }
			} else {
			  //if the above key does not exist we insert a new record of the non existing key
			  $insert_First_get = "INSERT INTO willOnHairTableAppointments(`willOnHairCol`, `ameliaCol`, `status`,`bookingStart`, 
				`bookingEnd`, `notifyParticipants`, `serviceId`, `packageId`, `providerId`, `locationId`, `internalNotes`, 
				`googleCalendarEventId`, `googleMeetUrl`, `outlookCalendarEventId`, `zoomMeeting`, `lessonSpace`, `parentId`) 
				VALUES ('$willOnHairId', '$ameliaId', '$status', '$bookingStart',
				 '$bookingEnd','$notifyParticipants', '$serviceId','$packageId', '$providerId', '$locationId','$internalNotes',
				 '$googleCalendarEventId','$googleMeetUrl','$outlookCalendarEventId','$zoomMeeting','$lessonSpace','$parentId')";
			  if (mysqli_query($conn, $insert_First_get)) {
			  }
			}
	  
	  
	  
	  
			$i++;
		  }
	  
		  // we select table: willOnHairTableAppointments for the process of 
		  //generating amelia ids for the records coming from the backend by 
		  //inserting them into the table: wp_amelia_locations
		  $conn = mysqli_connect($sname, $uname, $password, $db_name);
		  $sql_send_to_amelia = "SELECT * FROM willOnHairTableAppointments";
		  $report_send_to_amelia = mysqli_query($conn, $sql_send_to_amelia);
	  
		  if ($report_send_to_amelia == TRUE) {
			while ($row_send_to_amelia = mysqli_fetch_array($report_send_to_amelia)) {
			  // we store all its records into variables
			  $willOnHairId = $row_send_to_amelia['willOnHairCol'];
			  $ameliaId = $row_send_to_amelia['ameliaCol'];
	  
			  $status = $row_send_to_amelia['status'];
	
			  $bookingStart = $row_send_to_amelia['bookingStart'];
			  $bookingEnd = $row_send_to_amelia['bookingEnd'];
			  $notifyParticipants = $row_send_to_amelia['notifyParticipants'];
		
			  $internalNotes = $row_send_to_amelia['internalNotes'];
			  $googleCalendarEventId = $row_send_to_amelia['googleCalendarEventId'];
			  $googleMeetUrl = $row_send_to_amelia['googleMeetUrl']; 
	  
		
			  $outlookCalendarEventId = $row_send_to_amelia['outlookCalendarEventId'];
			  $zoomMeeting = $row_send_to_amelia['zoomMeeting'];
			  $lessonSpace = $row_send_to_amelia['lessonSpace'];
	  
	  
			  $parentId = $row_send_to_amelia['parentId'];
			  $serviceId = $row_send_to_amelia['serviceId'];
			  $packageId = $row_send_to_amelia['packageId'];
			  $providerId = $row_send_to_amelia['providerId'];
			  $locationId = $row_send_to_amelia['locationId'];
	  
	
			  
	  
			  // check the record ameliaId if null or equal to 0 we insert the whole record into tablle:wp_amelia_locations
			  if ($ameliaId == NULL || $ameliaId == 0) {
				$send_to_amelia_category = "INSERT INTO wp_amelia_appointments (`status`, `bookingStart`, 
				`bookingEnd`, `notifyParticipants`, `serviceId`, `packageId`, `providerId`, `locationId`, `internalNotes`, 
				`googleCalendarEventId`, `googleMeetUrl`, `outlookCalendarEventId`, `zoomMeeting`, `lessonSpace`, `parentId`) 
				VALUES ('$status', '$bookingStart',
				 '$bookingEnd','$notifyParticipants', '$serviceId','$packageId', '$providerId', '$locationId','$internalNotes',
				 '$googleCalendarEventId','$googleMeetUrl','$outlookCalendarEventId','$zoomMeeting','$lessonSpace','$parentId')";
				if (mysqli_query($conn, $send_to_amelia_category)) {
	  
				  //during each insert of each records form the while loop and the above 
				  //contion we collect the last id that was inserted into the table:wp_amelia_locations so as to
				  //up the column: ameliaCol in th Table: willOnHairTableAppointments
				  $last_id = mysqli_insert_id($conn);
				  if ($last_id == TRUE) {
					$willOnHairTableAppointments_updateTable = "UPDATE `willOnHairTableAppointments` SET `ameliaCol`='$last_id' WHERE willOnHairCol = '$willOnHairId'";
	  
					if (mysqli_query($conn, $willOnHairTableAppointments_updateTable)) {
					  $sql_second_post = "SELECT * FROM willOnHairTableAppointments WHERE willOnHairCol = '$willOnHairId'";
					  $report_second_post = mysqli_query($conn, $sql_second_post);
	  
					  if ($row_second_post = mysqli_fetch_array($report_second_post)) {
	  
						$ameliaId_send = $row_second_post['ameliaCol'];
	  
						$status_send = $row_second_post['status'];
	
						$bookingStart_send = $row_second_post['bookingStart'];
						$bookingEnd_send = $row_second_post['bookingEnd'];
						$notifyParticipants_send = $row_second_post['notifyParticipants'];
				  
						$internalNotes_send = $row_second_post['internalNotes'];
						$googleCalendarEventId_send = $row_second_post['googleCalendarEventId'];
						$googleMeetUrl_send = $row_second_post['googleMeetUrl']; 
				
				  
						$outlookCalendarEventId_send = $row_second_post['outlookCalendarEventId'];
						$zoomMeeting_send = $row_second_post['zoomMeeting'];
						$lessonSpace_send = $row_second_post['lessonSpace'];
				
				
						$parentId_send = $row_second_post['parentId'];
						$serviceId_send = $row_second_post['serviceId'];
						$packageId_send = $row_second_post['packageId'];
						$providerId_send = $row_second_post['providerId'];
						$locationId_send = $row_second_post['locationId'];
	
	  
						//After the column: ameliaCol in th Table: willOnHairTableAppointments is up to date
						// we send the updated table:willOnHairTableAppointments to the backend
						$secondPostApp = [
						  "id" => $willOnHairId,
						  "ameliaId" => $ameliaId_send,
						  "status" => strtoupper($status_send),
						  "bookingStart"=> $bookingStart_send,
						  "bookingEnd"=> $bookingEnd_send,
						  "notifyParticipants"=> $notifyParticipants_send,
						  "packageId" => $packageId_send,
						  "internalNotes"=> $internalNotes_send,
						  "googleCalendarEventId"=> $googleCalendarEventId_send,
						  "googleMeetUrl"=> $googleMeetUrl_send,
						  "outlookCalendarEventId"=> $outlookCalendarEventId_send,
						  "zoomMeeting"=> $zoomMeeting_send,
						  "lessonSpace"=> $lessonSpace_send,  
						];
	  
						$curl = curl_init();
	  
						curl_setopt_array($curl, array(
						  CURLOPT_URL => "$url/api/v1/employees/$providerId_send/appointments/amelia?locationId=$locationId_send&servicesId=$serviceId_send",
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 1,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'POST',
						  CURLOPT_POSTFIELDS => json_encode($secondPostApp),
						  CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json'
						  ),
						)
						);
	  
						$response = curl_exec($curl);
	  
						curl_close($curl);
						// echo "<br>2st POST<br> --------- $response ----------- <br>";

					  }
					}
				  }
				}
			  }
			}
		  }
	  
	  
	  
	  
		  // we display the final results of the table: wp_amelia_locations 
		  //which now contains a sync data of wp_amelia_locations and the backend 
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
		  }
	  
		  // $query = "DROP table willOnHairTableAppointments";
		  // if (mysqli_multi_query($conn, $query)) {
		  // }
		}
	


		//Customer Booking get and post
		//============= post to database ======================
		public function Print_wp_amelia_customer_bookings_post($sname, $uname, $password, $db_name, $url)
		{
		  $this->sname = $sname;
		  $this->uname = $uname;
		  $this->password = $password;
		  $this->db_name = $db_name;
		  $this->url = $url;
	  
	  
	  
		  //connect to database
		  $conn = mysqli_connect($sname, $uname, $password, $db_name);
	  
		  //Create New Table for categories sync
		  $sqlCreate = "CREATE TABLE willOnHairTableCustomerBooking(
			  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			  `willOnHairCol` INT NOT NULL DEFAULT 0,
			  `ameliaCol` INT NOT NULL,
			  `appointmentId` int(11) DEFAULT NULL,
			`customerId` int(11) NOT NULL,
			`status` enum('approved','pending','canceled','rejected') DEFAULT NULL,
			`price` double NOT NULL,
			`persons` int(11) NOT NULL,
			`couponId` int(11) DEFAULT NULL,
			`token` varchar(10) DEFAULT NULL,
			`customFields` text DEFAULT NULL,
			`info` text DEFAULT NULL,
			`utcOffset` int(3) DEFAULT NULL,
			`aggregatedPrice` tinyint(1) DEFAULT 1,
			`packageCustomerServiceId` int(11) DEFAULT NULL,
			`duration` int(11) DEFAULT NULL,
			`created` datetime DEFAULT NULL
				  )";
	  
		  $report_sqlCreate = mysqli_query($conn, $sqlCreate);
		  //Verify if Table has been created
		  if ($report_sqlCreate === TRUE) {
		  }
	  
		  // Select and collect data from table: wp_amelia_customer_bookings 
		  $sql_send_to_amelia = "SELECT * FROM wp_amelia_customer_bookings";
		  $report_send_to_amelia = mysqli_query($conn, $sql_send_to_amelia);
	  
		  if ($report_send_to_amelia == TRUE) {
	  
	  
			while ($row_send_to_amelia = mysqli_fetch_array($report_send_to_amelia)) {
			  // store each data from table: wp_amelia_customer_bookings  in variables
			  $ameliaId = $row_send_to_amelia['id'];
	  
			  $appointmentId = $row_send_to_amelia['appointmentId'];
			  $customerId = $row_send_to_amelia['customerId'];
			  $status = $row_send_to_amelia['status'];
			  $price = $row_send_to_amelia['price'];
			  $persons = $row_send_to_amelia['persons'];

			  $couponId = $row_send_to_amelia['couponId'];
			  $token = $row_send_to_amelia['token'];
			  $customFields = $row_send_to_amelia['customFields'];
			  $info = $row_send_to_amelia['info'];
			  $utcOffset = $row_send_to_amelia['utcOffset'];
	
			  $aggregatedPrice = $row_send_to_amelia['aggregatedPrice'];
			  $packageCustomerServiceId = $row_send_to_amelia['packageCustomerServiceId'];
			  $duration = $row_send_to_amelia['duration'];
			  $created = $row_send_to_amelia['created'];   
					 
			  
			  
	  
			  // Select Table: willOnHairTableCustomerBooking and isnert records coming from table: wp_amelia_customer_bookings 
			  $conn = mysqli_connect($sname, $uname, $password, $db_name);
			  $qry = "SELECT * FROM willOnHairTableCustomerBooking WHERE ameliaCol='$ameliaId'";
			  $rowCheck = mysqli_query($conn, $qry);


			  if ( mysqli_num_rows($rowCheck) > 0) {
				// echo "exist";
			} else {
				$qry = "INSERT INTO willOnHairTableCustomerBooking (`ameliaCol`,  `appointmentId`, `customerId`, `status`, 
				`price`, `persons`, `couponId`, `token`, `customFields`, `info`, `utcOffset`, `aggregatedPrice`, 
				`packageCustomerServiceId`, `duration`, `created`)  
				VALUES ('$ameliaId','$appointmentId', '$customerId', '$status','$price', '$persons', '$couponId','$token',
				 '$customFields', '$info','$utcOffset', '$aggregatedPrice','$packageCustomerServiceId','$duration',
				 '$created')";
				  if (mysqli_query($conn, $qry)) {
				  }
	  
			  }
			}
		  }
	  
	  
		  //After receiving data from table: wp_amelia_customer_bookings , next process to send it to the backend
		  $sql_table3 = "SELECT * FROM willOnHairTableCustomerBooking";
		  $report_table3 = mysqli_query($conn, $sql_table3);
		  if ($report_table3 == TRUE) {
	  
			while ($row_table3 = mysqli_fetch_array($report_table3)) {
	  
			  // select and store all records of table: willOnHairTableCustomerBooking in variables
	  
			$willOnHairId = $row_table3['willOnHairCol'];
			$ameliaId = $row_table3['ameliaCol'];
	
			$appointmentIdC = $row_table3['appointmentId'];
			$customerIdC = $row_table3['customerId'];
			$statusC = $row_table3['status'];
			$priceC = $row_table3['price'];
	  
			$personsC = $row_table3['persons'];
			$couponIdC = $row_table3['couponId'];
			$tokenC = $row_table3['token']; 
	
	  
			$customFieldsC = $row_table3['customFields'];
			$infoC = $row_table3['info'];
			$utcOffsetC = $row_table3['utcOffset'];
	
	
			$aggregatedPriceC = $row_table3['aggregatedPrice'];
			$packageCustomerServiceIdC = $row_table3['packageCustomerServiceId'];
			$durationC = $row_table3['duration'];
			$createdC = $row_table3['created'];
			
	
			  // we bind fields from the backend with our variables of the Table: willOnHairTableCustomerBooking in an array
			  $postBooking = [
											  "id" => $willOnHairId,
											  "ameliaId" => $ameliaId,
											  "status"=> strtoupper($statusC),
											  "price" =>  $priceC,
											  "persons" => $personsC,
											  "token" => "fd9cd60fbd",
											  "customFields" => $customFieldsC,
											  "aggregatedPrice" =>  $aggregatedPriceC,
											  "duration"=>  $durationC
											];
	  
			  // request header of our post to the backend
	  
			  $curl = curl_init();
	  
			  curl_setopt_array($curl, array(
				CURLOPT_URL => "$url/api/v1/appointments/$appointmentIdC/bookings/amelia?customerId=$customerIdC",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => json_encode($postBooking),
				//here we convert our array to a json format
				CURLOPT_HTTPHEADER => array(
				  'Content-Type: application/json'
				),
			  )
			  );
	  
			  $response = curl_exec($curl);
	  
			  curl_close($curl);
			//   echo " <br>1st post----------$response <br>";

			}
		  }
		}
	  
		//=============get from database and insert in amelia_Customer Booking ===============
		public function Print_wp_amelia_customer_bookings_insert($sname, $uname, $password, $db_name, $url)
		{
		  $this->sname = $sname;
		  $this->uname = $uname;
		  $this->password = $password;
		  $this->db_name = $db_name;
		  $this->url = $url;
	  
		  // we creat a connection
		  $conn = mysqli_connect($sname, $uname, $password, $db_name);
	  
		  // request header of our get from the backend
		  $curl = curl_init();
		  curl_setopt_array($curl, array(
			CURLOPT_URL => "$url/api/v1/appointments/customerBokings",
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
		  )
		  );
	  
		  $response = curl_exec($curl);
		  $result = json_decode($response, true); // here we decode data coming from backend and store it as an array
		  curl_close($curl);
		//   echo " <br>1st get----------$response <br>";

	  
		  // we loop through our array and store eacch into variables
		  $i = 0;
		  while ($i < count($result)) {
			$willOnHairId = $result[$i]['id'];
			$ameliaId = $result[$i]['ameliaId'];
			$status = $result[$i]['status'];
			$price = $result[$i]['price'];
			$persons = $result[$i]['persons'];
	
	  
			$couponId = $result[$i]['couponId'];
			$token = $result[$i]['token'];
			$customFields = $result[$i]['customFields'];
			$info = $result[$i]['info'];
	  
			$utcOffset = $result[$i]['utcOffset'];
			$aggregatedPrice = $result[$i]['aggregatedPrice'];
			$packageCustomerServiceId = $result[$i]['packageCustomerServiceId'];
			$duration = $result[$i]['duration'];
	
			$created = $result[$i]['created'];
			$appointmentId = $result[$i]['appointment']['ameliaId'];
			$customerId = $result[$i]['customer']['ameliaId'];
			// echo " <br>appointmentId----------$appointmentId <br>";
			// echo " <br>customerId----------$customerId <br>";

	
	
			//we select all records from table: willOnHairTableCustomerBooking with the particular key:ameliaCol
			$conn = mysqli_connect($sname, $uname, $password, $db_name);
			$sql_First_get = "SELECT * FROM willOnHairTableCustomerBooking WHERE ameliaCol=$ameliaId";
			$report_First_get = mysqli_query($conn, $sql_First_get);
	  
	  
	  
			if ($report_First_get == TRUE) {
			  // if the above key exist we update the records that concerns the key
			  $sql_updat_wilID = "UPDATE `willOnHairTableCustomerBooking` SET `willOnHairCol`='$willOnHairId' WHERE ameliaCol = '$ameliaId'";
			  $report_updat_wilID = mysqli_query($conn, $sql_updat_wilID);
			  if (mysqli_query($conn, $report_updat_wilID)) {
			  }
			} else {
			  //if the above key does not exist we insert a new record of the non existing key
			  $insert_First_get = "INSERT INTO willOnHairTableCustomerBooking (`willOnHairCol`, `ameliaCol`, 
			  `appointmentId`, `customerId`, `status`, `price`, `persons`, `couponId`, `token`, `customFields`, 
			  `info`, `utcOffset`, `aggregatedPrice`, `packageCustomerServiceId`, `duration`, `created`)
				VALUES ('$willOnHairId', '$ameliaId', 
				'$appointmentId', '$customerId','$status','$price', '$persons','$couponId', '$token', '$customFields',
				'$info','$utcOffset', '$aggregatedPrice','$packageCustomerServiceId','$duration','$created')";
			  if (mysqli_query($conn, $insert_First_get)) {
			  }
			}
	  
	  
	  
	  
			$i++;
		  }
	  
		  // we select table: willOnHairTableCustomerBooking for the process of 
		  //generating amelia ids for the records coming from the backend by 
		  //inserting them into the table: wp_amelia_customer_bookings 
		  $conn = mysqli_connect($sname, $uname, $password, $db_name);
		  $sql_send_to_amelia = "SELECT * FROM willOnHairTableCustomerBooking";
		  $report_send_to_amelia = mysqli_query($conn, $sql_send_to_amelia);
	  
		  if ($report_send_to_amelia == TRUE) {
			while ($row_send_to_amelia = mysqli_fetch_array($report_send_to_amelia)) {
			  // we store all its records into variables
			  $willOnHairId = $row_send_to_amelia['willOnHairCol'];
			  $ameliaId = $row_send_to_amelia['ameliaCol'];
	  
	
			  $appointmentId = $row_send_to_amelia['appointmentId'];
			  $customerId = $row_send_to_amelia['customerId'];
			  $status = $row_send_to_amelia['status'];
			  $price = $row_send_to_amelia['price'];
			  $persons = $row_send_to_amelia['persons'];
			  
	
			  $couponId = $row_send_to_amelia['couponId'];
			  $token = $row_send_to_amelia['token'];
			  $customFields = $row_send_to_amelia['customFields'];
			  $info = $row_send_to_amelia['info'];
			  $utcOffset = $row_send_to_amelia['utcOffset'];
	
			  $aggregatedPrice = $row_send_to_amelia['aggregatedPrice'];
			  $packageCustomerServiceId = $row_send_to_amelia['packageCustomerServiceId'];
			  $duration = $row_send_to_amelia['duration'];
			  $created = $row_send_to_amelia['created'];   
					 
	  
	
			  
	  
			  // check the record ameliaId if null or equal to 0 we insert the whole record into tablle:wp_amelia_customer_bookings 
			  if ($ameliaId == NULL || $ameliaId == 0) {
				$send_to_amelia_category = "INSERT INTO wp_amelia_customer_bookings ( `appointmentId`, `customerId`, `status`, `price`, `persons`, `couponId`, `token`, `customFields`, 
				`info`, `utcOffset`, `aggregatedPrice`, `packageCustomerServiceId`, `duration`, `created`) 
				VALUES ( '$appointmentId', '$customerId','$status','$price', '$persons','$couponId', '$token', '$customFields',
				'$info','$utcOffset', '$aggregatedPrice','$packageCustomerServiceId','$duration','$created')";
				if (mysqli_query($conn, $send_to_amelia_category)) {
	  
				  //during each insert of each records form the while loop and the above 
				  //contion we collect the last id that was inserted into the table:wp_amelia_customer_bookings  so as to
				  //up the column: ameliaCol in th Table: willOnHairTableCustomerBooking
				  $last_id = mysqli_insert_id($conn);
				  if ($last_id == TRUE) {
					$willOnHairTableCustomerBooking_updateTable = "UPDATE `willOnHairTableCustomerBooking` SET `ameliaCol`='$last_id' WHERE willOnHairCol = '$willOnHairId'";
	  
					if (mysqli_query($conn, $willOnHairTableCustomerBooking_updateTable)) {
					  $sql_second_post = "SELECT * FROM willOnHairTableCustomerBooking WHERE willOnHairCol = '$willOnHairId'";
					  $report_second_post = mysqli_query($conn, $sql_second_post);
	  
					  if ($row_second_post = mysqli_fetch_array($report_second_post)) {
	  
						$ameliaId_send = $row_second_post['ameliaCol'];
	  
						$appointmentId_send = $row_second_post['appointmentId'];
						$customerId_send = $row_second_post['customerId'];
						$status_send = $row_second_post['status'];
						$price_send = $row_second_post['price'];
				  
						$persons_send = $row_second_post['persons'];
						$couponId_send = $row_second_post['couponId'];
						$token_send = $row_second_post['token']; 
				
				  
						$customFields_send = $row_second_post['customFields'];
						$info_send = $row_second_post['info'];
						$utcOffset_send = $row_second_post['utcOffset'];
				
				
						$aggregatedPrice_send = $row_second_post['aggregatedPrice'];
						$packageCustomerServiceId_send = $row_second_post['packageCustomerServiceId'];
						$duration_send = $row_second_post['duration'];
						$created_send = $row_second_post['created'];
	
	
	  
						//After the column: ameliaCol in th Table: willOnHairTableCustomerBooking is up to date
						// we send the updated table:willOnHairTableCustomerBooking to the backend
						$secondPostCustomBooking = [
						  "id" => $willOnHairId,
						  "ameliaId" => $ameliaId_send,
						  "status" => strtoupper($status_send),
						  "price" =>  $price_send,
						  "persons" => $persons_send,
						  "token" => "fd9cd60fbd",
						  "customFields" => $customFields_send,
						  "aggregatedPrice" =>  $aggregatedPrice_send,
						  "duration"=>  $duration_send

	
						];
	  
						$curl = curl_init();
	  
						curl_setopt_array($curl, array(
						  CURLOPT_URL => "$url/api/v1/appointments/$appointmentId_send/bookings/amelia?customerId=$customerId_send",
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 1,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'POST',
						  CURLOPT_POSTFIELDS => json_encode($secondPostCustomBooking),
						  CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json'
						  ),
						)
						);
	  
						$response = curl_exec($curl);
	  
						curl_close($curl);
						// echo " <br>2st post----------$response <br>";
					  }
					}
				  }
				}
			  }
			}
		  }
	  
	  
	  
	  
		  // we display the final results of the table: wp_amelia_customer_bookings  
		  //which now contains a sync data of wp_amelia_customer_bookings  and the backend 
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
	  
		  // $query = "DROP table willOnHairTableCustomerBooking";
		  // if (mysqli_multi_query($conn, $query)) {
		  // }
		}


		//============= post to database ======================
    public function Print_wp_amelia_providers_to_daysoff_post($sname,$uname,$password,$db_name, $url){
      $this->sname= $sname;
      $this->uname=$uname;
      $this->password =$password;
      $this->db_name =$db_name;
      $this->url =$url;
      
      
            
            //connect to database
            $conn = mysqli_connect($sname, $uname, $password, $db_name);
            
            //Create New Table for categories sync
            $sqlCreate = "CREATE TABLE willOnHairTableDayOff(
              `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
              `willOnHairCol` INT NOT NULL DEFAULT 0,
              `ameliaCol` INT NOT NULL,
              `userId` int(11) NOT NULL,
              `name` varchar(255) NOT NULL,
              `startDate` date NOT NULL,
              `endDate` date NOT NULL,
              `repeat` tinyint(1) NOT NULL
            )";
            
              $report_sqlCreate=mysqli_query($conn,$sqlCreate);
            //Verify if Table has been created
              if ($report_sqlCreate === TRUE) {
              }
  
              // Select and collect data from table: wp_amelia_providers_to_daysoff 
              $sql_send_to_amelia="SELECT * FROM wp_amelia_providers_to_daysoff";
              $report_send_to_amelia=mysqli_query($conn,$sql_send_to_amelia);
  
              if($report_send_to_amelia== TRUE){ 
  
              while($row_send_to_amelia=mysqli_fetch_array($report_send_to_amelia))
              {
                // store each data from table: wp_amelia_providers_to_daysoff  in variables
                  $ameliaId = $row_send_to_amelia['id'];
  
                  $userId = $row_send_to_amelia['userId'];	
                  $name = $row_send_to_amelia['name'];
  
                  $startDate = $row_send_to_amelia['startDate'];
                  $endDate = $row_send_to_amelia['endDate'];
                  $repeat = $row_send_to_amelia['repeat'];

          
  
                  // Select Table: willOnHairTableDayOff and isnert records coming from table: wp_amelia_providers_to_daysoff 
                  $conn = mysqli_connect($sname, $uname, $password, $db_name);
                    $qry="SELECT * FROM willOnHairTableDayOff WHERE ameliaCol='$ameliaId'";
                    $rowCheck=mysqli_query($conn,$qry);
                    if (mysqli_num_rows($rowCheck) > 0) { 
                      
                        
                      } else{
                      $qry = "INSERT INTO willOnHairTableDayOff (`ameliaCol`, `userId`, `name`, `startDate`, `endDate`, `repeat`) 
                      VALUES ('$ameliaId','$userId', '$name', '$startDate','$endDate','$repeat')"; 
                      if (mysqli_query($conn,$qry)){ 
                      
                      }  
                  }
              }
            }
      
  
            //After receiving data from table: wp_amelia_providers_to_daysoff , next process to send it to the backend
                $sql_table3="SELECT * FROM willOnHairTableDayOff";
                $report_table3=mysqli_query($conn,$sql_table3);
                if($report_table3== TRUE ){ 
      
                while($row_table3=mysqli_fetch_array($report_table3) )
                {
              
                  // select and store all records of table: willOnHairTableDayOff in variables
  
                  $willOnHairId = $row_table3['willOnHairCol'];
                  $ameliaId = $row_table3['ameliaCol'];
                  $userIdC = $row_table3['userId'];
                  $nameC = $row_table3['name'];
                  $startDateC = $row_table3['startDate'];
                  $endDateC = $row_table3['endDate'];
                  $repeatC = $row_table3['repeat'];
      
                  // we bind fields from the backend with our variables of the Table: willOnHairTableDayOff in an array
                  $postDayOff = [ 
                    "id" => $willOnHairId,
                    "ameliaId" => $ameliaId,
                    "name" => $nameC,
                    "startDate" => $startDateC,
                    "endDate" => $endDateC,
                    "repeat" => $repeatC
                ];
  
                // request header of our post to the backend
      
                  $curl = curl_init();
                  
                  curl_setopt_array($curl, array(
                    CURLOPT_URL => "$url/api/v1/employees/$userIdC/days-off/amelia",                    
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 1,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($postDayOff),//here we convert our array to a json format
                    CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                    ),
                  ));
                  
                  $response = curl_exec($curl);
                //   echo "<br> ===== 1st post : $response <br>";
                curl_close($curl);
  
  
              }
  
                        
        }
    }
    
    //=============get from database and insert in wp_amelia_providers_to_daysoff ===============
    public function Print_wp_amelia_providers_to_daysoff_insert($sname,$uname,$password,$db_name, $url){
      $this->sname= $sname;
      $this->uname=$uname;
      $this->password =$password;
      $this->db_name =$db_name;
      $this->url =$url;
    
  // we creat a connection
    $conn = mysqli_connect($sname, $uname, $password, $db_name);			
  
    // request header of our get from the backend
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "$url/api/v1/employees/daysOff",
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
    $result = json_decode($response, true); // here we decode data coming from backend and store it as an array
    curl_close($curl);

    
    // we loop through our array and store eacch into variables
    $i = 0;
    while($i < count($result)) {
    $willOnHairId = $result[$i]['id'];	
    $ameliaId = $result[$i]['ameliaId'];
    $userId = $result[$i]['user']['ameliaId'];
    $name = $result[$i]['name'];
    $startDate = $result[$i]['startDate'];
    $endDate = $result[$i]['endDate'];
    $repeat = $result[$i]['repeat'];


    //we select all records from table: willOnHairTableDayOff with the particular key:ameliaCol
    $conn = mysqli_connect($sname, $uname, $password, $db_name);			
    $sql_First_get="SELECT * FROM willOnHairTableDayOff WHERE ameliaCol=$ameliaId";
    $report_First_get=mysqli_query($conn,$sql_First_get);
    

    
    if($report_First_get == TRUE){ 
      // if the above key exist we update the records that concerns the key
          $sql_updat_wilID="UPDATE `willOnHairTableDayOff` SET `willOnHairCol`='$willOnHairId' WHERE ameliaCol = '$ameliaId'";
          $report_updat_wilID=mysqli_query($conn,$sql_updat_wilID);
          if (mysqli_query($conn,$report_updat_wilID)){ 
          
          }  
        
      } else{
        //if the above key does not exist we insert a new record of the non existing key
        $insert_First_get = "INSERT INTO willOnHairTableDayOff(`willOnHairCol`, `ameliaCol`, `userId`, `name`, `startDate`, `endDate`, `repeat`) 
        VALUES ('$willOnHairId', '$ameliaId','$userId','$name','$startDate','$endDate','$repeat')"; 
          if (mysqli_query($conn,$insert_First_get)){ 
          }  
      }
    
    
    
    
    $i++;
    }
    
    // we select table: willOnHairTableDayOff for the process of 
    //generating amelia ids for the records coming from the backend by 
    //inserting them into the table: wp_amelia_providers_to_daysoff 
    $conn = mysqli_connect($sname, $uname, $password, $db_name);			
    $sql_send_to_amelia="SELECT * FROM willOnHairTableDayOff";
    $report_send_to_amelia=mysqli_query($conn,$sql_send_to_amelia);
  
    if($report_send_to_amelia== TRUE ){ 
    while($row_send_to_amelia=mysqli_fetch_array($report_send_to_amelia))
    {
        // we store all its records into variables
        $id = $row_send_to_amelia['id'];
        $willOnHairId = $row_send_to_amelia['willOnHairCol'];	
        $ameliaId = $row_send_to_amelia['ameliaCol'];
  
        $userId = $row_send_to_amelia['userId'];	
        $name = $row_send_to_amelia['name'];
  
        $startDate = $row_send_to_amelia['startDate'];
        $endDate = $row_send_to_amelia['endDate'];
        $repeat = $row_send_to_amelia['repeat'];
  
    
      // check the record ameliaId if null or equal to 0 we insert the whole record into tablle:wp_amelia_providers_to_daysoff 
      if($ameliaId == NULL || $ameliaId == 0){ 
        $send_to_amelia_category = "INSERT INTO wp_amelia_providers_to_daysoff (`userId`, `name`, `startDate`, `endDate`, `repeat`) 
        VALUES ('$userId','$name','$startDate','$endDate','$repeat')"; 
        if (mysqli_query($conn,$send_to_amelia_category)){ 
  
          //during each insert of each records form the while loop and the above 
          //contion we collect the last id that was inserted into the table:wp_amelia_providers_to_daysoff  so as to
          //up the column: ameliaCol in th Table: willOnHairTableDayOff
        $last_id = mysqli_insert_id($conn);
        if( $last_id ==TRUE ){
            $willOnHairTableDayOff_updateTable	= "UPDATE `willOnHairTableDayOff` SET `ameliaCol`='$last_id' WHERE willOnHairCol = '$willOnHairId'";
  
            if (mysqli_query($conn,$willOnHairTableDayOff_updateTable)){
            $sql_second_post="SELECT * FROM willOnHairTableDayOff WHERE willOnHairCol = '$willOnHairId'";
            $report_second_post=mysqli_query($conn,$sql_second_post);
      
            if($row_second_post=mysqli_fetch_array($report_second_post)){ 
  
              $ameliaId_send = $row_second_post['ameliaCol'];
    
              $userId_send = $row_second_post['userId'];	
              $name_send = $row_second_post['name'];
    
              $startDate_send = $row_second_post['startDate'];
              $endDate_send = $row_second_post['endDate'];
              $repeat_send = $row_second_post['repeat'];

  
            //After the column: ameliaCol in th Table: willOnHairTableDayOff is up to date
            // we send the updated table:willOnHairTableDayOff to the backend
            $secondPostDayOff = [ 
              "id" => $willOnHairId,
              "ameliaId" => $ameliaId_send,
              "name" => $name_send,
              "startDate" => $startDate_send,
              "endDate" => $endDate_send,
              "repeat" => $repeat_send
          ];
  
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
              CURLOPT_URL => "$url/api/v1/employees/$userId_send/days-off/amelia",                    
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 1,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => json_encode($secondPostDayOff),
              CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json'
              ),
            ));
            
            $response = curl_exec($curl);
  
          curl_close($curl);
		//   echo "<br> ===== 2st post : $response <br>";

  
  
            }
  
  
        }
        
  
        }
        
        }  
  
  
      }
      
      }
    }
  
  
    // $query = "DROP table willOnHairTableDayOff";
    // if (mysqli_multi_query($conn, $query)) {
    //   echo "Dropped Successfully";
    // } else {
    //   echo "Error:" . mysqli_error($conn);
    // }	
    
    // we display the final results of the table: wp_amelia_providers_to_daysoff  
    //which now contains a sync data of wp_amelia_providers_to_daysoff  and the backend 
    $sql_table3="SELECT * FROM wp_amelia_providers_to_daysoff";
    $report_table3=mysqli_query($conn,$sql_table3);
    if($report_table3== TRUE){ 
    echo "TABLE NAME: wp_amelia_providers_to_daysoff";
    echo "<table border='5'>";
    echo "<tr><th>id</th>
    <th>userId</th><th>name</th><th>startDate</th>
    <th>endDate</th><th>repeat</th></tr>";
    
    while($row_table3=mysqli_fetch_array($report_table3) )
    {
    
    
      echo "<tr><td>";									
      echo$row_table3['id'];
      echo "</td><td>";
      echo$row_table3['userId'];
      echo "</td><td>";
      echo$row_table3['name'];
      echo "</td><td>";
      echo$row_table3['startDate'];
      echo "</td><td>";									
      echo$row_table3['endDate'];
      echo "</td><td>";					
      echo$row_table3['repeat'];
      echo "</td></tr>";
      echo"<tr></tr>";
      echo"<tr></tr>";
      echo"<tr></tr>";
    
    }
    echo"</table>";
    
    }
    
    }
  




	}
?>


<style>
body {
  background: #D3D3D3
}

table {
  border: 1px #00BFFF solid;
  font-size: 1em;
  box-shadow: 0 2px 5px rgba(0,0,0,.25);
  width: 100%;
  border-collapse: collapse;
  border-radius: 5px;
  overflow: hidden;
  margin-bottom: 2rem;
  margin-right: 1rem;
}

th {
  text-align: center;
  background: #00BFFF;
}
  
thead {
  font-weight: bold;
  color: #fff;

}
  
 td, th {
  padding: .5em .5em;
  vertical-align: middle;
}
  
 td {
  border-bottom: 1px solid rgba(0,0,0,.1);
  background: #fff;
}

a {
  color: #73685d;
}
  
 @media all and (max-width: 768px) {
    
  table, thead, tbody, th, td, tr {
    display: block;
  }
  
  th {
    text-align: right;
  }
  
  table {
    position: relative; 
    padding-bottom: 0;
    border: none;
    box-shadow: 0 0 10px rgba(0,0,0,.2);
  }
  
  thead {
    float: left;
    white-space: nowrap;
  }
  
  tbody {
    overflow-x: auto;
    overflow-y: hidden;
    position: relative;
    white-space: nowrap;
  }
  
  tr {
    display: inline-block;
    vertical-align: top;
  }
  
  th {
    border-bottom: 1px solid #a39485;
  }
  
  td {
    border-bottom: 1px solid #e5e5e5;
  }
  
  
  }

  
</style>