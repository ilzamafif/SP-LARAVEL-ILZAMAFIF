const discountService = require('../services/discountService');

exports.calculateDiscount = async (req, res, next) => {
  try {
    const { customer_id, total_price } = req.body;
    if (!customer_id || !total_price) {
      return res.status(400).json({ error: 'customer_id dan total_price wajib diisi' });
    }
    const { discount, final_price } = discountService.calculate(total_price);
    return res.json({ discount, final_price });
  } catch (error) {
    next(error);
  }
};
