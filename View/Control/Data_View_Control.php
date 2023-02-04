<?php
class PrintAmeliaTables {

public function Print_wp_amelia_providers_to_weekdays($sname,$uname,$password,$db_name){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		  
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
	  

public function Print_wp_amelia_providers_to_services($sname,$uname,$password,$db_name){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		  
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

public function Print_wp_amelia_providers_to_periods($sname,$uname,$password,$db_name){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		  
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

public function Print_wp_amelia_providers_to_daysoff($sname,$uname,$password,$db_name){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
		  
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
public function Print_wp_amelia_extras($sname,$uname,$password,$db_name){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
			
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


public function Print_wp_amelia_galleries($sname,$uname,$password,$db_name){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
				
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
public function Print_wp_amelia_providers_to_locations($sname,$uname,$password,$db_name){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
					
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
public function Print_wp_amelia_locations($sname,$uname,$password,$db_name){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
					
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
		  


public function Print_wp_amelia_customer_bookings($sname,$uname,$password,$db_name){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
						
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


public function Print_wp_amelia_users($sname,$uname,$password,$db_name){
		$this->sname= $sname;
		$this->uname=$uname;
		$this->password =$password;
		$this->db_name =$db_name;
						
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



			

			

public function Print_wp_amelia_appointments($sname,$uname,$password,$db_name){
			$this->sname= $sname;
			$this->uname=$uname;
			$this->password =$password;
			$this->db_name =$db_name;
							
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
								
					}



							
							
				}


		




public function Print_wp_amelia_categories($sname,$uname,$password,$db_name){
	$this->sname= $sname;
	$this->uname=$uname;
	$this->password =$password;
	$this->db_name =$db_name;
					
					//connect to database
					$conn = mysqli_connect($sname, $uname, $password, $db_name);
					

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

public function Print_wp_amelia_services($sname,$uname,$password,$db_name){
	$this->sname= $sname;
	$this->uname=$uname;
	$this->password =$password;
	$this->db_name =$db_name;
					
					//connect to database
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




	}
?>
