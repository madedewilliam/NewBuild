/*
* JS For Operations
* */
$(document).ready(function(){

    //Login Authentication
    $(document).on("click", ".login_submit", function () {
        var username = $('#username').val();
        var user_password = $('#userpassword').val();
        if(username != '' && user_password != ''){
            var values = {username:username, user_password:user_password, type: "SIGN_IN"};
            $('.modal-title').empty();
            $('.modal-title').append('Logging In...');
            $('.modal-body').empty();
            $('.modal-body').append('<div align="center"><img src="assets/img/loader.gif" height="50px" width="50px"/></div>');
            $('#infoModal').modal('show');
            $.post("./ajax/maintenance.php", values, function (data) {
                if(data == 1){
                    location = 'dashboard';
                }else{
                    $('.modal-body').empty();
                    $('.modal-body').append(data);
                    return false;
                };
            });
        };
        return false;
    });

    //Login Using Enter Button
    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            $(".login_submit").click();
        };
    });

    //Add New Item
    $(document).on("click", ".add_item_btn", function () {
        var item_name = $('#item_name').val();
        var item_code = $('#item_code').val();
        var item_quantity = $('#item_quantity').val();
        var item_description = $('#item_description').val();

        if(item_name != '' && item_code != '' && item_quantity != '' && item_description != ''){
            $('.modal-title').empty();
            $('.modal-title').append("Adding: "+item_name);
            $('#infoModal').modal('show');
            var values = {item_name:item_name, item_code:item_code, item_quantity:item_quantity, item_description:item_description, type: "ADD"};
            $('.modal-body').empty();
            $('.modal-body').append('<div align="center"><img src="assets/img/loader.gif" height="50px" width="50px"/></div>');
            $.post("ajax/maintenance.php", values, function (data) {
                if(data == 1){
                    $('.modal-body').empty();
                    $('.modal-body').append(item_name+" was successfully added.");
                    $('#infoModal').on('hidden.bs.modal', function () {
                        location.reload();
                    });
                }else{
                    $('.modal-body').empty();
                    $('.modal-body').append(data);
                };
            });
        };
    });

    //Update Existing Item
    $(document).on("click", ".edit_item", function () {
        var uid = $(this).attr('uid');
        var i_name = $(this).attr('i_name');
        var i_code = $(this).attr('i_code');
        var i_qty = $(this).attr('i_qty');
        var i_descr = $(this).attr('i_descr');

        $('.modal-title').empty();
        $('.modal-title').append("Updating: "+i_name);
        $('.modal-body').empty();
        $('.modal-body').append("<table align='center' class='table table-hover table-center'>\n" +
            "<tr><td>Item Name</td><td><input id='i_name' type='text' class='form-control' value='"+i_name+"'/> <input type='hidden' id='record_id' value='"+uid+"'/></td></tr>\n" +
            "<tr><td>Item Code</td><td><input id='i_code' type='text' class='form-control' value='"+i_code+"'/></td></tr>\n" +
            "<tr><td>Item Quantity</td><td><input id='i_qty' type='text' class='form-control' value='"+i_qty+"'/></td></tr>\n" +
            "<tr><td>Item Description</td><td><textarea id='i_descr' type='text' class='form-control'>"+i_descr+"</textarea></td></tr>\n" +
            "<tr><td colspan='2'><input style='width: 100%' type='button' class='btn btn-info update_btn' value='Update'/></td></tr></table>");
        $('#infoModal').modal('show');
    });

    //Update Button Click
    $(document).on("click", ".update_btn", function () {
        var uid = $('#record_id').val();
        var i_name = $('#i_name').val();
        var i_code = $('#i_code').val();
        var i_qty = $('#i_qty').val();
        var i_descr = $('#i_descr').val();

        if(uid != '' && i_name != '' && i_code != '' && i_qty != '' && i_descr != ''){
            var values = {uid:uid, i_name:i_name, i_code:i_code, i_qty:i_qty, i_descr:i_descr, type: "UPDATE"};
            $('.modal-body').empty();
            $('.modal-body').append('<div align="center"><img src="assets/img/loader.gif" height="50px" width="50px"/></div>');
            $.post("ajax/maintenance.php", values, function (data) {
                if(data == 1){
                    $('.modal-body').empty();
                    $('.modal-body').append(i_name+" was successfully updated.");
                    $('#infoModal').on('hidden.bs.modal', function () {
                        location.reload();
                    });
                }else{
                    $('.modal-body').empty();
                    $('.modal-body').append(data);
                };
            });
        };
    });

    //Deleting Item
    $(document).on("click", ".remove_item", function () {
        var uid = $(this).attr('uid');
        var i_name = $(this).attr('i_name');

        if(uid != '' && i_name != ''){
            $('.modal-title').empty();
            $('.modal-title').append("Deleting: "+i_name);
            $('#infoModal').modal('show');
            var values = {uid:uid, type: "DELETE"};
            $('.modal-body').empty();
            $('.modal-body').append('<div align="center"><img src="assets/img/loader.gif" height="50px" width="50px"/></div>');
            $.post("ajax/maintenance.php", values, function (data) {
                if(data == 1){
                    $('.modal-body').empty();
                    $('.modal-body').append(i_name+" was successfully deleted.");
                    $('#infoModal').on('hidden.bs.modal', function () {
                        location.reload();
                    });
                }else{
                    $('.modal-body').empty();
                    $('.modal-body').append(data);
                };
            });
        };
    });
});