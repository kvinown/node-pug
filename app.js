const express = require('express');
const session = require('express-session');
const router = require('./routes/route');

const app = express();

app.set('view engine', 'pug');
app.set('views', 'views');

// Middleware to parse URL-encoded data
app.use(express.urlencoded({ extended: false }));

// Middleware to parse JSON data
app.use(express.json());

app.use(session({
    secret: 'your-secret-key',
    resave: false,
    saveUninitialized: false
}));

app.use(router);

app.listen(8888, () => {
    console.log('Server run at port 8888');
});
