server {
    listen 80;
    listen [::]:80;

    listen 443 ssl;
    listen [::]:443 ssl;
    include snippets/snakeoil.conf;

    server_name domain.com;
    root /var/www/domain.com;

    index index.php index.html index.htm;
    access_log  /var/log/nginx/maintenance.access.log;

    location / {
        # Adding the trailing slash
        rewrite ^([^.]*[^/])$ $1/ permanent;

        # Catch-all redirect
        rewrite ^ /index.php break;

        include snippets/fastcgi-php.conf;
    }

    location ~* ^.+\.(jpg|jpeg|gif|ico|png|svg|js|css|mp3|mp4|ogg|mpe?g|avi|txt|zip|gz|bz2?|rar|ttf|woff)$ {
        expires max;
        log_not_found off;
    }

    location ~ /\.ht {
        deny all;
    }
}
