const express = require('express');
const application = express();

const port = 9000;

application.use(express.json());

application.post('/hello', (request, response) => {
    console.log('Route /hello : ' , request.body);
    response.sendStatus(200);
})

application.post('/pangaea', (request, response) => {
    console.log('Route /pangaea : ' , request.body);
    response.sendStatus(200);
})

application.listen(port, () => {
    console.log(`Application started running on ${port}`)
})