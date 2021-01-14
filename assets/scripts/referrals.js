$(document).ready(function(){
	// ========= Jobs DataTables =========
	var table = $('#referrals_table').DataTable({
		dom: 'Bfrtip',
		buttons: {
			buttons: [
				{
				extend: "print",
					title: 'Reports - Referred Applicants',
					exportOptions: {
						columns: ':not(:last-child)',
					},
					customize : function(doc){ 
						$(doc.document.body).find('h1').css('font-size', '15pt');
					},
				},
				'pageLength',
			]
		}
	});
	// $('.dt-buttons').attr('hidden',true);
	$('.dt-buttons').height(10);
	$('.jobs_table_length').width(30);
	$(document).on('click', '#print', function(){
		$(".buttons-print")[0].click(); //trigger the click event
	 });
	$("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
    $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
	// Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').change( function() {
        table.draw();
	} );
	$('#close').click(function(){
		$('#min').val("");
		$('#max').val("");
		table.draw();
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

	$.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#min').datepicker("getDate");
            var max = $('#max').datepicker("getDate");
            var startDate = new Date(data[3]);
            if (min == null && max == null) { return true; }
            if (min == null && startDate <= max) { return true;}
            if(max == null && startDate >= min) {return true;}
            if (startDate <= max && startDate >= min) { return true; }
            return false;
        }
    );
});

$(document).ready(function() {
	$('.app_id').select2({
		allowClear: true
	});
	$(function(){
		$(".job_id").select2({
			minimumInputLength: 1,
			allowClear: true,
			ajax: {
				url: '../model/search_job.php',
				dataType: 'json',
				delay: 250,
                data: function (data) {
                    return {
                        searchTerm: data.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results:response
                    };
                },
                cache: true
			}
		});
	});
});