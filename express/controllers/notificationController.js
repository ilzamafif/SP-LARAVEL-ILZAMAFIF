exports.notifyOrder = async (req, res, next) => {
  try {
    const orderData = req.body;
    console.log('New Order Notification:', orderData);
    return res.json({ message: 'Notifikasi pesanan diterima' });
  } catch (error) {
    next(error);
  }
};
