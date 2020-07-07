<!DOCTYPE html>
<html lang = "EN">
<head>
    <title>CSE330 Module 5 Calendar</title>
    <link href="calendardesign.css" rel="stylesheet" type="text/css">
    <script src="newuser.js"></script>
    <script src="loginuser.js"></script>
</head>
<body>

    <div id = "login_page">
    <h1>Tommy and Rob Calendar</h1>
    <form>
        Username:
        <input type = "text" name = "login" id = "userfield" required><br>
        <input type = "hidden" name = "register" value = "user"><br>
        Password:
        <input type = "password" name = "password" id = "passfield" required><br>
        <br>
        <input type = "button" class = "open-button" value = "Login" id = "loginbutton" onclick="loginFunction('user');">
    </form>
    <br>
    <!-- <form action = "newuser.html">
        <input type = "submit" value = "Create New User" id = "newuserbutton">
    </form> -->
    <input type = "button" value = "Create New User" class = "open-button" id = "nubutton" onclick="nuFunction();">

    <br><br>
        <input type = "button" value = "Continue Without Logging In" class = "open-button" id = "nuloginbutton" onclick="loginFunction('nonuser');">
    </div>
    <div id = "newuser_page">
    <h1>Create An Account</h1>
    <form class="">
      Username:
      <input type="text" name="username" id="username" required><br><br>
      Password:
      <input type="password" name="password1" id="password1" required><br><br>
      Confirm Password:
      <input type="password" name="password2" id="password2" required><br><br>
      <input type="button" name="Create Account" class = "open-button" value="Create Account" onclick="createAccount();">
    </form>
    </div>


	<div id = "calendar_page">
    <h1>
        Tommy and Rob Calendar
    </h1>
    <h2 id = "monthtitle">
        MONTH
    </h2>
    <table>
        <tr>
            <th class = "cul">
                SUNDAY
            </th>
            <th class = "cul">
                MONDAY
            </th>
            <th class = "cul">
                TUESDAY
            </th>
            <th class = "cul">
                WEDNESDAY
            </th>
            <th class = "cul">
                THURSDAY
            </th>
            <th class = "cul">
                FRIDAY
            </th>
            <th class = "cul">
                SATURDAY
            </th>
        </tr>
        <tr>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
        </tr>
        <tr id = "sixth">
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
            <td class = "day">
                <div class = "date">
                    <div class = "number">
                        1
                    </div>
                    <div class = "events">
                        <ul class="elist"></ul>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <br>
    <div class = "bottom">
        <div class ="buttons">
            <button class = "open-button" value = "Previous Month" id = "prev_month_btn">Previous Month </button>
        </div>
        <div class ="buttons" id = "add_btn">
            <button class="open-button1"  onclick="openEvent()">Add Event</button>
        </div>
        <div class ="buttons" id = "man_btn">
            <button class="open-button1"  onclick="toggleEventManagement()">Event Management</button>
        </div>
        <div class ="buttons">
            <button class = "open-button" value = "Next Month" id = "next_month_btn">Next Month</button>
        </div>
        <div class ="buttons">
            <form action="callogout.php" class ="open-button"  method="POST">
                <input type="submit" class = "open-button" value="Logout">
            </form>
            <!-- <button class = "open-button" value="Logout" onclick="calLogout()">Logout</button> -->
        </div>
    </div>
    </div>

    <div class = "eventform" id = "addEvent">
            <h1>Add Event</h1>
        <form  class="form-container">        
            <label for="eventname"><b>Event Name</b></label>
            <input type="text" placeholder="Enter Event Name" name="eventname" id="ename" required><br><br>

            <label for="year"><b>Year</b></label>
            <input type="number" oninput="this.value=(parseInt(this.value)); if (this.value.length > 4) { this.value = this.value.slice(0,4); }" placeholder="Enter Event Year" name="year" id="year" required><br><br>

            <label for="month"><b>Month</b></label>
            <input type="number" oninput="this.value=(parseInt(this.value)); if (this.value.length > 2) { this.value = this.value.slice(0,2); }" placeholder="Enter Event Month" name="month" id ="month" required><br><br>

            <label for="day"><b>Day</b></label>
            <input type="number" oninput="this.value=(parseInt(this.value)); if (this.value.length > 2) { this.value = this.value.slice(0,2); }" placeholder="Enter Event Day" name="day" id="day" required><br><br>

            <label for="hour"><b>Hour</b></label>
            <input type="number" oninput="this.value=(parseInt(this.value)); if (this.value.length > 2) { this.value = this.value.slice(0,2); }" placeholder="Enter Event Hour" name="hour" id="hour" required><br><br>

            <label for="minute"><b>Minute</b></label>
            <input type="number" oninput="this.value=(parseInt(this.value)); if (this.value.length > 2) { this.value = this.value.slice(0,2); }" placeholder="Enter Event Minute" name="minute" id="minute" required><br><br>
            
            <label for="ampm"><b>AM or PM?</b></label>
            <input type="radio" name="ampm" value="AM" id="AM">
            <label for="AM">AM</label> 
            <input type="radio" name="ampm" value="PM" id="PM">
            <label for="PM">PM</label><br><br>

            <label for="tag"><b>Text Color</b></label>
            <input type="radio" name="tag" value="B" id="black">
            <label for="black">Black</label> 
            <input type="radio" name="tag" value="P" id="purple">
            <label for="purple">Purple</label> 
            <input type="radio" name="tag" value="R" id="red">
            <label for="red">Red</label><br><br>
            
            <label for="pub"><b>Public Event?</b></label>
            <input type="radio" name="pub" value="false" id="false">
            <label for="false">Not Public</label> 
            <input type="radio" name="pub" value="true" id="true">
            <label for="true">Public</label><br>

            <br>
            <div class = "popupbuttons">
                    <button type="button" class="btn" id = "schedule" onclick="scheduleEvent();">Schedule Event</button>
                    <button type="button" class="btn" onclick="closeEvent();">Close</button>
            </div>
            
            </form>
    </div>

    <div class = "modeventform" id = "modEvent">
            <h1>Edit Event</h1>
        <form  class="form-container">        
            <label for="eventname"><b>Event Name</b></label>
            <input type="text" placeholder="Enter Event Name" name="eventname" id="enameM" required><br><br>

            <label for="year"><b>Year</b></label>
            <input type="number" oninput="this.value=(parseInt(this.value)); if (this.value.length > 4) { this.value = this.value.slice(0,4); }" placeholder="Enter Event Year" name="year" id="yearM" required><br><br>

            <label for="month"><b>Month</b></label>
            <input type="number" oninput="this.value=(parseInt(this.value)); if (this.value.length > 2) { this.value = this.value.slice(0,2); }" placeholder="Enter Event Month" name="month" id ="monthM" required><br><br>

            <label for="day"><b>Day</b></label>
            <input type="number" oninput="this.value=(parseInt(this.value)); if (this.value.length > 2) { this.value = this.value.slice(0,2); }" placeholder="Enter Event Day" name="day" id="dayM" required><br><br>

            <label for="hour"><b>Hour</b></label>
            <input type="number" oninput="this.value=(parseInt(this.value)); if (this.value.length > 2) { this.value = this.value.slice(0,2); }" placeholder="Enter Event Hour" name="hour" id="hourM" required><br><br>

            <label for="minute"><b>Minute</b></label>
            <input type="number" oninput="this.value=(parseInt(this.value)); if (this.value.length > 2) { this.value = this.value.slice(0,2); }" placeholder="Enter Event Minute" name="minute" id="minuteM" required><br><br>
            
            <label for="ampm"><b>AM or PM?</b></label>
            <input type="radio" name="ampmM" value="AM" id="AMM">
            <label for="AM">AM</label> 
            <input type="radio" name="ampmM" value="PM" id="PMM">
            <label for="PM">PM</label><br><br>
 
            <!-- <label for="tag"><b>Tag</b></label>
            <input type="text" placeholder="Enter Event Tag" name="tag" id ="tagM" required><br><br> -->

            <label for="tag"><b>Text Culor</b></label>
            <input type="radio" name="tagM" value="B" id="blackM">
            <label for="black">Black</label> 
            <input type="radio" name="tagM" value="P" id="purpleM">
            <label for="purple">Purple</label> 
            <input type="radio" name="tagM" value="R" id="redM">
            <label for="red">Red</label><br><br>
            
            <label for="pub"><b>Public Event?</b></label>
            <input type="radio" name="pubM" value="false" id="falseM">
            <label for="false">Not Public</label> 
            <input type="radio" name="pubM" value="true" id="trueM">
            <label for="true">Public</label><br>

            <br>
            <div class = "popupbuttons">
                    <button type="button" class="btn" id = "mod_btn">Modify Event</button>
                    <button type="button" class="btn" onclick="closeEvent2();">Close</button>
            </div>
            
            </form>
    </div>


    <div class = "eventform1" id = "addEvent1">
        <h1>Event Mananger</h1>
        
        <div id = "listsect1">

        </div>
        <form  class="form-container">
            <br>
            <div class = "popupbuttons">
                    <button type="button" class="btn" onclick="closeEvent1();">Close</button>
            </div>
        
        </form>
    </div>

    <div class = "eventform1" id = "userList">
        <h1>List of Users To Share With</h1>
                    
                    <div id = "listsect2">

                    </div>
            <form  class="form-container">
                <br>
                <div class = "popupbuttons">
                        <button type="button" class="btn" onclick="closeUserModal();">Close</button>
                </div>
        </form>
    </div>
    
    

    <script src="calendarpopulate.js"></script>
    <script src="calendarJavascript.js"></script>

</body>
</html>