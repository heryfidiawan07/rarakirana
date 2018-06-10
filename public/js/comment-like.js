$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).on('click','.comlike',function(){
  	var id = $(this).attr('id');
  	var link  = $(this).attr('data-url');
  	$.ajax({
        type: 'POST',
        url : link,
        data:  {id:id},
        success : function(data){
          //console.log(data.prnlike.length);
          $('.comcount_'+id).before('<span class="animated bounceOutUp" style="position:absolute;">'+data.status+'</span>');
          $('.comcount_'+id).replaceWith('<span class="comcount_'+id+'" style="margin-left: 5px;">'+data.prnlike.length+'</span>');
        },error : function(data){
          //console.log('error');
        }
    });
  });
//Get Users Like - Modal
  $('.caretModal').on('click',function(){
    var id = $(this).attr('data-id');
    var link  = $(this).attr('data-url');
    $.ajax({
        type: 'GET',
        url : link,
        data:  {id:id},
        success : function(data){
          $('#userLike_'+id).text(data.likes.length+' Orang Menyukai');
          for (var i = 0; i < data.likes.length; i++) {
            if (data.likes[i].user_id != null) {
              //console.log(data.users[i].name);
              $('#userLikes_'+id).append('<a href="/user/'+data.users[i].slug+'" class="usersModal users_'+data.users[i].id+'"></a>')
              if (data.users[i].img != null) {
                $('<img src="/users/'+data.users[i].img+'" class="img-circle" id="img_'+data.users[i].id+'" alt="" width="30">').appendTo('.users_'+data.users[i].id);
              if (data.users[i].graph != null) {
                $('<img src="'data.users[i].graph'" class="img-circle" id="img_'+data.users[i].id+'" alt="" width="30">').appendTo('.users_'+data.users[i].id);
              }else{
                $('<img src="https://www.gravatar.com/avatar/'+md5(data.users[i].email)+'?d=mm&s=50" class="img-circle" id="img_'+data.users[i].id+'" alt="" width="30">').appendTo('.users_'+data.users[i].id);
              }
              $('#img_'+data.users[i].id).after('<b>'+data.users[i].name+'</b>');
            }else{
              //console.log('Pengunjung');
              $('#userLikes_'+id).append('<a class="usersModal users_'+i+'"></a>')
              $('<img src="/users/users.jpg" class="img-circle" id="img_'+i+'" alt="" width="30">').appendTo('.users_'+i);
              $('#img_'+i).after('<b>Pengunjung</b>');
            }
          }
        },error : function(data){
          //console.log('error');
        }
    });
    $('#userscommentlikes_'+id).on('hidden.bs.modal', function (e) {
      $('.usersModal').remove();
    });

  });

});