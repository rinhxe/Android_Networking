const express = require('express');
const mongoose = require('mongoose');

const CarModel = require('./model/CarModel');
const uri = "mongodb://127.0.0.1:27017/api";
const bodyParser = require('body-parser');


mongoose.connect(uri,{
    useNewUrlParser: true,
    useUnifiedTopology: true,
}) 
.then(() => {
    console.log('Da ket noi voi MongoDB');
})
.catch((err) => {
    console.error('Khong ket noi dc MongoDB: ', err);
})

const app = express();
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

app.get('/listCar', async function (req, res) {

    try {
        const carList = await CarModel.find().lean();
        console.log('Da ket noi voi MongoDB');
        res.json(carList);
      } catch (err) {
        console.error('Error fetching products:', err);
        res.status(500).json({ error: 'Internal server error' });
      }
})

// Định nghĩa API thêm sản phẩm
app.post('/addCars', async (req, res) => {
  try {
    const { name, price, quantity } = req.body;
    const car = new CarModel({ name, price, quantity });
    await car.save();
    //res.json(car);
    const carList = await CarModel.find().lean();
    res.json(carList);
  } catch (err) {
    console.error('Error adding product:', err);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// Định nghĩa API sửa đổi sản phẩm
app.put('/cars/:carId', async (req, res) => {
  try {
    const { carId } = req.params;
    const { name, price, quantity } = req.body;
    const car = await CarModel.findByIdAndUpdate(
      carId,
      { name, price, quantity },
      { new: true }
    );
    const carList = await CarModel.find().lean();
    res.json(carList);
    //res.json(car);
  } catch (err) {
    console.error('Error updating product:', err);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// Định nghĩa API xóa sản phẩm
app.delete('/cars/:carId', async (req, res) => {
  try {
    const { carId } = req.params;
    await CarModel.findByIdAndRemove(carId);
    const carList = await CarModel.find().lean();
    res.json(carList);
    //res.json({ success: true });
  } catch (err) {
    console.error('Error deleting product:', err);
    res.status(500).json({ error: 'Internal server error' });
  }
});

  
  // Khởi động server
  const port = 8000;
  app.listen(port, () => {
    console.log(`Server started on port ${port}`);
  });