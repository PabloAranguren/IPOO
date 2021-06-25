/*CREACION TABLA teatro*/
CREATE TABLE teatro(
    idteatro bigint(11) AUTO_INCREMENT,
    nombre varchar(50),
    direccion varchar(50),
    PRIMARY KEY (idteatro)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

/*CREACION TABLA funcion*/
    CREATE TABLE funcion (
    idfuncion bigint(11) AUTO_INCREMENT,
    nombre varchar(50),
    precio float,
    fecha date,
    horainicio varchar(5),
    duracion int(3),
    idteatro bigint(11),
    PRIMARY KEY (idfuncion),
    FOREIGN KEY (idteatro) REFERENCES teatro (idteatro)
    ON UPDATE CASCADE
    ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;

/*CREACION TABLA cine*/
CREATE TABLE cine (
    idfuncion bigint(11),
    genero varchar(20),
    pais varchar(50),
    PRIMARY KEY (idfuncion),
    FOREIGN KEY (idfuncion) REFERENCES funcion (idfuncion)
    ON UPDATE CASCADE
    ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*CREACION TABLA musical*/
CREATE TABLE musical (
    idfuncion bigint(11),
    director varchar(50),
    cantpersonas int(3),
    PRIMARY KEY (idfuncion),
    FOREIGN KEY (idfuncion) REFERENCES funcion (idfuncion)
    ON UPDATE CASCADE
    ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*CREACION TABLA obra*/
CREATE TABLE obra (
    idfuncion bigint(11),
    PRIMARY KEY (idfuncion),
    FOREIGN KEY (idfuncion) REFERENCES funcion (idfuncion)
    ON UPDATE CASCADE
    ON DELETE CASCADE
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;