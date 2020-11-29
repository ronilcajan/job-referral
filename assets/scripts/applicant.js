//======= product image preview before upload =====
var profileloadFile = function(event) {
	var output = document.getElementById("profile_output");
	output.src = URL.createObjectURL(event.target.files[0]);
};

$(document).ready(function(){
	// ========= Jobs DataTables =========
	$('#applicant_table').DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": false,
        "ajax": "../model/applicants_datatables.php"
    });

	// ========== Insert/Edit Products ==============
	$('.create-jobs').on('click', function(){
		var formdata = new FormData(document.getElementById("applicant_form"));

		if( $('.name').val()  != '' && 
			$('.address').val()  != '' && 
			$('.educ_level').val()  != '' && 
			$('.work_ex').val()  != '' )
		{
			$.ajax({
				type: "POST",
				url: "../model/applicant.php",
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
			if($('.name').val() == '' ){
				toastr.warning("Full name is required!");
			}
			if($('.address').val() == '' ){
				toastr.warning("Address is required!");
			}
			if($('.educ_level').val() == '' ){
				toastr.warning("Eucational level is required!");
			}
			if($('.work_ex').val() == '' ){
				toastr.warning("Qualification is required!");
			}
		}
		return false;
	});

	// =========== Search Applicants ==============
	$('.id_search').on('click', function(){
		var id = $('.id_no').val();

		if(id.trim() != ''){

			$.ajax({
				type: "POST",
				url: "../model/edit_applicant.php",
				dataType: "json",
				data: {id:id.trim()},
				cache: false,
				success: function(response) {
					if (response.success == true) {
						toastr.success(response.message);

						$('.status').attr("checked", false);
						$('.gender').attr("checked", false);
						$('.name').val(response.applicant.name);
						$('.address').val(response.applicant.address);
						$('.contact').val(response.applicant.contact_num);
						$('#'+response.applicant.gender).attr("checked", true);
						$('#'+response.applicant.status.replace(/\s/g, '-').toLowerCase()).attr("checked", true);
						$('.bday').val(response.applicant.birthday);
						$('.work_ex').val(response.applicant.experience);
						$('.educ_level').val(response.applicant.educ_level);
						$('.course').val(response.applicant.course);
						$('.qualification').val(response.applicant.qualification);
						document.getElementById("profile_output").src = "../uploads/avatar/"+response.applicant.image;
						

					} else {
						toastr.error(response.message);
					}
				}
			});

		}else{

			toastr.warning("Please enter serial number!");

		}
	});
	
	// ========== Delete Applicant ================
	$('#applicant_table').on('click','tbody tr .remove_applicant', function(){
		var id = $(this).attr('id');

		swal({
		  	title: "Are you sure?",
		  	text: "Once removed, you will not be able to recover this Applicant!",
		  	icon: "warning",
		  	buttons: true,
		  	dangerMode: true,
		})
		.then((willDelete) => {

		  	if (willDelete) {

		  		$.ajax({
					type: "POST",
					url: "../model/remove_applicant.php",
					data: {
						id: id
					},
					dataType: "json",
					cache: false,
					success: function(response) {
						if (response.success == true) {
							toastr.success(response.message);
							$("#applicant_table").DataTable().ajax.reload();
						} else {
							$("#loading-screen").hide();
							toastr.error(response.message);
						}
					}
				});
		    	
		  	} 
		});
	});

	// ========== Edit Applicant redirect ================
	$('#applicant_table').on('click','tbody tr .edit_applicant', function(){
		var id = $(this).attr('id');
		swal({
		  	title: "Edit this Applicant info?",
		  	text: "You will redirected to the edit applicant page!",
		  	icon: "info",
		  	buttons: true,
		  	dangerMode: false,
		})
		.then((edit_products) => {
			
		  	if (edit_products) {
				window.location.href='../applicants/add_applicants.php?id='+id;
		  	} 
		});
	});

});