FROM node:10.18.1-alpine3.11
LABEL maintainer="Andrew Bilenduke <andrewbilenduke@gmail.com>"

RUN mkdir -p /var/www/
RUN mkdir -p /var/www/node_modules

WORKDIR /var/www/

COPY package*.json ./

RUN npm install

COPY . .

CMD [ "npm", "run", "dev" ]
