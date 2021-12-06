var password = document.querySelector('#password');
var cpassword = document.querySelector('#cpassword');
var passworderror = document.querySelector('.passerror');
var pwd_match = document.querySelector('.pwd_match');

var regularExpression  = /^(?=.*[0-9])(?=.*[!@#$&*])[a-zA-Z0-9!@#$&*]{8,}$/;

password.addEventListener('keyup', function(){
	if(!regularExpression.test(password.value)){
		password.style.borderBottom = '2px solid red';
		passworderror.style.display = 'block';
	}else{password.style.borderBottom = '2px solid green';passworderror.style.display = 'none';}
});

cpassword.addEventListener('keyup', function(){
		if(password.value != cpassword.value){pwd_match.style.display = 'block';cpassword.style.borderBottom = '2px solid red';}
		else{pwd_match.style.display = 'none';cpassword.style.borderBottom = '2px solid green';submit.disabled = false;}
});
