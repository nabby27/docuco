FROM node:13.10

RUN apt-get update -y && apt-get -y install xvfb

WORKDIR  /app

COPY ./ /app/

RUN npm install