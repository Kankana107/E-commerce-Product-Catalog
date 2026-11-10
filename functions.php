<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* Sample category photos. You can replace these URLs with individual product photos later. */
$photos = [
    'meat' => 'https://images.unsplash.com/photo-1604503468506-a8da13d82791?auto=format&fit=crop&w=800&q=85',
    'seafood' => 'https://www.bing.com/th/id/OIP.gzmFcdeMK0EGrOV0qBbutQHaFj?w=193&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2',
    'vegetables' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=800&q=85',
    'fruits' => 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?auto=format&fit=crop&w=800&q=85',
    'flowers' => 'https://www.bing.com/th/id/OIP.pIgrKb9TwPN2d0et7UsVagHaE8?w=172&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2',
    'pantry' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&w=800&q=85'
];

/* Product details: name, category, description, sample price, and photo. */
$catalog = [
    // Popular products shown first on the Home page
    'chicken' => ['name' => 'Chicken', 'category' => 'Meat', 'detail' => 'Fresh cut · 500 g', 'price' => 189, 'image' => $photos['meat']],
    'fish' => ['name' => 'Rui fish', 'category' => 'Fish & seafood', 'detail' => 'Cleaned fresh · 500 g', 'price' => 249, 'image' => $photos['seafood']],
    'fruit' => ['name' => 'Banana', 'category' => 'Fruits', 'detail' => 'Fresh bunch · 1 kg', 'price' => 59, 'image' => $photos['fruits']],
    'oil' => ['name' => 'Groundnut oil', 'category' => 'Oils & masalas', 'detail' => 'Cold pressed · 1 L', 'price' => 299, 'image' => $photos['pantry']],
    'flower' => ['name' => 'Hibiscus flowers', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 49, 'image' => $photos['flowers']],
    'tomatoes' => ['name' => 'Tomatoes', 'category' => 'Vegetables', 'detail' => 'Farm fresh · 1 kg', 'price' => 49, 'image' => 'https://www.bing.com/th/id/OIP.eJfELhrS5U_6guz41uzEdQHaE7?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],

    // Meat
    'beef' => ['name' => 'Beef', 'category' => 'Meat', 'detail' => 'Fresh cut · 500 g', 'price' => 399, 'image' => 'https://th.bing.com/th/id/OIP.4p4_eL9A_P6iEQ_ZE49NAgHaFj?w=108&h=108&c=1&bgcl=c41d33&r=0&o=7&dpr=2&pid=ImgRC&rm=3'],
    'goat-meat' => ['name' => 'Goat meat', 'category' => 'Meat', 'detail' => 'Fresh cut · 500 g', 'price' => 449, 'image' => 'https://www.bing.com/th/id/OIP.KW-C7HXCyBSXT6ngv0Uf_AHaFj?w=167&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],

    // Fish and seafood: 
    'hilsa' => ['name' => 'Hilsa fish', 'category' => 'Fish & seafood', 'detail' => 'Fresh cut · 500 g', 'price' => 599, 'image' => 'https://www.bing.com/th/id/OIP.F9npvQ5rYMcMMJLedbanDgHaE8?w=199&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'katla' => ['name' => 'Katla fish', 'category' => 'Fish & seafood', 'detail' => 'Cleaned fresh · 500 g', 'price' => 279, 'image' => 'https://www.bing.com/th/id/OIP.2vNlQuYX04DBhL0Zn1SEqwHaE8?w=188&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'pomfret' => ['name' => 'Pomfret', 'category' => 'Fish & seafood', 'detail' => 'Whole fish · 500 g', 'price' => 399, 'image' => 'https://www.bing.com/th/id/OIP.T9PcWonDpP2CjMYIjp1JqQAAAA?w=220&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'tilapia' => ['name' => 'Tilapia', 'category' => 'Fish & seafood', 'detail' => 'Cleaned fresh · 500 g', 'price' => 229, 'image' => 'https://static.vecteezy.com/system/resources/previews/012/426/039/large_2x/tilapia-on-wooden-cutting-board-background-fresh-raw-tilapia-fish-from-the-tilapia-farm-free-photo.JPG'],
    'seer-fish' => ['name' => 'Seer fish', 'category' => 'Fish & seafood', 'detail' => 'Steaks · 500 g', 'price' => 449, 'image' => 'https://th.bing.com/th/id/OIP.gPY-1Dd9fYsG_jT87cqyJAHaE7?w=197&h=148&c=7&rs=1&qlt=90&o=6&dpr=1.3&pid=acf-sdl'],
    'mackerel' => ['name' => 'Mackerel', 'category' => 'Fish & seafood', 'detail' => 'Fresh fish · 500 g', 'price' => 199, 'image' => 'https://www.bing.com/th/id/OIP.J5Sf58uTrUONZWIU3KqU4AHaFF?w=183&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'sardines' => ['name' => 'Sardines', 'category' => 'Fish & seafood', 'detail' => 'Fresh fish · 500 g', 'price' => 149, 'image' => 'https://www.bing.com/th/id/OIP.p-OT0D5LIqs8mxBM_VI8HwHaEJ?w=215&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'salmon' => ['name' => 'Salmon', 'category' => 'Fish & seafood', 'detail' => 'Fillet · 250 g', 'price' => 499, 'image' => 'https://www.bing.com/th/id/OIP.bViNCxWaksyOO7IZPy_P-gHaEJ?w=201&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'tuna' => ['name' => 'Tuna', 'category' => 'Fish & seafood', 'detail' => 'Fresh cut · 500 g', 'price' => 349, 'image' => 'https://th.bing.com/th/id/OIP.TfSaxVlaIzhOHGVE3uFe5QHaHa?w=108&h=108&c=1&bgcl=1be377&r=0&o=7&dpr=2&pid=ImgRC&rm=3'],
    'prawns' => ['name' => 'Prawns', 'category' => 'Fish & seafood', 'detail' => 'Cleaned · 250 g', 'price' => 299, 'image' => 'https://www.bing.com/th/id/OIP.oRo8n9jUslefEEN3lrZ26gHaEK?w=212&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'octopus' => ['name' => 'Octopus', 'category' => 'Fish & seafood', 'detail' => 'Cleaned · 500 g', 'price' => 399, 'image' => 'https://aquariumwhisperer.com/wp-content/uploads/2023/11/Unique-types-of-octopus-in-the-ocean-2048x1365.jpg'],

    // Vegetables: 
    'potato' => ['name' => 'Potatoes', 'category' => 'Vegetables', 'detail' => 'Farm fresh · 1 kg', 'price' => 39, 'image' => 'https://www.bing.com/th/id/OIP._uP6Hdomrz9wErl4DP8ccwHaE8?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'onion' => ['name' => 'Onions', 'category' => 'Vegetables', 'detail' => 'Farm fresh · 1 kg', 'price' => 45, 'image' => 'https://www.bing.com/th/id/OIP._43_PxSCOgw_vhERAnH_xQHaDt?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'carrot' => ['name' => 'Carrots', 'category' => 'Vegetables', 'detail' => 'Farm fresh · 500 g', 'price' => 49, 'image' => 'https://www.bing.com/th/id/OIP.gJkK-KaB_MgFl9CiByHUPAHaFo?w=193&h=147&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'cucumber' => ['name' => 'Cucumber', 'category' => 'Vegetables', 'detail' => 'Farm fresh · 500 g', 'price' => 35, 'image' => 'https://www.bing.com/th/id/OIP.ZgCEHKY5lolwshjKDGM41gHaJ4?w=193&h=257&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'cabbage' => ['name' => 'Cabbage', 'category' => 'Vegetables', 'detail' => 'Fresh · 1 piece', 'price' => 40, 'image' => 'https://www.bing.com/th/id/OIP.TIVV8ryJQ8L_fYTHo4c2kwHaE7?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'cauliflower' => ['name' => 'Cauliflower', 'category' => 'Vegetables', 'detail' => 'Fresh · 1 piece', 'price' => 55, 'image' => 'https://www.bing.com/th/id/OIP.LvywF6cVLKa7tw1xup27bQHaGQ?w=193&h=163&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'spinach' => ['name' => 'Spinach', 'category' => 'Vegetables', 'detail' => 'Fresh bunch', 'price' => 30, 'image' => 'https://www.bing.com/th/id/OIP.8EAvQYQasINS8_iTT9n1hQHaHa?w=193&h=193&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'green-beans' => ['name' => 'Green beans', 'category' => 'Vegetables', 'detail' => 'Farm fresh · 500 g', 'price' => 59, 'image' => 'https://www.bing.com/th/id/OIP.k6NhTmCAM_eT3fNWgQteeAHaE7?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'bell-pepper' => ['name' => 'Bell pepper', 'category' => 'Vegetables', 'detail' => 'Farm fresh · 500 g', 'price' => 69, 'image' => 'https://www.bing.com/th/id/OIP.OKwiMerHm-EzzQdO_g2g5QHaE6?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'brinjal' => ['name' => 'Brinjal', 'category' => 'Vegetables', 'detail' => 'Farm fresh · 500 g', 'price' => 45, 'image' => 'https://www.bing.com/th/id/OIP.AsMkpw6PAZP8nX6JmyrxEQHaFI?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'okra' => ['name' => 'Okra', 'category' => 'Vegetables', 'detail' => 'Farm fresh · 500 g', 'price' => 49, 'image' => 'https://www.bing.com/th/id/OIP.ekyiE8rGE-_1Ed9RS8X8vAHaEo?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'pumpkin' => ['name' => 'Pumpkin', 'category' => 'Vegetables', 'detail' => 'Fresh cut · 500 g', 'price' => 35, 'image' => 'https://www.bing.com/th/id/OIP.U46JRsHnPBBVCNlHH5WaLQHaE7?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'green-peas' => ['name' => 'Green peas', 'category' => 'Vegetables', 'detail' => 'Farm fresh · 500 g', 'price' => 65, 'image' => 'https://www.bing.com/th/id/OIP.OIDn85k4Se1533M_KBT_NQHaEJ?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'broccoli' => ['name' => 'Broccoli', 'category' => 'Vegetables', 'detail' => 'Fresh · 1 piece', 'price' => 89, 'image' => 'https://www.bing.com/th/id/OIP.3k8082immh_-bfqWvkc7KgHaEm?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],

    // Fruits: 
    'apple' => ['name' => 'Apples', 'category' => 'Fruits', 'detail' => 'Fresh · 1 kg', 'price' => 159, 'image' => 'https://www.bing.com/th/id/OIP.3_BosVmdfve7m7g_XIJy9AHaHa?w=193&h=193&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'orange' => ['name' => 'Oranges', 'category' => 'Fruits', 'detail' => 'Fresh · 1 kg', 'price' => 99, 'image' => 'https://www.bing.com/th/id/OIP.hHS7HSAJt2B2ZZ-UDS7WNwHaFQ?w=193&h=137&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'mango' => ['name' => 'Mango', 'category' => 'Fruits', 'detail' => 'Seasonal · 1 kg', 'price' => 149, 'image' => 'https://www.bing.com/th/id/OIP.HKwaNIPtF3GFXujee6s3lwHaE7?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'grapes' => ['name' => 'Grapes', 'category' => 'Fruits', 'detail' => 'Fresh · 500 g', 'price' => 79, 'image' => 'https://www.bing.com/th/id/OIP.MbyXjwP7GLrxph_SWBCZMgHaE8?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'papaya' => ['name' => 'Papaya', 'category' => 'Fruits', 'detail' => 'Fresh · 1 piece', 'price' => 69, 'image' => 'https://www.bing.com/th/id/OIP.J12HNtnE7ZxrJ2_aG7YHSAHaHa?w=193&h=193&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'pineapple' => ['name' => 'Pineapple', 'category' => 'Fruits', 'detail' => 'Fresh · 1 piece', 'price' => 79, 'image' => 'https://www.bing.com/th/id/OIP.UArcBbi0P1dBnVrrqeNbkQHaHa?w=193&h=193&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'watermelon' => ['name' => 'Watermelon', 'category' => 'Fruits', 'detail' => 'Fresh · 1 piece', 'price' => 99, 'image' => 'https://www.bing.com/th/id/OIP.WpgCtJ9Ey0u0IskylXHFlwHaGT?w=193&h=164&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'pomegranate' => ['name' => 'Pomegranate', 'category' => 'Fruits', 'detail' => 'Fresh · 500 g', 'price' => 89, 'image' => 'https://www.bing.com/th/id/OIP.QnVu-djBdnC_4_mdNZ5ArAHaFd?w=193&h=142&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'guava' => ['name' => 'Guava', 'category' => 'Fruits', 'detail' => 'Fresh · 1 kg', 'price' => 79, 'image' => 'https://www.bing.com/th/id/OIP.pTJZKFnJEj-LKZNC7UGiNAHaFy?w=193&h=151&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'pear' => ['name' => 'Pear', 'category' => 'Fruits', 'detail' => 'Fresh · 500 g', 'price' => 99, 'image' => 'https://www.bing.com/th/id/OIP.7aAD93fW_mWAb1JdakC6ngHaEK?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'kiwi' => ['name' => 'Kiwi', 'category' => 'Fruits', 'detail' => 'Fresh · 3 pieces', 'price' => 119, 'image' => 'https://www.bing.com/th/id/OIP.B7Jbs0BG_XaxieN4c9OEJAHaEs?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'strawberry' => ['name' => 'Strawberries', 'category' => 'Fruits', 'detail' => 'Fresh box · 250 g', 'price' => 129, 'image' => 'https://www.bing.com/th/id/OIP.hxCZcXMwGhvMDq2FnrAaQAHaE7?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'lemon' => ['name' => 'Lemons', 'category' => 'Fruits', 'detail' => 'Fresh · 500 g', 'price' => 39, 'image' => 'https://www.bing.com/th/id/OIP.kdrNKDu4qbZb2NZXaurkUwHaF4?w=193&h=153&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],

    // Flowers: 
    'rose' => ['name' => 'Roses', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 99, 'image' => 'https://www.bing.com/th/id/OIP.HuQ4jxWTVrYv7BqXXWOcRwHaGS?w=193&h=164&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'jasmine' => ['name' => 'Jasmine', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 59, 'image' => 'https://www.bing.com/th/id/OIP.giJDvTGaqmnFrpUQyyCosAHaE7?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'marigold' => ['name' => 'Marigold', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 49, 'image' => 'https://www.bing.com/th/id/OIP.O7fMj8wJ3AtCRk0D83__LgHaE8?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'lotus' => ['name' => 'Lotus', 'category' => 'Flowers', 'detail' => 'Fresh flowers · 2 pieces', 'price' => 79, 'image' => 'https://www.bing.com/th/id/OIP.dwt5NY883TKX4sSn4AgIOQHaEo?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'chrysanthemum' => ['name' => 'Chrysanthemums', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 89, 'image' => 'https://www.bing.com/th/id/OIP.sNcrP8eCoa_qbPv0AH8P5QHaE8?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'lily' => ['name' => 'Lilies', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 129, 'image' => 'https://www.bing.com/th/id/OIP.niVCISR6zKKpb_WL1ne1gQHaEj?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'tulip' => ['name' => 'Tulips', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 149, 'image' => 'https://www.bing.com/th/id/OIP.PeBBxyR7i4-q7DZ58jqjBAHaHa?w=193&h=193&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'orchid' => ['name' => 'Orchids', 'category' => 'Flowers', 'detail' => 'Fresh flowers · stem', 'price' => 119, 'image' => 'https://www.bing.com/th/id/OIP.Tmqy-pyViPf1V2e7v5xTOgHaKf?w=193&h=273&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'sunflower' => ['name' => 'Sunflowers', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 99, 'image' => 'https://th.bing.com/th/id/OIP.IcPTumnD9FZdkO3mtSsIKwHaLH?w=108&h=108&c=1&bgcl=b87894&r=0&o=7&dpr=2&pid=ImgRC&rm=3'],
    'lavender' => ['name' => 'Lavender', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 109, 'image' => 'https://www.bing.com/th/id/OIP.77L4_EaaOZzdeRADYA5kVwHaE7?w=193&h=135&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'carnation' => ['name' => 'Carnations', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 89, 'image' => 'https://cdn.pixabay.com/photo/2023/02/09/16/39/carnation-7779227_1280.jpg'],
    'daisy' => ['name' => 'Daisies', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 79, 'image' => 'https://www.bing.com/th/id/OIP.Fjjt_iL9puM3KBoLtFJviAHaFj?w=193&h=145&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'gerbera' => ['name' => 'Gerbera', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 89, 'image' => 'https://www.shutterbug.com/images/photopost/data/500/13373gerbers_2009.jpg'],
    'daffodil' => ['name' => 'Daffodils', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 119, 'image' => 'https://www.bing.com/th/id/OIP.muZmIr5W3cDg_64neU7usAHaLH?w=193&h=290&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'peony' => ['name' => 'Peonies', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 179, 'image' => 'https://www.bing.com/th/id/OIP.8DFdcXv24O9tbUYaL8foBgHaGL?w=193&h=161&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'calendula' => ['name' => 'Calendula', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 69, 'image' => 'https://www.bing.com/th/id/OIP.K0gPSTFz_mZLoiuELP_LBwHaJ4?w=193&h=257&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'baby-breath' => ['name' => 'Baby breath', 'category' => 'Flowers', 'detail' => 'Fresh flowers · bunch', 'price' => 99, 'image' => 'https://www.bing.com/th/id/OIP.ZQe8k57QoX7qa8q4306LRwHaGq?w=193&h=174&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],

    // Oils, masalas, and flour stay under the existing Oils & masalas heading
    'coconut-oil' => ['name' => 'Coconut oil', 'category' => 'Oils & masalas', 'detail' => 'Cold pressed · 1 L', 'price' => 349, 'image' => 'https://www.bing.com/th/id/OIP.cmqOGmS3pDimQ0f2662FPgHaHa?w=128&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'mustard-oil' => ['name' => 'Mustard oil', 'category' => 'Oils & masalas', 'detail' => 'Pure oil · 1 L', 'price' => 199, 'image' => 'https://www.bing.com/th/id/OIP.UCp4b_jie170dXsyDI7JmwHaHa?w=138&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'sesame-oil' => ['name' => 'Sesame oil', 'category' => 'Oils & masalas', 'detail' => 'Cold pressed · 500 ml', 'price' => 249, 'image' => 'https://www.bing.com/th/id/OIP.4eAT7HubHBc3HbMB1KYUaQHaE7?w=187&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'sunflower-oil' => ['name' => 'Sunflower oil', 'category' => 'Oils & masalas', 'detail' => 'Cooking oil · 1 L', 'price' => 179, 'image' => 'https://www.bing.com/th/id/OIP.APYAyyqX7u2Bytk9SX6ljAHaHa?w=136&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'turmeric' => ['name' => 'Turmeric powder', 'category' => 'Oils & masalas', 'detail' => 'Ground spice · 200 g', 'price' => 69, 'image' => 'https://www.bing.com/th/id/OIP.zDH5TScdOV4xOQDJ-7eY3wHaHa?w=122&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'chilli-powder' => ['name' => 'Red chilli powder', 'category' => 'Oils & masalas', 'detail' => 'Ground spice · 200 g', 'price' => 79, 'image' => 'https://th.bing.com/th/id/OIP.xBMIX9quDXh8R0R1msKKyQHaHa?w=148&h=148&c=7&rs=1&qlt=90&o=6&dpr=1.3&pid=acf-sdl'],
    'cumin' => ['name' => 'Cumin seeds', 'category' => 'Oils & masalas', 'detail' => 'Whole spice · 200 g', 'price' => 89, 'image' => 'https://www.bing.com/th/id/OIP.epa6Ru5gny0FIX2smiGZbwHaE2?w=192&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'coriander-powder' => ['name' => 'Coriander powder', 'category' => 'Oils & masalas', 'detail' => 'Ground spice · 200 g', 'price' => 69, 'image' => 'https://www.bing.com/th/id/OIP.NW3EJeZWecrBIBqm1zRnuwHaHa?w=128&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'garam-masala' => ['name' => 'Garam masala', 'category' => 'Oils & masalas', 'detail' => 'Spice blend · 100 g', 'price' => 99, 'image' => 'https://www.bing.com/th/id/OIP.A-2KRgdf_UzYAlLxfHwfiAHaEz?w=175&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'black-pepper' => ['name' => 'Black pepper', 'category' => 'Oils & masalas', 'detail' => 'Whole spice · 100 g', 'price' => 119, 'image' => 'https://th.bing.com/th/id/OIP.5mV7VuhxA98nWeFa_IuZyQHaDr?r=0&o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3'],
    'flour' => ['name' => 'Whole wheat flour', 'category' => 'Oils & masalas', 'detail' => 'Stone ground · 1 kg', 'price' => 85, 'image' => 'https://www.bing.com/th/id/OIP.j5oe_TNSQOCo7B7ZVS8EcwHaH6?w=127&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'rice-flour' => ['name' => 'Rice flour', 'category' => 'Oils & masalas', 'detail' => 'Fine ground · 1 kg', 'price' => 75, 'image' => 'https://www.bing.com/th/id/OIP.nJg2cqrg7IIRaPpRE5JhNwHaE8?w=197&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'gram-flour' => ['name' => 'Gram flour', 'category' => 'Oils & masalas', 'detail' => 'Besan · 1 kg', 'price' => 99, 'image' => 'https://www.bing.com/th/id/OIP.LPUJLEq-87qMOQAP7Z_prwHaE8?w=192&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2'],
    'maize-flour' => ['name' => 'Maize flour', 'category' => 'Oils & masalas', 'detail' => 'Stone ground · 1 kg', 'price' => 79, 'image' => 'https://www.bing.com/th/id/OIP.ZsLngL7--qEaOx2ovVJ1CwHaHa?w=137&h=128&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=ImgAns&rm=2']
];

/* Keep these six products first for the Home page popular-products section. */
$popularIds = ['chicken', 'fish', 'fruit', 'oil', 'flower', 'tomatoes'];
$products = [];

foreach ($popularIds as $id) {
    $product = $catalog[$id];
    $product['id'] = $id;
    $products[] = $product;
}

foreach ($catalog as $id => $product) {
    if (!in_array($id, $popularIds, true)) {
        $product['id'] = $id;
        $products[] = $product;
    }
}

function escapeHtml($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function productById($id)
{
    global $products;

    foreach ($products as $product) {
        if ($product['id'] === $id) {
            return $product;
        }
    }

    return null;
}

function cartCount()
{
    return array_sum($_SESSION['cart']);
}

function cartSubtotal()
{
    $subtotal = 0;

    foreach ($_SESSION['cart'] as $id => $quantity) {
        $product = productById($id);

        if ($product !== null) {
            $subtotal += $product['price'] * (int) $quantity;
        }
    }

    return $subtotal;
}

function deliveryFee()
{
    $subtotal = cartSubtotal();

    if ($subtotal === 0 || $subtotal >= 999) {
        return 0;
    }

    return 49;
}
?>