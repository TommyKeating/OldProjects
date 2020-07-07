let eID_GLOBAL = 0;

//function to help with sharing an event with another user
function eShare(user_id)
{
    let userID = user_id;

	const data1 = { 'event_id': eID_GLOBAL, 'user_id': userID };
            fetch("shareevent.php", {
                method: 'POST',
                body: JSON.stringify(data1),
                headers: { 'content-type': 'application/json' }
            })
            .then(response => response.json())
            .catch(error => console.error('Error:' + error));
    document.getElementById("userList").style.display = "none";
}

//send event id to be used for sharing functionality with another user
function sendEventID(eID){
    eID_GLOBAL = eID;
    document.getElementById('addEvent1').style.display = 'none';
    fetch("sharelist.php", {
        method: 'POST',
        headers: { 'content-type': 'application/json' }
    })
    .then(response => response.json())
	.then(response => createShareButtons(response));
    setTimeout(100);
    //document.getElementById("addEvent1").style.display = "block";
    document.getElementById('userList').style.display = 'block';
}

//takes the response of available users and helps populate a list of active users to share with
function createShareButtons(response)
{
    if(response.success){
        document.getElementById("listsect2").innerHTML = "";
        for(let i = 0; i < response.data.length; i++)
        {
            let entryE = document.createElement('div');
            entryE.appendChild(document.createTextNode(response.data[i][1] + ":  "));
            let button4 = document.createElement('BUTTON');
            button4.appendChild(document.createTextNode("Share With This User"));
            button4.addEventListener('click', function(event){eShare(response.data[i][0])});
            entryE.appendChild(button4);
            document.getElementById("listsect2").appendChild(entryE);
        }
	}
}

//toggle the event management modal
function toggleEventManagement() 
        {
            const myNode = document.getElementById("listsect1");
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }


            fetch("eventlist.php", {
                method: 'POST',
                headers: { 'content-type': 'application/json' }
            })
            .then(response => response.json())
	        .then(response => eventManagementHelper(response));
            setTimeout(100);
            document.getElementById("addEvent1").style.display = "block";
        }

//function that helps take in data for event management and display html in modal
function eventManagementHelper(response)
{
    if(response.success){
		for(let i = 0; i < response.data.length; i++){
            let eventer_ID = response.data[i][0];
			let entryE = document.createElement('div');
            entryE.appendChild(document.createTextNode("[" + response.data[i][2] + "] " + response.data[i][1]));
            let bre = document.createElement('br');
            entryE.appendChild(bre);
            let button1 = document.createElement('BUTTON');
            button1.appendChild(document.createTextNode("Edit Event"));
            //button1.onclick = function(){eChange(eventer_ID)};
            button1.addEventListener('click', function(){eChange(eventer_ID)});
            entryE.appendChild(button1);
            let button2 = document.createElement('BUTTON');
            button2.appendChild(document.createTextNode("Share Event"));
            //button2.onclick = function(){sendEventID(eventer_ID)};
            button2.addEventListener('click', function(event){sendEventID(eventer_ID)});
            entryE.appendChild(button2);
            let button3 = document.createElement('BUTTON');
            button3.appendChild(document.createTextNode("Delete Event"));
            //button3.onclick = function(){eDelete(eventer_ID)};
            button3.addEventListener('click', function(event){eDelete(eventer_ID)});
            entryE.appendChild(button3);
            document.getElementById("listsect1").appendChild(entryE);

		}
	}
}

//function run at beginning of website to check if a user is still authenticated
function checkSessionValid()
{
    fetch("checkloginstatus.php", {
        method: 'POST',
        headers: { 'content-type': 'application/json' }
    })
    .then(response => response.json())
    .then(response => checkUserID(response));
}

checkSessionValid();

//function to help session valid above and if valid response for a user id change display of elements
function checkUserID(response)
{
    if(response.UID)
    {
        document.getElementById("login_page").style.display = "none";
        document.getElementById("calendar_page").style.display = "block";
        document.getElementById('add_btn').style.display = 'block';
        document.getElementById('man_btn').style.display = 'block';
        updateCalendar();
    }
    else
    {
        fetch("callogout.php", {
            method: 'POST',
            headers: { 'content-type': 'application/json' }
        })
        .catch(error => console.error('Error:' + error));
    }
}

function closeEvent1() 
        {
            const myNode = document.getElementById("listsect1");
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
            document.getElementById("addEvent1").style.display = "none";
        }