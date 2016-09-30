$(function(){
	$('button').off('click');
	$('#drop').on({
		'dragover dragenter': function(e){
			e.preventDefault();
			e.stopPropagation();
		},
		'drop': function(e)
		{		
			e = e || window.event; // get window.event if e argument missing (in IE)   
            if (e.preventDefault) {
                e.preventDefault();
            } // stops the browser from redirecting off to the image.

            var dt = e.dataTransfer;
            var files = dt.files;
            console.log(files);
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                //attach event handlers here...

                reader.readAsDataURL(file);
                addEventHandler(reader, 'loadend', function (e, file) {

                    if($('#drop').find('.msg-drop'))
                    {
                      $('#drop').find('.msg-drop').remove();
                    }
                    var bin = this.result;
                    var fileCont = document.createElement('div');
                    fileCont.className = "files-container";
                    document.getElementById('drop').appendChild(fileCont);
                                        
                    // var fileNumber = list.getElementsByTagName('img').length + 1;
                    // status.innerHTML = fileNumber < files.length ? 'Loaded 100% of file ' + fileNumber + ' of ' + files.length + '...' : 'Done loading. processed ' + fileNumber + ' files.';

                    var img = document.createElement("img");
                    img.file = file;
                    img.src = bin;
                    img.className = "thumb";
                    fileCont.appendChild(img);
                    
                    var newFile = document.createElement('div');
                    newFile.innerHTML = file.name;
                    newFile.className = "fileName";
                    img.appendChild(newFile);                                                          
                    
                }.bindToEventHandler(file));
            }
            return false;
        });
		
		function addEventHandler(obj, evt, handler) {
		    if (obj.addEventListener) {
		        // W3C method
		        obj.addEventListener(evt, handler, false);
		    } else if (obj.attachEvent) {
		        // IE method.
		        obj.attachEvent('on' + evt, handler);
		    } else {
		        // Old school method.
		        obj['on' + evt] = handler;
		    }
		}





























			// var dataTransfer = e.originalEvent.dataTransfer;
			// if(dataTransfer && dataTransfer.files.length)
			// {
			// 	e.preventDefault();
			// 	e.stopPropagation();

			// 	var dt = e.dataTransfer;
			// 	var files = dt.files;
			// 	for(var i = 0; i < files.length; i++)
			// 	{
			// 		var file = files[i];
			// 		files_array.push(file);
			// 	}


			// 	if( dataTransfer && dataTransfer.files.length) {
			//     e.preventDefault();
			//     e.stopPropagation();
			//     $.each( dataTransfer.files, function(i, file) {
			//       	var reader = new FileReader();
			//       	reader.onload = $.proxy(function(file, $fileList, event) {
			//         var img = file.type.match('image.*') ? "<img src='" + event.target.result + "' /> " : "";
			//         $fileList.prepend( $("<li>").append( img + file.name ) );
			//       }, this, file, $("#fileList"));
			//       reader.readAsDataURL(file);
			//     });
			// }
			// }
		}
	});


	// $('button').on('click',function(e){
	// 	e.preventDefault();
	// 	var request = {};
	// 	var file = [];
	// 	request.courses = $('#courses').val();
	// 	request.branches = $('#branches').val();
	// 	request.years = $('#years').val();
	// 	request.sections = $('#sections').val();
	// 	request.subject = $('#subject').val();
	// 	request.additional_details = $('#additional-details').val();
	// 	request._token = $('#_token').val();
	// 	request.files_array = file;
	// 	});
	// 	$.ajax({
	// 		'type': 'post',
	// 		'url': 'save',
	// 		'data': request
	// 	})
	// 	.done(function(response){
	// 		console.log(response);
	// 	});
		


	});
