var players = [];

window.onload = () => {

    listagem_jogadores();

}

function listagem_jogadores()
{

    players = [];

    const tabela_jogadores = document.getElementById("data");

    tabela_jogadores.innerHTML = "<tbody style='height: 80px;'> " +
    "<tr> <th style='width: 20%'> Posição </th> <th style='width: 50%'> " +
    "Usuário </th> <th style='width: 20%'> Recorde </th> </tr> </tbody>";

    const requisicao = fetch("http://localhost:8000/generate_json");

    const json = requisicao.then(retorno => {

        if(retorno.ok)
        {

            return retorno.json();

        }

        else
        {

            return "Nada a retornar.";

        }

    });

    json.then(lista_jogadores => {

        if(lista_jogadores != "Nada a retornar.")
        {

            var posicao = 0;

            for(var i = 0; i < lista_jogadores.length; i++)
            {

                if(lista_jogadores[i].ativo == 1 && lista_jogadores[i].recorde != null)
                {

                    posicao++;

                    players.push({"posicao": posicao.toString(), "usuario": lista_jogadores[i].usuario, "recorde": lista_jogadores[i].recorde});

                }
    
            }

            if(players.length > 0)
            {

                document.getElementById("container").style.display = "flex";

                for(var i = 0; i < players.length; i++)
                {

                    var linha = "<tbody style='height: 50px; border-top: 2px solid #000000;'> " +
                                "<tr> <td style='width: 20%'> " + players[i].posicao + "º </td> <td style='width: 50%'> ";
        
                    if(i == 0)
                    {
        
                        linha += players[i].usuario + "</td> <td style='width: 20%; color: #008000'> ";
        
                    }
        
                    else if(i == players.length - 1)
                    {
        
                        linha += players[i].usuario + "</td> <td style='width: 20%; color: #FF0000'> ";
        
                    }
        
                    else
                    {
        
                        linha += players[i].usuario + "</td> <td style='width: 20%'> ";
        
                    }

                    linha += players[i].recorde + " </td> </tr> </tbody>";

                    if(document.getElementById("data").offsetHeight + 50 > document.body.offsetHeight * 0.70)
                    {

                        tabela_jogadores.innerHTML += linha;

                        break;

                    }

                    else
                    {

                        tabela_jogadores.innerHTML += linha;

                    }
        
                }

            }

            else
            {

                document.getElementById("container").style.display = "none";

                setTimeout(() => {

                    alert("Nenhum jogador encontrado.");
    
                }, 200);

            }

        }

        else
        {

            document.getElementById("container").style.display = "none";

            setTimeout(() => {

                alert("Nenhum jogador encontrado.");

            }, 200);

        }

    });

    document.getElementById("usuario").value = "";

}

function pesquisar_jogador(usuario)
{

    if(usuario == "")
    {

        alert("Preencha o campo de forma correta, antes de prosseguir!");

    }

    else
    {

        var jogador = "";

        for(var i = 0; i < players.length; i++)
        {
    
            if(players[i].usuario == usuario)
            {
    
                jogador = players[i];
    
                break;
    
            }
    
        }
    
        if(jogador != "")
        {
    
            alert("Usuário: " + jogador.usuario + ".\n\nPosição no Ranking: " + jogador.posicao + "º lugar.\n\nRecorde: " + jogador.recorde + ".");
    
        }
    
        else
        {
    
            alert("Usuário não encontrado. Verifique se este realmente existe. Caso ele exista, veja se há algum recorde salvo.");
    
        }

    }

    document.getElementById("usuario").value = "";

}