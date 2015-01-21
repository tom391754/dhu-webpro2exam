$(function(){
	$("#btn-chat").click(function(){
		var msg=$("#btn-input").val();
		var room=$("#room").val();
		var time=new Date().format("yyyy-MM-dd hh:mm:ss");
		if(''==msg){
			alert('please input something.');
		}else{
			$.post('index.php/messages?action=insert',{room:room,content:msg,time:time},function(result){
				//alert(result);
				if('success'==result.trim()){
					var str="<li class=\"left clearfix\">"
							  +"<div class=\"chat-body clearfix\">"
								  +"<div class=\"header\">"
									  +"<small class=\"pull-right text-muted\">"
										+"  <span class=\"glyphicon glyphicon-time\"></span>"+time+"</small>"
									  +"</div>"
									  +"<p>"
										  +msg
									  +"</p>"
								  +"</div>"
							  +"</li>";
					$('.chat').append(str);
					$("#btn-input").val('');
					$("#btn-input").focus();
				}else{
					alert('error.');
				}
			});
		}
		
	});
	//getNewMsg();
	setInterval(getNewMsg,3000);
});

function getNewMsg(){
	var room=$("#room").val();
	var maxMsgID = $("#maxMsgID").val();
	//if(0 == maxMsgID) {
		$.post('index.php/messages?action=getAllMsg',{room:room},function(data){
			if('error.' != data){
				var obj = eval(data);
				var html = "";
				$.each(obj, function(i,item){     
					//alert(item.content+","+item.send_at);
					var str="<li class=\"left clearfix\">"
							  +"<div class=\"chat-body clearfix\">"
								  +"<div class=\"header\">"
									  +"<small class=\"pull-right text-muted\">"
										+"  <span class=\"glyphicon glyphicon-time\"></span>"+item.send_at+"</small>"
									  +"</div>"
									  +"<p>"
										  +item.content
									  +"</p>"
								  +"</div>"
							  +"</li>";
					
					html+=str;
					maxMsgID=item.id;
				});
				$('.chat').html(html);
				$("#maxMsgID").val(maxMsgID);
			}else{
				alert('error.');
			}
		});
	/*} else {
		$.post('index.php/messages?action=getNewMsg',{room:room,msgID:maxMsgID},function(data){
			if('error.' != data){
				var obj = eval(data);
				var html = "";
				$.each(obj, function(i,item){     
					//alert(item.content+","+item.send_at);
					var str="<li class=\"left clearfix\">"
							  +"<div class=\"chat-body clearfix\">"
								  +"<div class=\"header\">"
									  +"<small class=\"pull-right text-muted\">"
										+"  <span class=\"glyphicon glyphicon-time\"></span>"+item.send_at+"</small>"
									  +"</div>"
									  +"<p>"
										  +item.content
									  +"</p>"
								  +"</div>"
							  +"</li>";
					
					html+=str;
					maxMsgID=item.id;
				});
				$('.chat').append(html);
				$("#maxMsgID").val(maxMsgID);
			}else{
				alert('error.');
			}
		});
	}*/
}
Date.prototype.format = function(format) {
    /*
     * eg:format="yyyy-MM-dd hh:mm:ss";
     */
    var o = {
        "M+" :this.getMonth() + 1, // month
        "d+" :this.getDate(), // day
        "h+" :this.getHours(), // hour
        "m+" :this.getMinutes(), // minute
        "s+" :this.getSeconds(), // second
        "q+" :Math.floor((this.getMonth() + 3) / 3), // quarter
        "S" :this.getMilliseconds()
    // millisecond
    }
 
    if (/(y+)/.test(format)) {
        format = format.replace(RegExp.$1, (this.getFullYear() + "")
                .substr(4 - RegExp.$1.length));
    }
 
    for ( var k in o) {
        if (new RegExp("(" + k + ")").test(format)) {
            format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k]
                    : ("00" + o[k]).substr(("" + o[k]).length));
        }
    }
    return format;
}