echo "instalando LXD"
sudo apt-get install lxd -y

echo "loguin al grupo"
newgrp lxd

echo "Iniciando lxd..."
lxd init --auto

sleep 10

echo "Generando contenedor"
lxc launch ubuntu:20.04 web

sleep 10

echo "Instalando apache2"
lxc exec web -- apt-get install apache2 -y

echo "Reemplazando el index.html al contenedor"
lxc file push /vagrant/index.html web/var/www/html/index.html

echo "Reiniciando el servicio apache2"
lxc exec web -- systemctl restart apache2

echo "reenvio de puertos generado"
lxc config device add web myport80 proxy listen=tcp:192.168.100.2:5080 connect=tcp:127.0.0.1:80

