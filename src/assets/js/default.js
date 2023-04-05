var urlOrigin = window.location.origin;
var urlPathname = '/' + window.location.pathname.split('/')[1];
var newUrl;

if (urlPathname) {
    newUrl = urlOrigin + urlPathname;
} else {
    newUrl = urlOrigin;
}

var body = document.querySelector('body');

// DATA ATUALIZADA DO FOOTER

const copyright = document.querySelector(".copyright");

let today = new Date();
let currentYear = today.getFullYear();

copyright.innerHTML = `<p>© Container Media Corp USA ${currentYear} - Todos os Direitos Reservados.</p>`; // EXIBE SEMPRE O ANO ATUAL

// CAROUSEL NO ARROWS
const liveCarousel = document.getElementById('liveChannelsCarousel');

if (liveCarousel) {
    const carouselArea = document.querySelector(".carouselcontainer_carousel");
    const carouselContainer = document.querySelector(".carouselcontainer_carousel .container");
    const carouselItems = document.querySelectorAll(".container .image_container");
    const carouselButtons = document.querySelectorAll(".carouselcontainer_navigation .navigation_item");

    let widthArea = window.screen.width;

    if (widthArea <= 540) {
        carouselArea.style.width = `${widthArea}px`;
    } else {
        carouselArea.style.width = `${widthArea - 100}px`;
    }


    const itemWidth = carouselItems[0].offsetWidth; // PEGA O TAMANHO DO ITEM BASEADO NO PRIMEIRO ITEM DO ARRAY

    function moveCarousel(index) {
        // REALIZA A ANIMAÇÃO DE TRANSFORM BASEADO NO TAMANHO DO ITEM VEZES DATA-INDEX DELE (EXEMPLO: ITEM * 0) ELE NAO MOVE, (ITEM * 1) ELE MOVE O TAMANHO DELE 1X
        carouselContainer.style.transform = `translate(-${itemWidth * index}px)`;
    };

    carouselButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const index = btn.getAttribute('data-index');
            const select = document.getElementsByClassName('carouselcontainer_navigation')[0].getElementsByClassName('active')[0];

            if (select) {
                select.classList.remove('active');
            }
            btn.classList.add('active');

            moveCarousel(index);
        })
    })
}

// CAROUSEL W/ ARROWS
const carouselPage = document.getElementById('carouselPage');

if (carouselPage) {

    const carouselContainer = document.querySelector('.content_carousel');
    const carouselItems = document.querySelectorAll('.carousel_item');
    const prevButton = document.querySelector('.carousel_container .prev');
    const nextButton = document.querySelector('.carousel_container .next');
    // SEMPRE MOVE O ITEM BASEADO NO TAMANHO DELE MESMO PARA A ESQUERDA, SEJA POSITIVO OU NEGATIVO O VALOR
    // NEGATIVO E POSITIVO NO VALOR FAZ DAR O EFEITO DE IR PARA A DIREITA E ESQUERDA
    prevButton.addEventListener('click', () => {
        carouselContainer.scrollLeft -= carouselContainer.offsetWidth;
    });

    nextButton.addEventListener('click', () => {
        carouselContainer.scrollLeft += carouselContainer.offsetWidth;
    });

    let screenWidth = window.screen.width; // DESCOBRE A LARGURA DA TELA
    let quantity // DEFINE A QUANTIDADE DE ITEM NO CARROSSEL

    if (screenWidth <= 540) { // CONDICIONAL PARA EXIBIR OS ITENS DE MANEIRA RESPONSIVA
        quantity = 1;
    } else if (screenWidth <= 980) {
        quantity = 2;
    } else {
        quantity = 3;
    }


    let itemWidth = 100 / quantity; // FAZ O TAMANHO TOTAL DO CONTAINER DIVIDIDO PELA QUANTIDADE DE ITENS

    carouselItems.forEach(item => {
        item.style.width = `calc(${itemWidth}% - 40px)`; // AQUI DEFINE QUE O OS ITENS VAO TER O TAMANHO EXATO PARA SE DIVIDIR DENTRO DO CONTAINER IGUALMENTE
    })

}

// ANIMATIONS SCROLL IMAGES
const images = document.querySelector('img');

if (images) {

    addEventListener("scroll", () => {

        windowH = window.innerHeight / 1.5;
        animationImages = document.querySelectorAll('.out-in');

        if (animationImages) {
            animationImages.forEach(showImage);
        }

    });

    function showImage(item, index) {

        if (animationImages[index].getBoundingClientRect().top < windowH && !animationImages[index].classList.contains('show')) {
            animationImages[index].classList.add('show');
        }

    }
}

// SEARCH BLOG

const search = document.getElementById('search');

if (search) {
    const containerBlog = document.querySelector('.blog_news_container');
    // PESQUISA PELA BARRA DE PESQUISA
    search.addEventListener('keypress', (e) => {

        if (e.key === 'Enter') {

            let currentSearch = search.value;
            containerBlog.innerHTML = '';

            const getSearch = async () => {
                const searchDB = await fetch(newUrl + '/src/includes/get-search.php?currentSearch=' + currentSearch);
                const response = await searchDB.json();

                if (response == "Nenhuma") {
                    containerBlog.innerHTML = "Nenhuma notícia encontrada!"
                } else {
                    for (let i = 0; i < response.length; i++) {

                        let news = document.createElement('a');

                        news.setAttribute('href', newUrl + response[i].link_post)
                        news.classList.add('blog_news_item')

                        news.innerHTML = `
                            <div class="blog_item_container">
                                <div class="news_image">
                                    <img src="https://containermedia.com.br/assets/images/${response[i].image_post}" alt="Notícia" loading="lazy" />
                                </div>
                                <div class="news_category">
                                    <span class="category">${response[i].tag_post}</span>
                                </div>
                                <div class="news_content">
                                    <p class="title">${response[i].title_post}</p>
                                    <p class="content">${response[i].text_post}</p>
                                </div>
                            </div>
                    `
                        containerBlog.append(news);
                    }
                }
            };

            getSearch();
        }
    });
    // PESQUISA PELOS BOTÕES DE CATEGORIA
    const categoryButtons = document.querySelectorAll('[data-category]');
    const blogStart = document.getElementById('allBlog');

    let lastElement;
    categoryButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            let currentCategory = button.dataset.category; // PEGA O DATA ATTRIBUTE DO TIPO CATEGORIA DE CADA BOTÃO
            let tagSearch = true;

            const select = document.getElementsByClassName('category_list')[0].getElementsByClassName('selected')[0]

            containerBlog.innerHTML = '';

            blogStart.scrollIntoView();

            const getCategory = async () => {
                button.classList.add('selected');

                var urlAsync

                if (select && lastElement.dataset.category == currentCategory) { // COMPARA SE O MESMO BOTÃO FOI CLICADO
                    select.classList.remove('selected');
                    tagSearch = false; // DESATIVA A PESQUISA POR CATEGORIA E EXIBE TODAS AS NOTÍCIAS
                    urlAsync = newUrl + '/src/includes/get-search.php?currentCategory=null';
                    console.log(lastElement)
                } else if (select && lastElement.dataset.category != currentCategory) { // SE ALGUM BOTAO QUE SEJA DIFERENTE DO ATUAL FOI CLICADO EM CATEGORIA
                    lastElement.classList.remove('selected');
                    tagSearch = true;
                    urlAsync = newUrl + `/src/includes/get-search.php?currentCategory=${currentCategory}&tagSearch=${tagSearch}`;
                    lastElement = e.target;
                    console.log(lastElement)
                } else { // CASO NENHUM BOTÃO TENHA SIDO CLICADO
                    tagSearch = true;
                    urlAsync = newUrl + `/src/includes/get-search.php?currentCategory=${currentCategory}&tagSearch=${tagSearch}`;
                    lastElement = e.target;
                    console.log(lastElement)
                };

                const categories = await fetch(urlAsync); // RECEBE A URL DE ACORDO COM A CONDICIONAL
                const categoriesResponse = await categories.json();

                if (categoriesResponse == "Nenhuma") {
                    containerBlog.innerHTML = "Nenhuma notícia encontrada!"
                } else {
                    for (let i = 0; i < categoriesResponse.length; i++) {

                        let news = document.createElement('a');

                        news.setAttribute('href', newUrl + categoriesResponse[i].link_post)
                        news.classList.add('blog_news_item')

                        news.innerHTML = `
                            <div class="blog_item_container">
                                <div class="news_image">
                                    <img src="https://containermedia.com.br/assets/images/${categoriesResponse[i].image_post}" alt="Notícia" loading="lazy" />
                                </div>
                                <div class="news_category">
                                    <span class="category">${categoriesResponse[i].tag_post}</span>
                                </div>
                                <div class="news_content">
                                    <p class="title">${categoriesResponse[i].title_post}</p>
                                    <p class="content">${categoriesResponse[i].text_post}</p>
                                </div>
                            </div>
                    `
                        containerBlog.append(news);
                    }
                }
            };

            getCategory();

        })
    })
}

// (BACK TO) NEW PAGE

const backButton = document.querySelector('[data-back]');

if (backButton) {
    backButton.addEventListener('click', () => {
        history.go(-1);
    })
}

// MENU MOBILE

const menu = document.querySelector('.nav_menu');
const menuNav = document.querySelector('.nav_content');

menu.addEventListener('click', () => {
    menu.classList.toggle('active');
    menuNav.classList.toggle('active');

    document.addEventListener('scroll', () => {
        menu.classList.remove('active');
        menuNav.classList.remove('active');
    })

})

// CONTAGEM DE ACESSOS AS NOTICIAS
