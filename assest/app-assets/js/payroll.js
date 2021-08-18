// JavaScript Document


$(document).ready(function(){
	
	
    $('#modeofdeduction').on('change', function() {
      if ( this.value == 'Fixed')
      //.....................^.......
      {
		
        $("#formodeofdeduction").hide(0, function(){
          
			document.getElementById('errorMsg').innerHTML = '<div class="alert alert-info">Enter Amount in Employee Contribution or Employer Contribution</div>';
        });
		
   
        
      }
      if ( this.value == 'Calculated')
      {
       $("#formodeofdeduction").show(0, function(){
		   document.getElementById('errorMsg').innerHTML = '<div class="alert alert-info">Select Deduction Applied On. Then Enter Percentage of Employee Contribution or Employer Contribution</div>';
           
			
        });
		
      }
	 
 window.setTimeout(function () {
			$(".alert-info").fadeTo(400, 0).slideUp(400, function () {
				$(this).remove();
			});
		}, 5000);
    });
	
	$('#typeofdeduction').on('change', function() {
      if ( this.value == 'Regular')
      //.....................^.......
      {
		
        $("#fortypeofdeduction").hide(0, function(){
          
			document.getElementById('errorMsg').innerHTML = '<div class="alert alert-info">No date Selection for Regular type deduction</div>';
        });
		
   
        
      }
      if ( this.value == 'Temperary')
      {
       $("#fortypeofdeduction").show(0, function(){
		   document.getElementById('errorMsg').innerHTML = '<div class="alert alert-info">Select From Date, To date for Temperary type deduction</div>';
           
			
        });
		
      }
	 
window.setTimeout(function () {
			$(".alert-info").fadeTo(400, 0).slideUp(400, function () {
				$(this).remove();
			});
		}, 5000);
    });
	
	
});

function addempstrength(){
	var clientRate = document.getElementById('client_rate').value;
	var clientSt = document.getElementById('strength').value;
	
	if(clientRate && clientSt){
		document.getElementById('total').value=clientRate * clientSt;
		}
	//else{alert('Only Number allowed');}
}

function copyAddress(){
	
	var x = document.getElementById('copy').checked;
	
	if(x === true){
		document.emp.village.value = document.emp.p_village.value;
		document.emp.post.value		= document.emp.p_post.value;
		document.emp.police_station.value = document.emp.p_police_station.value;
		document.emp.dist.value = document.emp.p_dist.value;
		document.emp.t_state.value = document.emp.p_state.value;
		document.emp.pin.value = document.emp.p_pin.value;
		document.emp.t_mobile.value = document.emp.p_mobile.value;
		
		
	}
	else{
		document.emp.village.value = "";
		document.emp.post.value		= "";
		document.emp.police_station.value = "";
		document.emp.dist.value = "";
		document.emp.t_state.value = "";
		document.emp.pin.value = "";
		document.emp.t_mobile.value = "";
		}
	
}