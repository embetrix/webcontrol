#!/bin/sh

VPN_DIR="/etc/openvpn"

ln -sf ${VPN_DIR}/configs/$1 ${VPN_DIR}/openvpn.conf

echo "$2" >  ${VPN_DIR}/login.pem
echo "$3" >> ${VPN_DIR}/login.pem

systemctl restart openvpn

exit 0
