window.onload = () => {

    listagem_jogadores();

}

function listagem_jogadores()
{

    const tabela_jogadores = document.getElementById("data");

    tabela_jogadores.innerHTML = "<tbody style='height: 80px;'> " +
    "<tr> <th> Posição </th> <th> Usuário </th> <th> Recorde </th> </tr> </tbody>";

    const requisicao = fetch("http://localhost:8000/generate_json");

    const json = requisicao.then(retorno => { return retorno.json(); });

    json.then(lista_jogadores => {

        if(lista_jogadores != "Nada a retornar.")
        {

            var players = [];

            for(var i = 0; i < lista_jogadores.length; i++)
            {

                if(lista_jogadores[i].recorde != null)
                {

                    players.push({"usuario": lista_jogadores[i].usuario, "recorde": lista_jogadores[i].recorde});

                }
    
            }

            if(players.length > 0)
            {

                var posicao = 0

                for(var i = 0; i < players.length; i++)
                {

                    posicao++;

                    var linha = "<tbody style='height: 50px; border-top: 2px solid #000000;'> " +
                                "<tr> <td> " + posicao + "º </td> <td> ";
        
                    if(i == 0)
                    {
        
                        linha += players[i].usuario + "</td> <td style='color: #008000'> ";
        
                    }
        
                    else if(i == players.length - 1)
                    {
        
                        linha += players[i].usuario + "</td> <td style='color: #FF0000'> ";
        
                    }
        
                    else
                    {
        
                        linha += players[i].usuario + "</td> <td> ";
        
                    }

                    linha += players[i].recorde + " </td> </tr> </tbody>";

                    tabela_jogadores.innerHTML += linha;
        
                }

            }

            else
            {

                alert("Nenhum jogador(a) encontrado(a).");

            }

        }

        else
        {

            alert("Nenhum jogador(a) encontrado(a).");

        }

    });

}