 $(document).ready(function(){
    $("#botaomenu1").click(function(){
      $('#f_editais').toggle();
      if($('#f_editais').is(':visible'))
      {
        $("#botaomenu").val('-');
	  }else{
		$("#botaomenu").val('+');
	  }
	  });
									});
								