# ShopFacil - Loja Virtual com CRUD em PHP

Projeto desenvolvido para o trabalho final da disciplina de **Desenvolvimento Web (HTML, CSS, JavaScript e PHP)** do curso de Análise e Desenvolvimento de Sistemas (Estácio).

## Sobre o projeto
A **ShopFacil** é uma loja virtual de departamentos com vitrine responsiva, busca e filtro de produtos, carrinho simples, página de contato com validação e um painel administrativo com CRUD completo ligado ao MySQL.

## Tecnologias utilizadas
- **HTML5** (estrutura semântica, múltiplas páginas e formulários)
- **CSS3** (layout externo com Flexbox, Grid e responsividade mobile)
- **JavaScript** (filtro por categoria, busca por nome, contador do carrinho, menu mobile e validação de formulários)
- **PHP + PDO** (conexão com banco de dados e CRUD completo)
- **MySQL** (armazenamento dos produtos via XAMPP / phpMyAdmin)

## Estrutura de pastas
```text
ShopFacil/
├── banco.sql        # Script para criar o banco e a tabela de produtos
├── conexao.php      # Conexão com o MySQL usando PDO
├── index.php        # Página inicial da loja (vitrine)
├── contato.php      # Página de contato com validação em JS
├── admin.php        # Painel CRUD (cadastrar e listar produtos)
├── editar.php       # Edição de produtos cadastrados
├── excluir.php      # Exclusão de produtos
├── css/
│   └── style.css    # Estilos e media queries
├── js/
│   └── script.js    # Interações da página
└── img/             # Imagens dos produtos
