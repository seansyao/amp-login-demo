$(document).ready(function () {
	
	let password = "";
	
	//set all flags for validation
	let valid_username = false;
	let valid_first_name = false;
	let valid_last_name = false;
	let valid_email = true;
	let valid_password = false;
	let password_match = false;
	let pswd_length = false;
	let pswd_has_num = false;
	let pswd_has_lcl = false;
	let pswd_has_ucl = false;
	
	//regular expresssions for checking the password strength
	let numbers = new RegExp('[0-9]');
	let lower_case= new RegExp('[a-z]');
	let upper_case= new RegExp('[A-Z]');
	
	let password_content= 	"<div class='password_req_1'><span class='password_req_1'>&#10004;</span> At least 8 characters</div>" +
							"<div class='password_req_2'><span class='password_req_2'>&#10004;</span> At least 1 number</div>" +
							"<div class='password_req_3'><span class='password_req_3'>&#10004;</span> At least 1 lower case letter</div>" + 
							"<div class='password_req_4'><span class='password_req_4'>&#10004;</span> At least 1 upper case letter</div>";
    
	//Popup bubble for password requirements
    $("input.password").tooltip({
        items: 'input',
        content: password_content,
        position: { my: "left+15 center", at: "right center" }
    }).unbind('mouseenter mouseleave mouseover mouseout');
    
    //input box tracking password on each key in
    $("input.password").on('input', function() {
    	validate_password();
    });
    
    //validate on click
    $("input.password").focus(function() {
    	validate_password();
    });
    
    $("input[name*='username']").on('input', function() {
    	let username = $("input[name*='username']").val();
    	if(username.length > 0) {
    		valid_username = true;
    	}
    	else {
    		valid_username = false;
    	}
    	
    	validate_inputs();
    });
    
    $("input[name*='first_name']").on('input', function() {
    	let first_name = $("input[name*='first_name']").val();
    	if(first_name.length > 0) {
    		valid_first_name = true;
    	}
    	else {
    		valid_first_name = false;
    	}
    	
    	validate_inputs();
    });
    
    $("input[name*='last_name']").on('input', function() {
    	let last_name = $("input[name*='last_name']").val();
    	if(last_name.length > 0) {
    		valid_last_name = true;
    	}
    	else {
    		valid_last_name = false;
    	}
    	
    	validate_inputs();
    });
    
    $("input[name*='password_2']").on('input', function() {
    	let password_2 = $("input[name*='password_2']").val();
    	if(password_2 == password) {
    		password_match = true;
    	}
    	else {
    		password_match = false;
    	}
    	
    	validate_inputs();
    });
    
    function validate_password() {
    	password = $("input.password").val();
    	
    	//check for 8 charact length
    	if(password.length > 7) {
    		$("span.password_req_1").css('color','green');
    		pswd_length = true;
    	}
    	else {
    		$("span.password_req_1").css('color','#E0E0E0;');
    		pswd_length = false;
    	}
    	
    	//check for number
    	if(password.match(numbers)) {
    		$("span.password_req_2").css('color','green');
    		pswd_has_num = true;
    	}
    	else {
    		$("span.password_req_2").css('color','#E0E0E0;');
    		pswd_has_num = false;
    	}
    	
    	//check for lower case
    	if(password.match(lower_case)) {
    		$("span.password_req_3").css('color','green');
    		pswd_has_lcl = true;
    	}
    	else {
    		$("span.password_req_3").css('color','#E0E0E0;');
    		pswd_has_lcl = false;
    	}
    	
    	//check for upper case
    	if(password.match(upper_case)) {
    		$("span.password_req_4").css('color','green');
    		pswd_has_ucl = true;
    	}
    	else {
    		$("span.password_req_4").css('color','#E0E0E0;');
    		pswd_has_ucl = false;
    	}
    	
    	//set valid_password boolean
    	if(pswd_length && pswd_has_num && pswd_has_lcl && pswd_has_ucl){
    		valid_password = true;
    	}
    	else {
    		valid_password = false;
    	}
    	
    	//check for password match with password_2
    	let password_2 = $("input[name*='password_2']").val();
    	if(password_2 == password) {
    		password_match = true;
    	}
    	else {
    		password_match = false;
    	}
    	
    	validate_inputs();
    }
    
    //check all inputs and enable/disalbe the register button
    function validate_inputs() {
    	if(valid_username && valid_first_name && valid_last_name && valid_email && valid_password && password_match){
    		$("button.register_button").prop("disabled", false);
    	}
    	else {
    		$("button.register_button").prop("disabled", true);
    	}
    }
});