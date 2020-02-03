CREATE DATABASE IF NOT EXISTS introducao_docker;
USE introducao_docker;

CREATE TABLE  IF NOT EXISTS products (
    id INT(11) AUTO_INCREMENT,
    name VARCHAR (255),
    price DECIMAL (10,2),
    PRIMARY KEY (id)
);

insert into products value (0, 'Curso de Front', 25000);
insert into products value (0, 'Curso de JS', 900);
