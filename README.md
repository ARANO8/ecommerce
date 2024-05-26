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


-->>>>>>>>>>>>>>>>BASE DE DATOS REFACTORIZADA<<<<<<<<<<<<<<<<<<

CATEGORIA(idcategoria, nombreC )
		INCLUYE( idcategoria, idproducto , )
PRODUCTO( idproducto, nombre, precio, stock , descripcion, idimgprod)
		IMGPRODUC(idimg, rutaimagen) 	
		COMPRA (idproducto, idfactura, precioventa, cantidad,)
FACTURA( idfactura,montoTotal, fecha , id  )
		VENDE(civendedor, idproducto, cantidad)
USUARIO(id, nombre, correo, user, password, direccion, fotoperfil, cliente, vendedor,)

-->>>>>>>>>>>>>>>>>>>>CONSULTA SQL<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-04:00";

CREATE TABLE `categoria` (
  `idcategoria` INT(11) NOT NULL AUTO_INCREMENT,
  `nombreC` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `imgproduc` (
  `idimg` INT(11) NOT NULL AUTO_INCREMENT,
  `rutaimagen` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idimg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `correo` VARCHAR(100) NOT NULL UNIQUE,
  `user` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `direccion` TEXT,
  `fotoperfil` VARCHAR(255),
  `cliente` TINYINT(1) NOT NULL DEFAULT 0,
  `vendedor` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `producto` (
  `idproducto` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `precio` DECIMAL(10,2) NOT NULL,
  `stock` INT(11) NOT NULL,
  `descripcion` TEXT,
  `idimgprod` INT(11) NOT NULL,
  PRIMARY KEY (`idproducto`),
  KEY `fk_imgprod` (`idimgprod`),
  CONSTRAINT `fk_producto_imgprod` FOREIGN KEY (`idimgprod`) REFERENCES `imgproduc` (`idimg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `factura` (
  `idfactura` INT(11) NOT NULL AUTO_INCREMENT,
  `montoTotal` DECIMAL(10,2) NOT NULL,
  `fecha` DATE NOT NULL,
  `id` INT(11) NOT NULL,
  PRIMARY KEY (`idfactura`),
  KEY `fk_usuario` (`id`),
  CONSTRAINT `fk_factura_usuario` FOREIGN KEY (`id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `compra` (
  `idproducto` INT(11) NOT NULL,
  `idfactura` INT(11) NOT NULL,
  `precioventa` DECIMAL(10,2) NOT NULL,
  `cantidad` INT(11) NOT NULL,
  PRIMARY KEY (`idproducto`, `idfactura`),
  KEY `fk_factura` (`idfactura`),
  CONSTRAINT `fk_compra_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`),
  CONSTRAINT `fk_compra_factura` FOREIGN KEY (`idfactura`) REFERENCES `factura` (`idfactura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `incluye` (
  `idcategoria` INT(11) NOT NULL,
  `idproducto` INT(11) NOT NULL,
  PRIMARY KEY (`idcategoria`, `idproducto`),
  KEY `fk_producto` (`idproducto`),
  CONSTRAINT `fk_incluye_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`),
  CONSTRAINT `fk_incluye_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `vende` (
  `idvendedor` INT(11) NOT NULL,
  `idproducto` INT(11) NOT NULL,
  `cantidad` INT(11) NOT NULL,
  PRIMARY KEY (`idvendedor`, `idproducto`),
  KEY `fk_producto` (`idproducto`),
  CONSTRAINT `fk_vende_vendedor` FOREIGN KEY (`idvendedor`) REFERENCES `usuario` (`id`),
  CONSTRAINT `fk_vende_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;







