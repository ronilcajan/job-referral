$(document).ready(function(){
	// ========= Jobs DataTables =========
	$('#referrals_table').DataTable();

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

	
	$('.hired_applicant').on('click', function(){
		var id = $(this).attr('id');

		$.ajax({
			type: "POST",
			url: "../model/hired_applicant.php",
			dataType: "json",
			data: {
				id:id
			},
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
		return false;
	});

	// ======================= Delete Referral ====================

	$('.remove_referral').on('click', function(){
		var id = $(this).attr('id');

		$.ajax({
			type: "POST",
			url: "../model/remove_referral.php",
			dataType: "json",
			data: {
				id:id
			},
			success: function(response) {
				if (response.success == true) {

					toastr.error(response.message);

					setTimeout(function() {
						window.location.reload(1);
					}, 2000);

				} else {
					toastr.error(response.message);
				}
			}
		});
		return false;
	});

});