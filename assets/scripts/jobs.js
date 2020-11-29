$(document).ready(function(){
	// ========= Jobs DataTables =========
	$('#jobs_table').DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": false,
        "ajax": "../model/jobs_datatable.php"
    });

	// ========== Insert/Edit Jobs ==============
	$('.create-jobs').on('click', function(){
		var formdata = new FormData(document.getElementById("job_form"));

		if( $('.ref_no').val() != '' && 
			$('.com_name').val()  != '' && 
			$('.job_des').val()  != '' && 
			$('.educ_level').val()  != '' && 
			$('.qualification').val()  != '' )
		{
			$.ajax({
				type: "POST",
				url: "../model/jobs.php",
				dataType: "json",
				data: formdata,
				processData: false,
				contentType: false,
				cache: false,
				success: function(response) {
					if (response.success == true) {
						toastr.success(response.message);
						setTimeout(function() {
							window.location.reload(1);
						}, 2000);
					} else {
						toastr.error(response.message);
					}
				}
			});
		}else{
			if($('.ref_no').val() == '' ){
				toastr.warning("Job referral number is required!");
			}
			if($('.com_name').val() == '' ){
				toastr.warning("Product company name is required!");
			}
			if($('.job_des').val() == '' ){
				toastr.warning("Product job description is required!");
			}
			if($('.educ_level').val() == '' ){
				toastr.warning("Eucational level is required!");
			}
			if($('.qualification').val() == '' ){
				toastr.warning("Qualification is required!");
			}
		}
		return false;
	});

	// =========== Search jobs ==============
	$('.ref_search').on('click', function(){
		var ref_no = $('.ref_no').val();

		if(ref_no.trim() != ''){

			$.ajax({
				type: "POST",
				url: "../model/edit_jobs.php",
				dataType: "json",
				data: {ref_no:ref_no.trim()},
				cache: false,
				success: function(response) {
					if (response.success == true) {
						toastr.success(response.message);
						$('#All').attr("checked", false);
						$('#Active').attr("checked", false);
						$('.com_name').val(response.jobs.company_name);
						$('.job_des').val(response.jobs.job_description);
						$('.count').val(response.jobs.count);
						$('#'+response.jobs.gender).attr("checked", true);
						$('#'+response.jobs.status).attr("checked", true);
						$('.work_ex').val(response.jobs.experience);
						$('.educ_level').val(response.jobs.educ_level);
						$('.course').val(response.jobs.course);
						$('.qualification').val(response.jobs.qualification);

					} else {
						toastr.error(response.message);
					}
				}
			});

		}else{

			toastr.warning("Please enter serial number!");

		}
	});

	// ========== Delete Jobs ================
	$('#jobs_table').on('click','tbody tr .remove_jobs', function(){
		var id = $(this).attr('id');

		swal({
		  	title: "Are you sure?",
		  	text: "Once removed, you will not be able to recover this job post!",
		  	icon: "warning",
		  	buttons: true,
		  	dangerMode: true,
		})
		.then((willDelete) => {

		  	if (willDelete) {

		  		$.ajax({
					type: "POST",
					url: "../model/remove_job.php",
					data: {
						id: id
					},
					dataType: "json",
					cache: false,
					success: function(response) {
						if (response.success == true) {
							toastr.success(response.message);
							$("#jobs_table").DataTable().ajax.reload();
						} else {
							$("#loading-screen").hide();
							toastr.error(response.message);
						}
					}
				});
		    	
		  	} 
		});
	});

	// ========== Edit Jobs redirect ================
	$('#jobs_table').on('click','tbody tr .edit_jobs', function(){
		var serial_no = $(this).attr('id');
		swal({
		  	title: "Edit this job post?",
		  	text: "You will redirected to the edit job page!",
		  	icon: "info",
		  	buttons: true,
		  	dangerMode: false,
		})
		.then((edit_products) => {
			
		  	if (edit_products) {
				window.location.href='../jobs/add_jobs.php?ref_no='+serial_no;
		  	} 
		});
	});

	$('.apply').on('click', function(e){
		e.preventDefault();

		var id = $(this).attr('id');
		console.log(id);
		
		var job = $('.job_id'+id).val();
		
		var appl = $('.appl_id'+id).val();

		$('.job_id').val(job);
		$('.appl_id').val(appl);

	});

	// ========== Insert Referrals ==============
	$('.submit-ref').on('click', function(e){
        e.preventDefault();
		var formdata = new FormData(document.getElementById("referral_form"));
		if($('.job_id').val() != null && !!$('.app_id').val() != null)
		{
			$.ajax({
				type: "POST",
				url: "../model/insert_ref.php",
				dataType: "json",
				data: formdata,
				processData: false,
				contentType: false,
				cache: false,
				success: function(response) {
					if (response.success == true) {
						toastr.success(response.message);
						setTimeout(function() {
							window.location.reload(1);
						}, 2000);
					} else {
						toastr.error(response.message);
					}
				}
			});
		}else{
			if($('.job_id').val() != 'null'){
				toastr.warning("Job/s is required!");
			}
			if($('.app_id').val() != 'null'){
				toastr.warning("Applicant/s is required!");
			}
		}
		return false;
	});

});