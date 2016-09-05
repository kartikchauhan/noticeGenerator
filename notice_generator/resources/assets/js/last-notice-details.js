$(function(){
	$('.check_last_notice_details').on('change', function(){
		var current_value; 		

		if($('.check_last_notice_details').prop('checked'))
		{						
			$('.last_notice_details_courses option').each(function(){				
				current_value = $(this).val(); // getting the current value of last_notice_courses				

				$('.courses option').each(function(){
					if($(this).val() == current_value)
					{
						$(this).attr('selected', true);
					}
				});
			});

			$('.last_notice_details_branches option').each(function(){				
				current_value = $(this).val();	// getting the current value of last_notice_branches				

				$('.branches option').each(function(){
					if($(this).val() == current_value)
					{
						$(this).attr('selected', true);
					}
				});
			});

			$('.last_notice_details_years option').each(function(){				
				current_value = $(this).val();	// getting the current value of last_notice_years				

				$('.years option').each(function(){
					if($(this).val() == current_value)
					{
						$(this).attr('selected', true);
					}
				});
			});

			$('.last_notice_details_sections option').each(function(){				
				current_value = $(this).val();	// getting the current value of last_notice_sections		

				$('.sections option').each(function(){
					if($(this).val() == current_value)
					{
						$(this).attr('selected', true);
					}
				});
			});
			
		}
		else
		{
			$('.courses option').each(function(){
				if($(this).prop('selected'))
					$(this).prop('selected', false);
			});

			$('.branches option').each(function(){
				if($(this).prop('selected'))
					$(this).prop('selected', false);
			});

			$('.years option').each(function(){
				if($(this).prop('selected'))
					$(this).prop('selected', false);
			});

			$('.sections option').each(function(){
				if($(this).prop('selected'))
					$(this).prop('selected', false);
			});

		}
	});	
});