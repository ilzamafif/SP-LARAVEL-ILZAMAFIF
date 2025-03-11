module.exports = (err, req, res, next) => {
  console.error(err.stack);
  res.status(500).json({
    error: 'Terjadi kesalahan pada server!',
    message: err.message,
  });
};
