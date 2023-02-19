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
									"image" => "string",
									"note" => "string"
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