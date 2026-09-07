USE dapoer_omom;
UPDATE menu SET gambar = CASE nama
  WHEN 'Ricebowl Chicken Pop Ukuran Besar' THEN 'assets/chicken_pop.jpeg'
  WHEN 'Nasi Ayam Teriyaki Mix Vegetables' THEN 'assets/ayam_teriyaki.jpeg'
  WHEN 'Nasi Daun Jeruk Ayam Cabe Garam' THEN 'assets/daun_jeruk.jpeg'
  WHEN 'Spaghetti Bolognese Cheese' THEN 'assets/spaghetti.jpeg'
  WHEN 'Nasi Ayam Serundeng Mix' THEN 'assets/serundeng_mix.jpeg'
  WHEN 'Ricebowl Chicken Pop Asam Manis' THEN 'assets/asam_manis.jpeg'
  ELSE gambar END
WHERE nama IN ('Ricebowl Chicken Pop Ukuran Besar','Nasi Ayam Teriyaki Mix Vegetables','Nasi Daun Jeruk Ayam Cabe Garam','Spaghetti Bolognese Cheese','Nasi Ayam Serundeng Mix','Ricebowl Chicken Pop Asam Manis');
