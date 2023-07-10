const cartas = [

    {carta: "./View/Assets/Images/Cards/Anri/Anri.jpg"},
    {carta: "./View/Assets/Images/Cards/Bachira/Bachira.jpg"},
    {carta: "./View/Assets/Images/Cards/Barou/Barou.jpg"},
    {carta: "./View/Assets/Images/Cards/Chigiri/Chigiri.jpg"},
    {carta: "./View/Assets/Images/Cards/Ego/Ego.jpg"},
    {carta: "./View/Assets/Images/Cards/Gagamaru/Gagamaru.jpg"},
    {carta: "./View/Assets/Images/Cards/Isagi/Isagi.jpg"},
    {carta: "./View/Assets/Images/Cards/Kunigami/Kunigami.jpg"},
    {carta: "./View/Assets/Images/Cards/Nagi/Nagi.jpg"},
    {carta: "./View/Assets/Images/Cards/Reo/Reo.jpg"},
    {carta: "./View/Assets/Images/Cards/Rin/Rin.jpg"},
    {carta: "./View/Assets/Images/Cards/Sae/Sae.jpg"}

];

// Variáveis do Cronômetro:

var horas = 0;

var minutos = 0;

var segundos = 0;

// Variáveis do Jogo - Armazenamento:

var quantidade_vezes_carta_gerada = [0,0,0,0,0,0,0,0,0,0,0,0];

var cartas_geradas = [];

var cartas_encontradas = [];

// Variáveis do Jogo - Controle:

var id_primeira_carta_escolhida = "";

var id_segunda_carta_escolhida = "";

var primeira_carta_escolhida = "";

var segunda_carta_escolhida = "";

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


function iniciar_jogo()
{

    const cronometro = setInterval(() => {

        segundos++;

        if(segundos == 60)
        {

            minutos ++;

            segundos = 0;

        }

        if(minutos == 60)
        {

            horas++;

            minutos = 0;

        }

        const h = verificar_digitos(horas.toString());

        const min = verificar_digitos(minutos.toString());

        const seg = verificar_digitos(segundos.toString());

        document.title = "(" + h + ":" + min + ":" + seg + ") Game";

        if(cartas_encontradas.length == 12)
        {

            clearInterval(cronometro);

        }

    }, 1000);

    document.getElementById("initialization").style.display = "none";

    document.getElementById("container").style.display = "flex";

}

function verificar_digitos(numero)
{

    if(numero.length == 1)
    {

        return "0" + numero;

    }

    else
    {

        return numero;

    }

}

function revelar_carta(id)
{

    var condicao = false;

    if(cartas_encontradas.length > 0)
    {

        for(var i = 0; i < cartas_encontradas.length; i++)
        {
    
            if(cartas_encontradas[i] == cartas_geradas[id])
            {

                condicao = true;

            }
    
        }

    }

    if(condicao == false)
    {

        const carta_selecionada = document.getElementById(id);

        carta_selecionada.classList.add("reveal_card");
    
        setTimeout(() => {
    
            carta_selecionada.style = "background-image: url('" + cartas_geradas[id] + "')";
    
            if(primeira_carta_escolhida == "" && segunda_carta_escolhida == "")
            {
    
                id_primeira_carta_escolhida = id;
    
                primeira_carta_escolhida = cartas_geradas[id_primeira_carta_escolhida];
    
                //console.log("Primeira opção: " + primeira_carta_escolhida);
    
            }
    
            else
            {

                if(id_primeira_carta_escolhida != id)
                {

                    id_segunda_carta_escolhida = id;
    
                    segunda_carta_escolhida = cartas_geradas[id_segunda_carta_escolhida];
        
                    //console.log("Segunda opção: " + segunda_carta_escolhida);

                }
    
            }
    
            setTimeout(() => {
    
                verificar_cartas_escolhidas();
            
            }, 350);
    
        }, 350);

    }

}

function verificar_cartas_escolhidas()
{

    if(primeira_carta_escolhida != "" && segunda_carta_escolhida != "")
    {

        if(primeira_carta_escolhida == segunda_carta_escolhida)
        {

            const par_encontrado = primeira_carta_escolhida;

            //const par_encontrado = segunda_carta_escolhida;

            cartas_encontradas.push(par_encontrado);

            //alert("Encontrou um par de cartas!");

            id_primeira_carta_escolhida = "";

            id_segunda_carta_escolhida = "";

            primeira_carta_escolhida = "";

            segunda_carta_escolhida = "";

            verificar_vitoria();

        }

        else if(primeira_carta_escolhida != segunda_carta_escolhida)
        {

            const primeira_carta = document.getElementById(id_primeira_carta_escolhida);

            const segunda_carta = document.getElementById(id_segunda_carta_escolhida);

            primeira_carta.classList.remove("reveal_card");

            primeira_carta.classList.add("hidden_card");

            segunda_carta.classList.remove("reveal_card");

            segunda_carta.classList.add("hidden_card");

            setTimeout(() => {

                primeira_carta.classList.remove("hidden_card");

                primeira_carta.style = "background-image: url('/View/Assets/Images/Card.jpg');";

                segunda_carta.classList.remove("hidden_card");

                segunda_carta.style = "background-image: url('/View/Assets/Images/Card.jpg');";

                id_primeira_carta_escolhida = "";

                id_segunda_carta_escolhida = "";

                primeira_carta_escolhida = "";

                segunda_carta_escolhida = "";

            }, 350);

        }

    }



}

function verificar_vitoria()
{

    if(cartas_encontradas.length == 12)
    {

        setTimeout(() => {

            //alert("Fim de Jogo! O jogo será reiniciado.");

            document.getElementById("container").style.display = "none";

            document.getElementById("hours").innerText = verificar_digitos(horas.toString());

            document.getElementById("minutes").innerText = verificar_digitos(minutos.toString());

            document.getElementById("seconds").innerText = verificar_digitos(segundos.toString());

            document.getElementById("time_banner").style.display = "flex";

            const recorde = verificar_digitos(horas.toString()) + ":" +
                            verificar_digitos(minutos.toString()) + ":" +
                            verificar_digitos(segundos.toString());

            document.getElementById("record").value = recorde;

        }, 1000);

    }

}