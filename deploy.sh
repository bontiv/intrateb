#! /bin/sh
sudo su -c "rm -rf /srv/http/src && cp -R * /srv/http/src && chown -R http /srv/http/src"
exit 0
