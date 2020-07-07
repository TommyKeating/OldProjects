function createAccount(){
  console.log("CREATE ACCOUNT TRIGGERED");
  const username = document.getElementById("username").value;
  const password1 = document.getElementById("password1").value;
  const password2 = document.getElementById("password2").value;


  if(password1 != password2){
    alert("Passwords do not match. Please correct this issue.");
  }
  else{
    const data = { 'username': username, 'password': password1 };
    fetch("createuser.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(response => response.json())
        .then((data) => {
          isSuccessfulNU(data)
        });
  }
}


function isSuccessfulNU(data){
  if(data.success){
    //window.location.href = "calendarone.php";
    document.getElementById("newuser_page").style.display = "none";
    document.getElementById("login_page").style.display = "block";
  }else{
    alert(data.message);
  }
  console.log(data.message);
}

function nuFunction()
{
  document.getElementById("newuser_page").style.display = "block";
  document.getElementById("login_page").style.display = "none";
  document.getElementById("calendar_page").style.display = "none";
}