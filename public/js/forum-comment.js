$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  //Textarea Comment Edit
  $(document).on('click','.comedit',function(){
    var comId = $(this).attr('data-id');
    //console.log(comId);
    $('.descom-'+comId).replaceWith(
      '<textarea rows="5" class="form-control descEdit-'+comId+'" name="description">'+$('.descom-'+comId).text()+'</textarea>'
      );
    $(this,'.comedito').replaceWith('<br><small class="pull-right btn btn-warning btn-xs comupdate-'+comId+'" data-id="'+comId+'" data-url="/comment/'+comId+'/thread/update"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> update</small>');
    var descEdit = $('.descEdit-'+comId).text();
    $('.comupdate-'+comId).on('click',function(){
      var description = $('.descEdit-'+comId).val();
      if (description.length < 1) {
        alert('Isi komentar tidak boleh kosong !');
      }else{
        $.ajax({
            type: 'POST',
            url : $('.comupdate-'+comId).attr('data-url'),
            data:  {id:comId, description:description},
            success : function(data, statusTxt, xhr){
              //console.log('Berhasil');
              function nl2br (str, is_xhtml) {   
                var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
                return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
              }
              $('.descEdit-'+comId).replaceWith('<div class="animated bounceInLeft descom descom-'+comId+'">'+nl2br(data.description)+'</div>');
              $('.comupdate-'+comId).replaceWith('<small class="pull-right btn btn-primary btn-xs comedit" data-id="'+comId+'"><span class="glyphicon glyphicon-edit"></span> edit</small>');
            },error : function(data, statusTxt, xhr){
              //console.log($('.comedit-'+comId).attr('data-url'));
            }
        });
      }
      
    });
  });

});