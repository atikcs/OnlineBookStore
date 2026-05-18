function validateRegister()
{
let name=
document.forms["regForm"]["name"].value.trim();

let email=
document.forms["regForm"]["email"].value.trim();

let password=
document.forms["regForm"]["password"].value;

let phone=
document.forms["regForm"]["phone"].value.trim();


if(name=="")
{
alert("Name required");
return false;
}

if(email=="")
{
alert("Email required");
return false;
}

let emailPattern=
/^[^\s@]+@[^\s@]+\.[^\s@]+$/;

if(!emailPattern.test(email))
{
alert("Invalid Email");
return false;
}

if(password.length<8)
{
alert(
"Password must be at least 8 characters"
);

return false;
}

if(phone.length<11)
{
alert(
"Phone number invalid"
);

return false;
}

return true;

}