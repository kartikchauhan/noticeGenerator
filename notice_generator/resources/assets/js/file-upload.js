$(function(){
    $('#fileUpload').on('click', function(){
        console.log('click');
        $('#file').trigger('click');

    });
});

if (window.FileReader) {    
    var drop;
    addEventHandler(window, 'load', function () {
        var status = document.getElementById('status');
        drop = document.getElementById('drop');
        var list = document.getElementById('list');

        function cancel(e) {
            if (e.preventDefault) {
                e.preventDefault();
            }
            return false;
        }

        // Tells the browser that we *can* drop on this target
        addEventHandler(drop, 'dragover', cancel);
        addEventHandler(drop, 'dragenter', cancel);
        
        var files, file, reader, file, bin, fileCont, filename, extension, img, newFile ;        

        $(':file').on('change', function (e){                    
            files = $(':file').prop("files");
            addFiles(e, files);
        });

        addEventHandler(drop, 'drop', function (e) {
            e = e || window.event; // get window.event if e argument missing (in IE)   
            if (e.preventDefault) {
                e.preventDefault();
            } // stops the browser from redirecting off to the image.

            var dt = e.dataTransfer;
            files = dt.files;
            addFiles(e, files);
            $(':file').off('change');
            $('input[type=file]')[0].files = files;            
            console.log($('input[type=file]')[0].files);
            return false;
        });
        Function.prototype.bindToEventHandler = function bindToEventHandler() {
            var handler = this;
            var boundParameters = Array.prototype.slice.call(arguments);
            //create closure
            return function (e) {
                e = e || window.event; // get window.event if e argument missing (in IE)   
                boundParameters.unshift(e);
                handler.apply(this, boundParameters);
            }
        };
    });
                
} else {
    document.getElementById('status').innerHTML = 'Your browser does not support the HTML5 FileReader.';
}


function addFiles(e, files)
        {
            for (var i = 0; i < files.length; i++)
            {
                file = files[i];                
                reader = new FileReader();

                reader.readAsDataURL(file);
                addEventHandler(reader, 'loadend', function (e, file) 
                {
                    if($('#drop').find('.msg-drop'))
                    {
                      $('#drop').find('.msg-drop').remove();
                    }
                    bin = this.result;
                    fileCont = document.createElement('div');
                    fileCont.className = "files-container";
                    document.getElementById('drop').appendChild(fileCont);
                    
                    filename = file.name;
                    extension = filename.split('.').pop().toLowerCase();
                    img = document.createElement("img");
                    img.file = file;
                    if(extension=='pdf')
                        img.src = '../uploads/pdf.png';                    
                    else if(extension=='doc' || extension=='docx')
                        img.src = '../uploads/docx.png';
                    else
                        img.src = bin;

                    img.className = "thumb";
                    fileCont.appendChild(img);
                    
                    newFile = document.createElement('div');
                    newFile.innerHTML = file.name;
                    newFile.className = "fileName";
                    img.appendChild(newFile);
                    
                }.bindToEventHandler(file))     
            }
        }

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


//Not plugged yet
var bar = $('.progress-bar');
$(function(){
  $(bar).each(function(){
    bar_width = $(this).attr('aria-valuenow');
    $(this).width(bar_width + '%');
  });
});

