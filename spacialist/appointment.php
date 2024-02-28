<?php
	session_start();
	if(!isset($_SESSION["bus_logo"]))
	{
		header("location: index.php");
		exit;
	}
?>
<?php

	  require_once '../dbcontroller/dbfunctions1.php';
	

?>
<?php
 if(isset($_POST['update'])){
  	$appointment_id = $_POST['appointment_id'];
  	$status = $_POST['status'];
    
   // console.log("appointment_id:".$appointment_id);
    /*$service_id = $_POST['service_id'];*/
    
      //if($status != '' ){
       updateApptByApptId($status,$appointment_id);
       //echo $update;
       /* for($i=0;$i<count($_POST["service_id"]); $i++)
      	{
          $service_id=$_POST["service_id"][$i];
          addServicesByStaffId($staff_id,$service_id);*/
        echo "<script> window.location='appointment.php?s=Appointment Updated';</script>";
      //}else{
        //echo "<script> window.location='appointment.php?m=Status must not be empty';</script>";
      //}
    }
  ?>
<link rel="stylesheet" type="text/css" href="css/w3.css">
 <link href="css/style-responsive.css" rel="stylesheet" />
  <link href="css/datatable.css" rel="stylesheet" />

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Spacialist - Dashboard</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Spartner</span></a>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-bell"></em><span class="label label-danger"><?php  $bus_id=$_SESSION["bus_id"];?><?php echo CountNotification($bus_id)?></span>
					</a>
						<ul class="dropdown-menu dropdown-messages">
							 <?php $bus_id=$_SESSION["bus_id"];?>
						 	 <?php $data = getApptByBusId($bus_id) ;

         					 if(isset($_SESSION["bus_id"])){
        						foreach($data as $datas){
           						
            					?>
            				
            				<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
									</a>
									<div class="message-body"><small class="pull-right">new</small>
										<a href="appointment.php"><strong><?php echo $datas['firstname']; ?></strong> booked an appointment on
										 <strong><?php echo $datas['sched_date']; ?></strong> <strong>@<?php echo date("g:i a",strtotime($datas['start_time'])).'-'.date("g:i a",strtotime($datas['end_time']));; ?></strong></a>
									<br /><small class="text-muted"><?php echo $datas['created_dt']; ?></small></div>
								</div>
							</li>
            				


            			 <?php
           				
          					}
         				}
          				?>
							
							<!-- <li class="divider"></li>
							<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
									</a>
									<div class="message-body"><small class="pull-right">1 hour ago</small>
										<a href="#">New message from <strong>Jane Doe</strong>.</a>
									<br /><small class="text-muted">12:27 pm - 25/03/2015</small></div>
								</div>
							</li> -->
							<li class="divider"></li>
							<li>
								<div class="all-button"><a href="appointment.php">
									<em class="fa fa-inbox"></em> <strong>All Appointments</strong>
								</a></div>
							</li>
						</ul>
					</li>
					<!-- <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-bell"></em><span class="label label-info">5</span>
					</a>
						<ul class="dropdown-menu dropdown-alerts">
							<li><a href="#">
								<div><em class="fa fa-envelope"></em> 1 New Message
									<span class="pull-right text-muted small">3 mins ago</span></div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-heart"></em> 12 New Likes
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-user"></em> 5 New Followers
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li>
						</ul>
					</li> -->
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
				<!--<img src= <?php echo "data:image/jpeg;base64,'.base64_encode($bus_logo->load()) .'" ?>/>'; -->
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo $_SESSION["bus_name"]; ?> </div>
				<div class="profile-usertitle-name">
					 <?php $bus_id=$_SESSION["bus_id"];?>
						 	 <?php $data = getBusHoursByBusId($bus_id) ;

         					 if(isset($_SESSION["bus_id"])){
        						foreach($data as $datas){
           							
            					?>
            					 <h5 class="w3-small"><?php echo date("g:i a",strtotime($datas['open_hr'])).'-'.date("g:i a",strtotime($datas['close_hr']))?></h5>
            		 <?php
           				
          					}
         				}
          				?>

				</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li ><a href="home.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="profile.php"><em class="fa fa-address-card">&nbsp;</em> Profile</a></li>
			<li ><a href="services.php"><em class="fa fa-list">&nbsp;</em> Services</a></li>
			<li><a href="staff.php"><em class="fa fa-user-circle">&nbsp;</em> Staff</a></li>
			<li><a href="transaction.php"><em class="fa fa-address-book-o">&nbsp;</em> Transactions</a></li>
			<li class="active"><a href="appointment.php"><em class="fa fa-calendar">&nbsp;</em> Appointments</a></li>
			<!-- <li><a href="ratings.php"><em class="fa fa-comments">&nbsp;</em> Ratings and Feedbacks</a></li> -->
			<li><a href="reports.php"><em class="fa fa-bar-chart">&nbsp;</em> Reports</a></li>
			<!--<li><a href="charts.html"><em class="fa fa-bar-chart">&nbsp;</em> Charts</a></li>-->
			<!--<li><a href="elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>-->
			<!--<li><a href="panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>-->
			<!--<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
					</a></li>
				</ul>
			</li>-->
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Appointments</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="panel panel-default">
					<div class="panel-heading">
						Appointments
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-cogs"></em>
							</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 1
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 2
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 3
											</a></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					
						


					<div class="panel-body">
						<table class="table table-striped table-advance table-hover" id="myTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th> Transaction_id</th>
                   <!--  <th><i class="fa fa-transgender-alt"></i> Client</th> -->
                    <th> Appointment Name</th>
                   <!--  <th> Appointment Desc.</th> -->
                    <th> Start_time</th>
                    <th> End_time</th>
                    <th> Sched_date</th>
                    <th> Staff</th>
                    <th> Status</th>
                    <th> Action</th>
                  </tr>  
                </thead>
              <tbody>

          <?php $data = getAppointmentByBusId($bus_id) ;
          if(isset($_SESSION["bus_id"])){
          foreach($data as $datas){
            echo '<tr>';
            ?>
            <td><?php echo $datas['appointment_id']; ?></td> 
            <td><?php echo strtoupper($datas['transaction_id']);?>
            <td><?php echo ($datas['appointment_name']); ?></td>
           <!--  <td><?php echo ($datas['appointment_desc']); ?></td> -->
            <td><?php echo date("g:i a",strtotime($datas['start_time'])); ?></td>
            <td><?php echo date("g:i a",strtotime($datas['end_time'])); ?></td>
            <td><?php echo ($datas['sched_date']); ?></td>
            <td><font color="blue"><strong><?php echo strtoupper($datas['firstname']); ?></strong></font></td>
            <td><?php echo strtoupper($datas['status']); ?></td>

            <td>
              <div class="btn-group">
                
              <button class="btn btn-primary" onclick="document.getElementById('view<?php echo $datas['appointment_id']; ?>').style.display='block'" >&#128065 </button>
              <button  class="btn btn-success" onclick="document.getElementById('edit<?php echo $datas['appointment_id']; ?>').style.display='block'"  >&#9998 </button>
             
            </div>
            </td>
             <!-- EDIT -->
            <div id="edit<?php echo $datas['appointment_id']; ?>" class="w3-modal">
              <div class="w3-modal-content " style="width:50%">
                <header class="w3-container w3-blue">
                  <span onclick="document.getElementById('edit<?php echo $datas['appointment_id']; ?>').style.display='none'" class="w3-btn w3-display-topright">x</span>
                  <h2><i class="fa fa-pencil-square-o"></i> Edit</h2>
                </header>
                <div class="w3-container w3-text-white w3-white">
                  <h2 class="w3-center"><i class="fa fa-info"></i>Appointment Info</h2>
                  <form method="POST" class="w3-container w3-margin">
                  <div class="w3-row w3-section">
                      
                     	 <p><label><b>Appointment_id</b></label>
                      
                        <input type="number" name="appointment_id" value="<?php echo $datas['appointment_id']; ?>"  class="w3-input w3-border" style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold" readonly>
                     	</p>
                       <!--  <p><label name="appointment_id" >Appointment_Id:&nbsp;</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><?php echo $datas['appointment_id']; ?></label>
                      	</p> -->
              			<p><label>Transaction_Id:</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><b></b>&nbsp;<?php echo $datas['transaction_id']; ?></label>
                      	</p>
                      	<p><label>Name:</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><b></b>&nbsp;<?php echo $datas['appointment_name']; ?></label>
                      	</p>
                      	<p><label>Description:</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><b></b>&nbsp;<?php echo $datas['appointment_desc']; ?></label>
                      	</p>
                        <p><label>Start Time:</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><b></b>&nbsp;<?php echo date("g:i a",strtotime($datas['start_time'])); ?></label>
                      	</p>
                      	<p><label>End Time:</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><b></b>&nbsp;<?php echo date("g:i a",strtotime($datas['end_time'])); ?></label>
                      	</p>
                      	<p><label>Appointment Date:</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><b></b>&nbsp;<?php echo $datas['sched_date']; ?></label>
                      	</p>
                      	<p><label>Staff Assigned:</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><b></b>&nbsp;<?php echo $datas['firstname']; ?></label>
                      	</p>

                    <p><label><b>Status</b></label>
                        <select name="status" class="w3-input w3-border" style="color:black">
                          <?php
                          $current = $datas['status'];
                          $status = array('confirmed' => 'CONFIRMED','completed' => 'COMPLETED','noshow' => 'NO SHOW');
                          foreach($status as $_status => $value)
                            echo ($current == $_status) ? '<option value='.$_status.' selected>'.$value.'</option>':'<option value='.$_status.' >'.$value.'</option>';
                          ?>
                        </select>
                    </p>
                      <button name="update" class="w3-btn w3-margin w3-blue w3-round-large w3-right"><i class="fa fa-save"></i> Update</button>
                  </form>
                </div>
              </div>
              </div>
               </div> 

             
         	        
            <!-- VIEW -->
            <div id="view<?php echo $datas['appointment_id']; ?>" class="w3-modal">
              <div class="w3-modal-content" style="width:50%">
                <header class="w3-container w3-blue">
                  <span onclick="document.getElementById('view<?php echo $datas['appointment_id']; ?>').style.display='none'" class="w3-btn w3-display-topright">x</span>
                  <h2><i class="fa fa-eye"></i>View</h2>
                </header>
                <div class="w3-card-4 w3-white">
                  <div class="w3-container w3-center">
                    <h3> Appointment Info</h3>
                    <!--  <p><label name="appointment_id" >Appointment_Id:&nbsp;</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><?php echo $datas['appointment_id']; ?></label>
                      	</p> -->
              			<p><label>Transaction_Id:</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><b></b>&nbsp;<?php echo $datas['transaction_id']; ?></label>
                      	</p>
                      	<p><label>Name:</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><b></b>&nbsp;<?php echo $datas['appointment_name']; ?></label>
                      	</p>
                      	<p><label>Description:</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><b></b>&nbsp;<?php echo $datas['appointment_desc']; ?></label>
                      	</p>
                        <p><label>Start Time:</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><b></b>&nbsp;<?php echo date("g:i a",strtotime($datas['start_time'])); ?></label>
                      	</p>
                      	<p><label>End Time:</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><b></b>&nbsp;<?php echo date("g:i a",strtotime($datas['end_time'])); ?></label>
                      	</p>
                      	<p><label>Appointment Date:</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><b></b>&nbsp;<?php echo $datas['sched_date']; ?></label>
                      	</p>
                      	<p><label>Staff Assigned:</label><label style="background-color:rgba(255,255,255,0.5);color:black;font-weight:bold"><b></b>&nbsp;<?php echo $datas['firstname']; ?></label>
                      	</p>
                   <!--  <?php echo $_SESSION["bus_name"]; ?>
                    
                    <h5 class="w3-large"><i class="fa fa-id-card-o"></i> <?php echo $datas['appointment_id']; ?></h5>
                    <h5 class="w3-large"><i class="fa fa-user"></i> <?php echo $datas['firstname']; ?></h5>
                    <h5 class="w3-small"><i class="fa fa-share-alt"></i> <?php echo ' : '.$datas['start_time']; ?></h5>
                    <h5 class="w3-small"><i class="fa fa-share-alt"></i> <?php echo ' : '.$datas['end_time']; ?></h5>
                    <h5 class="w3-small"><i class="fa fa-share-alt"></i> <?php echo ' : '.$datas['sched_date']; ?></h5>
                    <h5 class="w3-small"><i class="fa fa-share-alt"></i> <?php echo ' : '.$datas['firstname']; ?></h5> -->
                  </div>
                </div>
              </div>
            </div>
            <!-- //// -->
  
            <!-- DELETE -->

           
            <div id="delete<?php echo $datas['staff_id']; ?>" class="w3-modal">
              <div class="w3-modal-content " style="width:30%">
                <header class="w3-container w3-blue">
                  <span onclick="document.getElementById('delete<?php echo $datas['staff_id']; ?>').style.display='none'" class="w3-btn w3-display-topright">x</span>
                  <h2><i class="fa fa-trash"></i> Delete</h2>
                </header>
                <div class="w3-card-4 w3-white">
                  <div class="w3-container w3-center">
                    <h3><i class="fa fa-warning"></i> Delete Staff Info</h3>
                    <img src="img/blank.png" alt="Avatar" style="width:100px;border-radius:50%">
                    <h5 class="w3-large"><i class="fa fa-id-card-o"></i> <?php echo $datas['staff_id']; ?></h5>
                    <h5 class="w3-large"><i class="fa fa-user"></i> <?php echo $datas['firstname'].' '.$datas['lastname']; ?></h5>
                    <h5 class="w3-small"><i class="fa fa-venus"></i> <?php echo ' : '.$datas['gender']; ?></h5>
                    <h5 class="w3-small"><i class="fa fa-map-marker"></i> <?php echo ' : '.$datas['address']; ?></h5>
                    <div class="w3-section">
                       <input type="hidden" name="staff_id" value="<?php echo $datas['staff_id']; ?>">
                      <a href="deleteStaff.php?staff_id=<?php echo $datas['staff_id']; ?>"><button class="w3-btn w3-red w3-round"><i class="fa fa-trash"></i> Delete</button></a>
                      <button onclick="document.getElementById('delete<?php echo $datas['staff_id']; ?>').style.display='none'" class="w3-btn w3-green w3-round"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- //// -->
                                      <!-- ADD -->
  <div id="add" class="w3-modal">
    <div class="w3-modal-content " style="width:30%">
      <header class="w3-container w3-blue">
        <span onclick="document.getElementById('add').style.display='none' class="w3-btn w3-display-topright">x</span>
        <h2><i class="fa fa-user-plus"></i> Add</h2>
      </header>
      <div class="w3-container w3-text-white w3-white">
        <h2 class="w3-center"><i class="fa fa-info"></i> Staff Info</h2>
        <form method="POST" class="w3-container w3-margin">
          <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"> 
            </div>
            <p><label><b>Firstname</b></label>
            </br>
              <input type="text" name="firstname" placeholder="First Name" class="w3-input w3-border" style="color:black" required>
            </p>
            <p><label><b>Lastname</b></label><br/>
              <input type="text" name="lastname" placeholder="Last Name" class="w3-input w3-border" style="color:black" required>
            </p>
            <p><label><b>Gender</b></label>
              <select name="gender" class="w3-input w3-border" style="color:black">
                <option disabled selected>Gender</option>
                <option value="MALE">MALE</option>
                <option value="FEMALE">FEMALE</option>
              </select>
            </p>
            <p><label><b>Address</b></label><br/>
              <input type="text" name="address" placeholder="Address" class="w3-input w3-border" style="color:black" required>
            </p>
            
          <button name="add" ><i class="fa fa-save"></i> Add</button>
        </form>
      </div>
      </div>
    </div>
    <!-- //// -->
             </div> 
            </div>
  </div>

            <!-- //// -->
           
            <?php
            echo '</tr>';
          }
         }
          ?>
        </tbody>
      </table>
					</div>
					<!--<div class="panel-footer">
						<span class="input-group-btn">
								<button class="btn btn-primary btn-md" id="btn-todo">Submit</button>
						</span></div>-->
					</div>

		</div>
		
		</div>

	
            </section>
          </div>
        </div>
        <!-- page end-->
      </section>

	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
	<script type="text/javascript">
  $(document).ready(function(){
    $('#myTable').DataTable({
      "bInfo": false
    });
  });

 
</script>
		
</body>
</html>