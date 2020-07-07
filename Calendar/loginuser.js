function loginFunction(status){
  if(status == "user")
  {
    const username = document.getElementById("userfield").value;
    const password = document.getElementById("passfield").value;
  
    console.log(username);
    console.log(password);
  
    const data = { 'username': username, 'password': password };
    fetch("loginuser.php", {
      method: 'POST',
      body: JSON.stringify(data),
      headers: { 'content-type': 'application/json' }
    })
    .then(response => response.json())
    .then(data => isSuccessful(data))
    .catch(data => console.log("ERROR: " + data));
  }
  else
  {
    document.getElementById("login_page").style.display = "none";
    document.getElementById("calendar_page").style.display = "block";
    document.getElementById('add_btn').style.display = 'none';
    document.getElementById('man_btn').style.display = 'none';
    console.log("IM IN");
  }
}


function isSuccessful(data){
  if(data.success){
    //window.location.href = "calendarone.php";
    document.getElementById("login_page").style.display = "none";
    document.getElementById("calendar_page").style.display = "block";
    document.getElementById('add_btn').style.display = 'block';
    document.getElementById('man_btn').style.display = 'block';
    updateCalendar();
  }else{
    alert(data.message);
  }
  console.log(data.message);
}