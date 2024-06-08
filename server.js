// server.js
const express = require('express');
const app = express();

app.get('/', (req, res) => {
    const authorizationCode = req.query.code;
    res.send(`Authorization Code: ${authorizationCode}`);
    console.log(`Authorization Code: ${authorizationCode}`);
});

app.listen(3000, () => {
    console.log('Server is running on http://localhost:3000');
});