// Menu mobile
const btnMenuMobile = document.getElementById('btnMenuMobile');
const menuPrincipal = document.getElementById('menuPrincipal');

if (btnMenuMobile && menuPrincipal) {
    btnMenuMobile.addEventListener('click', () => {
        menuPrincipal.classList.toggle('aberto');
    });
}

// Filtro por categoria
const botoesCategoria = document.querySelectorAll('.cat-item');
const cardsProduto = document.querySelectorAll('.card-produto');

botoesCategoria.forEach((botao) => {
    botao.addEventListener('click', () => {
        botoesCategoria.forEach((b) => b.classList.remove('ativo'));
        botao.classList.add('ativo');

        const categoriaEscolhida = botao.getAttribute('data-categoria');

        cardsProduto.forEach((card) => {
            const catCard = card.getAttribute('data-categoria');
            if (categoriaEscolhida === 'todos' || catCard === categoriaEscolhida) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

// Busca de produtos
const campoBusca = document.getElementById('campoBusca');
const btnBuscar = document.getElementById('btnBuscar');

function filtrarPorNome() {
    if (!campoBusca) return;
    const termo = campoBusca.value.toLowerCase().trim();

    cardsProduto.forEach((card) => {
        const nome = card.getAttribute('data-nome');
        card.style.display = nome.includes(termo) ? 'flex' : 'none';
    });
}

if (btnBuscar) {
    btnBuscar.addEventListener('click', filtrarPorNome);
}
if (campoBusca) {
    campoBusca.addEventListener('keyup', filtrarPorNome);
}

// Carrinho simples + aviso
let totalItens = 0;
const contadorCarrinho = document.getElementById('contadorCarrinho');
const toastAviso = document.getElementById('toastAviso');
const botoesAdd = document.querySelectorAll('.btn-add');

botoesAdd.forEach((btn) => {
    btn.addEventListener('click', () => {
        totalItens++;
        if (contadorCarrinho) {
            contadorCarrinho.textContent = totalItens;
        }
        const nomeProduto = btn.getAttribute('data-nome');
        if (toastAviso) {
            toastAviso.textContent = `"${nomeProduto}" adicionado ao carrinho!`;
            toastAviso.style.display = 'block';
            setTimeout(() => {
                toastAviso.style.display = 'none';
            }, 2500);
        }
    });
});

// Validação da Newsletter
const formNews = document.getElementById('formNewsletter');
if (formNews) {
    formNews.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = document.getElementById('emailNews').value.trim();
        const msg = document.getElementById('msgNews');

        if (email === '' || !email.includes('@') || !email.includes('.')) {
            msg.textContent = 'Por favor, informe um e-mail válido.';
            msg.style.color = '#dc2626';
        } else {
            msg.textContent = 'Inscrição realizada com sucesso!';
            msg.style.color = '#166534';
            formNews.reset();
        }
    });
}

// Validação do formulário de contato
const formContato = document.getElementById('formContato');
if (formContato) {
    formContato.addEventListener('submit', (e) => {
        e.preventDefault();
        const nome = document.getElementById('nomeContato').value.trim();
        const email = document.getElementById('emailContato').value.trim();
        const assunto = document.getElementById('assuntoContato').value;
        const texto = document.getElementById('msgTexto').value.trim();
        const msg = document.getElementById('msgContato');

        if (nome.length < 3 || !email.includes('@') || assunto === '' || texto.length < 10) {
            msg.textContent = 'Preencha todos os campos corretamente (mensagem com mínimo de 10 caracteres).';
            msg.style.color = '#dc2626';
        } else {
            msg.textContent = 'Mensagem enviada com sucesso! Retornaremos em breve.';
            msg.style.color = '#166534';
            formContato.reset();
        }
    });
}