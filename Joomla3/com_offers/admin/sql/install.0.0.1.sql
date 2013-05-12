CREATE TABLE IF NOT EXISTS jml_custom_offers
(
  id INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(id),
  offerTitle VARCHAR(100),
  offerDescription VARCHAR(500),
  offerImageUrl VARCHAR(100),
  offerOrder INT
)