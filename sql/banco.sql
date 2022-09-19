CREATE DATABASE api_teste CHARACTER SET utf8 COLLATE utf8_general_ci;
USE api_teste;

CREATE TABLE tipo_usuario (
                              id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                              descricao VARCHAR(100) NOT NULL,
                              PRIMARY KEY(id)
);


CREATE TABLE usuarios (
                          id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                          tipo_usuario_id  INT UNSIGNED NOT NULL,
                          nome VARCHAR(200) NOT NULL,
                          sobrenome VARCHAR(200) NOT NULL,
                          cpf VARCHAR(45) NOT NULL,
                          email VARCHAR(200) UNIQUE NOT NULL,
                          senha VARCHAR(200) NOT NULL,
                          saldo DECIMAL(10,2) NOT NULL,
                          CONSTRAINT fk_tipo_usuario_id_tipo_usuario_id
                              FOREIGN KEY (tipo_usuario_id) REFERENCES tipo_usuario(id)
);

INSERT INTO `api_teste`.`tipo_usuario`
(`id`,
 `descricao`)
VALUES
    (1,
     "lojista");

INSERT INTO `api_teste`.`tipo_usuario`
(`id`,
 `descricao`)
VALUES
    (2,
     "comuns");
