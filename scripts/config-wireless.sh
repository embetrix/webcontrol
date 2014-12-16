#!/bin/sh

WIFI_CONFIG="/var/lib/connman/wifi.config"

sed -i "s/Name = .*/Name = $1/g" $WIFI_CONFIG
sed -i "s/Security = .*/Security = $2/g" $WIFI_CONFIG
sed -i "s/Passphrase = .*/Passphrase = $3/g" $WIFI_CONFIG

exit 0
