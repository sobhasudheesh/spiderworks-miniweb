$(function(){
	display_select2();
    
    if($('#fileupload').length)
        file_upload();

	$(document).on('click', '.miniweb-btn-warning-popup', function(event){
        event.preventDefault();
        var url = $(this).attr('href');
        var redirect_url = $(this).data('redirect-url');
        var message = $(this).data('message');
        if (typeof redirect_url !== typeof undefined && redirect_url !== false)
            var action = 'redirect';

        $.confirm({
                title: 'Warning',
                content: message,
                closeAnimation: 'scale',
                opacity: 0.5,
                buttons: {
                    'ok_button': {
                        text: 'Proceed',
                        btnClass: 'btn-blue',
                        action: function(){
                            var obj = this;
                            obj.buttons.ok_button.setText('Processing..'); // setText for 'hello' button
                            obj.buttons.ok_button.disable();
                            $.get(url).done(function (data) {
                                obj.$$close_button.trigger('click');
                                if (typeof data.error != "undefined") {
                                    var title = "Alert!";
                                    var response_msg = data.error;
                                }
                                else
                                {
                                    var title = "Success!";
                                    var response_msg = data.success;
                                }
                                $.confirm({
                                    title: title,
                                    content: response_msg,
                                    type: 'red',
                                    buttons: {
                                      'ok': function(){
                                        if(action == 'redirect')
                                            window.location.href= redirect_url;
                                        else
                                            dt();
                                      }
                                    },
                                   
                                });
                            });
                            return false;
                        }
                    },
                    close_button: {
                          text: 'Cancel',
                          action: function () {
                        }
                    },
                }
            });
    });

	var jc = false;
	$(document).on('click', '.miniweb-open-ajax-popup', function(e){
        e.preventDefault();
        var title = $(this).attr('title');
        if($(this).attr('data-url'))
            var targetUrl = $(this).data('url'); 
        else
            var targetUrl = $(this).attr('href');
        var popup_size = 'medium';
        if($(this).attr('data-popup-size'))
            popup_size = $(this).attr('data-popup-size');
        jc = $.confirm({
                title: title,
                closeIcon: true,
                buttons: {
                    close: {
                        text: 'Close', // text for button
                        isHidden: true, // initially not hidden
                    },
                },
                content: function(){
                    var self = this;
                    return $.ajax({
                        url: targetUrl,
                    }).done(function (response) {
                        self.setContentAppend(response);
                        setTimeout( function() {
                            display_select2();
                            if($('img.checkable').length)
                            {
                                $("img.checkable").imgCheckbox({
                                    onclick: function(el){
                                            var popType = $('#popupType').val();
                                            if(popType == 'single_image')
                                            {
                                                $('.imgChked').each(function(i, e) {
                                                    $(this).removeClass('imgChked');
                                                });
                                                el.addClass("imgChked");
                                            }
                                    }
                                });
                            }
                            if($('#fileupload').length)
                            {
                                file_upload();
                            }
                        }, 500 );
                            
                    });
                },
                columnClass: popup_size,
        });
    });

    $(document).on('click', '#miniweb-ajax-form-submit-btn', function(){
    	var obj = $(this);
    	var form = obj.parents('.confirm-wrap').find('form');
        var form_id = form.attr('id');
        var need_validation = form.attr('data-validate');
        var no_close_parent = obj.attr('data-force-open');
        var frmValid = true;
        if(typeof need_validation !== "undefined")
        {
            validate();
            frmValid = form.valid();
        }
        if(frmValid){
            obj.html('Processing..');
            obj.prop('disabled', true);
            var data = new FormData( $('#'+form_id)[0] );
            $.ajax({
                url : form.attr('action'),
                type: "POST",
                data : data,
                processData: false,
                contentType: false,
                success:function(data, textStatus, jqXHR){
                    if (typeof data.error != "undefined") {
                    	obj.html('Save');
            			obj.prop('disabled', false);
                        miniweb_alert('Alert!', data.error);
                    }
                    else if (typeof data.errors != "undefined") {
                    	obj.html('Save');
            			obj.prop('disabled', false);
            			var errorString = '<ul>';
				        $.each( data.errors, function( key, value) {
				            errorString += '<li>' + value + '</li>';
				        });
				        errorString += '</ul>';
                        miniweb_alert('Alert!', errorString);
                    }
                    else if(typeof data.success != "undefined"){
                        if(typeof no_close_parent == "undefined")
                        {
                    	   jc.close();
                        }
                        else
                        {
                            obj.html('Save');
                            obj.prop('disabled', false);
                        }
                        miniweb_alert('Success!', data.success, 'redraw');
                    }
                }
            });
        }
    });

    if($('.richtext').length)
    {
        $( ".richtext" ).each(function( index ) {
            var image_upload_url = $(this).data('image-url');
            $(this).summernote({
                callbacks: {
                    onImageUpload: function(files) {
                        that = $(this);
                        sendFile(files[0], that, image_upload_url);
                    }
                }
            });
        });
    }

        $(document).on('click', '.media-popup-nav .pagination .page-link', function(e){
              e.preventDefault();
              var loadurl = $(this).attr('href');
              var targ = $('#mediaList');
              if(loadurl != 'undefined'){
                  targ.load(loadurl, function(){
                    $("img.checkable").imgCheckbox({
                        onclick: function(el){
                            var popType = $('#popupType').val();
                            if(popType == 'single_image')
                            {
                                $('.imgChked').each(function(i, e) {
                                    $(this).removeClass('imgChked');
                                });
                                el.addClass("imgChked");
                            }
                        }
                    });
                  });
              }
          });

          $(document).on('keyup', '#mediaPopupSearchInput', function(e){
            var req = $(this).val();
            var loadurl = media_popup_url;
            $.ajax({
               url: loadurl,
               data: {req: req}, // serializes the form's elements.
               success: function(data)
               {
                  $('#mediaList').html(data);
                  $("img.checkable").imgCheckbox({
                        onclick: function(el){
                            var popType = $('#popupType').val();
                            if(popType == 'single_image')
                            {
                                $('.imgChked').each(function(i, e) {
                                    $(this).removeClass('imgChked');
                                });
                                el.addClass("imgChked");
                            }
                        }
                    });
               }
             });
          });

        $(document).on('click', '#setSingleImage', function(){
            var id = $('.imgChked').find('img').attr('id');
            var src = $('.imgChked').find('img').attr('src');
            var extra_attr = "";
            if(typeof $('.imgChked').find('img').attr('data-extra-attr') !== undefined && $('.imgChked').find('img').attr('data-extra-attr') !== false) {
                 var extra_attr = $('.imgChked').find('img').attr('data-extra-attr');
            }
            var link = $('<img>').prop('src', src).attr('class', 'card-img-top padding-20');
            $('#mediaId'+extra_attr).val(id);
            $('#image-holder-'+extra_attr).html(link);
            jc.close();
        });


        $(document).on('click', '.image-remove', function(){
            $(this).parent('.default-image-holder').find('img').attr('src', base_url+'/miniweb/img/add_image.png');
            $(this).parent('.default-image-holder').find("input[name='image_id']").val('');
        })
});

function sendFile(files, that, image_upload_url){
    data = new FormData();
    data.append("file", files);
    data.append("_token", _token);
    $.ajax({
        data: data,
        type: "POST",
        url: image_upload_url,
        cache: false,
        contentType: false,
        processData: false,
        success: function(url){
            that.summernote('insertImage', url)
        }
    });
}

function miniweb_alert(title, message, action, redirect_url)
{
    $.confirm({
        title: title,
        content: message,
        autoClose: 'ok_button1|8000',
        buttons: {
            ok_button1: {
                text: 'OK',
                btnClass: 'btn-success',
                action: function(){
                    if (typeof action !== "undefined" || action != null) { 
                        if(action == 'redraw')
                            dt();
                        else if(action == 'redirect'){
                            if (typeof redirect_url !== "undefined" || redirect_url != null) {
                                window.location.href= redirect_url;
                            }
                        } 
                    }
                }
            }
        }
    });
}

function display_select2()
{
    if($('.miniweb-select2-input').length)
    {
        $( ".miniweb-select2-input" ).each(function( index ) {

            var url = $(this).data('select2-url');
            var placeholder = $(this).data('placeholder');
            var parent = $(this).data('parent');
            if (typeof parent !== typeof undefined && parent !== false)
                parent = $(parent);
            else
                parent = $('body');
            if (typeof url !== typeof undefined && url !== false){
	            $(this).select2({
	                placeholder: placeholder,
	                allowClear: true,
	                dropdownParent: parent,
	                ajax: {
	                    url: url,
	                    dataType: 'json',
	                    method: 'get',
	                    processResults: function (data) {
	                        return {
	                            results: data
	                        };
	                    },
	                    cache: true
	                }
	            });
	        }
	        else
	        {
	        	$(this).select2({
	                placeholder: placeholder,
	                allowClear: true,
	                dropdownParent: parent,
	            });
	        }
        });
    }
}

function file_upload()
{
    var progressBar = $('<div/>').addClass('progress').append($('<div/>').addClass('progress-bar')); //progress bar

    $('#fileupload').fileupload({
        dataType: 'json',
        formData: {
            "_token": _token,
            "related_type": $('#related_type').val(),
            "related_id": $('#related_id').val(),
        },
        add: function (e, data) {
            $('.nav-tabs a[data-target="#tab2Media"]').tab('show');
            data.context = $('<div/>').addClass('col-md-3 media-previe-wrap').prependTo('#mediaList');
            $.each(data.files, function (index, file) {
                var node = $('<p/>').addClass('media-upload-preview');
                progressBar.clone().appendTo(node);
                node.appendTo(data.context);
            });
            data.submit();
        },
        progress: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            if (data.context) {
                data.context.each(function () {
                    $(this).find('.progress').attr('aria-valuenow', progress).children().first().css('width',progress + '%').text(progress + '%');
                });
            }
        },
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                if (file.url) {
                    var extra_attr = $('#holder_attr').val();
                    var link = $('<img>')
                            .prop('src', file.url).attr('id', file.id).attr('data-extra-attr', extra_attr)
                            .attr('data-original-src', file.original_file).attr('data-type', file.type);
                    var html = '<div class="thumbnail text-center">';
                        html +='<img src="'+file.url+'" id="'+file.id+'" data-extra-attr="'+extra_attr+'" data-original-src="'+file.original_file+'" data-type="'+file.type+'" style="width:200px;" />';
                        html +='</div>';
                    $(data.context.children()[index]).replaceWith(html);

                    var popType = $('#popupType').val();
                    if(popType == 'single_image')
                    {
                        $('.imgChked').each(function(i, e) {
                            $(this).removeClass('imgChked');
                        });
                    }

                    $('#'+file.id).imgCheckbox({preselect: true});
                                        
                } else if (file.error) {
                    var error = $('<span class="text-danger"/>').text(file.error);
                    $(data.context.children()[index])
                                              .append('<br>')
                                              .append(error);
                }
            });
        }
    });
}