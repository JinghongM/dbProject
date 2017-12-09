<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<script type="text/javascript">
function checkEmail(theForm) {
    if (theForm.EMAIL_1.value != theForm.EMAIL_2.value)
    {
        alert('Those emails don\'t match!');
        return false;
    } else {
        return true;
    }
}
//-->
</script> 




<form action="../" onsubmit="return checkEmail(this);">
<p> Enter Your Email Address:<br>
<input type="TEXT" name="EMAIL_1" size="20" maxlength="20"> 
<br>
Please Confirm Your Email Address:
<br>
<input type="TEXT" name="EMAIL_2" size="20" maxlength="20"> 
<br>
<input type="SUBMIT" value="Send Address!"></p> 
</form>	
</body>
</html>
