
# ///////////////////////////////////////////
# Productos
# ///////////////////////////////////////////

INSERT INTO producto_para_venta (
    nombre_producto, 
    precio_producto, 
    es_combo_bool, 
    categoria_producto, 
    producto_desactivado_bool, 
    descripcion_producto
) VALUES (
    'Bocadito Cream', 
    3500.00, 
    0, 
    'Capuccinos Saborizados', 
    0, 
    'Con dulce de leche, crema y salsa de caramelo'
);

-- Capuccinos Saborizados y Cafés Especiales
INSERT INTO producto_para_venta (nombre_producto, precio_producto, es_combo_bool, categoria_producto, producto_desactivado_bool, descripcion_producto) VALUES 
('Bocadito Cream', 3500.00, 0, 'clasicos', 0, 'Con esencia de caramelo, crema y salsa de caramelo'),
('Donuts Cream', 3500.00, 0, 'clasicos', 0, 'Con esencia de caramelo, crema y salsa de caramelo'),
('Nugaton Cream', 3500.00, 0, 'clasicos', 0, 'Con chocolate, crema y salsa de chocolate'),
('Chocman Cream', 3500.00, 0, 'clasicos', 0, 'Con dulce de leche, chocolate, crema y salsa de chocolate'),
('Café Calipso', 3500.00, 0, 'bebidas_calientes', 0, 'Expresso c/ esencia de licor de café y crema batida'),
('Café Inglés', 3500.00, 0, 'bebidas_calientes', 0, 'Expresso c/ esencia de licor de crema, crema batida y canela'),
('Café Irlandés', 3500.00, 0, 'bebidas_calientes', 0, 'Expresso c/ esencia de licor de whisky, crema batida y canela');


-- Cafetería Tradicional
INSERT INTO producto_para_venta (nombre_producto, precio_producto, es_combo_bool, categoria_producto, producto_desactivado_bool, descripcion_producto) VALUES 
('Café Expresso', 1900.00, 0, 'cafeteria', 0, 'El clásico café expresso Bonafide'),
('Café Jarrito', 2100.00, 0, 'cafeteria', 0, 'Medida jarrito, intenso y equilibrado'),
('Lágrima', 2100.00, 0, 'cafeteria', 0, 'Jarrito con leche manchada con café'),
('Café con Crema', 2500.00, 0, 'cafeteria', 0, 'Pocillo de café con un toque de crema'),
('Café Doble', 2400.00, 0, 'cafeteria', 0, 'Doble medida de expresso'),
('Café con Leche', 2400.00, 0, 'cafeteria', 0, 'Clásico café con leche'),
('Cappuccino', 3400.00, 0, 'cafeteria', 0, 'Expresso, leche y espuma de leche'),
('Submarino', 3500.00, 0, 'bebidas_calientes', 0, 'Leche caliente con barra de chocolate sumergida'),
('Té con Leche', 1900.00, 0, 'bebidas_calientes', 0, 'Infusión clásica con leche');

-- Bebidas Frías
INSERT INTO producto_para_venta (nombre_producto, precio_producto, es_combo_bool, categoria_producto, producto_desactivado_bool, descripcion_producto) VALUES 
('Frappé Bocadito', 3500.00, 0, 'bebidas_frias', 0, 'Café, bocadito, dulce de leche, chocolate y crema'),
('Frappé Nugaton', 3500.00, 0, 'bebidas_frias', 0, 'Café, nugaton, dulce de leche, chocolate y crema'),
('Frappé Amaretti', 3500.00, 0, 'bebidas_frias', 0, 'Café, amaretti, chocolate y crema'),
('Milkshake', 3500.00, 0, 'bebidas_frias', 0, 'Batido cremoso a elección'),
('Limonada', 2600.00, 0, 'bebidas_frias', 0, 'Refrescante con menta y jengibre'),
('Jugo Exprimido', 2900.00, 0, 'bebidas_frias', 0, '100% Natural de Naranja');

-- Postres y Antojos
INSERT INTO producto_para_venta (nombre_producto, precio_producto, es_combo_bool, categoria_producto, producto_desactivado_bool, descripcion_producto) VALUES 
('Porción de Torta', 3900.00, 0, 'postres', 0, 'Variedad de tortas del día'),
('Cuadrado Dulce', 2800.00, 0, 'postres', 0, 'Brownie, Coco y dulce de leche, o Manzana'),
('Muffin', 1900.00, 0, 'postres', 0, 'Sabor Vainilla con chips o Chocolate'),
('Alfajor de Maicena', 1200.00, 0, 'postres', 0, 'Clásico alfajor artesanal'),
('Cookies (x2)', 1700.00, 0, 'postres', 0, 'Dos galletas con chips de chocolate'),
('Donas', 1000.00, 0, 'postres', 0, 'Dona glaseada o rellena');

-- Combos Cafés
INSERT INTO producto_para_venta (nombre_producto, precio_producto, es_combo_bool, categoria_producto, producto_desactivado_bool, descripcion_producto) VALUES 
('Combo Clásico Medialunas', 3200.00, 1, 'combos', 0, 'Café con leche + 2 Medialunas'),
('Combo Tostadas', 3800.00, 1, 'combos', 0, 'Café con leche + Tostadas con queso y mermelada'),
('Combo Tostado', 5300.00, 1, 'combos', 0, 'Café con leche + Tostado de Jamón y Queso'),
('Combo Torta', 5300.00, 1, 'combos', 0, 'Café con leche + Porción de Torta a elección'),
('Combo Saludable', 4800.00, 1, 'combos', 0, 'Café con leche + Ensalada de frutas o Yogur con cereales'),
('Combo Compartir', 7400.00, 1, 'combos', 0, '2 Café con leche + Tostado de Jamón y Queso (Para 2)');

# ///////////////////////////////////////////
# Recetas
# ///////////////////////////////////////////

combos, clasicos, bebidas calientes, cafeteria, bebidas frias, 