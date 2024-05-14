PRAGMA foreign_keys = ON;

-- ----------------------------
-- Table structures
-- ----------------------------
DROP TABLE IF EXISTS brands;
DROP TABLE IF EXISTS models;
DROP TABLE IF EXISTS devices;

CREATE TABLE brands (
  id INTEGER PRIMARY KEY,
  name TEXT NOT NULL CHECK(name IN ('Samsung', 'Xiaomi', 'Apple', 'Google', 'Huawei', 'Nokia', 'Microsoft', 'Oppo'))
);

CREATE TABLE models (
  id INTEGER PRIMARY KEY,
  brand_id INTEGER NOT NULL,
  name TEXT NOT NULL,
  FOREIGN KEY(brand_id) REFERENCES brands(id)
);

CREATE TABLE devices (
  id INTEGER PRIMARY KEY,
  model_id INTEGER NOT NULL,
  name TEXT NOT NULL,
  released_at TEXT,
  body TEXT,
  os TEXT,
  storage TEXT,
  display_size TEXT,
  display_resolution TEXT,
  camera_pixels TEXT,
  video_pixels TEXT,
  ram TEXT,
  chipset TEXT,
  battery_size TEXT,
  battery_type TEXT,
  specifications TEXT NOT NULL,
  FOREIGN KEY(model_id) REFERENCES models(id)
);

CREATE TABLE User (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL,
  email TEXT NOT NULL
);


CREATE TABLE AD (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  device_id INTEGER NOT NULL,
  seller_username TEXT,
  brand TEXT NOT NULL,
  model TEXT NOT NULL,
  condition TEXT,
  location TEXT,
  price DECIMAL(10, 2) NOT NULL,
  image_path TEXT,
  description TEXT
);

INSERT INTO AD (id, device_id, seller_username, brand, model, condition, location, price, image_path, description)
VALUES(1, 3, 'ricardo', 'Samsung', 'Galaxy A52', 'Good', 'Porto', 820, null, 'Very good phone and in great condition. Ready to be loved by a new owner.');

CREATE TABLE Transaction_ (
    id INTEGER PRIMARY KEY,
    device_id INTEGER,
    buyer_id INTEGER,
    seller_id INTEGER,
    transaction_date DATE,
    price DECIMAL(10, 2),
    FOREIGN KEY (device_id) REFERENCES Device(id),
    FOREIGN KEY (buyer_id) REFERENCES User(id),
    FOREIGN KEY (seller_id) REFERENCES User(id)
);

-- ----------------------------
-- Records of brands
-- ----------------------------

INSERT INTO brands (id, name) VALUES (1, 'Samsung');
INSERT INTO brands (id, name) VALUES (2, 'Xiaomi');
INSERT INTO brands (id, name) VALUES (3, 'Apple');
INSERT INTO brands (id, name) VALUES (4, 'Google');
INSERT INTO brands (id, name) VALUES (5, 'Huawei');
INSERT INTO brands (id, name) VALUES (6, 'Nokia');
INSERT INTO brands (id, name) VALUES (7, 'Microsoft');
INSERT INTO brands (id, name) VALUES (8, 'Oppo');

-- ----------------------------
-- Database population
-- ----------------------------

-- Models for Samsung
INSERT INTO models (id, brand_id, name) VALUES (1, 1, 'Galaxy S21');
INSERT INTO models (id, brand_id, name) VALUES (2, 1, 'Galaxy Note 20');
INSERT INTO models (id, brand_id, name) VALUES (3, 1, 'Galaxy A52');
INSERT INTO models (id, brand_id, name) VALUES (4, 1, 'Galaxy Z Fold 3');
INSERT INTO models (id, brand_id, name) VALUES (5, 1, 'Galaxy Tab S7');

-- Devices for Samsung
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(1, 1, 'Galaxy S21 Ultra', '2021-01-29', 'Glass front (Gorilla Glass Victus), glass back (Gorilla Glass Victus), aluminum frame', 'Android 11, One UI 3.1', '128GB/256GB/512GB', '6.8 inches', '1440 x 3200 pixels', '108 MP', '8K', '12GB/16GB', 'Exynos 2100 (5 nm) - Global; Qualcomm SM8350 Snapdragon 888 5G (5 nm) - USA/China', '5000 mAh', 'Li-Ion', 'IP68 dust/water resistant (up to 1.5m for 30 mins); Ultra Wideband (UWB) support');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(2, 2, 'Galaxy Note 20 Ultra', '2020-08-21', 'Glass front (Gorilla Glass Victus), glass back (Gorilla Glass Victus), stainless steel frame', 'Android 10, upgradable to Android 11, One UI 3.1', '128GB/256GB/512GB', '6.9 inches', '1440 x 3088 pixels', '108 MP', '8K', '12GB', 'Exynos 990 (7 nm+) - Global; Qualcomm SM8250 Snapdragon 865+ (7 nm+) - USA', '4500 mAh', 'Li-Ion', 'IP68 dust/water resistant (up to 1.5m for 30 mins); Stylus support, Bluetooth integration, accelerometer, gyro, proximity, compass, barometer');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(3, 3, 'Galaxy A52 5G', '2021-03-26', 'Glass front (Gorilla Glass 5), plastic back, aluminum frame', 'Android 11, One UI 3.1', '128GB/256GB', '6.5 inches', '1080 x 2400 pixels', '64 MP', '4K', '6GB/8GB', 'Qualcomm SM7225 Snapdragon 750G 5G (8 nm)', '4500 mAh', 'Li-Po', 'IP67 dust/water resistant (up to 1m for 30 mins); microSDXC (uses shared SIM slot)');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(4, 4, 'Galaxy Z Fold 3', '2021-08-27', 'Glass front (Gorilla Glass Victus), glass back (Gorilla Glass Victus), aluminum frame', 'Android 11, One UI 3.5', '256GB/512GB', '7.6 inches', '1768 x 2208 pixels', '12 MP', '4K', '12GB', 'Qualcomm SM8350 Snapdragon 888 5G (5 nm)', '4400 mAh', 'Li-Ion', 'Main display: Foldable Dynamic AMOLED 2X, 120Hz, HDR10+, Cover display: Super AMOLED, 120Hz, HDR10+; IPX8 water resistant (up to 1.5m for 30 mins)');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(5, 5, 'Galaxy Tab S7', '2020-08-21', 'Glass front (Gorilla Glass 6), aluminum back, aluminum frame', 'Android 10, One UI 2.5', '128GB/256GB', '11.0 inches', '1600 x 2560 pixels', '13 MP', '4K', '6GB/8GB', 'Qualcomm SM8250 Snapdragon 865+ (7 nm+)', '8000 mAh', 'Li-Po', 'HDR10+, 120Hz, gyro support, Dolby Atmos sound, 4 speakers tuned by AKG');

-- Models for Xiaomi
INSERT INTO models (id, brand_id, name) VALUES (6, 2, 'Mi 11');
INSERT INTO models (id, brand_id, name) VALUES (7, 2, 'Redmi Note 10 Pro');
INSERT INTO models (id, brand_id, name) VALUES (8, 2, 'POCO X3 Pro');
INSERT INTO models (id, brand_id, name) VALUES (9, 2, 'Mi 11 Lite');
INSERT INTO models (id, brand_id, name) VALUES (10, 2, 'Redmi 9');

-- Devices for Xiaomi
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(6, 6, 'Mi 11 Ultra', '2021-04-23', 'Glass front (Gorilla Glass Victus), glass back (Gorilla Glass), aluminum frame', 'Android 11, MIUI 12.5', '256GB/512GB', '6.81 inches', '1440 x 3200 pixels', '50 MP', '8K', '8GB/12GB', 'Qualcomm SM8350 Snapdragon 888 5G (5 nm)', '5000 mAh', 'Li-Po', 'IP68 dust/water resistant (up to 1.5m for 30 mins); HDR10+, 120Hz, Dolby Vision');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(7, 7, 'Redmi Note 10 Pro Max', '2021-03-04', 'Glass front (Gorilla Glass 5), glass back (Gorilla Glass 5), plastic frame', 'Android 11, MIUI 12', '64GB/128GB', '6.67 inches', '1080 x 2400 pixels', '108 MP', '4K', '6GB/8GB', 'Qualcomm SM7150 Snapdragon 732G (8 nm)', '5020 mAh', 'Li-Po', 'HDR10, 120Hz, 240Hz touch sampling');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(8, 8, 'POCO X3 Pro', '2021-03-24', 'Glass front (Gorilla Glass 6), aluminum back, plastic frame', 'Android 11, MIUI 12', '128GB/256GB', '6.67 inches', '1080 x 2400 pixels', '48 MP', '4K', '6GB/8GB', 'Qualcomm SM8150-AC Snapdragon 730G (8 nm)', '5160 mAh', 'Li-Po', 'HDR10, 120Hz, 240Hz touch sampling');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(9, 9, 'Mi 11 Lite', '2021-04-29', 'Glass front (Gorilla Glass 5), glass back (Gorilla Glass 5), plastic frame', 'Android 11, MIUI 12', '64GB/128GB/256GB', '6.55 inches', '1080 x 2400 pixels', '64 MP', '4K', '6GB/8GB', 'Qualcomm SM7150 Snapdragon 732G (8 nm)', '4250 mAh', 'Li-Po', 'HDR10, 90Hz');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(10, 10, 'Redmi 9', '2020-06-10', 'Glass front (Gorilla Glass 3), plastic back, plastic frame', 'Android 10, MIUI 12', '32GB/64GB/128GB', '6.53 inches', '1080 x 2340 pixels', '13 MP', '1080p', '3GB/4GB', 'Mediatek Helio G80 (12 nm)', '5020 mAh', 'Li-Po', 'Water-repellent coating');

-- Models for Apple
INSERT INTO models (id, brand_id, name) VALUES (11, 3, 'iPhone 13 Pro Max');
INSERT INTO models (id, brand_id, name) VALUES (12, 3, 'iPhone 12 Pro');
INSERT INTO models (id, brand_id, name) VALUES (13, 3, 'iPhone SE (2020)');
INSERT INTO models (id, brand_id, name) VALUES (14, 3, 'iPhone 11');
INSERT INTO models (id, brand_id, name) VALUES (15, 3, 'iPhone SE 2');

-- Devices for Apple
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(11, 11, 'iPhone 13 Pro Max', '2021-09-24', 'Glass front (Ceramic Shield), glass back (Ceramic Shield), stainless steel frame', 'iOS 15', '128GB/256GB/512GB/1TB', '6.7 inches', '1284 x 2778 pixels', '12 MP', '4K', '6GB', 'Apple A15 Bionic (5 nm)', '4352 mAh', 'Li-Ion', 'HDR10, Dolby Vision, Wide color gamut, True-tone, 120Hz refresh rate');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(12, 12, 'iPhone 12 Pro', '2020-10-23', 'Glass front (Ceramic Shield), glass back (Ceramic Shield), stainless steel frame', 'iOS 14.1, upgradable to iOS 15', '128GB/256GB/512GB', '6.1 inches', '1170 x 2532 pixels', '12 MP', '4K', '6GB', 'Apple A14 Bionic (5 nm)', '2815 mAh', 'Li-Ion', 'HDR10, Dolby Vision, Wide color gamut, True-tone');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(13, 13, 'iPhone SE (2020)', '2020-04-24', 'Glass front (Gorilla Glass), glass back (Gorilla Glass), aluminum frame', 'iOS 13, upgradable to iOS 15', '64GB/128GB/256GB', '4.7 inches', '750 x 1334 pixels', '12 MP', '4K', '3GB', 'Apple A13 Bionic (7 nm+)', '1821 mAh', 'Li-Ion', 'Wide color gamut, True-tone');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(14, 14, 'iPhone 11', '2019-09-20', 'Glass front (Gorilla Glass), glass back (Gorilla Glass), aluminum frame', 'iOS 13, upgradable to iOS 15', '64GB/128GB/256GB', '6.1 inches', '828 x 1792 pixels', '12 MP', '4K', '4GB', 'Apple A13 Bionic (7 nm+)', '3110 mAh', 'Li-Ion', 'True-tone, Wide color gamut');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(15, 15, 'iPhone SE 2', '2020-04-24', 'Glass front (Gorilla Glass), glass back (Gorilla Glass), aluminum frame', 'iOS 13, upgradable to iOS 15', '64GB/128GB/256GB', '4.7 inches', '750 x 1334 pixels', '12 MP', '4K', '3GB', 'Apple A13 Bionic (7 nm+)', '1821 mAh', 'Li-Ion', 'Wide color gamut, True-tone');

-- Models for Google
INSERT INTO models (id, brand_id, name) VALUES (16, 4, 'Pixel 6 Pro');
INSERT INTO models (id, brand_id, name) VALUES (17, 4, 'Pixel 5a');
INSERT INTO models (id, brand_id, name) VALUES (18, 4, 'Pixel 4a');
INSERT INTO models (id, brand_id, name) VALUES (19, 4, 'Pixel 3a');
INSERT INTO models (id, brand_id, name) VALUES (20, 4, 'Pixel 2');

-- Devices for Google
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(16, 16, 'Pixel 6 Pro', '2021-10-28', 'Glass front (Gorilla Glass Victus), aluminum back, aluminum frame', 'Android 12', '128GB/256GB/512GB', '6.7 inches', '1440 x 3120 pixels', '50 MP', '4K', '12GB', 'Google Tensor (5 nm)', '5003 mAh', 'Li-Po', 'HDR10+, 120Hz refresh rate, Always-on display, Corning Gorilla Glass Victus');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(17, 17, 'Pixel 5a', '2021-08-17', 'Aluminum front, plastic back, plastic frame', 'Android 11', '128GB', '6.34 inches', '1080 x 2400 pixels', '12.2 MP', '4K', '6GB', 'Qualcomm Snapdragon 765G (7 nm)', '4680 mAh', 'Li-Po', 'HDR');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(18, 18, 'Pixel 4a', '2020-08-03', 'Glass front (Gorilla Glass 3), plastic back, plastic frame', 'Android 10, upgradable to Android 12', '128GB', '5.81 inches', '1080 x 2340 pixels', '12.2 MP', '4K', '6GB', 'Qualcomm Snapdragon 730G (8 nm)', '3140 mAh', 'Li-Po', 'HDR');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(19, 19, 'Pixel 3a', '2019-05-07', 'Glass front (Dragontrail), plastic back, plastic frame', 'Android 9.0 (Pie), upgradable to Android 12', '64GB', '5.6 inches', '1080 x 2220 pixels', '12.2 MP', '4K', '4GB', 'Qualcomm Snapdragon 670 (10 nm)', '3000 mAh', 'Li-Po', 'HDR');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(20, 20, 'Pixel 2', '2017-10-19', 'Front glass, aluminum body, partial glass back', 'Android 8.0 (Oreo), upgradable to Android 11', '64GB/128GB', '5.0 inches', '1080 x 1920 pixels', '12.2 MP', '4K', '4GB', 'Qualcomm Snapdragon 835 (10 nm)', '2700 mAh', 'Li-Ion', 'Water and dust resistant (IP67), Active Edge');

-- Models for Huawei
INSERT INTO models (id, brand_id, name) VALUES (21, 5, 'Huawei P50 Pro');
INSERT INTO models (id, brand_id, name) VALUES (22, 5, 'Huawei Mate 40 Pro');
INSERT INTO models (id, brand_id, name) VALUES (23, 5, 'Huawei P40 Pro');
INSERT INTO models (id, brand_id, name) VALUES (24, 5, 'Huawei Nova 8 Pro');
INSERT INTO models (id, brand_id, name) VALUES (25, 5, 'Huawei Enjoy 20 Pro');

-- Devices for Huawei
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(21, 21, 'Huawei P50 Pro', '2021-07-29', 'Glass front (Gorilla Glass), glass back, aluminum frame', 'HarmonyOS 2.0', '128GB/256GB/512GB', '6.6 inches', '1228 x 2700 pixels', '50 MP', '4K', '8GB/12GB', 'Qualcomm SM8350 Snapdragon 888 4G (5 nm)', '4360 mAh', 'Li-Po', 'IP68 dust/water resistant (up to 1.5m for 30 mins)');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(22, 22, 'Huawei Mate 40 Pro', '2020-10-22', 'Glass front (Gorilla Glass), ceramic back, aluminum frame', 'EMUI 11, Android 10', '128GB/256GB/512GB', '6.76 inches', '1344 x 2772 pixels', '50 MP', '4K', '8GB', 'HiSilicon Kirin 9000 5G (5 nm)', '4400 mAh', 'Li-Po', 'IP68 dust/water resistant (up to 1.5m for 30 mins)');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(23, 23, 'Huawei P40 Pro', '2020-04-07', 'Glass front (Gorilla Glass 6), glass back (Gorilla Glass 6), aluminum frame', 'EMUI 10.1, Android 10', '128GB/256GB/512GB', '6.58 inches', '1200 x 2640 pixels', '50 MP', '4K', '8GB', 'HiSilicon Kirin 990 5G (7 nm+)', '4200 mAh', 'Li-Po', 'IP68 dust/water resistant (up to 1.5m for 30 mins)');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(24, 24, 'Huawei Nova 8 Pro', '2020-12-23', 'Glass front (Gorilla Glass), glass back, aluminum frame', 'EMUI 11, Android 10', '128GB/256GB', '6.72 inches', '1236 x 2676 pixels', '64 MP', '4K', '8GB', 'HiSilicon Kirin 985 5G (7 nm)', '4000 mAh', 'Li-Po', 'HDR10');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(25, 25, 'Huawei Enjoy 20 Pro', '2020-06-24', 'Glass front, plastic back, plastic frame', 'EMUI 10.1, Android 10', '128GB/256GB', '6.5 inches', '1080 x 2400 pixels', '48 MP', '4K', '6GB/8GB', 'MediaTek MT6873V Dimensity 800 5G (7 nm)', '4000 mAh', 'Li-Po', 'HDR10');

-- Models for Nokia
INSERT INTO models (id, brand_id, name) VALUES (26, 6, 'Nokia 8.3 5G');
INSERT INTO models (id, brand_id, name) VALUES (27, 6, 'Nokia 5.4');
INSERT INTO models (id, brand_id, name) VALUES (28, 6, 'Nokia 3.4');
INSERT INTO models (id, brand_id, name) VALUES (29, 6, 'Nokia 2.4');
INSERT INTO models (id, brand_id, name) VALUES (30, 6, 'Nokia 1.4');

-- Devices for Nokia
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(26, 26, 'Nokia 8.3 5G', '2020-09-30', 'Glass front (Gorilla Glass 3), glass back (Gorilla Glass 3), aluminum frame', 'Android 10, upgradable to Android 11', '64GB/128GB', '6.81 inches', '1080 x 2400 pixels', '64 MP', '4K', '6GB/8GB', 'Qualcomm SM7250 Snapdragon 765G (7 nm)', '4500 mAh', 'Li-Po', 'HDR10');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(27, 27, 'Nokia 5.4', '2020-12-15', 'Glass front (Gorilla Glass 3), plastic back, plastic frame', 'Android 10, upgradable to Android 11', '64GB/128GB', '6.39 inches', '720 x 1560 pixels', '48 MP', '1080p', '4GB', 'Qualcomm SM6115 Snapdragon 662 (11 nm)', '4000 mAh', 'Li-Po', 'HDR');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(28, 28, 'Nokia 3.4', '2020-10-26', 'Glass front (Gorilla Glass 3), plastic back, plastic frame', 'Android 10, upgradable to Android 11', '32GB/64GB', '6.39 inches', '720 x 1560 pixels', '13 MP', '1080p', '3GB/4GB', 'Qualcomm SM4250 Snapdragon 460 (11 nm)', '4000 mAh', 'Li-Po', 'HDR');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(29, 29, 'Nokia 2.4', '2020-09-26', 'Glass front, plastic back, plastic frame', 'Android 10, upgradable to Android 11', '32GB/64GB', '6.5 inches', '720 x 1600 pixels', '13 MP', '1080p', '2GB/3GB', 'Mediatek MT6762 Helio P22 (12 nm)', '4500 mAh', 'Li-Po', 'HDR');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(30, 30, 'Nokia 1.4', '2021-02-03', 'Glass front, plastic back, plastic frame', 'Android 10 (Go edition)', '16GB/32GB', '6.52 inches', '720 x 1600 pixels', '8 MP', '1080p', '1GB/2GB', 'Qualcomm QM215 Snapdragon 215 (28 nm)', '4000 mAh', 'Li-Po', 'HDR');

-- Models for Microsoft
INSERT INTO models (id, brand_id, name) VALUES (31, 7, 'Surface Duo');
INSERT INTO models (id, brand_id, name) VALUES (32, 7, 'Lumia 950 XL');
INSERT INTO models (id, brand_id, name) VALUES (33, 7, 'Lumia 640 XL');
INSERT INTO models (id, brand_id, name) VALUES (34, 7, 'Lumia 535');
INSERT INTO models (id, brand_id, name) VALUES (35, 7, 'Lumia 1320');

-- Devices for Microsoft
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(31, 31, 'Surface Duo', '2020-09-10', 'Glass front (Gorilla Glass 5), glass back (Gorilla Glass 5), aluminum frame', 'Android 10', '128GB/256GB', '8.1 inches', '1800 x 2700 pixels', '11 MP', '4K', '6GB', 'Qualcomm SM8150 Snapdragon 855 (7 nm)', '3577 mAh', 'Li-Po', 'Foldable AMOLED, 90Hz refresh rate, HDR');
-- Devices for Microsoft (continued)
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(32, 32, 'Lumia 950 XL', '2015-11-25', 'Glass front (Corning Gorilla Glass 4), plastic back, plastic frame', 'Windows 10', '32GB', '5.7 inches', '1440 x 2560 pixels', '20 MP', '2160p', '3GB', 'Qualcomm MSM8994 Snapdragon 810 (20 nm)', '3340 mAh', 'Li-Ion', 'PureView technology, HDR');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(33, 33, 'Lumia 640 XL', '2015-03-13', 'Corning Gorilla Glass 3', 'Windows Phone 8.1, upgradable to Windows 10 Mobile', '8GB', '5.7 inches', '720 x 1280 pixels', '13 MP', '1080p', '1GB/2GB', 'Qualcomm Snapdragon 400 (28 nm)', '3000 mAh', 'Li-Ion', 'ClearBlack display');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(34, 34, 'Lumia 535', '2014-11-11', 'Glass front, plastic back, plastic frame', 'Microsoft Windows Phone 8.1, upgradable to Windows 10 Mobile', '8GB', '5.0 inches', '540 x 960 pixels', '5 MP', '480p', '1GB', 'Qualcomm Snapdragon 200 (28 nm)', '1905 mAh', 'Li-Ion', 'Scratch-resistant glass');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(35, 35, 'Lumia 1320', '2013-12-01', 'Corning Gorilla Glass 3', 'Microsoft Windows Phone 8, upgradable to 8.1', '8GB', '6.0 inches', '720 x 1280 pixels', '5 MP', '1080p', '1GB', 'Qualcomm Snapdragon S4', '3400 mAh', 'Li-Ion', 'ClearBlack display');

-- Models for Oppo
INSERT INTO models (id, brand_id, name) VALUES (36, 8, 'Oppo Find X3 Pro');
INSERT INTO models (id, brand_id, name) VALUES (37, 8, 'Oppo Reno 6 Pro');
INSERT INTO models (id, brand_id, name) VALUES (38, 8, 'Oppo A74');
INSERT INTO models (id, brand_id, name) VALUES (39, 8, 'Oppo F19 Pro');
INSERT INTO models (id, brand_id, name) VALUES (40, 8, 'Oppo A54');

-- Devices for Oppo
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(36, 36, 'Oppo Find X3 Pro', '2021-03-11', 'Glass front (Gorilla Glass 5), glass back (Gorilla Glass 5), aluminum frame', 'Android 11, ColorOS 11.2', '256GB/512GB', '6.7 inches', '1440 x 3216 pixels', '50 MP', '4K', '8GB/12GB', 'Qualcomm SM8350 Snapdragon 888 5G (5 nm)', '4500 mAh', 'Li-Po', 'HDR10+, 120Hz refresh rate, Dolby Vision');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(37, 37, 'Oppo Reno 6 Pro', '2021-05-27', 'Glass front (Gorilla Glass 5), glass back (Gorilla Glass 5), aluminum frame', 'Android 11, ColorOS 11.3', '128GB/256GB', '6.55 inches', '1080 x 2400 pixels', '64 MP', '4K', '8GB', 'MediaTek MT6779V Dimensity 1200 5G (6 nm)', '4500 mAh', 'Li-Po', 'HDR10');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(38, 38, 'Oppo A74', '2021-04-06', 'Glass front (Gorilla Glass 3), plastic back, plastic frame', 'Android 11, ColorOS 11.1', '128GB', '6.43 inches', '1080 x 2400 pixels', '48 MP', '4K', '6GB/8GB', 'Qualcomm SM6115 Snapdragon 662 (11 nm)', '5000 mAh', 'Li-Po', 'HDR');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(39, 39, 'Oppo F19 Pro', '2021-03-08', 'Glass front (Gorilla Glass 5), plastic back, plastic frame', 'Android 11, ColorOS 11.1', '128GB', '6.43 inches', '1080 x 2400 pixels', '48 MP', '4K', '8GB', 'Mediatek Helio P95 (12 nm)', '4310 mAh', 'Li-Po', 'HDR');
INSERT INTO devices (id, model_id, name, released_at, body, os, storage, display_size, display_resolution, camera_pixels, video_pixels, ram, chipset, battery_size, battery_type, specifications) VALUES
(40, 40, 'Oppo A54', '2021-04-19', 'Glass front (Gorilla Glass 3), plastic back, plastic frame', 'Android 10, ColorOS 7.2', '64GB/128GB', '6.51 inches', '720 x 1600 pixels', '13 MP', '1080p', '4GB/6GB', 'Mediatek MT6765 Helio P35 (12nm)', '5000 mAh', 'Li-Po', 'HDR');

-- ----------------------------
-- Populating Users
-- ----------------------------

--no longer needed
