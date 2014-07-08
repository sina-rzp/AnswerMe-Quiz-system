/*Index*/
function validate_login()
{
	var username= document.getElementById("uname").value;
	var password=document.getElementById("pwd").value;
	var message ="";
	
	var flag=0;
	var errordiv=document.getElementById('errordiv');
	if (username=="") 
		{
		message += "<p>Username Missing</p>";
		flag=1;  
		}

	if (password=="") 
		{
		message += "<p>Password Missing</p>";
		flag=1;  
		}
	if (flag==1)
	{
		errordiv.innerHTML= message;
		return false;
	}
	else
	{
	return true;
	}
}

function validate_quiz()
{
	var errordiv=document.getElementById('errordiv');
	var required= document.getElementById("q_required").value;
	var message ="";

	var obj = document.getElementsById('obj_question[]');
	var sub = document.getElementsById('sub_question[]');

    var objlen = document.getElementsByName('sub_question[]').length;
    var sublen = document.getElementsByName('obj_question[]').length;
    var count = 0;

    for(i=0;i<objlen;i++)
    {
         if(obj[i].checked)
         {
        	count++;
         }
    }
    for(i=0;i<sublen;i++)
    {
         if(sub[i].checked)
         {
        	count++;
         }
    }


    if (count!==required)
    {
    	message += "<p>Invalid Selection</p>";
		flag=1;
    }

    if (flag==1)
	{
		errordiv.innerHTML= message;
		return false;
	}
	else
	{
		return true;
	}
	

}


/* Admin Create User Form*/
function validate_user()
{
	var name= document.getElementById("name").value;
	var password= document.getElementById("password").value;
	var email= document.getElementById("email").value;
	var mod_check= document.getElementById("modcheck").value;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var message ="";
	var flag=0;
	
	var errordiv=document.getElementById('errordiv');
	
	if (name=="")
	{
		message += "<p>Name Missing</p>";
		flag=1;
	}
	
	if (password=="")
	{
		message += "<p>Password Missing</p>";
		flag=1;
	}
	
	if (email=="")
	{
		message += "<p>Email Missing</p>";
		flag=1;
	}
	
	if(email!=="" && reg.test(email) == false)
	{
		message += "<p>Wrong Email Format</p>";
		flag=1;
	}
	
	var chk = document.getElementsByName('module[]');
    var len = chk.length;
    var flag1=0;

    for(i=0;i<len;i++)
    {
         if(chk[i].checked)
         {
        	flag1=1;
          }
    }
    
    if (flag1!==1)
    {
    	message += "<p>Module not selected</p>";
    	flag=1;
    }
    
	
	if (flag==1)
	{
		errordiv.innerHTML= message;
		return false;
	}
	else
	{
		return true;
	}
}

/* Admin Update Module*/
function validate_updatemodule()
{

	var module_name= document.getElementById("modname").value;
	var message ="";
	var flag=0;
	
	var errordiv=document.getElementById('errordiv');
	
	if (module_name=="")
	{
		message += "<p>Module Name Missing</p>";
		flag=1;
	}
	
	if (flag==1)
	{
		errordiv.innerHTML= message;
		return false;
	}
	else
	{
		return true;
	}
}


/* Admin Update User Form*/
function validate_updateuser()
{
	var name= document.getElementById("name").value;
	var email= document.getElementById("email").value;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var message ="";
	var flag=0;
	
	var errordiv=document.getElementById('errordiv');
	
	if (name=="")
	{
		message += "<p>Name Missing</p>";
		flag=1;
	}
	
	if (email=="")
	{
		message += "<p>Email Missing</p>";
		flag=1;
	}
	
	if(email!=="" && reg.test(email) == false)
	{
		message += "<p>Wrong Email Format</p>";
		flag=1;
	}
	
	if (flag==1)
	{
		errordiv.innerHTML= message;
		return false;
	}
	else
	{
		return true;
	}
}

/* Admin Manage Module*/
function validate_modulename()
{
	var module_name= document.getElementById("modulename").value;
	var message ="";
	var flag=0;
	
	var errordiv=document.getElementById('errordiv');
	
	if (module_name=="")
	{
		message += "<p>Module Name Missing</p>";
		flag=1;
	}
	
	if (flag==1)
	{
		errordiv.innerHTML= message;
		return false;
	}
	else
	{
		return true;
	}
}

/* Lecturer Create Quiz*/
function validate_createquiz()
{
	var quiz_title= document.getElementById("quiztitle").value;
	var question_needed= document.getElementById("question-needed").value;
	var time= document.getElementById("time").value;
	var message ="";
	var flag=0;
	
	var errordiv=document.getElementById('errordiv');
	
	if (quiz_title=="")
	{
		message += "<p>Quiz Title Missing</p>";
		flag=1;
	}
	
	if (question_needed=="")
	{
		message += "<p>Number of Questions Missing</p>";
		flag=1;
	}

	if (isNaN(question_needed) && question_needed!=="")
	{
		message += "<p>Please Enter Numbers Only</p>";
		flag=1;
	}
	
	if (time=="")
	{
		message += "<p>Time Given Missing</p>";
		flag=1;
	}

	if (isNaN(time) && time!=="")
	{
		message += "<p>Please Enter Numbers Only</p>";
		flag=1;
	}
	
	if (flag==1)
	{
		errordiv.innerHTML= message;
		return false;
	}
	else
	{
		return true;
	}
}

/* Lecturer Create Topic*/
function validate_createtopic()
{
	var topic= document.getElementById("topic").value;
	var message ="";
	var flag=0;
	
	var errordiv=document.getElementById('errordiv');
	
	if (topic=="")
	{
		message += "<p>Topic Name Missing</p>";
		flag=1;
	}
	
	if (flag==1)
	{
		errordiv.innerHTML= message;
		return false;
	}
	else
	{
		return true;
	}
}

/* Lecturer Add Manual Objective*/
function validate_manualobj()
{
	var question= document.getElementById("qtext").value;
	var ansa= document.getElementById("ansa").value;
	var ansb= document.getElementById("ansb").value;
	var ansc= document.getElementById("ansc").value;
	var ansd= document.getElementById("ansd").value;
	var correct_answer= document.getElementById("correctanswer").value;
	var message ="";
	var flag=0;
	
	var errordiv=document.getElementById('errordiv');
	
	if (question=="")
	{
		message += "<p>Question Text Missing</p>";
		flag=1;
	}
	
	if (ansa=="")
	{
		message += "<p>Answer A Missing</p>";
		flag=1;
	}
	
	if (ansb=="")
	{
		message += "<p>Answer B Missing</p>";
		flag=1;
	}
	
	if (ansc=="")
	{
		message += "<p>Answer C Missing</p>";
		flag=1;
	}
	
	if (ansd=="")
	{
		message += "<p>Answer D Missing</p>";
		flag=1;
	}
	
	if (correct_answer=="")
	{
		message += "<p>Correct Answer Missing</p>";
		flag=1;
	}
	
	if (correct_answer!==ansa&&correct_answer!=ansb&&correct_answer!=ansc&&correct_answer!=ansd)
	{
		message += "<p>Correct Answer Error</p>";
		flag=1;
	}
	
	if (flag==1)
	{
		errordiv.innerHTML= message;
		return false;
	}
	else
	{
		return true;
	}
}

/* Lecturer Add Manual Subjective*/
function validate_manualsubj()
{
	var question= document.getElementById("question").value;
	var value= document.getElementById("value").value;
	var message ="";
	var flag=0;
	
	var errordiv=document.getElementById('errordiv');
	
	if (question=="")
	{
		message += "<p>Question Text Missing</p>";
		flag=1;
	}
	
	if (value=="")
	{
		message += "<p>Mark for question Missing</p>";
		flag=1;
	}
	
	if (flag==1)
	{
		errordiv.innerHTML= message;
		return false;
	}
	else
	{
		return true;
	}
}

/* Lecture Upload Question*/
function validate_upload()
{

	var file_name= document.getElementById("file").value;
	var message ="";
	var flag=0;
	
	var errordiv=document.getElementById('errordiv');
	
	if (file_name=="")
	{
		message += "<p>Please choose a file</p>";
		flag=1;
	}
	
	if (flag==1)
	{
		errordiv.innerHTML= message;
		return false;
	}
	else
	{
		return true;
	}
}

/* Lecture Edit Quiz*/
function validate_editquiz()
{
	var quiztitle= document.getElementById("quiztitle").value;
	var question_needed= document.getElementById("question-needed").value;
	var time= document.getElementById("time").value;
	var message ="";
	var flag=0;
	
	var errordiv=document.getElementById('errordiv');
	
	if (quiztitle=="")
	{
		message += "<p>Quiz Title Missing</p>";
		flag=1;
	}

	if (question_needed=="")
	{
		message += "<p>Number of Question Missing</p>";
		flag=1;
	}

	if (isNaN(question_needed) && question_needed!=="")
	{
		message += "<p>Please Enter Numbers Only</p>";
		flag=1;
	}
	
	if (time=="")
	{
		message += "<p>Time Given Missing</p>";
		flag=1;
	}

	if (isNaN(time) && time!=="")
	{
		message += "<p>Please Enter Numbers Only</p>";
		flag=1;
	}

	if (flag==1)
	{
		errordiv.innerHTML= message;
		return false;
	}
	else
	{
		return true;
	}
}

/*Student & Lecturer Edit Profile*/
function validate_profile()
{
	var password = document.getElementById("password").value;
	var confirm_password = document.getElementById("confirmpassword").value;
	var email = document.getElementById("email").value;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var message ="";
	var flag=0;
	
	var errordiv=document.getElementById('errordiv');
	
	if (password=="")
	{
		message += "<p>Password Missing</p>";
		flag=1;
	}
	
	if (confirm_password=="")
	{
		message += "<p>Confirm Password Missing</p>";
		flag=1; 
	}
	
	if (password !== confirm_password)
	{
		message += "<p>Password Mismatch</p>";
		flag=1; 
	}
	
	if (email=="")
	{
		message += "<p>Email Missing</p>";
		flag=1; 
	}
	
	if(email!=="" && reg.test(email) == false)
	{
		message += "<p>Wrong Email Format</p>";
		flag=1;
	}
	
	if (flag==1)
	{
		errordiv.innerHTML= message;
		return false;
	}
	else
	{
		return true;
	}
}