const express = require('express');
const morgan = require('morgan');
const discountRoutes = require('./routes/discountRoutes');
const notificationRoutes = require('./routes/notificationRoutes');
const errorHandler = require('./middlewares/errorHandler');
require('dotenv').config();

const app = express();

// Middleware untuk parsing JSON dan logging
app.use(express.json());
app.use(morgan('dev'));

// Routing
app.use('/calculate-discount', discountRoutes);
app.use('/notify-order', notificationRoutes);

app.get('/', (req, res) => {
  res.send('Node.js Microservice is running');
});

app.use(errorHandler);

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
