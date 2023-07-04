window.onload = () => {

    listagem_jogadores();

}

function listagem_jogadores()
{

    const requisicao = fetch("http://localhost:8000/ranking/generate_json");

    const json = requisicao.then(retorno => { return retorno.json() });

    json.then(lista_jogadores => {

        const tabela_jogadores = document.getElementById("data");

        tabela_jogadores.innerHTML = "<tbody style='height: 10%; border-bottom: 2px solid #000000;'> " +
        "<tr> <th> Posição </th> <th> Nome </th> <th> Usuário </th> <th> Recorde </th> </tr> </tbody>";

        for(var i = 0; i < lista_jogadores.length; i++)
        {

            if(lista_jogadores[i].recorde != null)
            {

                if(i == lista_jogadores.length - 1)
                {

                    tabela_jogadores.innerHTML += "<tbody style='height: 7%;'> " +
                    "<tr> <td> " + (i + 1) + "º </td> <td> " +
                    lista_jogadores[i].nome_jogador + " </td> <td> " +
                    lista_jogadores[i].nome_usuario + "</td> <td> " +
                    lista_jogadores[i].recorde + " </td> </tr> </tbody>";

                }

                else
                {

                    tabela_jogadores.innerHTML += "<tbody style='height: 7%; border-bottom: 2px solid #000000;'> " +
                    "<tr> <td> " + (i + 1) + "º </td> <td> " +
                    lista_jogadores[i].nome_jogador + " </td> <td> " +
                    lista_jogadores[i].nome_usuario + "</td> <td> " +
                    lista_jogadores[i].recorde + " </td> </tr> </tbody>";

                }

            }

        }

    })

}