exports.calculate = (total_price) => {
  let discount = 0;
  if (total_price >= 500000) {
    discount = total_price * 0.1; // 10% diskon
  }
  const final_price = total_price - discount;
  return { discount, final_price };
};
