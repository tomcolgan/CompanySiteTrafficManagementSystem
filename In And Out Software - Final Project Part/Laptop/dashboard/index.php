<?php
session_start();
    if(! isset($_SESSION["user"])){
		header('location: ../login/?error=login');
	}
?>
<head>
<!-- here is the href and sources for datatables, bootstrap, fonts -->
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" media='all' rel='stylesheet' type='text/css'/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="js/jquery-3.3.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script>
	//setting a var table and using the column names, id, data, operation and date
    $(document).ready(function() {
      var table =$('#table').DataTable( {
        "ajax":{
          "url":"table.php",
          "dataSrc":""
        },
        "columns":[
            {"data":"id"},
            {"data":"data"},
            {"data":"operation"},
            {"data":"date"}
        ]
    } );
    setInterval( function () {
    table.ajax.reload();
}, 2000 );

$("#table2").hide();
} );
</script>
<style>
.dot {
  height: 25px;
  width: 25px;
  
  border-radius: 50%;
  display: inline-block;
}
html, body{overflow-x: hidden;}

</style>

<script>
//setTimeout(modal, 1000);
setInterval(function(){modal();}, 3800);

function modal(){
    var table = document.getElementById("table");
    //check rows and cells
    if(table.rows[1].cells[0].innerHTML.localeCompare("No data available in table") == -1){
        test=$('#myModal').hasClass('in');
          if(! test){
            for (var i = 0, row; row = table.rows[i],i<table.rows.length; i++) {
              if(row.cells[2].innerHTML == "N"){
                $("#data").empty().append('<div class="custom-control custom-radio"><input type="radio" id="radio1" name="customRadio" class="custom-control-input"  onclick="update('+row.cells[0].innerHTML+',\''+'INPUT\''+')"><label class="custom-control-label" for="customRadio1">INPUT</label></div><div class="custom-control custom-radio"><input type="radio" id="radio2" name="customRadio" class="custom-control-input"  onclick="update('+row.cells[0].innerHTML+',\''+'OUTPUT\''+')"><label class="custom-control-label" for="customRadio2">OUTPUT</label></div>');
                $('#myModal').modal('show');
                test=true;
              }
              }
          }
          
          //setTimeout(modal, 1000);
      }
          
            
            
}

function update(id,op){
  $('#myModal').modal('hide');
  var request = $.ajax({
    type: "POST",
    url: "operation.php",
    data: {"id": id, "operation":op},
    dataType: "html"
});

}

</script>
<script src="js/modernizr.js"></script>
<script> 
	$(document).ready(function(){
		$(".se-pre-con").fadeOut(2000);;
	});
</script>
	<style>
		.no-js #loader { display: none;  }
		.js #loader { display: block; position: absolute; left: 100px; top: 0; }
		.se-pre-con {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url(images/loading.gif) center no-repeat #fff;
}
	</style>
</head>
<html>
<body>
<div class="se-pre-con"></div>
<div class="content">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><i class="fa fa-home"></i>  In Out System</a>
    </div>
    <div class="dropdown" style="float:right;margin-right:10%;">
        <button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user">  TOM.C</i>
        <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="settings.php">Settings</a></li>
                <li><a href="../logout.php">Sign out</a></li>
            </ul>
    </div>
  </div>
  
</nav>
<div id="state">
</div>

<div style="padding:5%">
<table id="table" class="display table table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>Data</th>
                <th>Operation</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            
        </tbdoy>
</table>
<!--<table id="table2" border="1">
  <tbody id="tbody">
  </tbody>
</table>-->
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-body">
          <div id="data">
          </div>
        </div>
        
      </div>
      
    </div>
  </div>
  
</body>
</html>