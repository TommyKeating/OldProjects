/* * * * * * * * * * * * * * * * * * * *\
 *               Module 4              *
 *      Calendar Helper Functions      *
 *                                     *
 *        by Shane Carr '15 (TA)       *
 *  Washington University in St. Louis *
 *    Department of Computer Science   *
 *               CSE 330S              *
 *                                     *
 *      Last Update: October 2017      *
\* * * * * * * * * * * * * * * * * * * */

/*  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

(function () {
	"use strict";

	/* Date.prototype.deltaDays(n)
	 * 
	 * Returns a Date object n days in the future.
	 */
	Date.prototype.deltaDays = function (n) {
		// relies on the Date object to automatically wrap between months for us
		return new Date(this.getFullYear(), this.getMonth(), this.getDate() + n);
	};

	/* Date.prototype.getSunday()
	 * 
	 * Returns the Sunday nearest in the past to this date (inclusive)
	 */
	Date.prototype.getSunday = function () {
		return this.deltaDays(-1 * this.getDay());
	};
}());

/** Week
 * 
 * Represents a week.
 * 
 * Functions (Methods):
 *	.nextWeek() returns a Week object sequentially in the future
 *	.prevWeek() returns a Week object sequentially in the past
 *	.contains(date) returns true if this week's sunday is the same
 *		as date's sunday; false otherwise
 *	.getDates() returns an Array containing 7 Date objects, each representing
 *		one of the seven days in this month
 */
function Week(initial_d) {
	"use strict";

	this.sunday = initial_d.getSunday();
		
	
	this.nextWeek = function () {
		return new Week(this.sunday.deltaDays(7));
	};
	
	this.prevWeek = function () {
		return new Week(this.sunday.deltaDays(-7));
	};
	
	this.contains = function (d) {
		return (this.sunday.valueOf() === d.getSunday().valueOf());
	};
	
	this.getDates = function () {
		let dates = [];
		for(let i=0; i<7; i++){
			dates.push(this.sunday.deltaDays(i));
		}
		return dates;
	};
}

/** Month
 * 
 * Represents a month.
 * 
 * Properties:
 *	.year == the year associated with the month
 *	.month == the month number (January = 0)
 * 
 * Functions (Methods):
 *	.nextMonth() returns a Month object sequentially in the future
 *	.prevMonth() returns a Month object sequentially in the past
 *	.getDateObject(d) returns a Date object representing the date
 *		d in the month
 *	.getWeeks() returns an Array containing all weeks spanned by the
 *		month; the weeks are represented as Week objects
 */
function Month(year, month) {
	"use strict";
	
	this.year = year;
	this.month = month;
	
	this.nextMonth = function () {
		return new Month( year + Math.floor((month+1)/12), (month+1) % 12);
	};
	
	this.prevMonth = function () {
		return new Month( year + Math.floor((month-1)/12), (month+11) % 12);
	};
	
	this.getDateObject = function(d) {
		return new Date(this.year, this.month, d);
	};
	
	this.getWeeks = function () {
		let firstDay = this.getDateObject(1);
		let lastDay = this.nextMonth().getDateObject(0);
		
		let weeks = [];
		let currweek = new Week(firstDay);
		weeks.push(currweek);
		while(!currweek.contains(lastDay)){
			currweek = currweek.nextWeek();
			weeks.push(currweek);
		}
		
		return weeks;
	};
}









let currentMonth = new Month(2019, 9); 
let eventsArr = [];
updateCalendar();

// event listener to go forward a month
document.getElementById("next_month_btn").addEventListener("click", function(event){
	currentMonth = currentMonth.nextMonth(); 
	updateCalendar(); 
}, false);

//event listener to go back a month
document.getElementById("prev_month_btn").addEventListener("click", function(event){
	currentMonth = currentMonth.prevMonth(); // Previous month would be currentMonth.prevMonth()
	updateCalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML
	//alert("The new month is "+currentMonth.month+" "+currentMonth.year);
}, false);

//button involved in creating an event
document.getElementById("schedule").addEventListener("click", function(event){
	setTimeout(updateCalendar, 100);
}, false);



//update calendar populates the table with the correct days, days of the week as well as events (using a helper function)
function updateCalendar(){
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	document.getElementById("monthtitle").innerHTML = monthNames[currentMonth.month] + " " + currentMonth.year;
    let weeks = currentMonth.getWeeks();
	let calNums = document.getElementsByClassName("number");
	let calScroll = document.getElementsByClassName("elist");
	let calPointer = 0;
	const tempMonth = currentMonth.month;

	if(weeks.length <= 5){
		document.getElementById("sixth").style.display = "none";
	}else{
		document.getElementById("sixth").style.display = "";
	}
	
	for(let w in weeks){
		let days = weeks[w].getDates();
		for(let d in days){
            calScroll[calPointer].innerHTML = "";
			if(days[d].getMonth() == tempMonth){
				getEventsFromDB((currentMonth.month + 1), days[d].getDate(), currentMonth.year, calPointer);
				calNums[calPointer].innerHTML = days[d].getDate();
				calNums[calPointer].style.display = "";
			}
			else{
				calNums[calPointer].style.display = "none";
			}
			calPointer++;
        }
    }
}

//this gets a specific date from the database and helps the previous function populate it into the table
function getEventsFromDB(month, day, year, calPointer){
    const data = { 'month': month, 'day': day, 'year': year };
    fetch("getevents.php", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'content-type': 'application/json' }
    })
	.then(response => response.json())
	.then(response => setEventsArr(response, calPointer));
}

//helper function that when the response is returned from database, it customizes the event and adds some css before insertion into the table
function setEventsArr(response, calPointer){
	let calScroll = document.getElementsByClassName("elist");
	if(response.success){
		for(let i = 0; i < response.data.length; i++){
            let entry = document.createElement('li');
            let color_of_text = response.data[i][3];
            if(color_of_text == "R"){
                entry.style.cssText = "color:red";
            }else if(color_of_text == "P"){
                entry.style.cssText = "color:purple";
            }
            
			let datetimeObj = new Date(response.data[i][2]);
			let time = datetimeObj.toLocaleTimeString('en-US');
			//time = dateTime.ToString("HH:");
			entry.appendChild(document.createTextNode("[" + time + "] " + response.data[i][1]));
			calScroll[calPointer].appendChild(entry);
		}
	}
}


// to share event with another user
function eShare(event_id, user_id)
{
    const myNode = document.getElementById("listsect1");
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
    
    let eventID = event_id;
    let userID = user_id;

	const data1 = { 'event_id': eventID, userID};
            fetch("shareevent.php", {
                method: 'POST',
                body: JSON.stringify(data1),
                headers: { 'content-type': 'application/json' }
            })
            .then(response => response.json())
            .catch(error => console.error('Error:' + error));
    document.getElementById("userList").style.display = "none";
}

//called to modify an existing event
function eChange(event_id)
{
    document.getElementById("addEvent1").style.display = "none";
    let eventID = event_id;
    
	const data1 = { 'event_id': eventID};
            fetch("editevent.php", {
                method: 'POST',
                body: JSON.stringify(data1),
                headers: { 'content-type': 'application/json' }
            })
            .then(response => response.json())
            .then(response => setmodal(response))
            .catch(error => console.error('Error:' + error));
     document.getElementById("modEvent").style.display = "block";
}


let event_ID_M = 0;
//shows the modal for the changing of events, populates the modal with the event's current values
function setmodal(response)
{
    event_ID_M = response.message[0];
    document.getElementById("mod_btn").addEventListener("click", modalBTN, false);

    document.getElementById('enameM').value = response.message[1];

    if(response.message[3] == "B"){
        document.getElementsByName("tagM")[0].checked = true;
    }else if(response.message[3] == "P"){
        document.getElementsByName("tagM")[1].checked = true;
    }else{
        document.getElementsByName("tagM")[2].checked = true;
    }

    if(response.message[4] == 0)
    {
        document.getElementById('falseM').checked = true;
    }
    else
    {
        document.getElementById('trueM').checked = true;
    }

    let year = response.message[2].substring(0, 4);
    let month = response.message[2].substring(5, 7);
    let day = response.message[2].substring(8, 10);
    let hour = response.message[2].substring(11, 13);
    let minute = response.message[2].substring(14, 16);

    let yearN = parseInt(year);
    let monthN = parseInt(month);
    let dayN = parseInt(day);
    let hourN = parseInt(hour);
    let minuteN = parseInt(minute);

    if(hourN >= 12)
    {
        document.getElementById('PMM').checked = true;
    }
    else
    {
        document.getElementById('AMM').checked = true;
    }

    if(hourN > 12){
        document.getElementById('hourM').value = hourN - 12;
    }else if(hourN == 0){
        document.getElementById('hourM').value = hourN + 12;
    }
    else{
        document.getElementById('hourM').value = hourN;
    }



    document.getElementById('yearM').value = yearN;
    document.getElementById('monthM').value = monthN;
    document.getElementById('dayM').value = dayN;
    document.getElementById('minuteM').value = minuteN;

    
}

//function that is helping modify an event
function modalBTN(){
    
        document.getElementById("modEvent").style.display = "none";

        let ename = document.getElementById("enameM").value;
        let month = document.getElementById("monthM").value;
        let year = parseInt(document.getElementById("yearM").value);
        let day = parseInt(document.getElementById("dayM").value);
        let minute = parseInt(document.getElementById("minuteM").value);
        let hrval = document.getElementById("hourM").value;

        if((ename != "") && (month != "") && (year != null) && (day != null) && (minute != null) && (hrval != null) && (document.getElementsByName("ampmM")[0].checked || document.getElementsByName("ampmM")[1].checked) && ( document.getElementsByName("pubM")[0].checked || document.getElementsByName("pubM")[1].checked) && ( document.getElementsByName("tagM")[0].checked || document.getElementsByName("tagM")[1].checked || document.getElementsByName("tagM")[2].checked))
        {
            let ampm_pointers = document.getElementsByName("ampmM");
            let amORpm = null;
            let hour = parseInt(document.getElementById("hourM").value);
            
            for(let i=0; i<ampm_pointers.length; i++)
            {
                if(ampm_pointers[i].checked)
                {
                    amORpm = i;
                    break;
                }
            }
            if(amORpm == 1)
            {
                if(hour == 12)
                {
                    hour = parseInt(document.getElementById("hourM").value);
                }
                else
                {
                    hour = parseInt(document.getElementById("hourM").value) - 12;
                }
                document.getElementById('PMM').checked = true;
            }
            else
            {
                if(hour == 0)
                {
                    hour = 12;
                }
                else
                {
                    hour = parseInt(document.getElementById("hourM").value);
                }
                document.getElementById('AMM').checked = true;
            }
            let pub_pointers = document.getElementsByName("pubM");
            let pubstatus = null;
            let pub = null;
            
            for(let i=0; i<pub_pointers.length; i++)
            {
                if(pub_pointers[i].checked)
                {
                      pubstatus = pub_pointers[i].value;
                    break;
                }
            }
            if(pubstatus == "true")
            {
                pub = 1;
            }
            else
            {
                pub = 0;
            }
            ///////////
            let tagger_pointers = document.getElementsByName("tagM");
            let tagstatus = null;
            let tag = null;
            
            for(let i=0; i<tagger_pointers.length; i++)
            {
                if(tagger_pointers[i].checked)
                {
                    tagstatus = tagger_pointers[i].value;
                    break;
                }
            }
            if(tagstatus == "R")
            {
                tag = "R";
            }
            else if(tagstatus == "B")
            {
                tag = "B";
            }
            else
            {
                tag = "P";
            }
            ///////////

            if(day < 10)
            {
                day = "0" + day;
            }
            if(month < 10)
            {
                month = "0" + month;
            }
            if(minute < 10)
            {
                minute = "0" + minute;
            }
            if(hour < 10)
            {
                hour = "0" + hour;
            }


            let datime = year + "-" + month + "-" + day + " " + hour + ":" + minute + ":00";

            
            event_ID_M = parseInt(event_ID_M);

            const data2 = { 'event_identification': event_ID_M, 'event_name': ename, 'event_date': datime, 'event_tag': tag, 'event_ispub': pub };
            fetch("modevent.php", {
                method: 'POST',
                body: JSON.stringify(data2),
                headers: { 'content-type': 'application/json' }
            })
            .then(response => response.json())
            //.then(response => console.log(response.message))
            //.then(setTimeout(updateCalendar, 300))
            .catch(error => console.error('Error:' + error));
            setTimeout(updateCalendar, 100);
            document.getElementById("modEvent").style.display = "none";
            const myNode = document.getElementById("listsect1");
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
            document.getElementById("addEvent1").style.display = "none";
        }
}


//function called to delete an event based on the event id
function eDelete(event_id)
{
	const data1 = { 'event_id': event_id};
            fetch("deleteevent.php", {
                method: 'POST',
                body: JSON.stringify(data1),
                headers: { 'content-type': 'application/json' }
            })
            .then(response => response.json())
			.catch(error => console.error('Error:' + error));  
			document.getElementById("addEvent1").style.display = "none";
            setTimeout(updateCalendar, 100);
            const myNode = document.getElementById("listsect1");
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
}


        //these functions below are used to set display to block or not visible
        function openEvent() 
        {
            document.getElementById("addEvent").style.display = "block";
        }
        function openEvent1() 
        {
            document.getElementById("addEvent1").style.display = "block";
        }
        function closeEvent() 
        {
            document.getElementById("addEvent").style.display = "none";
        }
        
        function closeEvent2() 
        {
            const myNode = document.getElementById("listsect1");
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
            document.getElementById("modEvent").style.display = "none";
        }
        function closeUserModal() 
        {
            document.getElementById("userList").style.display = "none";
        }



        //function that deals with creating an event
        function scheduleEvent()
        {
            let ename = document.getElementById("ename").value;
            let month = document.getElementById("month").value;
            let year = parseInt(document.getElementById("year").value);
            let day = parseInt(document.getElementById("day").value);
            let minute = parseInt(document.getElementById("minute").value);
            let hrval = document.getElementById("hour").value;

            if((ename != null) && (month != null) && (year != null) && (day != null) && (minute != null) && (hrval != null) && (document.getElementsByName("ampm")[0].checked || document.getElementsByName("ampm")[1].checked) && ( document.getElementsByName("pub")[0].checked || document.getElementsByName("pub")[1].checked) && ( document.getElementsByName("tag")[0].checked || document.getElementsByName("tag")[1].checked || document.getElementsByName("tag")[2].checked))
            {
                
                document.getElementById("addEvent").style.display = "none";
                let ampm_pointers = document.getElementsByName("ampm");
                let amORpm = null;
                let hour = parseInt(document.getElementById("hour").value);
                
                for(let i=0; i<ampm_pointers.length; i++)
                {
                    if(ampm_pointers[i].checked)
                    {
                          amORpm = i;
    			        break;
        		    }
    		    }
                if(amORpm == 1) //pm case
                {
                    if(hour == 12)
                    {
                        hour = parseInt(document.getElementById("hour").value);
                    }
                    else
                    {
                        hour = 12 + parseInt(document.getElementById("hour").value);
                    }
                }
                else
                {
                    if(hour == 12)
                    {
                        hour = 0;
                    }
                    else
                    {
                        hour = parseInt(document.getElementById("hour").value);
                    }
                }
                let pub_pointers = document.getElementsByName("pub");
                let pubstatus = null;
                let pub = null;
                
                for(let i=0; i<pub_pointers.length; i++)
                {
                    if(pub_pointers[i].checked)
                    {
  				        pubstatus = pub_pointers[i].value;
    			        break;
        		    }
    		    }
                if(pubstatus == "true")
                {
                    pub = 1;
                }
                else
                {
                    pub = 0;
                }
                
                //////
                let tagger_pointers = document.getElementsByName("tag");
                let tagstatus = null;
                let tag = null;
                
                for(let i=0; i<tagger_pointers.length; i++)
                {
                    if(tagger_pointers[i].checked)
                    {
                        tagstatus = tagger_pointers[i].value;
                        break;
                    }
                }
                if(tagstatus == "R")
                {
                    tag = "R";
                }
                else if(tagstatus == "B")
                {
                    tag = "B";
                }
                else
                {
                    tag = "P";
                }
                //////

                if(day < 10)
                {
                    day = "0" + day;
                }
                if(month < 10)
                {
                    month = "0" + month;
                }
                if(minute < 10)
                {
                    minute = "0" + minute;
                }
                if(hour < 10)
                {
                    hour = "0" + hour;
                }

                

                let datime1 = year + "-" + month + "-" + day + " " + hour + ":" + minute + ":00";

                const data1 = { 'ename': ename, 'datime': datime1, 'tag': tag, 'pub': pub };
                fetch("makeevent.php", {
                    method: 'POST',
                    body: JSON.stringify(data1),
                    headers: { 'content-type': 'application/json' }
                })
                .then(response => response.json())
                //.then(response => console.log(response.message))
                //.then(console.log("MAKE                                EVENT"))
                //.then(setTimeout(updateCalendar, 100))
                .catch(error => console.error('Error:' + error));
                
            }    
        }    