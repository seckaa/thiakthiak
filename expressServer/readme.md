npm init
npm install express
node server.js //start server without nodemon

//add autoload for changes
npm install -g nodemon

npm run server //start server with nodemon
npm install colors
npm i morgan
npm i dotenv
npm i mysql2

image upload helper
npm i multer --save

===============
secure ssl cert
+++++++++

server
npm install -g mkcert
mkcert create-ca
mkcert create-cert

client
npm install wbrtc-adaptor
mkcert create-ca
mkcert create-cert
"scripts": {
"start": "set HTTPS=true&&set SSL_CRT_FILE=./certs/cert.crt&&set SSL_KEY_FILE=./certs/cert.key&&react-scripts start",
}
