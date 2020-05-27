FROM node:lts-alpine as build-stage
LABEL maintainer="Andrew Bilenduke <andrewbilenduke@gmail.com>"

WORKDIR /var/www

COPY package*.json ./

RUN npm install

COPY . .

CMD [ "npm", "run", "dev" ]
