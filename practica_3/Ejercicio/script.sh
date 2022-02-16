echo "creando usuario local"
sudo useradd -p grivera grivera 

echo "instalando un servidor vsftpd"
sudo apt-get install vsftpd -y

echo "Modificando vsftpd.conf con sed"
sed -i 's/#ftpd_banner=Welcome to blah FTP service./ftpd_banner=COMPUTACION EN LA NUBE FTP/g' /etc/vsftpd.conf

echo "Restricción acceso anonymous"
sed -i 's/anonymous_enable=YES/anonymous_enable=NO/g' /etc/vsftpd.conf

echo "Reiniciando el servicio"
sudo service vsftpd restart



