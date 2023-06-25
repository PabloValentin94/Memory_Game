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

var id_primeira_carta_escolhida = "";

var id_segunda_carta_escolhida = "";

var primeira_carta_escolhida = "";

var segunda_carta_escolhida = "";

var cartas_encontradas = [];

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
            
            }, 500);
    
        }, 750);

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

            /*for(var i = 0; i < cartas_encontradas.length; i++)
            {

                console.log(cartas_encontradas[i]);

            }*/

            alert("Encontrou um par de cartas!");

            id_primeira_carta_escolhida = "";

            id_segunda_carta_escolhida = "";

            primeira_carta_escolhida = "";

            segunda_carta_escolhida = "";

            verificar_vitoria();

        }

        else if(primeira_carta_escolhida != segunda_carta_escolhida)
        {

            document.getElementById(id_primeira_carta_escolhida).classList.remove("reveal_card");

            document.getElementById(id_primeira_carta_escolhida).classList.add("hidden_card");

            document.getElementById(id_segunda_carta_escolhida).classList.remove("reveal_card");

            document.getElementById(id_segunda_carta_escolhida).classList.add("hidden_card");

            setTimeout(() => {

                document.getElementById(id_primeira_carta_escolhida).classList.remove("hidden_card");

                document.getElementById(id_primeira_carta_escolhida).style = "background-image: url('./Assets/Images/Card.jpg');";

                document.getElementById(id_segunda_carta_escolhida).classList.remove("hidden_card");

                document.getElementById(id_segunda_carta_escolhida).style = "background-image: url('./Assets/Images/Card.jpg');";

                id_primeira_carta_escolhida = "";

                id_segunda_carta_escolhida = "";

                primeira_carta_escolhida = "";

                segunda_carta_escolhida = "";

            }, 750);

        }

    }



}

function verificar_vitoria()
{

    if(cartas_encontradas.length == 12)
    {

        setTimeout(() => {

            alert("Fim de Jogo! O jogo será reiniciado.");
    
            window.location.reload(true);

        }, 1000);

    }

}
