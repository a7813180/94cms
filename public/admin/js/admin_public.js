function submitTo(url,func,extra){
	switch(func){
		case 'add':
			add(url);
			break;
		case 'edit':
			edit(url);
			break;
		default:
			break;
	}
}
function edit(url){
        $.layer({
        type: 2,
		shift: 'top', //���϶�������
        border: [0], //����ʾ�߿�
        maxmin: true,
        title: ['�༭', 'border:none; background:#3b95c8; color:#fff;' ],
        area: ['500px', '450px'],
        iframe: {src: url},
		end: function(index){
	     window.setTimeout("window.location='<?php echo $this->module_url('');?>'",2000); 
        }
    })
	
 
}