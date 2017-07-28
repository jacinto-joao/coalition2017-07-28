$(document).ready(function(){
	$('form').validator();

	let $modal = $('#ajax-modal');

	$(document).on('click', '[data-toggle="ajax-modal"]',function(e){
		e.preventDefault();

		$('#myModal').hide();
        let url = $(this).attr('href');

        if(url.indexOf('#') === 0){
        	$('#mainModal').modal('open');
        }else{
        	$.get(url, function(data) {
                $modal.modal();
                $modal.html(data);
                $('form').validator().on('submit', function (e) {
                    if (e.isDefaultPrevented()) {
                        return false;
                    }});
            });
        }
	});
	$(document).on('submit', '.ajax-submit', function(e){
        e.preventDefault();
        let $form = $(this),$modal = $form.closest('.modal-dialog'),$modalBody = $form.find('.modal-body');
        $modalBody.find('.alert-danger').remove();
        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: $form.attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend : function(){
                $modal.addClass('spinner');
            },
            success : function(data){
                if(data.redirectTo){
                    $modal.close();   
                    nodeChilds(data.redirectTo);
                }else{
                  window.location.reload();  
              }
              
          },
          error : function(jqXhr, json, errorThrown){
            let errors = jqXhr.responseJSON;
            let errorStr = '';
            $.each( errors, function( key, value ) {
                $('input[name="'+key+'"]').parents('.form-group').addClass("has-error");
                errorStr += '- ' + value[0] + '<br/>';
            });
            let errorsHtml= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + errorStr + '</div>';
            $modalBody.prepend(errorsHtml);
        },
        complete : function(){
            $modal.removeClass('spinner');
        }
    });

    });
});

