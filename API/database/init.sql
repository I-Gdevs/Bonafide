CREATE DATABASE IF NOT EXISTS bonafide;

USE bonafide;

# Proveedores, comprobantes de compra y stock
CREATE TABLE proveedores (
	id_proveedor INT(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre_proveedor VARCHAR(100) NOT NULL,
	cuit_proveedor INT(12) NOT NULL,
	detalle_proveedor VARCHAR(100)
);

CREATE TABLE comprobante_compra (
	id_comprobante INT(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fecha_comprobante DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	numero_comprobante INT(9),
	precio_comprobante DECIMAL(10, 2),
	id_proveedor INT,
	CONSTRAINT fk_comprobante_compra_proveedor FOREIGN KEY (id_proveedor) REFERENCES proveedores(id_proveedor)
);

CREATE TABLE detalle_compra (
	id_detalle_compra INT(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	precio_unitario DECIMAL(10, 2) NOT NULL,
	id_comprobante INT,
	id_ingrediente INT,
	CONSTRAINT fk_detalle_comprobante FOREIGN KEY (id_comprobante) REFERENCES comprobante_compra(id_comprobante),
	CONSTRAINT fk_detalle_ingrediente FOREIGN KEY (id_ingrediente) REFERENCES ingredientes(id_ingrediente)
);

CREATE TABLE locales (
	id_local INT(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	direccion_local VARCHAR(100) NOT NULL,
	empleados_local INT(5) NOT NULL,
	id_usuario INT NOT NULL,
	CONSTRAINT fk_local_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE ingredientes (
	id_ingrediente INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre_ingrediente VARCHAR(100) NOT NULL,
	cantidad_ingrediente FLOAT(9),
	unidad_medida_ingrediente VARCHAR(10),
	id_local INT,
	CONSTRAINT fk_ingrediente_local FOREIGN KEY (id_local) REFERENCES locales(id_local)
);

CREATE TABLE recetas(
	id_receta INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_producto INT,
	CONSTRAINT fk_receta_producto FOREIGN KEY (id_producto) REFERENCES producto_para_venta(id_producto),
	descripcion_receta VARCHAR(200),
	tiempo_preparacion_receta TIME NOT NULL
);

CREATE TABLE ingredientes_para_receta (
	id_ing_para_receta INT(7) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_ingrediente INT(6),
	CONSTRAINT fk_ingrediente_para_receta FOREIGN KEY (id_ingrediente) REFERENCES ingredientes(id_ingrediente),
	id_receta INT(6),
	CONSTRAINT fk_ingrediente_receta FOREIGN KEY (id_receta) REFERENCES recetas(id_receta),
	cantidad_para_receta INT(6) NOT NULL,
	unidad_de_medida_receta VARCHAR(10)
);

# Carrito de compra, comandas, venta y cobro de productos a clientes finales
CREATE TABLE producto_para_venta (
	id_producto INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre_producto VARCHAR(100) NOT NULL,
	precio_producto DECIMAL(10, 2),
	es_combo_bool bool,
	cantidad_stock INT(9)
);

CREATE TABLE carrito_de_compra (
	id_carrito INT(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_local INT,
	CONSTRAINT fk_cdc_local FOREIGN KEY (id_local) REFERENCES locales(id_local),
	id_usuario INT,
	CONSTRAINT fk_cdc_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
	id_producto INT,
	CONSTRAINT fk_cdc_producto FOREIGN KEY (id_producto) REFERENCES producto_para_venta(id_producto),
	precio_cdc DECIMAL(10, 2) NOT NULL,
	fecha_cdc DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE estados_comanda(
	id_estado INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre_estado VARCHAR(100) NOT NULL
);

CREATE TABLE comandas(
	id_comanda INT(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_carrito INT,
	CONSTRAINT id_carrito_compra_comanda FOREIGN KEY (id_carrito) REFERENCES carrito_de_compra(id_carrito),
	fecha_inicio_comanda DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	temporizador_comanda DATETIME,
	id_estado INT,
	CONSTRAINT id_comada_estado FOREIGN KEY (id_estado) REFERENCES estados_comanda(id_estado)
);

CREATE TABLE ventas (
	id_venta INT(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fecha_venta DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	tipo_factura_venta VARCHAR(10) NOT NULL ,
	id_comanda INT,
	CONSTRAINT fk_venta_comanda FOREIGN KEY (id_comanda) REFERENCES comandas(id_comanda)
);

CREATE TABLE cobros (
	id_cobro INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	precio_total_cobro DECIMAL(10, 2) NOT NULL,
	fecha_cobro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	id_venta INT,
	CONSTRAINT fk_cobro_venta FOREIGN KEY (id_venta) REFERENCES ventas(id_venta)
);