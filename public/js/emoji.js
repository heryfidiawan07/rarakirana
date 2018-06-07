$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  //Get Users Vote - Modal
  $('.caretVotes').on('click',function(){
    var mid = $(this).attr('data-mid');
    var pid = $(this).attr('data-pid');
    var link  = $(this).attr('data-url');
    $.ajax({
        type: 'GET',
        url : link,
        data:  {mid:mid,pid:pid},
        success : function(data){
          $('#userVote_'+mid).text(data.likes.length);
          for (var i = 0; i < data.likes.length; i++) {
            if (data.likes[i].user_id != null) {
              //console.log(data.users[i].name);
              $('.userVote_'+mid).append('<a href="/user/'+data.users[i].slug+'" class="usersModalVote users_'+data.users[i].id+'"></a>')
              if (data.users[i].img == null) {
                $('<img src="https://www.gravatar.com/avatar/'+md5(data.users[i].email)+'?d=mm&s=50" class="img-circle" id="img_'+data.users[i].id+'" alt="" width="30">').appendTo('.users_'+data.users[i].id);  
              }else{
                $('<img src="/users/'+data.users[i].img+'" class="img-circle" id="img_'+data.users[i].id+'" alt="" width="30">').appendTo('.users_'+data.users[i].id);
              }
              $('#img_'+data.users[i].id).after('<b>'+data.users[i].name+'</b>');
            }
          }
        },error : function(data){
          //console.log('error');
        }
    });
    $('#usersvote_'+mid).on('hidden.bs.modal', function (e) {
      $('.usersModalVote').remove();
    });

  });

});