# ChronoJournal App
This app uses CKeditor as a WTSIWYG editor
# To use this app follow are some steps:

# Step 1 -
Create a .env file and copy the .env.example data to .env and change the encryption key to your secret key and add your database url in DB_URI. Now

# Step 2 -
Run this command on your terminal
```console
php artisan serve
```
Or if you want to host it to your Wifi network, run this command in your terminal
```console
ipconfig
```
Here you will see something like this:
IPv4 Address. . . . . . . . . . . : 192.xxx.x.xxx
Copy the ip address and run this command on the terminal
```console
php artisan serve --host=YOUR_IP_ADDRESS_HERE
```

# Step 3 -
Go to the link: 
http://127.0.0.1:8000/
Here you can see the main page

### If you open the editor (/journal page) first time, Click on the refresh button on the navbar to activate the editor, Because at first time loading it doesn't works well, But you've to do it only once.
#### (Well it's a problem I know but i couldn't find the solution of it, If anyone finds the solution then please let me know)
# Thank you !   
