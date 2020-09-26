function showmodal(){
	alert
}
  function hidemodal(){
    document.getElementById('myModal').style.display='none';
  $('button').click(function(){
    $('input[type="email"]').val(' ');
    $('input[type="text"]').val(' ');
  });
  }

  function cltxt(){
  	document.getElementById('myModal').style.display='none';
	$('button').click(function(){
		$('input[type="text"]').val(' ');
	});
	}

  //expand|collapse user data
  var coll = document.getElementsByClassName("collapsible");
  var i;
  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var content = this.nextElementSibling;
      if (content.style.maxHeight){
        content.style.maxHeight = null;
      } else {
        content.style.maxHeight = content.scrollHeight + "px";
      } 
    });
  }

  //USER DELETE ALERT
  $(document).ready(function(){
    $("button.del_alert").click(function(e){
      if(!confirm('Anda akan menghapus data')){
        e.preventDefault();
        return false;
      }return true;
    });
  });