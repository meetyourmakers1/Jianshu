var editor = new wangEditor('content');

if(editor.config){
    editor.config.uploadImgUrl = '/posts/imageupload';

    editor.config.uploadHeaders = {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    };

    editor.create();
}
$.ajaxSetup({
    headers : {
        'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
    }
});
$(".like-button").click(function(event){
    var target = $(event.target);
    var current_button = target.attr('like-value');
    var user_id =target.attr('like-user');
    if(current_button == 1){
        //取消关注
        $.ajax({
            url : "/user/unfan/"+user_id,
            method : "POST",
            dateType : "json",
            success : function(data){
                if(data.error != 0){
                    alert(data.message+'操作失败!');
                    return ;
                }
                target.attr('like_value',0);
                target.text('关注');
            }
        })
    }else{
        //关注
        $.ajax({
            url : "/user/fan/"+user_id,
            method : "POST",
            dateType : "json",
            success : function(data){
                if(data.error != 0){
                    alert(data.message+'操作失败!');
                    return ;
                }
                target.attr('like_value',1);
                target.text('取消关注');
            }
        })
    }
});