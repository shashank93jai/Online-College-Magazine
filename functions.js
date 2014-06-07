function validate_register()
{
    var name=document.getElementById('reg_name').value;
    var roll=document.getElementById('reg_roll').value;
    var email=document.getElementById('reg_email').value;
    var pass=document.getElementById('reg_pass').value;
    var rpass=document.getElementById('reg_rpass').value;
    var rsec=document.getElementById('reg_sec').value;
    var rans=document.getElementById('reg_ans').value;
 //   var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var filter = /^([0-9]){9}@nitt\.edu$/;
    var filter1= /^([0-9]){9}$/;
    x=1;
    if(name==null || name=="")
    {
        document.getElementById('name_error').innerHTML='Name compulsory';
        x=0;
    }
    else
    {
        document.getElementById('name_error').innerHTML='';
    }
    if(email==null || email=="")
    {
        document.getElementById('email_error').innerHTML='Email compulsory';
        x=0;
    }
    else if (!filter.test(email))
    {
        document.getElementById('email_error').innerHTML='Enter valid Email address';
        x=0;
    }
    else
    {
        document.getElementById('email_error').innerHTML='';
    }
    if(roll==null || roll=="")
    {
        document.getElementById('roll_error').innerHTML='RollNo compulsory';
        x=0;
    }
    else if(!filter1.test(roll))
    {
        document.getElementById('roll_error').innerHTML='Enter valid Roll num';
        x=0;
    }
    else
    {
        document.getElementById('roll_error').innerHTML='';
    }
    if(pass==null || pass=="")
    {
        document.getElementById('pass_error').innerHTML='Password compulsory';
        x=0;
    }
    else
    {
        document.getElementById('pass_error').innerHTML='';
    }
    if(rpass==null || rpass=="")
    {
        document.getElementById('rpass_error').innerHTML='Reenter Password';
        x=0;
    }
    else if(pass!=null && pass!="" && pass!=rpass)
    {
        document.getElementById('rpass_error').innerHTML='Passwords must match';
        x=0;
    }
    else
    {
        document.getElementById('rpass_error').innerHTML='';
    }
    if(x==0)
        return false;
    else
    {
        var xmlhttp;
        if (window.XMLHttpRequest)
        {
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                if(xmlhttp.responseText=="Login Successful")
                {
                    window.location="index.php";
                }
                else
                    document.getElementById("notification").innerHTML=xmlhttp.responseText;
            }
        }
        var parameters="roll="+roll+"&pass="+pass+"&name="+name+"&email="+email+"&rsec="+rsec+"&rans="+rans;
        xmlhttp.open("POST","register.php",true);
        xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        xmlhttp.send(parameters);

    }
}

function validate_login()
{
    var roll=document.getElementById('login_roll').value;
    var filter1= /^([0-9]){9}$/;
    var pass=document.getElementById('login_pass').value;
    x=1;
    if(roll=="" || roll==null)
    {
        document.getElementById('login_err').innerHTML="Please fill in the required details";
        x=0;
    }
    else if(!filter1.test(roll))
    {
        document.getElementById('login_err').innerHTML='Enter valid Roll num';
        x=0;
    }
    if(pass=="" || pass==null)
    {
        document.getElementById('login_err').innerHTML="Please fill in the required details";
        x=0;
    }
    if(x==1)
    {
        var xmlhttp;
        if (window.XMLHttpRequest)
        {
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                if(xmlhttp.responseText=="Login Successful")
                {
                    window.location="index.php";
                }
                else
                    document.getElementById("login_err").innerHTML=xmlhttp.responseText;
            }
        }
        var parameters="roll="+roll+"&pass="+pass;
        xmlhttp.open("POST","login.php",true);
        xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        xmlhttp.send(parameters);
    }

}
function changeRating(articleID,n,old)
{

	var e=document.getElementById('rating'+articleID);
	var val=e.options[e.selectedIndex].value;
    document.getElementById('button'+articleID).onclick=function(){ changeRating(articleID,0,val);}	
		var xmlhttp;
        if (window.XMLHttpRequest)
        {
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
				document.getElementById("checkRated"+articleID).innerHTML=xmlhttp.responseText;
            }
        }
        if(n==1)
        {
            xmlhttp.open("GET","insertRating.php?articleID="+articleID+"&rating="+val+"&old="+old,true);
        }
        else if(n==0)
        {
			xmlhttp.open("GET","updateRating.php?articleID="+articleID+"&rating="+val+"&old="+old,true);
		}
        xmlhttp.send();

}
function disp_confirm()
{
    var c=confirm('Are you sure');
    if(c==true)return true;
    else return false;
}
