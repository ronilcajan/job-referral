$(document).ready(function(){
	// ========= Jobs DataTables =========
	var table = $('#referrals_table').DataTable({
		dom: 'lBfrtip',
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"buttons": [
                {
					extend: "copy",
					exportOptions: {
						columns: ':not(:last-child)',
					},
                },
                {
					extend: "excel",
					exportOptions: {
						columns: ':not(:last-child)',
					},
                },
                {
					extend: "csv",
					exportOptions: {
						columns: ':not(:last-child)',
					},
                },
                {
					extend: "pdf",
					title: 'Reports - Referred Applicants',
					exportOptions: {
						columns: ':not(:last-child)',
					},
					customize : function(doc){ 
						var rowCount = doc.content[1].table.body.length;
						for (i = 1; i < rowCount; i++) {
							  doc.content[1].table.body[i][0].alignment = 'center';
							  doc.content[1].table.body[i][1].alignment = 'center';
							  doc.content[1].table.body[i][2].alignment = 'center';
							  doc.content[1].table.body[i][3].alignment = 'center';
							  doc.content[1].table.body[i][4].alignment = 'center';
						}
                        doc.content[1].table.widths = ['5%','23%','23%','23%','23%' ];

                    },
                
                },
                {
					extend: "print",
					title: 'Reports - Referred Applicants',
					exportOptions: {
						columns: ':not(:last-child)',
					},
                    customize : function(doc){ 
                        $(doc.document.body).find('h1').css('font-size', '15pt');
                    },
                }
		]
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
