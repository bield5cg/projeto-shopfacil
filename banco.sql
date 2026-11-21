CREATE DATABASE shopfacil_db;
USE shopfacil_db;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    secao VARCHAR(20) NOT NULL,
    imagem VARCHAR(255)
);

INSERT INTO produtos (nome, categoria, preco, secao, imagem) VALUES
('Smartphone Pro 128GB', 'Eletrônicos', 2899.00, 'destaque', 'img/celular.jpg'),
('Smartwatch Sport Fit', 'Eletrônicos', 349.90, 'destaque', 'img/relogio.jpg'),
('Fone Bluetooth Cancelamento', 'Eletrônicos', 499.00, 'destaque', 'img/fone.jpg'),
('Tênis Corrida Masculino', 'Esportes', 279.90, 'destaque', 'img/tenis.jpg'),
('Mochila Executiva Viagem', 'Moda', 159.90, 'destaque', 'img/mochila.jpg'),
('Headphone Sem Fio Studio', 'Eletrônicos', 229.90, 'mais_vendido', 'img/headphone.jpg'),
('Camiseta Básica Algodão', 'Moda', 69.90, 'mais_vendido', 'img/camiseta.jpg'),
('Cafeteira Elétrica Inox', 'Casa & Cozinha', 249.00, 'mais_vendido', 'img/cafeteira.jpg'),
('Bolsa Feminina Casual', 'Moda', 189.90, 'mais_vendido', 'img/bolsa.jpg'),
('Smart TV LED 43" Full HD', 'Eletrônicos', 1799.00, 'mais_vendido', 'img/tv.jpg');