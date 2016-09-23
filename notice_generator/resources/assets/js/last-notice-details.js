$(function(){
	var courses = [], branches = [], years = [], sections = [];
	$('#check_last_notice_details').on('change', function(){
		if($('#check_last_notice_details').prop('checked')) 
		{

			$('.last_notice_courses option').each(function(){
				courses.push($(this).val()); // getting all the previous selected courses
			});

			$('#courses').multiselect('select', courses); // selecting all the previous selected courses

			$('.last_notice_branches option').each(function(){				
				branches.push($(this).val());

			});
			
			$('#branches').multiselect('select', branches);

			$('.last_notice_years option').each(function(){				
				years.push($(this).val());

			});
			
			$('#years').multiselect('select', years);

			$('.last_notice_sections option').each(function(){				
				sections.push($(this).val());

			});
			
			$('#sections').multiselect('select', sections);

		}
		else
		{
			$('#courses').multiselect('deselect', courses);
			$('#branches').multiselect('deselect', branches);
			$('#years').multiselect('deselect', years);
			$('#sections').multiselect('deselect', sections);

		}
	});
});
