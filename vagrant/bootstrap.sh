#!/usr/bin/env bash

export DEBIAN_FRONTEND=noninteractive

apt-get update
apt-get install -y python2.7

sudo ln -s /usr/bin/python2.7 /usr/bin/python

cat /home/ubuntu/.ssh/authorized_keys >> /root/.ssh/authorized_keys

sed -i 's/ubuntu-xenial/devbox/g' /etc/hostname
sed -i 's/ubuntu-xenial/devbox/g' /etc/hosts

echo 'devbox' > /proc/sys/kernel/hostname