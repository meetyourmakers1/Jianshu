$.ajaxSetup({
    headers : {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//文章审核
$('.post-audit').click(function (event) {
    target = $(event.target);
    var post_id = target.attr('post-id');
    var status = target.attr('post-action-status');

    $.ajax({
        url : '/admin/posts/check/'+post_id,
        method : 'POST',
        data : {'status' : status},
        dataType : 'json',
        success : function(data){
            if(data.error != 0){
                alert(data.message);
                return;
            }
            target.parent().parent().remove();
        }
    });
});
//删除专题
$('.resource-delete').click(function (event) {
    if(confirm('确定执行删除专题嘛?') == false){
        return ;
    }
    target = $(event.target);
    event.preventDefault();
    var url = target.attr('delete-url');

    $.ajax({
        url : url,
        method : 'POST',
        data : {'_method' : 'DELETE'},
        dataType : 'json',
        success : function(data){
            if(data.error != 0){
                alert(data.message);
                return;
            }
            window.location.reload();
        }
    });
});