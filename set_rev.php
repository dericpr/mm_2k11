 <html>                                                                  
 <head>                                                                  


<link rel="stylesheet" href="bootstrap-1.1.0.css">
<style type="text/css">
	.changed { background-color:LightGreen;}
	.failedchanged { background-color:Red;}
 </style>

 <script type="text/javascript" src="jquery.js"></script>          
 <script type="text/javascript">                                         

 function getList(first) {
	 var table = $("#rev_list");
	 if ( first != 1 )
		 table.fadeOut();
	 table.html("");
	$.post('getidedata.php',function(data) {
		$.each(data, function(i,rev){
	     	table.append("<tr id='"+rev.id+"'></tr>");
			var tr = $('tr:last', table);
			var url_width = rev.url.length;
			tr.append("<td> <input class='ide_info' type='hidden' id='id' value='"+rev.id+"' /></td>" +
					  "<td> <input class='ide_info' type='text' id='tag' value='"+rev.tag+"'></input></td>" +
			          "<td> <input class='ide_info' type='text' id='name' value='"+rev.name+"'></input</td>" +
					  "<td> <input class='ide_info' type = 'text' id='url' size=50 value='"+rev.url+"'></input></td>" +
					  "<td> <input class='ide_info' type='text' id='rev' value='"+rev.revision+"'></input></td>" +
					  "<td> <button class='delref btn ' id='"+rev.id+"'><img src='del.png' /></button></td>");
		});
	}, "json");
	table.fadeIn();

}
 // we will add our javascript code here                                    
 $(document).ready(function() {
	 getList(1);
	
	var $scrollingDiv = $("#addDiv");
	$(window).scroll(function() {
		$scrollingDiv
			.stop()
			.animate({"marginTop": ($(window).scrollTop() + 30) + "px"}, "slow" );
	});
	$(".delref").live('click', function() {
		var delid = $(this).attr('id');
		if ( delid == 1 || delid == 2 )
		{
			var r = confirm("Are you Sure you want to delete this one?")
			if ( r == true ) {
				var m = confirm("Are you really Sure?  Thomas may just kill you if you delete a product build configuration by accident");
				if ( m == true ) {
					$.post('removeidetype.php', {"delid": delid}, function(data) {
					if ( data.res == 1 ) {
						$("#"+delid).fadeOut(300, function() { $(this).remove();});
					}

					}, "json");
				} else {
					alert("Whew, you dodged a bullet there...");
				}
			} else {
				alert ("It's okay, we all make mistakes.");
			}
		} else {
			$.post('removeidetype.php', {"delid": delid}, function(data) {
				if ( data.res == 1 ) {
					$("#"+delid).fadeOut(300, function() { $(this).remove();});
				}

			}, "json");
		}

	});
	$("#clickey_click").live('click', function() {
		var ideInfo = new Array();
		$(".ide_info").each(function() {
			ideInfo.push($(this).val());
		});
		$.post('setidedata.php',{"idedata" : ideInfo}, function(data) {
			if ( data.res == '1' ) {
			  $(".ide_info").removeClass('changed');
			} else {
			  $(".ide_info").removeClass('failedchange');
			}
		}, "json");
	});

	$(".ide_info").live('keyup', function() {
		$(this).addClass('changed');
	});

	$("#addnewbtn").live('click', function () {
		var newIde  = new Array();
		newIde.push($('#tag_new').val());
		newIde.push($('#name_new').val());
		newIde.push($('#url_new').val());
		newIde.push($('#rev_new').val());
		$.post('addnewide.php', {"newide":newIde}, function(data) {
			if ( data.res == '1' ) {
				var table = $("#rev_list");
		     	table.append("<tr id='"+data.newid+"'></tr>");
				var tr = $('tr:last', table);
				tr.hide();
				var url_width = newIde[2].length;
				tr.append("<td> <input class='ide_info' type='hidden' id='id' value='"+data.newid+"' /></td>" +
					  "<td> <input class='ide_info' type='text' id='tag' value='"+newIde[0]+"'></input></td>" +
			          "<td> <input class='ide_info' type='text' id='name' value='"+newIde[1]+"'></input</td>" +
					  "<td> <input class='ide_info' type = 'text' id='url' size=50 value='"+newIde[2]+"'></input></td>" +
					  "<td> <input class='ide_info' type='text' id='rev' value='"+newIde[3]+"'></input></td>" +
					  "<td> <button class='delref btn' id='"+data.newid+"'><img src='del.png' /></button></td>");
				tr.fadeIn();
				$(document).scrollTop($(document).height());

			} else {
				alert (data.sql);
				alert (data.res);
			}

		}, "json");
	});

 });

 </script>                  
   
                                          
 </head>                                                                 
 <body>                                                                  

<div class='container-fluid'>
<div class="topbar-wrapper" style="z-index: 5;">
    <div class="topbar">
      <div class="fill">

        <div class="container">
          <h3><a href="buildman.php">Crank Build Manager</a></h3>
          <ul>
            <li class="active"><a href="#">Home</a></li>
            <li><a href="demo.php">Manage Runtime Builds</a></li>
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>

          </ul>
          <!--<form action="">
            <input type="text" placeholder="Search" />
          </form>
		 -->
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

        </div>
      </div> <!-- /fill -->
    </div> <!-- /topbar -->
  </div> <!-- topbar-wrapper -->


<br><br><br>
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
<div id="addDiv" class="sidebar">
<h2>Add new entry</h2>
<form id='addnew' name='addnew' class='form-stacked'>
<div class='clearfix'>
<label for='tag'>Tag</label><div class='input'><input type='text' id='tag_new' /></div></td>
<label for='name'>Name</label><div class='input'><input type='text' id='name_new'/></div></td>
<label for='url'>URL</label><div class='input'><input type = 'text' id='url_new'/></div></td>
<label for='rev'>Revision</label><div class='input'><input type='text' id='rev_new'/></div></td>
</form>
</div>
<button class='btn' id='addnewbtn' style='float:right'><img src='plus1.png'/></input>
</div>

<div class="content">
<p>If you've made changes you don't want to save, simply refresh the page to erase any modifications</p>
<p>
<button class='btn' id='clickey_click'><img src='disk.png' /></button>
<h2>Existing build definitions</h2>
	<table id='rev_list' border='1' class='common-table zebra-striped'>
	<thead>
	<tr>
		<th><th>Tag<th>Name<th>URL<th>revision
	</tr>
	</thead>
	<tbody>
	</tbody>
	</table>
 </p>
</div>
</div>
</body>                                                                 
 </html>

