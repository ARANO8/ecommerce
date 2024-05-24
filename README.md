# Ecommerce
## Proyecto para la materia de Web 3 a cargo del Ph.d. Alan Corini
En este proyecto se utilizo php con el modelo MVC

## Base de Datos 
La base de datos debe ser creada con el nombre ecommerce-bd

CODIGO SQL:
-- Crear tabla CATEGORIA
CREATE TABLE CATEGORIA (
    idcategoria INT PRIMARY KEY AUTO_INCREMENT,
    nombreC VARCHAR(255) NOT NULL
);

-- Crear tabla PRODUCTO
CREATE TABLE PRODUCTO (
    idproducto INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    descripcion TEXT
);

-- Crear tabla FACTURA
CREATE TABLE FACTURA (
    idfactura INT PRIMARY KEY AUTO_INCREMENT,
    montoTotal DECIMAL(10, 2) NOT NULL,
    fecha DATE NOT NULL,
    id INT NOT NULL,
    FOREIGN KEY (id) REFERENCES USUARIO(id)
);

-- Crear tabla USUARIO
CREATE TABLE USUARIO (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL UNIQUE,
    user VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    direccion TEXT,
    cliente BOOLEAN NOT NULL DEFAULT FALSE,
    vendedor BOOLEAN NOT NULL DEFAULT FALSE
);

-- Crear tabla INCLUYE (relación entre CATEGORIA y PRODUCTO)
CREATE TABLE INCLUYE (
    idcategoria INT NOT NULL,
    idproducto INT NOT NULL,
    PRIMARY KEY (idcategoria, idproducto),
    FOREIGN KEY (idcategoria) REFERENCES CATEGORIA(idcategoria),
    FOREIGN KEY (idproducto) REFERENCES PRODUCTO(idproducto)
);

-- Crear tabla COMPRA (relación entre PRODUCTO y FACTURA)
CREATE TABLE COMPRA (
    idproducto INT NOT NULL,
    idfactura INT NOT NULL,
    precioventa DECIMAL(10, 2) NOT NULL,
    cantidad INT NOT NULL,
    PRIMARY KEY (idproducto, idfactura),
    FOREIGN KEY (idproducto) REFERENCES PRODUCTO(idproducto),
    FOREIGN KEY (idfactura) REFERENCES FACTURA(idfactura)
);

-- Crear tabla VENDE (relación entre USUARIO y PRODUCTO)
CREATE TABLE VENDE (
    idvendedor INT NOT NULL,
    idproducto INT NOT NULL,
    cantidad INT NOT NULL,
    PRIMARY KEY (idvendedor, idproducto),
    FOREIGN KEY (idvendedor) REFERENCES USUARIO(id),
    FOREIGN KEY (idproducto) REFERENCES PRODUCTO(idproducto)
);
