$(document).ready(function(){
	//check admin password correct or not
	$('#current_pwd').keyup(function(){
		var current_pwd = $('#current_pwd').val();
		// alert(current_pwd);
		$.ajax({
			type:'post',
			url:'/admin/check-current-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				if (resp == 'false') {
					$('#chkCurrentPwd').html('<font color="red">Current password is not correct</font>');
				}else{
					$('#chkCurrentPwd').html('<font color="green">Current password is  correct</font>');
				}
			},
			error:function(){
				alert('error');
			}
		});
	});
});