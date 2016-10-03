$(function(){
	var courses = [], branches = [], years = [], sections = [];

	$('.tree-toggle').click(function () {
		$(this).parent().children('ul.tree').toggle(200);
	});

	$('#check_last_notice_details').on('change', function(){
		if($('#check_last_notice_details').prop('checked')) 
		{

			$('.last_notice_courses li').each(function(){
				courses.push($(this).val()); // getting all the previous selected courses
			});

			$('#courses').multiselect('select', courses); // selecting all the previous selected courses

			$('.last_notice_branches li').each(function(){				
				branches.push($(this).val());

			});
			
			$('#branches').multiselect('select', branches);

			$('.last_notice_years li').each(function(){				
				years.push($(this).val());

			});
			
			$('#years').multiselect('select', years);

			$('.last_notice_sections li').each(function(){				
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
