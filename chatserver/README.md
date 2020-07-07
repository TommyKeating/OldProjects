# CSE330
Robert Vitali: 457235

Tommy Keating: 457556

We give no login information for this module, there exist no default user with any powers like previous modules had.
No url is required in the ReadME either since server will be run by grader.

Creative Portion

What We Implemented:
1. Hashing passwords when creating and entering a chatroom
2. Swear word check to block messages as well as usernames with swear words
3. Poking other users
4. LogOut Feature
5. LogIn and LogOut Announcements

How We Implemented:
1. Using a form of encryption, when creating a room for the first time (server side), the password entered by the user is hashed and saved. We also check when a user is trying to join a password protected chatroom if the password is correct (comparing to saved hash password).
2. We wanted to use some packages after seeing the head TA's video that he posted on piazza about how many pre existing functions exist for Node.js. We found a swear word package that allows us to check to see if a user's message contains profanity and if true, we send a message in the chat saying the message was not allowed. We also implemented this functionality where if a username contains profanity, the user is not allowed to use that username.
3. Using alert messages and checking to see if the user is the desired poke.
4. Logging out by removing the user from the users list by finding the location in the array and using the splice function. 
5. Broadcasting whenever a new user signs on or logs off using an alert to all users.


Why We Implemented:
1. We had previously dealt with hashing passwords in a previous lab and thought that if we are going to be storing a password server side, we should be protecting how they are stored.
2. Trying to make the chat app the most realistic possible, swear words in public places usually are blocked on the internet. We also wanted to gain exposure to using packages implemented by other users, as that is one of the benefits of Node.js over other programming platforms.
3. We implemented this because it reminded us of what Facebook had and is a similar feature to pinging users to get their attention in other common chat apps.
4. In order to let a user leave and rejoin we made logging out possible via a button.
5. To notify users of the site of who is and is not online like other platforms do.
