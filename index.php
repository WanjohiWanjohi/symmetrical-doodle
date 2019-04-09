<!DOCTYPE html>
<html lang="en">

<head>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'connect.php';

?>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Online Services Reminder</title>

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
	type="text/css">
<link
	href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
	rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css"
	rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-secondary sidebar sidebar-dark accordion"
			id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a
				class="sidebar-brand d-flex align-items-center justify-content-center"
				href="index.html">
				<div class="sidebar-brand-icon rotate-n-15"></div>
				<div class="sidebar-brand-text mx-3">Online Services Billing
					Reminder System</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0 ">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item active"><a class="nav-link" href="index.php"> <i
					class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span>
			</a></li>

			<!-- Divider -->
			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">Interface</div>



			<!-- Nav Item - New Service-->
			<li class="nav-item"><a class="nav-link collapsed"
				data-toggle="modal" href="#fullform" aria-expanded="true"
				aria-controls="collapseUtilities"> <i class="fas fa-fw fa-plus"></i>
					<span>Add new service</span>
			</a></li>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">
			<li class="nav-item"><a class="nav-link collapsed"
				data-toggle="modal" data-target="#setreminder" aria-expanded="true"
				onclick="" aria-controls="collapseUtilities"> <i
					class="fas fa-fw fa-wrench"></i> <span>Set Reminder</span>
			</a></li>
			<hr class="sidebar-divider">

			<!-- to vieew subscription Histories -->
			<li class="nav-item"><a class="nav-link collapsed"
				data-toggle="modal" data-target="#subscriptionhistory"
				aria-expanded="true" onclick="" aria-controls="collapseUtilities"> <i
					class="fas fa-fw fa-chart-area"></i> <span>Subscriptions History</span>
			</a></li>

			<!-- Divider -->

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>

		</ul>
		<!-- End of Sidebar -->
		<div class="modal fade" id="setreminder" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5>Set Reminder</h5>
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="post" id = "reminderform" name = "reminderform">
							<div >
								<label for="servicetype"> Service Type *</label> <select
									id="servicetype" name="servicetype" required>
									<script type="text/javascript">
						// to get the dropdown list for service type 						
							var xmlhttp = new XMLHttpRequest;
							xmlhttp.onreadystatechange = function() {
						    	  if (this.readyState == 4 && this.status == 200) {
											var myObj = JSON.parse(this.responseText);
												var i = 0;
												while(i < myObj.length){
													  document.getElementById("servicetype").innerHTML =
														   document.getElementById("servicetype").innerHTML + 
														   "<option value='"+myObj[i] + "'>"+myObj[i]+"</option>";													  
													  i++;
													}
						    	  }}
					    	  xmlhttp.open("GET", "views/service_dropdown.php");
					    	  xmlhttp.send();						    	  
						</script>

								</select>
							</div>
							<div>
								<label for="personresponsible"> Person to be Reminded *</label> <select
									id="personresponsible" name="personresponsible" required>
									<script>
									//get the people in db 
									var xmlhttp = new XMLHttpRequest;
									xmlhttp.onreadystatechange = function() {
								    	  if (this.readyState == 4 && this.status == 200) {
													var myObj = JSON.parse(this.responseText);
													var i = 0;
													while(i < myObj.length){

														  document.getElementById("personresponsible").innerHTML =
															   document.getElementById("personresponsible").innerHTML + 
															   "<option value='"+myObj[i] + "'>"+myObj[i]+"</option>";													  
														  i++;
														}
								    	  }}
							    	  xmlhttp.open("GET", "views/service_remindee.php");
							    	  xmlhttp.send();
									</script>
								</select>
							</div>
							<div>
								<table id="remindertable" class="table">

									<thead>

									</thead>
									<script>								
								 var xmlhttp = new XMLHttpRequest();
								var txt = "<tr><td>Reminder ID</td><td>Reminder Description</td><td>Reminder Days To</td><td>SMS</td><td>Email</td></tr>";
								xmlhttp.onreadystatechange = function() {
								  if (this.readyState == 4 && this.status == 200) {
								    myObj = JSON.parse(this.responseText);
								    for (x in myObj) {
								      txt += "<tr span = \"col\">";
								      for(i in x){
											txt += "<td>" + myObj[x][i] + "</td>";
											txt += "<td>" + myObj[x][1] + "</td>";
											txt += "<td>" + myObj[x][2] + "</td>";
									      }
								      txt += "<td><input type= \"radio\" value=\"sms\"  id = \"sms\"  name= \"group["+myObj[x][2]+"\]\"> </td>";
								      txt += "<td><input type=\"radio\" value=\"email\" id = \"email\" name=\"group["+myObj[x][2]+"\]\"></td>";
										txt += "</tr>";
									    }
								    document.getElementById("remindertable").innerHTML = txt;
								  }
								}
								xmlhttp.open("GET", "views/reminder.php", true);
								xmlhttp.send(); 
								</script>
								</table>
							</div>
							<div align="right">
								<button class="btn btn-success" type="submit"
									id="remindersubmit" name="remindersubmit" onclick = "submitReminder()">Set Reminder</button>
							</div>
						</form>
						<script>
						
								function submitReminder(){
									var newform = document.getElementById("reminderform");
									var formData = new FormData(newform);
									
									var xmlhttp = new XMLHttpRequest();
									xmlhttp.open('POST','controller/setmail.php',true);
									x.send(formData);
									
						}								}
							</script>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="subscriptionhistory" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5>Service Status History</h5>
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table id="servicehistory">
							<thead>
								<tr>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Service State</th>
									<th>Service Type</th>
								</tr>
							</thead>
							<tbody>
								<script>
								var xmlhttp = new XMLHttpRequest();
								xmlhttp.onreadystatechange = function() {
									  if (this.readyState == 4 && this.status == 200) {
							        	var tabledata = JSON.parse(this.responseText);
									        	//clear the existing data before populate
									 			 for(var row in tabledata){
									 					    if(typeof tabledata[row] === "object") {
										 					    //write received data
									 					    	$('#servicehistory').dataTable().fnAddData(tabledata[row]);
									 					    } else if(typeof tabledata[row] === "string") {
									 					        alert(tabledata + " = " +  receivedData[row]);
														    }
								}}}
										xmlhttp.open("POST","views/status_histories.php",true)
										xmlhttp.send();
							</script>
						
						</table>

					</div>
				</div>
			</div>

		</div>

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav
					class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop"
						class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>

					<!-- Topbar Search -->
					<form
						class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
						<div class="input-group">
							<input type="text" class="form-control bg-light border-0 small"
								placeholder="Search for..." aria-label="Search"
								aria-describedby="basic-addon2">
							<div class="input-group-append">
								<button class="btn btn-primary" type="button">
									<i class="fas fa-search fa-sm"></i>
								</button>
							</div>
						</div>
					</form>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<!-- Nav Item - Search Dropdown (Visible Only XS) -->
						<li class="nav-item dropdown no-arrow d-sm-none"><a
							class="nav-link dropdown-toggle" href="#" id="searchDropdown"
							role="button" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false"> <i class="fas fa-search fa-fw"></i>
						</a> <!-- Dropdown - Messages -->
							<div
								class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
								aria-labelledby="searchDropdown">
								<form class="form-inline mr-auto w-100 navbar-search">
									<div class="input-group">
										<input type="text"
											class="form-control bg-light border-0 small"
											placeholder="Search for..." aria-label="Search"
											aria-describedby="basic-addon2">
										<div class="input-group-append">
											<button class="btn btn-primary" type="button">
												<i class="fas fa-search fa-sm"></i>
											</button>
										</div>
									</div>
								</form>
							</div></li>

						<!-- Nav Item - Alerts -->
						<li class="nav-item dropdown no-arrow mx-1"><a
							class="nav-link dropdown-toggle" href="#" id="alertsDropdown"
							role="button" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false"> <i class="fas fa-bell fa-fw"></i> <!-- Counter - Alerts -->
								<span class="badge badge-danger badge-counter">3+</span>
						</a> <!-- Dropdown - Alerts -->
							<div
								class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
								aria-labelledby="alertsDropdown">
								<h6 class="dropdown-header">Alerts Center</h6>
								<a class="dropdown-item d-flex align-items-center" href="#">
									<div class="mr-3">
										<div class="icon-circle bg-primary">
											<i class="fas fa-file-alt text-white"></i>
										</div>
									</div>

								</a> <a class="dropdown-item text-center small text-gray-500"
									href="#">Show All Alerts</a>
							</div></li>
					</ul>
				</nav>
				<!-- End of Topbar -->
				<div id="fullform" class="modal" role="dialog">

					<div class="modal-dialog">
						<div class="modal-header">
							<h4 class="modal-title" style="color: #000000; align: center">Add
								an Online Service type</h4>
						</div>

						<form method="post" role="form" autocomplete="on" id="fullform"
							name="fullform" >
							<div class="modal-content modal-body">
								<div class="row">
									<div class="col-md-6 form-group">
										<fieldset>
											<legend>
												<small> Person Responsible</small>
											</legend>
											<div class="form-group" id="person_details">
												<label style="color: #000000" for="fname"
													class="label-control">First name</label> <input
													name="fname" id="fname" class="form-control" placeholder=""
													required>

											</div>
											<div class="form-group" id="lastname">
												<label style="color: #000000" for="lname"
													class="label-control">Last Name</label> <input name="lname"
													id="lname" class="form-control" required>
											</div>
											<div class="form-group" id="phone">
												<label style="color: #000000" for="fone">Phone Number</label>
												<input class="form-control" id="fone" name="fone" required>
											</div>

											<div class="form-group" id="email">
												<label style="color: #000000" for="mail">Email</label> <input
													type="email" class="form-control" name="mail" id="mail"
													required>
											</div>
										</fieldset>
										<div class="form-group" id="service">
											<label style="color: #000000" for="onlineservice"
												class="label-control">Online Service Type</label> <input
												class="form-control" type="text" id="onlineservice"
												name="onlineservice">
										</div>
										<div class="form-group" id="cost">
											<label style="color: #000000" for="cost">Cost</label> <input
												class="form-control" type="text" id="kost" name="kost"
												required>
										</div>

									</div>

									<div class="col-md-6 form-group ">
										<div class="form-group">
											<br> <br> <label style="color: #000000" for="serviceprov"
												class="label-control">Service Provider</label> <input
												class="form-control" type="text" id="serviceprov"
												name="serviceprov">
										</div>

										<div class="form-group " id="frequency">
											<label style="color: #000000" for="frequency">Frequency </label><small
												style="color: #000000"> (period in days)</small><input
												id="freqwency" name="freqwency" class="form-control"
												type="number" />
										</div>


										<div class="form-group" id="alternativeprovider">
											<label style="color: #000000" for="alternativeservices">Alternative
												Service Providers</label> <input class="form-control"
												type=text id="alternativeservices"
												name="alternativeservices">
										</div>
										<div class="form-group" id="consequences">
											<label style="color: #000000" for="Risk">Risk</label> <input
												class="form-control" id="risk" name="risk" type="text"
												required placeholder="Cost of missing a payment">
										</div>

										<div class="form-group" id="service_users">
											<label style="color: #000000" for="serviceuser">Service
												User(s)</label> <input class="form-control" id="serviceuser"
												name="serviceuser" placeholder="Center(s) accruing the cost"
												required />
											<!--  		<small style="color: grey"> Seperate using a comma!</small>-->
										</div>
										<div class="form-group" id="creditcardnumber">
											<label style="color: #000000" for="Credit_card_number">Credit
												Card Number</label> <input class="form-control"
												id="credcardnumber" name="credcardnumber"
												placeholder="Credit Card Number" required>
										</div>
									</div>
								</div>
								<script>
								
								function serviceSubmit(){
									var myform = document.getElementById("fullform");
									var formData = new FormData(myform);
								var xhr = new XMLHttpRequest();
								xhr.open('POST','controller/validate.php',true);
								xhr.send(formData);
								
					}
								</script>
								<div class="col-md-12" align="right">
									<div class="panel-group">
										<div class="panel panel-default">
											<div class="panel-heading">

												<button class="button btn-success btn-md btn-rounded"
													type="submit" name="formsubmit" id="formsubmit"
													onclick="serviceSubmit()" style="width: 150px;">Submit</button>

											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Begin Page Content -->
			<div class="container-fluid">
				<!-- Page Heaing -->
				<div
					class="d-sm-flex align-items-center justify-content-between mb-4">
					<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

				</div>
				<!-- Content Row -->
				<div class="container-fluid">

					<ul class="nav nav-tabs" id="tablist">
						<script>
								function getTabs(){
								var xmlhttp = new XMLHttpRequest();
								var txt = "";
								var thisObj =""
								xmlhttp.onreadystatechange = function() {
									  if (this.readyState == 4 && this.status == 200) {
										thisObj = JSON.parse(this.responseText);
// 										console.log(thisObj);
										for(x in thisObj){
												//check if its first object and set class to active
											txt += "<li class = \" nav-item \"><a onclick=\"sendTabs(this);\" data-toggle = \"tab\" id = "+thisObj[x]+" >" +thisObj[x]+" "+ "</a></li>";
										    document.getElementById("tablist").innerHTML = txt;
											
											}								
								}}
								xmlhttp.open("GET", "views/tabs.php",true)
								xmlhttp.send();
									return txt;
								}

								 function sendTabs(element){
							    	 var clickedelement = element.id;    	
								    var myObj = JSON.stringify(clickedelement);
							    	var xmlhttp = new XMLHttpRequest();
							    	xmlhttp.onreadystatechange = function() {
							    	  if (this.readyState == 4 && this.status == 200) {
							        	var table=  document.getElementById('tablebody');
							        	//clear the existing data before populate
							        	$('#dataTable').DataTable().clear().draw();										 receivedData = JSON.parse(this.responseText);//receive and parse the data into multidimensional array
										 console.log(receivedData);		
							 			 for(var row in receivedData){
							 					    if(typeof receivedData[row] === "object") {
								 					    //write received data
							 					    	$('#dataTable').dataTable().fnAddData(receivedData[row]);
							 					    } else if(typeof receivedData[row] === "string") {
							 					        alert(receivedData + " = " +  receivedData[row]);
												    }
							 					    }
							    	  }
							    	};
							    	xmlhttp.open("GET", "controller/read.php?x="+myObj, true);
							    	xmlhttp.send();       
							    	}		
							</script>
						<script>getTabs();</script>


					</ul>


					<!-- Page Heading -->
					<!-- DataTables Example -->
					<div class="card shadow mb-4">
						<div class="card-header py-3"></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%"
									cellspacing="0">
									<thead>
										<tr>
											<th>Service Provider</th>
											<th>Service Charge</th>
											<th>Credit Card Number</th>
											<th>Service Type</th>
											<th>Service User</th>
											<th>Consequence</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Email</th>
											<th>Mobile Number</th>

										</tr>
									</thead>
									<tbody id="tablebody">

									</tbody>
									<tfoot>
										<tr>
											<th>Service Provider</th>
											<th>Service Charge</th>
											<th>Alternative service provider</th>
											<th>Responsible</th>
											<th>Contact Email</th>
											<th>Consequence</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Email</th>
											<th>Mobile Number</th>

										</tr>
									</tfoot>

								</table>
							</div>
						</div>
					</div>

				</div>
				<script>
   
    </script>
				<!-- Content Row -->
				<div class="row">

					<!-- Content Column -->
					<div class="col-lg-6 mb-4"></div>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; Your Website 2019</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->
		</div>
		<!-- End of Content Wrapper -->
	</div>
	<!-- End of Page Wrapper -->
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top"> <i
		class="fas fa-angle-up"></i>
	</a>
	<!-- Bootstrap core JavaScript-->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Core plugin JavaScript-->
	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="vendor/chart.js/Chart.min.js"></script>
	<!-- Page level plugins -->
	<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

	<script
		src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script
		src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script
		src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
	<!-- Page level custom scripts -->
	<script src="js/demo/datatables-demo.js"></script>

</body>

</html>
