var password = document.querySelector('#password');
var cpassword = document.querySelector('#cpassword');
var passworderror = document.querySelector('.passerror');
var pwd_match = document.querySelector('.pwd_match');
var btn = document.querySelector('#btndisable');
btn.style.display = 'none';
var pwd = document.querySelector('#pwd');
var cpwd = document.querySelector('#cpwd');

var regularExpression  = /^(?=.*[0-9])(?=.*[!@#$&*])[a-zA-Z0-9!@#$&*]{8,}$/;

password.addEventListener('keyup', function(){
	if(!regularExpression.test(password.value)){
		password.style.borderBottom = '2px solid red';
		passworderror.style.display = 'block';
	}else{password.style.borderBottom = '2px solid green';passworderror.style.display = 'none';}
});

cpassword.addEventListener('keyup', function(){
		if(password.value != cpassword.value){pwd_match.style.display = 'block';cpassword.style.borderBottom = '2px solid red';}
		else{pwd_match.style.display = 'none';cpassword.style.borderBottom = '2px solid green';btn.style.display = 'block';}
});

pwd.addEventListener('keyup', function(){
	if(!regularExpression.test(pwd.value)){
		pwd.style.borderBottom = '2px solid red';
		passworderror.style.display = 'block';
	}else{pwd.style.borderBottom = '2px solid green';passworderror.style.display = 'none';}
});

cpwd.addEventListener('keyup', function(){
		if(pwd.value != cpwd.value){pwd_match.style.display = 'block';cpwd.style.borderBottom = '2px solid red';}
		else{pwd_match.style.display = 'none';cpwd.style.borderBottom = '2px solid green';btn.style.display = 'block';}
});
