<article class="markdown-body entry-content container-lg" itemprop="text"><h1><a id="user-content-laraelearn" class="anchor" aria-hidden="true" href="#laraelearn"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.775 3.275a.75.75 0 001.06 1.06l1.25-1.25a2 2 0 112.83 2.83l-2.5 2.5a2 2 0 01-2.83 0 .75.75 0 00-1.06 1.06 3.5 3.5 0 004.95 0l2.5-2.5a3.5 3.5 0 00-4.95-4.95l-1.25 1.25zm-4.69 9.64a2 2 0 010-2.83l2.5-2.5a2 2 0 012.83 0 .75.75 0 001.06-1.06 3.5 3.5 0 00-4.95 0l-2.5 2.5a3.5 3.5 0 004.95 4.95l1.25-1.25a.75.75 0 00-1.06-1.06l-1.25 1.25a2 2 0 01-2.83 0z"></path></svg></a>LaraELearn</h1>
<p>AdminLTE x Laravel E-Learning System Script</p>
<p><a target="_blank" rel="noopener noreferrer" href="https://github.com/Abdurozzaq/LaraELearn/blob/master/admin-screenshoot-1368x793.png"><img src="https://github.com/Abdurozzaq/LaraELearn/raw/master/admin-screenshoot-1368x793.png" alt="Image of Yaktocat" style="max-width:100%;"></a></p>
<p>Features</p>
<p>User Roles
Admin, Teacher,
Student.</p>
<p>Basic Features</p>
<p>Authentication, Course/Mapel, Class/Kelas,
Upload Theory/Materi (Teacher),
See Theory/Materi based on Student Class and Course.</p>
<p>User Manager</p>
<p>Create Student, Manage Student Profile,
Create Teacher,
Manage Teacher Profile.</p>
<h1><a id="user-content-installation" class="anchor" aria-hidden="true" href="#installation"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.775 3.275a.75.75 0 001.06 1.06l1.25-1.25a2 2 0 112.83 2.83l-2.5 2.5a2 2 0 01-2.83 0 .75.75 0 00-1.06 1.06 3.5 3.5 0 004.95 0l2.5-2.5a3.5 3.5 0 00-4.95-4.95l-1.25 1.25zm-4.69 9.64a2 2 0 010-2.83l2.5-2.5a2 2 0 012.83 0 .75.75 0 001.06-1.06 3.5 3.5 0 00-4.95 0l-2.5 2.5a3.5 3.5 0 004.95 4.95l1.25-1.25a.75.75 0 00-1.06-1.06l-1.25 1.25a2 2 0 01-2.83 0z"></path></svg></a>Installation</h1>
<p>Create a Database Table in phpMyAdmin</p>
<p>Extract the LaraELearn Source Code that has been downloaded to a folder anywhere.</p>
<p>Open Code Editor → Terminal.</p>
<p>In Terminal, navigate to the extracted LaraELearn folder.
<code>$ cd LaraELearn</code></p>
<p>Enter these commands one by one (without the $ sign),</p>
<pre lang="$"><code>$ cp .env.example .env
$ php artisan key:generate
$ php artisan storage:link
</code></pre>
<p>Edit the .env file like this,</p>
<pre lang="DB_CONNECTION"><code>DB_HOST = 127.0.0.1 // change to Host your database
DB_PORT = 3306
DB_DATABASE = laraelearn // change to the name of the database table that you created
DB_USERNAME = root // change to be your database username, default root
DB_PASSWORD = ... // change to your databse password, null default 
</code></pre>
<p>Run this command for Seed :
<code>$ php artisan migrate --seed</code></p>
<p>Done <g-emoji class="g-emoji" alias="wink" fallback-src="https://github.githubassets.com/images/icons/emoji/unicode/1f609.png">😉</g-emoji>, to run LaraELearn enter the command below:
<code>$ php artisan serve</code></p>
<p>Then open the browser, and enter the url:
<code>http://localhost:8000</code></p>
<p>or if you want to run on another port, use the command:
<code>$ php artisan serve --port: 627 // e.g. the port is "627"</code></p>
<p>Thank you, Good Luck ... <g-emoji class="g-emoji" alias="grin" fallback-src="https://github.githubassets.com/images/icons/emoji/unicode/1f601.png">😁</g-emoji></p>
<h1><a id="user-content-export-to-pdf-feature" class="anchor" aria-hidden="true" href="#export-to-pdf-feature"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.775 3.275a.75.75 0 001.06 1.06l1.25-1.25a2 2 0 112.83 2.83l-2.5 2.5a2 2 0 01-2.83 0 .75.75 0 00-1.06 1.06 3.5 3.5 0 004.95 0l2.5-2.5a3.5 3.5 0 00-4.95-4.95l-1.25 1.25zm-4.69 9.64a2 2 0 010-2.83l2.5-2.5a2 2 0 012.83 0 .75.75 0 001.06-1.06 3.5 3.5 0 00-4.95 0l-2.5 2.5a3.5 3.5 0 004.95 4.95l1.25-1.25a.75.75 0 00-1.06-1.06l-1.25 1.25a2 2 0 01-2.83 0z"></path></svg></a>Export To PDF Feature</h1>
<p>LaraELearn is using Laravel Snappy for export Materi/Theory to PDF,
so for configuring LaraELearn for Laravel Snappy see <code>https://github.com/barryvdh/laravel-snappy</code></p>
<h1><a id="user-content-the-accounts-on-seeder" class="anchor" aria-hidden="true" href="#the-accounts-on-seeder"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.775 3.275a.75.75 0 001.06 1.06l1.25-1.25a2 2 0 112.83 2.83l-2.5 2.5a2 2 0 01-2.83 0 .75.75 0 00-1.06 1.06 3.5 3.5 0 004.95 0l2.5-2.5a3.5 3.5 0 00-4.95-4.95l-1.25 1.25zm-4.69 9.64a2 2 0 010-2.83l2.5-2.5a2 2 0 012.83 0 .75.75 0 001.06-1.06 3.5 3.5 0 00-4.95 0l-2.5 2.5a3.5 3.5 0 004.95 4.95l1.25-1.25a.75.75 0 00-1.06-1.06l-1.25 1.25a2 2 0 01-2.83 0z"></path></svg></a>The Accounts on seeder:</h1>
<p>Admin Account - Username: Okemin, Password: password</p>
<p>Teacher Account - Username: Teacher, Password: password</p>
<p>Student Account - Username: Student, Password: password</p>
<p>You can add new account from admin account.</p>
</article>
