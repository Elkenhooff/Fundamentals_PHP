CREATE DATABASE Saguadim;
USE Saguadim;

-- Criação da Tabela de Usuários
CREATE TABLE usuarios(
    usu_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usu_login VARCHAR(30) NOT NULL,
    usu_email VARCHAR(100) NOT NULL,
    usu_senha VARCHAR(50) NOT NULL,
    usu_status CHAR(1) NOT NULL,
    usu_key VARCHAR(10) NOT NULL
);

-- Criação da Tabela de Clientes
CREATE TABLE cliente(
    cli_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cli_nome VARCHAR(50) NOT NULL,
    cli_email VARCHAR(100) NOT NULL,
    cli_telefone BIGINT NOT NULL,
    cli_cpf VARCHAR(20) NOT NULL,
    cli_curso VARCHAR(50) NOT NULL,
    cli_sala INT NOT NULL,
    cli_status CHAR(1) NOT NULL,
    cli_saldo FLOAT(10,2) NOT NULL
);

-- Criação da Tabela de Fornecedores
CREATE TABLE fornecedores(
    for_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    for_nome VARCHAR(50) NOT NULL
);

-- Criação da Tabela de Produtos
CREATE TABLE produtos(
    pro_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pro_nome VARCHAR(100) NOT NULL,
    pro_descricao VARCHAR(150) NOT NULL,
    pro_custo DECIMAL(10,2) NOT NULL,
    pro_preco DECIMAL(10,2) NOT NULL,
    pro_quantidade INT NOT NULL,
    pro_validade DATE NOT NULL,
    fk_for_id INT NOT NULL,
    pro_status CHAR(1) NOT NULL
);

-- Criação da Tabela de Encomendas
CREATE TABLE encomendas(
    enc_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    enc_emissao DATETIME NOT NULL,
    enc_entrega DATETIME NOT NULL,
    fk_pro_id INT NOT NULL,
    fk_cli_id INT NOT NULL,
    fk_ven_id INT NOT NULL,
    enc_status CHAR(1) NOT NULL
);

-- Criação da Tabela de Vendas
CREATE TABLE vendas(
    ven_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ven_data DATETIME NOT NULL,
    fk_cli_id INT NOT NULL,
    fk_iv_codigo VARCHAR(50) NOT NULL,
    ven_total DECIMAL(10,2) NOT NULL
);

CREATE TABLE item_venda(
    iv_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    iv_quantidade INT NOT NULL,
    iv_total DECIMAL(10,2),
    iv_codigo VARCHAR(50) NOT NULL,
    fk_pro_id INT NOT NULL
);

-- Criação da Tabela de Log
CREATE TABLE table_log(
    tab_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tab_query VARCHAR(500) NOT NULL,
    tab_data DATETIME NOT NULL
);

-- Chaves Estrangeiras

-- Chave Produtos
ALTER TABLE produtos ADD CONSTRAINT fk_for_id_pro FOREIGN KEY produtos(fk_for_id) REFERENCES fornecedores(for_id);

-- Chave Encomendas
ALTER TABLE encomendas ADD CONSTRAINT fk_pro_id_enc FOREIGN KEY encomendas(fk_pro_id) REFERENCES produtos(pro_id);
ALTER TABLE encomendas ADD CONSTRAINT fk_cli_id_enc FOREIGN KEY encomendas(fk_cli_id) REFERENCES cliente(cli_id);
ALTER TABLE encomendas ADD CONSTRAINT fk_ven_id_enc FOREIGN KEY encomendas(fk_ven_id) REFERENCES vendas(ven_id);

-- Chave Vendas
ALTER TABLE vendas ADD CONSTRAINT fk_cli_id_ven FOREIGN KEY vendas(fk_cli_id) REFERENCES cliente(cli_id);
-- ALTER TABLE vendas ADD CONSTRAINT fk_iv_codigo_ven FOREIGN KEY vendas(fk_iv_codigo) REFERENCES item_venda(iv_codigo);

-- Chave Item Venda
ALTER TABLE item_venda ADD CONSTRAINT fk_pro_id_iv FOREIGN KEY item_venda(fk_pro_id) REFERENCES produtos(pro_id);