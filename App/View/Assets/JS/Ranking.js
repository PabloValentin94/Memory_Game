window.onload = () => {

    listagem_jogadores();

}

function listagem_jogadores()
{

    const tabela_jogadores = document.getElementById("data");

    tabela_jogadores.innerHTML = "<tbody style='height: 15%; border-bottom: 2px solid #000000;'> " +
    "<tr> <th> Posição </th> <th> Usuário </th> <th> Recorde </th> </tr> </tbody>";

    const requisicao = fetch("http://localhost:8000/generate_json");

    const json = requisicao.then(retorno => { return retorno.json(); });

    json.then(lista_jogadores => {

        if(lista_jogadores != "Nada a retornar.")
        {

            for(var i = 0; i < lista_jogadores.length; i++)
            {
    
                const posicao = i + 1;
    
                if(i == 0)
                {
    
                    tabela_jogadores.innerHTML += "<tbody style='height: 60px; border-bottom: 2px solid #000000;'> " +
                    "<tr> <td> " + posicao + "º </td> <td> " +
                    lista_jogadores[i].usuario + "</td> <td style='color: #008000'> " +
                    lista_jogadores[i].recorde + " </td> </tr> </tbody>";
    
                }
    
                else if(i == lista_jogadores.length - 1)
                {
    
                    tabela_jogadores.innerHTML += "<tbody style='height: 60px;'> " +
                    "<tr> <td> " + posicao + "º </td> <td> " +
                    lista_jogadores[i].usuario + "</td> <td style='color: #FF0000'> " +
                    lista_jogadores[i].recorde + " </td> </tr> </tbody>";
    
                }
    
                else
                {
    
                    tabela_jogadores.innerHTML += "<tbody style='height: 60px; border-bottom: 2px solid #000000;'> " +
                    "<tr> <td> " + posicao + "º </td> <td> " +
                    lista_jogadores[i].usuario + "</td> <td> " +
                    lista_jogadores[i].recorde + " </td> </tr> </tbody>";
    
                }
    
            }

        }

    });

}