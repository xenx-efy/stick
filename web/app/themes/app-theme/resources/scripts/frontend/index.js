// eslint-disable-next-line no-unused-vars
import config from '@config';
import './vendor/*.js';
import '@styles/frontend';
import '@images/favicon.ico';
import './spritesvg';

// Your code goes here ...

async function postRequest() {
  return await fetch(myajax.url, {
    method: 'POST',
    credentials: 'same-origin',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'Cache-Control': 'no-cache',
    },
    body: new URLSearchParams({
      action: 'post-request',
      post_title: 'hola como estas',
    }),
  });
}

async function getRequest() {
  const url = new URL(myajax.url);
  const params = {
    one: 'hola',
    two: 'bud',
    action: 'get-request',
  };

  url.search = new URLSearchParams(params).toString();
  return await fetch(url, {
    method: 'GET',
  });
}

getRequest().then((response) => {
  response.json().then((parsedResp) => {
    console.log(parsedResp);
  });
});

postRequest().then((response) => {
  response.json().then((parsedResp) => {
    console.log(parsedResp);
  });
});
