<?php
	require('../func/config.php');
	if(!$user->is_logged_in()){ header('Location: login'); }

  $pagetitle ="Registration Entries";
	$activeregistrationusers = "active open";
	$activereg = "active";
?>
  <?php include('includes/header.php');?>
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class=""><a href="#">Users</a></li>
							<li class="active">View Users</li>
						</ul><!-- /.breadcrumb -->

						<?php include('includes/nav-setings.php');?>

							<div class="page-header">
								<h1>
									System Users

								</h1>
							</div><!-- /.page-header -->

							<div class="row">
								<div class="col-xs-12">
									<!-- PAGE CONTENT BEGINS -->

									<div class="row">
										<div class="col-xs-12">
											<div class="clearfix">
												<div class="pull-right tableTools-container"></div>
											</div>

											<div class="table-header">
												All available users
											</div>

											<!-- div.table-responsive -->

											<!-- div.dataTables_borderWrap -->
											<div>
												<table id="dynamic-table" class="table table-striped table-bordered table-hover">
													<thead>
													<tr>
														<th class="center">
															<label class="pos-rel">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</th>
														<th>Name</th>
														<th>Email Address</th>
														<th>Payroll Number</th>
														<th>Phone Number</th>
														<th>Date Registered</th>
														<th>Approval Status </th>

														<th></th>
													</tr>
												</thead>

												<tbody>
												<?php
												$stmt = $db->prepare('SELECT * FROM profilemaster');
												$stmt->execute();
												while($row=$stmt->fetch(PDO::FETCH_ASSOC))
												{
													//extract($row);
												 ?>
													<tr>
														<td class="center">
															<label class="pos-rel">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</td>

														<td><?php echo $row['Name'] ?></td>
														<td><?php echo $row['Email'] ?></td>
														<td><?php echo $row['PayrollNumber'] ?></td>
														<td><?php echo $row['PhoneNumber'] ?></td>
														<td><?php echo date('jS M Y', strtotime($row['DateAdded'])) ?></td>
														<td><?php if( $row['Status']=="N"){echo "<span class='label label-sm label-warning'>Unconfirmed Account</span>";}else if( $row['Status']=="Y") { echo "<span class='label label-sm label-success'>Confirmed Account</span>";} else if( $row['Status']=="S") { echo "<span class='label label-sm label-danger'>Suspended Account</span>"; } else  { echo "<span class='label label-sm label-warning'>Pending Admin Approval</span>"; }?></td>

														<td>
															<div class="hidden-md hidden-lg">
 															 <div class="inline pos-rel">
 																 <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
 																	 <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
 																 </button>

 																 <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
 																	 <li>
 																		 <a href="javascipt:void(0)" data-id="<?php echo $row['Id']; ?>" class="tooltip-success approve_user" data-rel="tooltip" title="Approve">
 																			 <span class="green">
 																				 <i class="ace-icon fa fa-check bigger-120"></i>
 																			 </span>
 																		 </a>
 																	 </li>
																	 <li>
 																		 <a href="javascipt:void(0)" data-id="<?php echo $row['Id']; ?>" class="tooltip-warning suspend_user" data-rel="tooltip" title="Suspend">
 																			 <span class="orange">
 																				 <i class="ace-icon fa fa-flag bigger-120"></i>
 																			 </span>
 																		 </a>
 																	 </li>
 																	 <li>
																		 <?php
				 																$id = $row['Id'];
				 																if($user->countTotalAssetsByUser($row['Id'])=="0"){
																					echo '<a href="javascipt:void(0)" data-id="'.$id.'" class="tooltip-danger delete_user" data-rel="tooltip" title="Delete">
		  																			 <span class="red">
		  																				 <i class="ace-icon fa fa-trash-o bigger-120"></i>
		  																			 </span>
		  																		 </a>';
																				}
																			?>
 																	 </li>
 																 </ul>
 															 </div>
 														 </div>
															<div class="hidden-sm hidden-xs btn-group">
																<a class="btn btn-xs btn-success approve_user" data-id="<?php echo $row['Id']; ?>" href="javascipt:void(0)">
																	<i class="ace-icon fa fa-check bigger-120" title="Approve"></i>
																</a>

																<button class="btn btn-xs btn-warning suspend_user" data-id="<?php echo $row['Id']; ?>" href="javascipt:void(0)">
																	<i class="ace-icon fa fa-flag bigger-120" title="Suspend user"></i>
																</button>
																<?php
																$id = $row['Id'];
																if($user->countTotalAssetsByUser($row['Id'])=="0"){
																	echo '<a class="btn btn-xs btn-danger delete_user" data-id="'.$id.'" href="javascipt:void(0)">
																		<i class="ace-icon fa fa-trash-o bigger-120" title="Delete/Clear user"></i>
																	</a>';
																}
																 ?>
															</div>

														</td>
													</tr>
													<?php
												}
													 ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

		<?php  include('includes/footer.php'); ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="../assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="../assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="../assets/js/dataTables.buttons.min.js"></script>
		<script src="../assets/js/buttons.flash.min.js"></script>
		<script src="../assets/js/buttons.html5.min.js"></script>
		<script src="../assets/js/buttons.print.min.js"></script>
		<script src="../assets/js/buttons.colVis.min.js"></script>
		<script src="../assets/js/dataTables.select.min.js"></script>
		<script src="../assets/js/bootbox.js"></script>
		<!-- ace scripts -->
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">

				$(document).ready(function(){
					$('.suspend_user').click(function(e){

						e.preventDefault();

						var pid = $(this).attr('data-id');
						var parent = $(this).parent("td").parent("tr");

						bootbox.dialog({
							message: "Are you sure you want to suspend this user?",
							title: "<i class='glyphicon glyphicon-log-out'></i> Suspend User?",
							buttons: {
							success: {
								label: "No",
								className: "btn-success",
								callback: function() {
								 $('.bootbox').modal('hide');
								}
							},
							danger: {
								label: "Suspend!",
								className: "btn-danger",
								callback: function() {


									$.post('../suspend-user.php', { 'user_id':pid })
									.done(function(response){
										bootbox.alert(response);
										parent.fadeOut('slow');
									})
									.fail(function(){
										bootbox.alert('Something Went Wrong ....');
									})

								}
							}
							}
						});


					});

					$('.approve_user').click(function(e){

						e.preventDefault();

						var pid = $(this).attr('data-id');
						var parent = $(this).parent("td").parent("tr");

						bootbox.dialog({
							message: "Are you sure you want to confirm this user?",
							title: "<i class='glyphicon glyphicon-ok'></i> Approve User?",
							buttons: {
							success: {
								label: "No",
								className: "btn-success",
								callback: function() {
								 $('.bootbox').modal('hide');
								}
							},
							danger: {
								label: "Confirm!",
								className: "btn-danger",
								callback: function() {


									$.post('../approve-registration.php', { 'user_id':pid })
									.done(function(response){
										bootbox.alert(response);
										parent.fadeOut('slow');
									})
									.fail(function(){
										bootbox.alert('Something Went Wrong ....');
									})

								}
							}
							}
						});


					});

					$('.delete_user').click(function(e){

						e.preventDefault();

						var pid = $(this).attr('data-id');
						var parent = $(this).parent("td").parent("tr");

						bootbox.dialog({
							message: "Are you sure you want to Delete ?",
							title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
							buttons: {
							success: {
								label: "No",
								className: "btn-success",
								callback: function() {
								 $('.bootbox').modal('hide');
								}
							},
							danger: {
								label: "Delete!",
								className: "btn-danger",
								callback: function() {


									$.post('../custom/deleteUser.php', { 'delete':pid })
									.done(function(response){
										bootbox.alert(response);
										parent.fadeOut('slow');
									})
									.fail(function(){
										bootbox.alert('Something Went Wrog ....');
									})

								}
							}
							}
						});


					});

				});
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable =
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
						{ "bSortable": false },
						null, null,null, null, null, null,
						{ "bSortable": false }
					],
					"aaSorting": [],


					//"bProcessing": true,
							//"bServerSide": true,
							//"sAjaxSource": "http://127.0.0.1/table.php"	,

					//,
					//"sScrollY": "200px",
					//"bPaginate": false,

					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element

					//"iDisplayLength": 50


					select: {
						style: 'multi'
					}
					} );



				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
						{
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
						},
						{
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
						},
						{
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
						},
						{
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
						},
						{
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
						},
						{
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
						}
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );

				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});


				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {

					defaultColvisAction(e, dt, button, config);


					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});

				////

				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);





				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );




				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header

					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});

				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});



				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});



				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header

					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});

				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});



				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();

					var off2 = $source.offset();
					//var w2 = $source.width();

					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}




				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/





				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
					{
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
					}
				).css('padding-top', '12px');
				*/


			})
		</script>
	</body>
</html>
