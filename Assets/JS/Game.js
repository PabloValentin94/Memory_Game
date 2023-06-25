const cartas = [

    {carta: "./Assets/Images/Cards/Anri/Anri.jpg"},
    {carta: "./Assets/Images/Cards/Bachira/Bachira.jpg"},
    {carta: "./Assets/Images/Cards/Barou/Barou.jpg"},
    {carta: "./Assets/Images/Cards/Chigiri/Chigiri.jpg"},
    {carta: "./Assets/Images/Cards/Ego/Ego.jpg"},
    {carta: "./Assets/Images/Cards/Gagamaru/Gagamaru.jpg"},
    {carta: "./Assets/Images/Cards/Isagi/Isagi.jpg"},
    {carta: "./Assets/Images/Cards/Kunigami/Kunigami.jpg"},
    {carta: "./Assets/Images/Cards/Nagi/Nagi.jpg"},
    {carta: "./Assets/Images/Cards/Reo/Reo.jpg"},
    {carta: "./Assets/Images/Cards/Rin/Rin.jpg"},
    {carta: "./Assets/Images/Cards/Sae/Sae.jpg"}

];

var cartas_geradas = [];

var quantidade_vezes_carta_gerada = [0,0,0,0,0,0,0,0,0,0,0,0];

var cartas_encontradas = 0;

var primeira_carta_escolhida = "";

var segunda_carta_escolhida = "";

var id_primeira_carta_escolhida = "";

var id_segunda_carta_escolhida = "";

window.onload = () => {

    // Código executado quando a página for carregada:

    const gerar_cartas_aleatoriamente = setInterval(() => {

        // Math.random: gera um número real maior ou igual a 0 e menor que 1. Exemplo: 0,572.

        // Math.floor: pega a parte inteira de um número real. Exemplo: 6,800 -> 6.

        const numero_aleatorio = Math.floor(Math.random() * 12);

        if(quantidade_vezes_carta_gerada[numero_aleatorio] < 2)
        {

            const imagem = cartas[numero_aleatorio].carta;
    
            cartas_geradas.push(imagem);
    
            quantidade_vezes_carta_gerada[numero_aleatorio] += 1;
    
        }

        if(cartas_geradas.length >= 24)
        {

            clearInterval(gerar_cartas_aleatoriamente);

        }

    }, 10);

};

function revelar_carta(id)
{

    const carta_selecionada = document.getElementById(id);

    carta_selecionada.classList.add("reveal_card");

    setTimeout(() => {

        carta_selecionada.style = "background-image: url('" + cartas_geradas[id] + "')";

    }, 750);

}

function verificar_cartas_escolhidas()
{

    /*if(primeira_carta_escolhida == segunda_carta_escolhida)
    {

        if(primeira_carta_escolhida != "")
        {

            const carta_encontrada = primeira_carta_escolhida;

            alert("Encontrou um par de cartas!");
    
            cartas_encontradas.push(carta_encontrada);

            id_primeira_carta_escolhida = "";

            id_segunda_carta_escolhida = "";

            primeira_carta_escolhida = "";

            segunda_carta_escolhida = "";

        }

    }

    else
    {

        

    }*/

}

function verificar_vitoria()
{

    if(cartas_encontradas.length == 12)
    {

        //alert("Fim de Jogo! O jogo será reiniciado.");

        alert("Fim de Jogo!");

        document.querySelector(".card").classList.remove("reveal_card");

        //window.location.reload(true);

    }

}