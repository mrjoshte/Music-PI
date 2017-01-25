# Music-PI
Welcome to your new Pi setup.
Both Pi's are configured to request the IPs that have been reserved for them.
The music Pi is requesting 192.168.220.144 and the info board is requesting 192.168.220.152.
 *Note: there is no guarantee that the Pi's will actually use these IP addresses.  More on what to do if they do not later.
The code for both projects is availible on GitHub under mavericksoftwareconsulting.  Both Pi's are connected to the repositories
and we hope to roll out future developments through the use of git.
 
Both Pi's are configured to start up when plugged in with no further configuration (unless the music Pi does not use its reserved IP).
The info board will be accessible via a web browser at 192.168.220.152:1337.  The admin page is accessible at 192.168.220.152:1337/admin.

Once you are logged in these can be changed.  The security question and answer can be changed here as well.
This page allows you to edit some of the basic display info on the board.  After you press "Submit" on any of the items the changes will take
affect instantly.  At this point, if the music Pi is not using the reserved IP address you may change it here.

The music Pi has a Now Playing page that is accessible at 192.168.220.144:6680/mopify/.  The admin page is accessible at
192.168.220.144/admin (If not displaying properly try logging in at 192.168.220.144/login).  The username and password for this are the same as the info board.
Currently there is no way to change these from the web portal, changes will need to be made by connecting directly to the MySQL database.
A Change Password feature will be coming in a future update.

The Pi's are both running Raspbian Jessie, a Debian distro adapted to run on the ARM architecture of the Pi.


Remote connections to the Pi's can be made using a SSH client such as PuTTY.

The info board is configured to start automatically and launch when the board is turned on.  The server is a Node.js server which starts on the system on port 1337.
Chromium will start in kiosk mode and automatically load the info board.  The board will kill the Node.js server at 6pm and the Pi will restart every morning at 7am.
This can be changed by editing the root user's crontab file with the command: crontab -e

Files for the server can be found in /home/pi/info/ This folder is also tied to the git repository for the project.
The JSON files within the ServerSide folder correspond to the data displayed on the board.  These values can be easily edited using the admin page.

The music system runs using the Mopidy mpd with the Mopidy-Spotify plugin to allow it to stream Spotify playlists.
It uses an edited version of the Mopify plugin for Mopidy to create the Now Playing page.
Controls over the music while the Mopidy service is running can be done by making an SSH connection to the Pi then using mpc.
Another way is to use a mpd client such as Auremo MPD Client.  The connection server is 192.168.240.30:6600.

The Now Playing page can be found at /usr/local/lib/python2.7/dist-packages/mopidy_mopify/static/min/
You will probably never have to touch the files contained here, but just so you know where it is.

The following info can be changed easily using the web portal or by editing the configuration files listed below.
Spotify username and password:
The Mopidy configuration file can be found at /root/.config/mopidy/mopidy.conf
This file contains in the [Spotify] section the username and password currently used to sign into Spotify.

Playlist:
The file that controls starting the Mopidy service and playlist is located at /etc/init.d/randomshuffle.sh
This file contains the line: mpc load "<playlistName>"
Editing the value <playlistName> will change the playlist that is loaded.

Start and stop times:
The system automatically starts Mopidy at 8am and stops at 5pm and will restart the service should it die at any point between these times.
This is done using the root user's crontab and can be changed by editing this file.

Admin web portal:
All files can be found in the /var/www/ folder.  This file serves as the git repository for the project.
Additional files used for editing system files and executing system commands can be found in /root/

Changing the admin web portal username and password: (Note, feature not yet implemented on web portal)
The username and password for the admin web portal are stored in a MySQL database.  The database is named MY_DB and credentials to allow PHP to access it are stored in
the file /var/www/php/config.php  To edit the data stored in the database you will need to login to MySQL as root using the command: mysql -p -u root
Enter the following commands to change the username and password:
USE MY_DB;
UPDATE Passwords SET pass='<yourNewPassword>' WHERE user='admin';
exit;

Aliases:
The Now Playing page can display who added the song to the playlist.  The username is as it appears on Spotify, however, if the user's name does not match their real name,
the Spotify username will be displayed instead.  A file located in the root directory called spotifynames can be used to alias out usernames into the user's actual name.

Updates:
Since the projects are all tied to git, we hope to roll out future updates through the use of git.
When updates are availible, you will be notified to make a pull from the repository.  After that you may need to run an update script included in the repository to verify
that all files are in the correct location or make any setting changes to the system that may be necessary.

Questions, comments, concerns:
Please contact Scott Mueller
Email: S.Mueller@thomsonreuters.com
Skype: ams-scott.mueller
