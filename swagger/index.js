const express = require('express');
const fs = require('fs');
const app = express();
const swaggerUi = require('swagger-ui-express');

const swaggerFile = `${process.cwd()}/index.json`
const swaggerData = fs.readFileSync(swaggerFile, 'utf8');
const swaggerJSON = JSON.parse(swaggerData);

app.use('/', swaggerUi.serve, swaggerUi.setup(swaggerJSON, null, null, null));

app.listen(3000, () => {
    console.log('Server running on port 3000');
});
