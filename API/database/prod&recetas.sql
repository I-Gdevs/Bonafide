
# ///////////////////////////////////////////
# Productos
# ///////////////////////////////////////////


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
# Modelo de Articulos
# ///////////////////////////////////////////

INSERT INTO modelos_de_articulos (nombre_modelo_articulo, unidad_medida_modelo_articulo, modelo_articulo_desactivado_bool) VALUES 
-- Cafetería
('Café en Grano', 'kg', 0),
('Leche Entera', 'lt', 0),
('Leche Almendras', 'lt', 0),
('Crema de Leche', 'lt', 0),
('Agua Mineral', 'lt', 0),
('Cacao en Polvo', 'kg', 0),
('Barra Chocolate Submarino', 'un', 0),
('Té en Saquito', 'un', 0),
('Yerba Mate', 'kg', 0),

-- Jarabes y Salsas
('Salsa de Caramelo', 'lt', 0),
('Salsa de Chocolate', 'lt', 0),
('Dulce de Leche', 'kg', 0),
('Esencia Vainilla', 'lt', 0),
('Esencia Avellana', 'lt', 0),
('Esencia Licor Café', 'lt', 0),
('Esencia Licor Crema', 'lt', 0),
('Esencia Licor Whisky', 'lt', 0),

-- Golosinas / Adicionales
('Bocadito Bonafide', 'un', 0),
('Nugaton', 'un', 0),
('Chocman', 'un', 0),
('Donut Americana', 'un', 0),
('Galletas Amaretti', 'kg', 0),
('Canela en Polvo', 'kg', 0),

-- Panadería y Comida
('Medialuna Cocida', 'un', 0),
('Pan de Miga (Feta)', 'un', 0),
('Pan Arabe', 'un', 0),
('Pan Ciabatta', 'un', 0),
('Pan Bagel', 'un', 0),
('Jamón Cocido', 'kg', 0),
('Jamón Crudo', 'kg', 0),
('Queso Tybo (Máquina)', 'kg', 0),
('Queso Crema', 'kg', 0),
('Pollo Cocido', 'kg', 0),
('Peceto', 'kg', 0),
('Vegetales Grillados', 'kg', 0),
('Mermelada Individual', 'un', 0),

-- Pastelería
('Porción Torta Base', 'un', 0),
('Cuadrado Dulce Base', 'un', 0),
('Muffin Base', 'un', 0),
('Alfajor Maicena', 'un', 0),
('Cookie', 'un', 0);

# ///////////////////////////////////////////
# Recetas
# ///////////////////////////////////////////

-- 1. Café Expresso (Solo café)
INSERT INTO recetas (id_producto, descripcion_receta, tiempo_preparacion_receta)
SELECT id_producto, 'Extracción de 30ml', '00:02:00' FROM producto_para_venta WHERE nombre_producto = 'Café Expresso';

INSERT INTO ingredientes_para_receta (id_receta, id_modelo_articulo, cantidad_para_receta)
SELECT r.id_receta, m.id_modelo_articulo, 0.009 -- 9 gramos de café
FROM recetas r JOIN producto_para_venta p ON r.id_producto = p.id_producto
JOIN modelos_de_articulos m ON m.nombre_modelo_articulo = 'Café en Grano'
WHERE p.nombre_producto = 'Café Expresso';

-- 2. Café con Leche (Café + Leche)
INSERT INTO recetas (id_producto, descripcion_receta, tiempo_preparacion_receta)
SELECT id_producto, 'Mitad café, mitad leche texturizada', '00:03:00' FROM producto_para_venta WHERE nombre_producto = 'Café con Leche';

INSERT INTO ingredientes_para_receta (id_receta, id_modelo_articulo, cantidad_para_receta)
SELECT r.id_receta, m.id_modelo_articulo, 0.009 -- Café
FROM recetas r JOIN producto_para_venta p ON r.id_producto = p.id_producto
JOIN modelos_de_articulos m ON m.nombre_modelo_articulo = 'Café en Grano' WHERE p.nombre_producto = 'Café con Leche'
UNION ALL
SELECT r.id_receta, m.id_modelo_articulo, 0.150 -- 150ml Leche
FROM recetas r JOIN producto_para_venta p ON r.id_producto = p.id_producto
JOIN modelos_de_articulos m ON m.nombre_modelo_articulo = 'Leche Entera' WHERE p.nombre_producto = 'Café con Leche';

-- 3. Submarino (Leche + Barra Chocolate)
INSERT INTO recetas (id_producto, descripcion_receta, tiempo_preparacion_receta)
SELECT id_producto, 'Leche bien caliente con barra', '00:04:00' FROM producto_para_venta WHERE nombre_producto = 'Submarino';

INSERT INTO ingredientes_para_receta (id_receta, id_modelo_articulo, cantidad_para_receta)
SELECT r.id_receta, m.id_modelo_articulo, 0.250 -- 250ml Leche
FROM recetas r JOIN producto_para_venta p ON r.id_producto = p.id_producto
JOIN modelos_de_articulos m ON m.nombre_modelo_articulo = 'Leche Entera' WHERE p.nombre_producto = 'Submarino'
UNION ALL
SELECT r.id_receta, m.id_modelo_articulo, 1 -- 1 Barra
FROM recetas r JOIN producto_para_venta p ON r.id_producto = p.id_producto
JOIN modelos_de_articulos m ON m.nombre_modelo_articulo = 'Barra Chocolate Submarino' WHERE p.nombre_producto = 'Submarino';

-- 4. Bocadito Cream (Café + Leche + Dulce de Leche + Salsa + Bocadito)
INSERT INTO recetas (id_producto, descripcion_receta, tiempo_preparacion_receta)
SELECT id_producto, 'Base DDL, Café, Leche, Crema, Salsa', '00:05:00' FROM producto_para_venta WHERE nombre_producto = 'Bocadito Cream';

INSERT INTO ingredientes_para_receta (id_receta, id_modelo_articulo, cantidad_para_receta)
SELECT r.id_receta, m.id_modelo_articulo, cantidad
FROM recetas r JOIN producto_para_venta p ON r.id_producto = p.id_producto,
(
    SELECT id_modelo_articulo, 0.009 as cantidad FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Café en Grano'
    UNION ALL SELECT id_modelo_articulo, 0.150 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Leche Entera'
    UNION ALL SELECT id_modelo_articulo, 0.030 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Dulce de Leche'
    UNION ALL SELECT id_modelo_articulo, 0.020 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Salsa de Caramelo'
    UNION ALL SELECT id_modelo_articulo, 1 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Bocadito Bonafide'
    UNION ALL SELECT id_modelo_articulo, 0.030 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Crema de Leche'
) as insumos
JOIN modelos_de_articulos m ON m.id_modelo_articulo = insumos.id_modelo_articulo
WHERE p.nombre_producto = 'Bocadito Cream';

-- 5. Nugaton Cream (Similar estructura)
INSERT INTO recetas (id_producto, descripcion_receta, tiempo_preparacion_receta)
SELECT id_producto, 'Café, Leche, Salsa Choco, Nugaton', '00:05:00' FROM producto_para_venta WHERE nombre_producto = 'Nugaton Cream';

INSERT INTO ingredientes_para_receta (id_receta, id_modelo_articulo, cantidad_para_receta)
SELECT r.id_receta, m.id_modelo_articulo, cantidad
FROM recetas r JOIN producto_para_venta p ON r.id_producto = p.id_producto,
(
    SELECT id_modelo_articulo, 0.009 as cantidad FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Café en Grano'
    UNION ALL SELECT id_modelo_articulo, 0.150 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Leche Entera'
    UNION ALL SELECT id_modelo_articulo, 0.020 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Salsa de Chocolate'
    UNION ALL SELECT id_modelo_articulo, 1 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Nugaton'
    UNION ALL SELECT id_modelo_articulo, 0.030 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Crema de Leche'
) as insumos
JOIN modelos_de_articulos m ON m.id_modelo_articulo = insumos.id_modelo_articulo
WHERE p.nombre_producto = 'Nugaton Cream';

-- 6. Sandwich Tostado J/Q (Pan + Jamon + Queso)
INSERT INTO recetas (id_producto, descripcion_receta, tiempo_preparacion_receta)
SELECT id_producto, 'Tostado de miga clásico', '00:07:00' FROM producto_para_venta WHERE nombre_producto = 'Sandwich Tostado J/Q';

INSERT INTO ingredientes_para_receta (id_receta, id_modelo_articulo, cantidad_para_receta)
SELECT r.id_receta, m.id_modelo_articulo, cantidad
FROM recetas r JOIN producto_para_venta p ON r.id_producto = p.id_producto,
(
    SELECT id_modelo_articulo, 2 as cantidad FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Pan de Miga (Feta)'
    UNION ALL SELECT id_modelo_articulo, 0.040 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Jamón Cocido'
    UNION ALL SELECT id_modelo_articulo, 0.040 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Queso Tybo (Máquina)'
) as insumos
JOIN modelos_de_articulos m ON m.id_modelo_articulo = insumos.id_modelo_articulo
WHERE p.nombre_producto = 'Sandwich Tostado J/Q';

-- 7. Bagel Caesar (Pan Bagel + Pollo)
INSERT INTO recetas (id_producto, descripcion_receta, tiempo_preparacion_receta)
SELECT id_producto, 'Bagel con pollo', '00:10:00' FROM producto_para_venta WHERE nombre_producto = 'Bagel Caesar';

INSERT INTO ingredientes_para_receta (id_receta, id_modelo_articulo, cantidad_para_receta)
SELECT r.id_receta, m.id_modelo_articulo, cantidad
FROM recetas r JOIN producto_para_venta p ON r.id_producto = p.id_producto,
(
    SELECT id_modelo_articulo, 1 as cantidad FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Pan Bagel'
    UNION ALL SELECT id_modelo_articulo, 0.100 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Pollo Cocido'
) as insumos
JOIN modelos_de_articulos m ON m.id_modelo_articulo = insumos.id_modelo_articulo
WHERE p.nombre_producto = 'Bagel Caesar';

-- 8. Combo Clásico Medialunas
INSERT INTO recetas (id_producto, descripcion_receta, tiempo_preparacion_receta)
SELECT id_producto, 'Café c/leche y 2 medialunas', '00:04:00' FROM producto_para_venta WHERE nombre_producto = 'Combo Clásico Medialunas';

INSERT INTO ingredientes_para_receta (id_receta, id_modelo_articulo, cantidad_para_receta)
SELECT r.id_receta, m.id_modelo_articulo, cantidad
FROM recetas r JOIN producto_para_venta p ON r.id_producto = p.id_producto,
(
    -- Componentes del Café
    SELECT id_modelo_articulo, 0.009 as cantidad FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Café en Grano'
    UNION ALL SELECT id_modelo_articulo, 0.150 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Leche Entera'
    -- Componentes de la Comida
    UNION ALL SELECT id_modelo_articulo, 2 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Medialuna Cocida'
) as insumos
JOIN modelos_de_articulos m ON m.id_modelo_articulo = insumos.id_modelo_articulo
WHERE p.nombre_producto = 'Combo Clásico Medialunas';

-- 9. Frappé Bocadito
INSERT INTO recetas (id_producto, descripcion_receta, tiempo_preparacion_receta)
SELECT id_producto, 'Licuado hielo, café y bocadito', '00:06:00' FROM producto_para_venta WHERE nombre_producto = 'Frappé Bocadito';

INSERT INTO ingredientes_para_receta (id_receta, id_modelo_articulo, cantidad_para_receta)
SELECT r.id_receta, m.id_modelo_articulo, cantidad
FROM recetas r JOIN producto_para_venta p ON r.id_producto = p.id_producto,
(
    SELECT id_modelo_articulo, 0.009 as cantidad FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Café en Grano'
    UNION ALL SELECT id_modelo_articulo, 0.100 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Leche Entera'
    UNION ALL SELECT id_modelo_articulo, 1 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Bocadito Bonafide'
    UNION ALL SELECT id_modelo_articulo, 0.020 FROM modelos_de_articulos WHERE nombre_modelo_articulo = 'Salsa de Chocolate'
) as insumos
JOIN modelos_de_articulos m ON m.id_modelo_articulo = insumos.id_modelo_articulo
WHERE p.nombre_producto = 'Frappé Bocadito';

-- 10. Porción de Torta
INSERT INTO recetas (id_producto, descripcion_receta, tiempo_preparacion_receta)
SELECT id_producto, 'Servir porción', '00:01:00' FROM producto_para_venta WHERE nombre_producto = 'Porción de Torta';

INSERT INTO ingredientes_para_receta (id_receta, id_modelo_articulo, cantidad_para_receta)
SELECT r.id_receta, m.id_modelo_articulo, 1
FROM recetas r JOIN producto_para_venta p ON r.id_producto = p.id_producto
JOIN modelos_de_articulos m ON m.nombre_modelo_articulo = 'Porción Torta Base'
WHERE p.nombre_producto = 'Porción de Torta';


# ///////////////////////////////////////////
# Imagenes
# ///////////////////////////////////////////

-- Añadir tabla para vincular productos con imagen en Bonafide/public/img/productos

ALTER TABLE producto_para_venta ADD COLUMN imagen_producto VARCHAR(255);

UPDATE producto_para_venta 
SET imagen_producto = CASE nombre_producto
    -- CAFETERÍA CLÁSICA
    WHEN 'Café Expresso' THEN 'img/productos/cafe_expresso.jpg'
    WHEN 'Café Jarrito' THEN 'img/productos/cafe_jarrito.jpg'
    WHEN 'Lágrima' THEN 'img/productos/lagrima.jpg'
    WHEN 'Café con Crema' THEN 'img/productos/cafe_crema.jpg'
    WHEN 'Café Doble' THEN 'img/productos/cafe_doble.jpg'
    WHEN 'Café con Leche' THEN 'img/productos/cafe_con_leche.jpg'
    WHEN 'Cappuccino' THEN 'img/productos/cappuccino.jpg'
    WHEN 'Submarino' THEN 'img/productos/submarino.jpg'
    WHEN 'Té con Leche' THEN 'img/productos/te_con_leche.jpg'
    
    -- ESPECIALES (CREAMS)
    WHEN 'Bocadito Cream' THEN 'img/productos/cream_choco.jpg'
    WHEN 'Donuts Cream' THEN 'img/productos/cream_caramel.jpg'
    WHEN 'Nugaton Cream' THEN 'img/productos/cream_avellana.jpg'
    WHEN 'Chocman Cream' THEN 'img/productos/cream_intenso.jpg'
    WHEN 'Café Calipso' THEN 'img/productos/cafe_calipso.jpg'
    WHEN 'Café Inglés' THEN 'img/productos/cafe_ingles.jpg'
    WHEN 'Café Irlandés' THEN 'img/productos/cafe_irlandes.jpg'

    -- BEBIDAS FRÍAS
    WHEN 'Frappé Bocadito' THEN 'img/productos/frappe_choco.jpg'
    WHEN 'Frappé Nugaton' THEN 'img/productos/frappe_avellana.jpg'
    WHEN 'Frappé Amaretti' THEN 'img/productos/frappe_almendra.jpg'
    WHEN 'Milkshake' THEN 'img/productos/milkshake.jpg'
    WHEN 'Limonada' THEN 'img/productos/limonada.jpg'
    WHEN 'Jugo Exprimido' THEN 'img/productos/jugo_naranja.jpg'

    -- COMIDA Y COMBOS
    WHEN 'Combo Clásico Medialunas' THEN 'img/productos/combo_medialunas.jpg'
    WHEN 'Combo Tostadas' THEN 'img/productos/combo_tostadas.jpg'
    WHEN 'Combo Tostado' THEN 'img/productos/combo_tostado.jpg'
    WHEN 'Sandwich Tostado J/Q' THEN 'img/productos/tostado_jq.jpg'
    WHEN 'Croissant Relleno' THEN 'img/productos/croissant_relleno.jpg'
    WHEN 'Bagel Caesar' THEN 'img/productos/bagel_pollo.jpg'
    WHEN 'Ciabatta de Peceto' THEN 'img/productos/ciabatta.jpg'
    WHEN 'Wrap de Pollo' THEN 'img/productos/wrap.jpg'
    WHEN 'Tarta del Día' THEN 'img/productos/tarta.jpg'

    -- PASTELERÍA
    WHEN 'Porción de Torta' THEN 'img/productos/torta_porcion.jpg'
    WHEN 'Cuadrado Dulce' THEN 'img/productos/brownie.jpg'
    WHEN 'Muffin' THEN 'img/productos/muffin.jpg'
    WHEN 'Alfajor de Maicena' THEN 'img/productos/alfajor.jpg'
    WHEN 'Cookies (x2)' THEN 'img/productos/cookies.jpg'
    WHEN 'Donas' THEN 'img/productos/dona.jpg'
    
    ELSE 'img/productos/default.jpg' -- Imagen por defecto si falta alguna
END;