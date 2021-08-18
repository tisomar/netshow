#!/bin/bash
if [ -d "/var/www/html/node_modules" ]
 then
    rm -rf node_modules
fi

npm install
#npm install -g @vue/cli
#npm install -g @vue/cli-service-global
#npm install --save axios vue-axios
#npm install vue-tel-input-vuetify
npm run serve -- --port 8080

echo "Mudando o dono da pasta dist"
chown -R 1000:1000 dist
chmod -R 777 dist
