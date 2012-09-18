 <html>                                                                  
 <head>                                                                  
<link rel="stylesheet" href="bootstrap-1.1.0.css">
 <style type="text/css">
	.active_new { background-color:LightGreen;}
	.active_existing { background-color:LightBlue;}
	.active_existing_delete { background-color:Crimson;color:white}
 </style>
 <script type="text/javascript" src="jquery.js"></script>          
 <script type="text/javascript">                                         

 // we will add our javascript code here                                    
 $(document).ready(function() {
$('input:checkbox').live('change', function(){ 
	if ( $(this).parent().is('.active_existing')) {
    	$(this).parent().addClass('active_existing_delete');
    	$(this).parent().removeClass('active_existing');
	} else if ( $(this).parent().is('.active_existing_delete')) {
	 	$(this).parent().addClass('active_existing');
		$(this).parent().removeClass('active_existing_delete');
	}
    $(this).parent().toggleClass('active_new', this.checked);
	
	$('#addnew').attr("disabled", false);
});


	$('#addnew').click(function() {
		var selectedBuilds  = new Array();
		selectedBuilds.push($('#formtag').val());
		$("input[@name='buildGroup[]']:checked").each(function() {
	    	selectedBuilds.push($(this).val());
		});

		$.post('setchecked.php', {selected: selectedBuilds}, function(data) {
			setChecks();
		});
	});

	$.post('getall.php',function(data) {
		var table = $("#linux_list");
		table.html("");
		table = $("#qnx_list");
		table.html("");
		table = $("#windows_list");
		table.html("");
		table = $("#mac_list");
		table.html("");
		for (var i=0, l=data.length; i < l; i++) {
			var s = data[i].runtime;
			if ( s.indexOf("linux-") != -1 ) {
				table = $("#linux_list");
			} else if ( s.indexOf("qnx-") != -1 || s.indexOf("nto-") != -1 ) {
				table = $("#qnx_list");
			} else if ( s.indexOf("win") != -1  ) {
				table = $("#windows_list");
			} else if ( s.indexOf("macos") != -1 ) {
				table = $("#mac_list");
			}


			table.append('<tr></tr>');
			var tr = $('tr:last', table);
			tr.append("<td><input type='checkbox' class='avail' name='buildGroup[]' id='avail_"+data[i].id+"' value='"+data[i].id+"'/>" + data[i].runtime + "</td>");
		}
	}, "json");

	setChecks();
 	$('#tag').change(function(event) {
		setChecks();
	}); 

	 function setChecks() 
     {
         $('#addnew').attr("disabled", true);
         var x = $('#tag').val();
         $("#formtag").val(x);
         $(".avail").attr('checked', false);
         $(".avail").parent().removeClass('active_new');
         $(".avail").parent().removeClass('active_existing');
         $(".avail").parent().removeClass('active_existing_delete');
         $.post('getlist.php', {selected: $('#tag').val() },
             function(data) {
                 for (var i=0, l=data.length; i < l; i++) {
                     $('input[id=avail_'+data[i].id+']').attr('checked', true);
                     $('input[id=avail_'+data[i].id+']').parent().toggleClass('active_existing', true);
                 }
             }, "json");
     };
 
	$("#addnewbtn").live('click', function () {
		var newIde  = new Array();
		newIde.push($('#tag_new').val());
		alert("Tag : " + newIde);
		$.post('addnewtag.php', {"newtag":newIde}, function(data) {
			if ( data.res == '1' ) {
				$("#tag").append("<option value = '" + data.newtag + "'>"+data.tagval+"</option>");
			} else {
				alert (data.sql);
				alert (data.res);
			}

		}, "json");
	});


 }); // document.ready

 </script>                  
   
                                          
 </head>                                                                 
 <body>  
<div class='container-fluid'>
<div class="topbar-wrapper" style="z-index: 5;">
    <div class="topbar">
      <div class="fill">
        <div class="container">
          <object style = 'vertical-align:middle;float:left' data="crank_logo_pms382.svg" type="image/svg+xml" height="64" ></object>
		  <h3><a href="buildman.php">Crank Build Manager</a></h3>
          <ul>
            <li class="active"><a href="#">Home</a></li>
            <li><a href="set_rev.php">IDE Builds</a></li>
            <li><a href="http://192.168.1.122">CS-Patti</a></li>
            <li><a href="#">Link</a></li>

          </ul>
          <!--<form action="">
            <input type="text" placeholder="Search" />
          </form>
          <ul class="nav secondary-nav">
            <li class="menu">
              <a href="#" class="menu">Dropdown</a>
              <ul class="menu-dropdown">
                <li><a href="#">Secondary link</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Another link</a></li>
              </ul>
            </li>
          </ul>
		-->
        </div>
      </div> <!-- /fill -->
    </div> <!-- /topbar -->
  </div> <!-- topbar-wrapper -->


<br><br><br><br><br>
                                                               
<?php

	/**********************************************************************
	*  ezSQL initialisation for mySQL
	*/

	// Include ezSQL core
	include_once "shared/ez_sql_core.php";

	// Include ezSQL database specific component
	include_once "mysql/ez_sql_mysql.php";

	// Initialise database object and establish a connection
	// at the same time - db_user / db_password / db_name / db_host
	$db = new ezSQL_mysql('buildbot','buildbot','build','localhost');
?>	
<div class="sidebar" id="addDiv">
<h2>Add new entry</h2>
<form id='addnewForm' name='addnewForm' class='form-stacked'>
<div class='clearfix'>
 <label for='tag'>Tag</label><td><input type='text' id='tag_new' ></input><button id='addnewbtn' class='btn' style='width:35px;height:35px;'><img height='25px' width='25px' src='plus1.png'/></input>
</div>
</form>


</div>
<div class='content'>

	Select a tag below to see the currently selected
	<?php
	$sql = "select * from tags";
	$taglist = $db->get_results($sql);
	echo "<select id='tag'>";
	foreach ($taglist as $tag) {
		echo "<option value = '".$tag->id."'>".$tag->name."</option>";
	}
	echo "</select>";
	?>
&nbsp;&nbsp;
<button id='addnew' class='btn disabled' disabled><img src='disk.png' /></button>
<button id='deltag' class='btn'><img src='del.png' /></button>
<table id='grid'></table>

	<input type='hidden' name='formtag' id='formtag' value=0>
	<table>
	<th>Linux<th>QNX<th>Windows<th>MAC
	<tr><td style='vertical-align:top;'>
			<table id='linux_list' class='common-table'>
			</table>
	<td style='vertical-align:top;'>		
			<table id='qnx_list' class='common-table'>
			</table>
	<td style='vertical-align:top;'>	
			<table id='windows_list' class='common-table'>
			</table>
	<td style='vertical-align:top;'>
			<table id='mac_list' class='common-table'>
			</table>
</div> <!-- // content end -->
 </body>                                                                 
 </html>


