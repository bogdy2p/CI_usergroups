<IfModule mod_rewrite.c>
RewriteEngine on

RewriteBase /user_ci/

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

RewriteCond %{REQUEST_URI} ^system.*
RewriteRule ^(.*)$ /index.php?/$1 [L]

RewriteCond %{REQUEST_URI} ^application.*
RewriteRule ^(.*)$ /index.php?/$1 [L]

RewriteRule .* index.php?$0 [PT,L]
RewriteRule ^(.*)$ index.php?/$1 [L]
</IfModule>
<IfModule !mod_rewrite.c>
ErrorDocument 404 /index.php
</IfModule>







