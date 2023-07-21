var lista_jogadores = [];

window.onload = () => {

    document.getElementById("botao").style.display = "flex";

    const requisicao = fetch("http://localhost:8000/generate_json");

    const json = requisicao.then(retorno => { return retorno.json(); });

    json.then(listagem_jogadores => {

        if(listagem_jogadores != "Nada a retornar.")
        {

            for(var i = 0; i < listagem_jogadores.length; i++)
            {

                if(listagem_jogadores[i].ativo == 1)
                {

                    lista_jogadores.push({"id": listagem_jogadores[i].id, "usuario": listagem_jogadores[i].usuario});

                }
    
            }

            if(lista_jogadores.length > 0)
            {

                (document.getElementById("opcao").value = "login").selected = true;

                mudar_formulario("login");

            }

            else
            {

                (document.getElementById("opcao").value = "cadastro").selected = true;

                mudar_formulario("cadastro");

            }

        }

    });

}

function mudar_formulario(valor)
{

    switch(valor)
    {

        case "cadastro":

            document.getElementById("choice").style.width = "450px";

            const form_cadastro = 
            
            "<div id='cadastro'>" +

                "<span>" +

                "<label for='cpf'> CPF: </label>" +
                "<input id='cpf' type='number' name='cpf' placeholder='Insira seu CPF.'" +
                " min='00000000000' max='99999999999' autocomplete='off' required>" +

                "</span>" +

                "<span>" +

                    "<label for='usuario'> User Name: </label>" +
                    "<input id='usuario' type='text' name='usuario' placeholder='Crie um nome de jogador(a).'" +
                    " minlength='2' maxlength='25' autocomplete='off' required>" +

                "</span>" +

                "<span>" +

                    "<label for='senha'> Password: </label>" +
                    "<input id='senha' type='password' name='senha' placeholder='Crie uma senha.'" +
                    " minlength='4' maxlength='20' autocomplete='off' required>" +

                "</span>" +

            "</div>";

            document.getElementById("form").innerHTML = form_cadastro;

            document.getElementById("botao").style.display = "flex";

            document.getElementById("botao").innerText = "Cadastrar";

            document.getElementById("botao").ariaLabel = "Criar meu perfil no jogo.";

            setTimeout(() => {

                alert("Para evitar eventuais transtornos, insira apenas informações que pertençam a você.");

            }, 150);

        break;

        case "edicao":

            document.getElementById("choice").style.width = "550px";

            if(lista_jogadores.length > 0)
            {

                const form_edicao = 
            
                "<div id='edicao'>" +
    
                    "<span>" +
    
                        "<label for='usuario'> User Name: </label>" +
                        "<input id='usuario' type='text' name='usuario' placeholder='Insira seu atual nome de jogador(a).'" +
                        " minlength='2' maxlength='25' autocomplete='off' required>" +
    
                    "</span>" +
    
                    "<span>" +
    
                        "<label for='senha'> Password: </label>" +
                        "<input id='senha' type='password' name='senha' placeholder='Insira sua atual senha.'" +
                        " minlength='4' maxlength='20' autocomplete='off' required>" +
    
                    "</span>" +
    
                    "<span>" +
    
                        "<label for='usuario_novo'> New User Name: </label>" +
                        "<input id='usuario_novo' type='text' name='usuario_novo' placeholder='Crie um novo nome de jogador(a).'" +
                        " minlength='2' maxlength='25' autocomplete='off' required>" +
    
                    "</span>" +
    
                    "<span>" +
    
                        "<label for='senha_nova'> New Password: </label>" +
                        "<input id='senha_nova' type='password' name='senha_nova' placeholder='Crie uma nova senha.'" +
                        " minlength='4' maxlength='20' autocomplete='off' required>" +
    
                    "</span>" +
    
                "</div>";
    
                document.getElementById("form").innerHTML = form_edicao;
    
                document.getElementById("botao").style.display = "flex";
    
                document.getElementById("botao").innerText = "Editar";
    
                document.getElementById("botao").ariaLabel = "Editar meu perfil do jogo.";

            }

            else
            {

                document.getElementById("form").innerHTML = "<p> Nenhum usuário encontrado. </p>";

                document.getElementById("botao").style.display = "none";

            }

        break;

        case "banimento":

            document.getElementById("choice").style.width = "450px";

            if(lista_jogadores.length > 0)
            {

                const form_banimento = 
                    
                "<div id='banimento'>" +

                    "<span>" +

                        "<label for='jogador'> Player: </label>" +
                        "<select id='jogador' type='text' name='jogador' required> </select>" +

                    "</span>" +

                    "<span>" +

                        "<label for='chave'> Key: </label>" +
                        "<input id='chave' type='password' name='chave' placeholder='Insira a senha mestra.'" +
                        " minlength='4' maxlength='20' autocomplete='off' required>" +

                    "</span>" +

                "</div>";

                document.getElementById("form").innerHTML = form_banimento;

                document.getElementById("botao").style.display = "flex";

                document.getElementById("botao").innerText = "Desativar";

                document.getElementById("botao").ariaLabel = "Desativar um perfil do jogo.";

                document.getElementById("jogador").innerHTML = "";

                var numeracao = 0;

                for(var i = 0; i < lista_jogadores.length; i++)
                {

                    numeracao++;
        
                    document.getElementById("jogador").innerHTML += "<option value='" + lista_jogadores[i].id + "'> " + numeracao + " - " + lista_jogadores[i].usuario + " </option>";
        
                }

            }

            else
            {

                document.getElementById("form").innerHTML = "<p> Nenhum usuário encontrado. </p>";

                document.getElementById("botao").style.display = "none";

            }

        break;

        case "login":

            document.getElementById("choice").style.width = "450px";

            if(lista_jogadores.length > 0)
            {

                const form_login = 
            
                "<div id='login'>" +

                    "<span>" +

                        "<label for='usuario'> User Name: </label>" +
                        "<input id='usuario' type='text' name='usuario' placeholder='Insira seu nome de jogador(a).'" +
                        " minlength='2' maxlength='25' autocomplete='off' required>" +

                    "</span>" +

                    "<span>" +

                        "<label for='senha'> Password: </label>" +
                        "<input id='senha' type='password' name='senha' placeholder='Insira sua senha.'" +
                        " minlength='4' maxlength='20' autocomplete='off' required>" +

                    "</span>" +

                "</div>";

                document.getElementById("form").innerHTML = form_login;

                document.getElementById("botao").style.display = "flex";

                document.getElementById("botao").innerText = "Entrar";

                document.getElementById("botao").ariaLabel = "Acessar o jogo utilizando meu perfil.";

            }

            else
            {

                document.getElementById("form").innerHTML = "<p> Nenhum usuário encontrado. </p>";

                document.getElementById("botao").style.display = "none";

            }

        break;

    }

}