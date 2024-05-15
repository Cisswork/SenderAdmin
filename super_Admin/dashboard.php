<?php
	include('config.php');
	
	if(!isset($_SESSION['id']))  
	{
    echo "<script>window.location.href='index.php';</script>";
	} 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
                .panel-primary>.panel-heading {
                color: #fff;
                background-color: #ff6633;
                border-color: #ff6633;
                }
                .panel-primary {
                    border-color: #0f0f0f;
                }  
                .progress-description, .info-box-text {
                    display: block;
                    font-size: 16px;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }
                .nav-tabs-custom>.nav-tabs>li>a {
                    color: #444;
                    border-radius: 0;
                    font-size: 20px;
                }		
                .nav>li>a {
                position: relative;
                display: block;
                padding: 7px 55px;
                }			
                .nav-tabs-custom>.nav-tabs>li>a {
                    color: #f9f2f2;
                    border-radius: 0;
                    font-size: 20px;
                }
                .nav-tabs-custom>.nav-tabs>li>a, .nav-tabs-custom>.nav-tabs>li>a:hover {
                    background: #e7823a;
                    margin: 7 px;
                }
                .nav-tabs-custom>.nav-tabs>li>a:hover {
                    color: #36c;
                }
                .panel {
                
                    border-radius: 2px;
                }

        </style>
        <style type="text/css">
            a {
                color: #1a1b1b;
            }
            .btn.active, .btn:active {
            background-image: none;
            outline: 0;
            -webkit-box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
            box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
            background: #007d76;
            color: #fff;
            }
    
        
            .skin-blue .main-header .navbar {
            background-color: #f3c235;
            }
            .btn-default1 {
                background-color: #f4f4f4;
                color: #444;
                border-color: #ddd;
                width: 100%;
                font-size: 17px;
            }
            .btn-default1:hover {
                background-color: #BE0411;
                color: #fff;
                border-color: #BE0411;
                width: 100%;
                font-size: 17px;
            }
            .btn-default2 {
                background-color: #f4f4f4;
                color: #444;
                border-color: #ddd;
                width: 100%;
                font-size: 17px;
            }
            .btn-default2:hover {
                background-color: #4D93C7;
                color: #fff;
                border-color: #4D93C7;
                width: 100%;
                font-size: 17px;
            }
            .btn-default3 {
                background-color: #f4f4f4;
                color: #444;
                border-color: #ddd;
                width: 100%;
                font-size: 17px;
            }
            .btn-default3:hover {
                background-color: #FFD50B;
                color: #fff;
                border-color: #FFD50B;
                width: 100%;
                font-size: 17px;
            }
            .btn-default4 {
                background-color: #f4f4f4;
                color: #444;
                border-color: #ddd;
                width: 100%;
                font-size: 17px;
            }
            .btn-default4:hover {
                background-color: #78AC2C;
                color: #fff;
                border-color: #78AC2C;
                width: 100%;
                font-size: 17px;
            }
            .btn-default5 {
                background-color: #f4f4f4;
                color: #444;
                border-color: #ddd;
                width: 100%;
                font-size: 17px;
            }
            .btn-default5:hover {
                background-color: #007d76;
                color: #fff;
                border-color: #007d76;
                width: 100%;
                font-size: 17px;
            }
            .btn-default6 {
                background-color: #007d76;
                color: #fff;
                border-color: #007d76;
                width: 100%;
                font-size: 17px;
            }
            .scroll{
                overflow-y:hidden;
                overflow:scroll;
                height:325px;
                width:100%;
            }
                
            /*SECTION DASHBOARD NAME AND DATE START AND END AND SUBMIT BUTTON CSS START */
            .content-header {
                position: relative;
                padding: 15px 15px 0 30px;
            }
                            .fully-headings {
                display: flex;
            }

            .fully-headings .head-name {
                width: 40%;
                text-align: left;
            }

            .fully-headings .date-name {
                width: 50%;
            }

            .date-name .fully-date {
                display: flex;
                width: 100%;
            }

            .fully-headings .head-name h1 {
                font-weight: 500;
                line-height: 1.1;
                color: black;
                font-family: 'Source Sans Pro',sans-serif;
                margin-top: 0px;
                margin-bottom: 0px;
                font-size: 36px;
            }

            .date-name .fully-date .start-date {
                width: 50%;
                text-align: right;
            }

            .date-name .fully-date .start-date input#start {
                width: 100%;
                padding: 5px 6px;
                background: white;
                border: 1px solid lightgrey;
                border-radius: 5px 0px;
                box-shadow: 0px 2px 20px rgb( 0 0 0 /10%);
            }

            .date-name .fully-date .end-date {
                width: 50%;
                text-align: center;
            }

            .date-name .fully-date .end-date input#start {
                width: 90%;
                padding: 5px 6px;
                background: white;
                border: 1px solid lightgrey;
                border-radius: 5px 0px;
                box-shadow: 0px 2px 20px rgb( 0 0 0 /10%);
            }

            .fully-headings .date-submit {
                width: 15% !important;
                text-align: left;
                margin: 0px 0px 0px 1px !important;
                float: left !important;
            }
            .fully-headings .date-submit {
            width: 15% !important;
                text-align: left;
                margin: 0px 0px 0px 1px !important;
                float: left !important;
            }
            .fully-headings .date-submit input.form-control {
                width: 100%;
            }

            .canvasjs-chart-credit.style {
                outline: none;
                margin: 0px;
                position: absolute;
                right: 2px;
                top: 231px;
            color: #f4f4f4 !important;
                text-decoration: none;
                font-size: 11px;
                font-family: Calibri, "Lucida Grande", "Lucida Sans Unicode", Arial, sans-serif;
            }               
            text {
                font-size: 15px;
                font-weight: bold;
                color:lightgrey !important;
                font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
            }               
            
            h3 {
                color: black;
                font-family:'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
            }   



            @media screen and (min-width: 320px) and (max-width: 768px){
            nav.navbar.navbar-static-top {
                margin-left: 0px !important;
            }
            .fully-headings .date-submit {
                width: 40% !important;
                text-align: left;
                margin: 6px 15px 7px 6px !important;
                float: left !important;
            }
            .fully-headings .date-submit {
                width: 37% !important;
                text-align: left;
                margin: 6px 0px 3px 30px !important;
                float: left !important;
            }
            .fully-headings .date-submit input.form-control {
                width: 100%;
            }
            }
        </style>
    </head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
				<?php   include('header.php');    ?>
  				<?php   include('sidebar.php');    ?>
  				<!-- Content Wrapper. Contains page content -->
  			<div class="content-wrapper">
   	 				<!-- Content Header (Page header) -->
   				<section class="content-header"> </section>
					<!-- Main content -->
                <section class="content">
                    <div class="row" style="padding: 10px 13px 0 18px;"><!-- /.row -->
                        <?php 
                            $sql=mysqli_query($con,"select count(id) as count from user_register");
                            $data=mysqli_fetch_assoc($sql);
                            
                            $sql1=mysqli_query($con,"select count(DriverID) as count from Drivers");
                            $data1=mysqli_fetch_assoc($sql1);
                        
                            
                            $sql4=mysqli_query($con,"select count(id) as count from notification_tbl");
                            $data4=mysqli_fetch_assoc($sql4);
                            
                            
                            $sql6=mysqli_query($con,"select count(id) as count from booking_cancel");
                            $data6=mysqli_fetch_assoc($sql6);

                            $total=$data4['count']+$data6['count'];
                            $total1=$data7+$data8+$data9;
                            $total2=$datas+$dataa+$datab;
                            $total3=$datac+$datad+$datae;
                            
                            $get=mysqli_query($con,"select count(id) as count from notification_table");
                            $trip=mysqli_fetch_assoc($get);
                            $complete=$trip['count'];
                            $get1=mysqli_query($con,"select count(id) as count from notification_tbl WHERE driver_status='end_ride' OR driver_status='Complete'");
                            $trip1=mysqli_fetch_assoc($get1);
                            $complete1=$trip1['count'];
                            $get2=mysqli_query($con,"select count(id) as count from notification_tbl WHERE driver_status='cancel'");
                            $trip2=mysqli_fetch_assoc($get2);
                            $complete2=$trip2['count'];
                            $total_trip=$complete1+$complete2;
                            $cancelled=$complete2;
                            
                            $act=mysqli_query($con,"select count(DriverID) as driver from Drivers where login_status = '1'");
                            $record=mysqli_fetch_assoc($act);
                            $act_no=$record['driver'];
                            
                            $dact=mysqli_query($con,"select count(DriverID ) as driver1 from Drivers where  (login_status = '0' OR login_status = '')");
                            $record1=mysqli_fetch_assoc($dact);
                            $dact_no=$record1['driver1'];

                            //$totalVisitors = 883000;
                        
                            $newVsReturningVisitorsDataPoints = array(
                                array("y"=> $complete1, "name"=> "Completed Trip", "color"=> "#E7823A"),
                                array("y"=> $cancelled, "name"=> "Cancelled Trip", "color"=> "#546BC1")
                                
                            );
                            
                            $newVisitorsDataPoints = array(
                                array("x"=> 1420050600000 , "y"=> 33000),
                                array("x"=> 1422729000000 , "y"=> 35960),
                                array("x"=> 1425148200000 , "y"=> 42160),
                                array("x"=> 1427826600000 , "y"=> 42240),
                                array("x"=> 1430418600000 , "y"=> 43200),
                                array("x"=> 1433097000000 , "y"=> 40600),
                                array("x"=> 1435689000000 , "y"=> 42560),
                                array("x"=> 1438367400000 , "y"=> 44280),
                                array("x"=> 1441045800000 , "y"=> 44800),
                                array("x"=> 1443637800000 , "y"=> 48720),
                                array("x"=> 1446316200000 , "y"=> 50840),
                                array("x"=> 1448908200000 , "y"=> 51600)
                            );
                            
                            $returningVisitorsDataPoints = array(
                                array("x"=> 1420050600000 , "y"=> 22000),
                                array("x"=> 1422729000000 , "y"=> 26040),
                                array("x"=> 1425148200000 , "y"=> 25840),
                                array("x"=> 1427826600000 , "y"=> 23760),
                                array("x"=> 1430418600000 , "y"=> 28800),
                                array("x"=> 1433097000000 , "y"=> 29400),
                                array("x"=> 1435689000000 , "y"=> 33440),
                                array("x"=> 1438367400000 , "y"=> 37720),
                                array("x"=> 1441045800000 , "y"=> 35200),
                                array("x"=> 1443637800000 , "y"=> 35280),
                                array("x"=> 1446316200000 , "y"=> 31160),
                                array("x"=> 1448908200000 , "y"=> 34400)
                            );
                            ?>
                            <div class="col-md-6">
                                <div class="row" style="border:1px solid #000;border-radius: 5px;margin-left: -2px; margin-top: 10px;"><!-- /.row -->
                                            <p style="color: #ffffff;    background-color: #ff6633;padding: 10px 0 10px 17px;margin-top: 0px;"><i class="fa fa-bar-chart"></i> Site Statistics</p>
                                                    <div class="col-md-6 col-sm-6 col-xs-12"><!-- /col 6 -->
                                                        <a href="viewcustomer.php"><div class="info-box">
                                                            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                                                            <div class="info-box-content">
                                                            <span class="info-box-text">USERS</span>
                                                            <?php
                                                                $sql_user=mysqli_query($con,"SELECT * FROM user_register");
                                                                $count_user=mysqli_num_rows($sql_user);
                                                            ?>
                                                            <span class="info-box-number"><?php echo $count_user;?></span>
                                                                
                                                            </div>
                                                            <!-- /.info-box-content -->
                                                        </div></a>
                                                        <!-- /.info-box -->
                                                    </div><!-- /col 6 -->      
                                                        
                                                    <div class="col-md-6 col-sm-6 col-xs-12"><!-- /col 6 -->
                                                            <a href="viewdriver.php"> <div class="info-box">
                                                            <span class="info-box-icon bg-yellow"><i class="fa fa-male"></i></span>
                                                            <div class="info-box-content">
                                                                <span class="info-box-text">DRIVERS</span>
                                                                <?php
                                                                    $sql_rides=mysqli_query($con,"SELECT * FROM Drivers");
                                                                    $count_driver=mysqli_num_rows($sql_rides);
                                                                ?>
                                                                <span class="info-box-number"><?php echo $count_driver;?></span>
                                                                </div>
                                                            <!-- /.info-box-content -->
                                                        </div></a>
                                                        <!-- /.info-box -->
                                                    </div><!-- /col 6 -->
                                                    
                                                    <div class="col-md-12 col-sm-12 col-xs-12"><!-- /col 6 -->
                                                        <!--<a href="earning_trip.php"><div class="info-box">-->
                                                        <a href="earning_trip.php"><div class="info-box">
                                                            <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                                                            <div class="info-box-content">
                                                                <span class="info-box-text">TOTAL EARNING</span>
                                                                <?php
                                                                    $sql_amount=mysqli_query($con,"SELECT  sum(total_fare) as amount FROM notification_tbl where (driver_status='end_ride' OR driver_status ='Complete')");
                                                                    $amount=mysqli_fetch_assoc($sql_amount);
                                                                    $am=$amount['amount'];
                                                                ?>
                                                                <span class="info-box-number">$ <?php echo number_format((float)$am, 2, '.', ''); ?></span>
                                                                </div>
                                                            <!-- /.info-box-content -->
                                                        </div></a>
                                                        <!-- /.info-box -->
                                                    </div><!-- /col 6 -->
                                </div><!-- /.row -->
                            </div>
                        
                            <div class="col-md-6">
                                    <div class="row" style="border:1px solid #000;border-radius: 5px;margin: 10px 0px 0 0px;width: 104%;"><!-- /.row -->
                                    <p style="color: #ffffff;    background-color: #ff6633;padding: 10px 0 10px 17px;margin-top: 0px;"><i class="fa fa-area-chart"></i> Ride Statistics</p>
                                            <div class="col-md-6 col-sm-6 col-xs-12"><!-- /col 6 -->
                                                        <!--<a href="bookinghistory.php"><div class="info-box">-->
                                                        <a href="bookinghistory.php"><div class="info-box">
                                                                <span class="info-box-icon bg-aqua"><i class="fa fa-cubes"></i></span>
                                                                <div class="info-box-content">
                                                                <span class="info-box-text">TOTAL TRIPS</span>
                                                                <?php
                                                                    $sql_amount1=mysqli_query($con,"SELECT  count(id) as trips FROM notification_tbl");
                                                                    $amount1=mysqli_fetch_assoc($sql_amount1);
                                                                    $am1=$amount1['trips'];
                                                                ?>
                                                                <span class="info-box-number"> <?php echo $am1; ?></span>
                                                                </div>
                                                                <!-- /.info-box-content -->
                                                            </div></a>
                                                            <!-- /.info-box -->
                                            </div><!-- /col 6 -->
                                            <div class="col-md-6 col-sm-6 col-xs-12"><!-- /col 6 -->
                                                <!--<a href="vehicletype.php"> <div class="info-box">-->
                                                <a href="view_package.php"> <div class="info-box">
                                                <span class="info-box-icon bg-yellow"><i class="fa fa-clone"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">TOTAL PACKAGES</span>
                                                        <?php
                                                        $sql_amount2=mysqli_query($con,"SELECT  count(id) as cars FROM tbl_package");
                                                        $amount2=mysqli_fetch_assoc($sql_amount2);
                                                        $am2=$amount2['cars'];
                                                    ?>
                                                    <span class="info-box-number"> <?php echo $am2; ?></span>
                                                    </div>
                                                <!-- /.info-box-content -->
                                                </div></a>
                                                <!-- /.info-box -->
                                            </div><!-- /col 6 -->
                                                
                                            <div class="col-md-6 col-sm-6 col-xs-12"><!-- /col 6 -->
                                                    <!--<a href="ridecancellreport.php"><div class="info-box">-->
                                                        <!--<a href="ridecancellreport.php"><div class="info-box">-->
                                                        <a href="ridecancellreport.php"><div class="info-box">
                                                        <span class="info-box-icon bg-red"><i class="fa fa-times-circle-o"></i></span>
                                                            <div class="info-box-content">
                                                            <span class="info-box-text">CANCELLED TRIPS</span>
                                                            <?php
                                                                $sql_amount22=mysqli_query($con,"SELECT  count(id) as cancle FROM notification_tbl where driver_status='cancel'");
                                                                $amount22=mysqli_fetch_assoc($sql_amount22);
                                                                $am22=$amount22['cancle'];
                                                                
                                                                $sql_amount5=mysqli_query($con,"SELECT  count(id) as cancles FROM canclebooking");
                                                                $amount5=mysqli_fetch_assoc($sql_amount5);
                                                                $am5=$amount5['cancles'];
                                                            ?>
                                                            <span class="info-box-number"> <?php echo $am22; ?></span>
                                                        </div>
                                                        <!-- /.info-box-content -->
                                                        </div></a>
                                                    <!-- /.info-box -->
                                            </div><!-- /col 6 -->  

                                            <div class="col-md-6 col-sm-6 col-xs-12"><!-- /col 6 -->
                                                            <!--<a href="bookinghistory.php"> <div class="info-box">-->
                                                            <!--<a href="earning_trip.php"> <div class="info-box">-->
                                                            <a href="earning_trip.php"> <div class="info-box">
                                                            <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>
                                                                <div class="info-box-content">
                                                                <span class="info-box-text">COMPLETED TRIPS</span>
                                                                <?php
                                                                    $sql_amount1=mysqli_query($con,"SELECT  count(id) as trips FROM notification_tbl where driver_status='end_ride' OR driver_status='Complete' ");
                                                                    $amount1=mysqli_fetch_assoc($sql_amount1);
                                                                    $am1=$amount1['trips'];
                                                                ?>
                                                                <span class="info-box-number"> <?php echo $am1; ?></span>
                                                            </div>
                                                            <!-- /.info-box-content -->
                                                            </div></a>
                                                            <!-- /.info-box -->
                                            </div><!-- /col 6 -->  
                                    
                                                
                                            </div><!-- /col 6 -->
                                    </div><!-- /.row -->
                            </div>
                            <br>
                            <br>
                            <script>
                                window.onload = function () 
                                {
                                    
                                    var totalVisitors = <?php echo $total_trip; ?>;
                                    var visitorsData = 
                                    {
                                        "New vs Returning Visitors": [{
                                            click: visitorsChartDrilldownHandler,
                                            cursor: "pointer",
                                            explodeOnClick: false,
                                            innerRadius: "75%",
                                            legendMarkerType: "square",
                                            name: "New vs Returning Visitors",
                                            radius: "100%",
                                            showInLegend: true,
                                            startAngle: 90,
                                            type: "doughnut",
                                            dataPoints: <?php echo json_encode($newVsReturningVisitorsDataPoints, JSON_NUMERIC_CHECK); ?>
                                        }],
                                        "New Visitors": [{
                                            color: "#E7823A",
                                            name: "Completed Trip",
                                            type: "column",
                                            xValueType: "dateTime",
                                            dataPoints: <?php echo json_encode($newVisitorsDataPoints, JSON_NUMERIC_CHECK); ?>
                                        }],
                                        "Returning Visitors": [{
                                            color: "black",
                                            name: "Cancelled Trip",
                                            type: "column",
                                            xValueType: "dateTime",
                                            dataPoints: <?php echo json_encode($returningVisitorsDataPoints, JSON_NUMERIC_CHECK); ?>
                                        }]
                                    };
                                
                                    var newVSReturningVisitorsOptions = {
                                        animationEnabled: true,
                                        theme: "light2",
                                        title: {
                                            text: "Trip Status",
                                            fontSize: 15,
                                            fontColor: "black",
                                        },
                                        subtitles: [{
                                            text: "",
                                            backgroundColor: "#2eacd1",
                                            fontSize: 14,
                                            fontColor: "white",
                                            padding: 5
                                        }],
                                        legend: {
                                            fontFamily: "sans-serif",
                                            fontSize: 13,
                                            itemTextFormatter: function (e) {
                                                return e.dataPoint.name  ;  
                                            }
                                        },
                                        data: []
                                    };
                                    
                                    var visitorsDrilldownedChartOptions = {
                                        animationEnabled: true,
                                        theme: "light2",
                                        axisX: {
                                            labelFontColor: "#717171",
                                            lineColor: "#a2a2a2",
                                            tickColor: "#a2a2a2"
                                        },
                                        axisY: {
                                            gridThickness: 0,
                                            includeZero: false,
                                            labelFontColor: "#717171",
                                            lineColor: "#a2a2a2",
                                            tickColor: "#a2a2a2",
                                            lineThickness: 1
                                        },
                                        data: []
                                    };
                                    
                                    var chart = new CanvasJS.Chart("chartContainer", newVSReturningVisitorsOptions);
                                    chart.options.data = visitorsData["New vs Returning Visitors"];
                                    chart.render();

                                    function visitorsChartDrilldownHandler(e) {
                                        chart = new CanvasJS.Chart("chartContainer", visitorsDrilldownedChartOptions);
                                        chart.options.data = visitorsData[e.dataPoint.name];
                                        chart.options.title = { text: e.dataPoint.name }
                                        chart.render();
                                        $("#backButton").toggleClass("invisible");
                                    }
                                    
                                    $("#backButton").click(function() { 
                                        $(this).toggleClass("invisible");
                                        chart = new CanvasJS.Chart("chartContainer", newVSReturningVisitorsOptions);
                                        chart.options.data = visitorsData["New vs Returning Visitors"];
                                        chart.render();
                                    });
                            
                                }
                            </script>

                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <script type="text/javascript">
                            // Load google charts
                            google.charts.load('current', {'packages':['corechart']});
                            google.charts.setOnLoadCallback(drawChart);

                            // Draw the chart and set the chart values
                            function drawChart()
                            {
                                var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                ['Active',24],
                                ['Inactive', 18]
                                
                                ]);

                                // Optional; add a title and set the width and height of the chart
                                var options = {'title':'Driver Status', 'width':300, 'height':250,'font-size': 15, 'font-weight':'normal'};

                                // Display the chart inside the <div> element with id="piechart"
                                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                                chart.draw(data, options);
                            }
                            </script>
                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <script type="text/javascript">
                                // Load google charts
                                google.charts.load('current', {'packages':['corechart']});
                                google.charts.setOnLoadCallback(drawChart);

                                // Draw the chart and set the chart values
                                function drawChart() 
                                {
                                var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                ['Active',<?php echo $act_no;?>],
                                ['Inactive', <?php echo $dact_no;?>]
                                
                                ]);

                                // Optional; add a title and set the width and height of the chart
                                var options = {'title':'Driver Status', 'width':300, 'height':250 ,'font-size': 15, 'font-weight':'normal'};

                                // Display the chart inside the <div> element with id="piechart"
                                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                                chart.draw(data, options);
                                }
                            </script>

                            <div class="row" style="padding: 0 0px 0 15px;">
                                <div class="col-md-6">
                                    <div class="panel panel-primary bg-gray-light" style="width: 102%;">
                                        <div class="panel-heading">
                                            <div class="panel-title-box">
                                            <i class="fa fa-bar-chart"></i> Trips								
                                            </div>                                  
                                        </div>
                                        <div class="panel-body padding-0" style="background: #fff;">
                                            <div class="col-md-6 col-sm-12 col-xs-12"><div id="chartContainer" style="height: 245px; width: 260px;"></div></div>
                                            <div class="col-md-6">
                                                <?php
                                                $sql_amount1=mysqli_query($con,"SELECT  count(id) as trips FROM notification_tbl");
                                                $amount1=mysqli_fetch_assoc($sql_amount1);
                                                $am1=$amount1['trips'];
                                                ?>
                                                <h3>Trips  Count : <?php echo $am1;?></h3>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END VISITORS BLOCK -->
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="panel panel-primary bg-gray-light" style="width: 102%;">
                                        <div class="panel-heading">
                                            <div class="panel-title-box">
                                                <i class="fa fa-bar-chart"></i> Drivers								
                                            </div>                                  
                                        </div>
                                        <div class="panel-body padding-0" style="background: #fff;padding: 2px;">
                                            <div class="col-md-6 col-sm-12 col-xs-12"><div id="piechart" style="height: 250px; width: 260px;"></div></div>
                                            <div class="col-md-6">
                                                <h3>Driver Count : <?php echo $data1['count'];?></h3>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END VISITORS BLOCK -->
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </section>
            </div>
            <?php include('footer.php');?>
        </div>
        <!-- jQuery 3 -->
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- Sparkline -->
        <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- jvectormap  -->
        <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- SlimScroll -->
        <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- ChartJS -->
        <script src="bower_components/chart.js/Chart.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="dist/js/pages/dashboard2.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	</body>
</html>