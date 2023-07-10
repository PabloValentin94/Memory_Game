function mudar_formulario()
{

    switch(document.getElementById("opcao").value)
    {

        case "cadastro":

            document.getElementById("choice").style.width = "450px";

            const form_cadastro = 
            
            "<div id='cadastro'>" +

                "<span>" +

                "<label for='cpf'> CPF: </label>" +
                "<input id='cpf' type='number' name='cpf' placeholder='Insira seu CPF.' required>" +

                "</span>" +

                "<span>" +

                    "<label for='usuario'> User Name: </label>" +
                    "<input id='usuario' type='text' name='usuario' placeholder='Crie um nome de jogador(a).' required>" +

                "</span>" +

                "<span>" +

                    "<label for='senha'> Password: </label>" +
                    "<input id='senha' type='password' name='senha' placeholder='Crie uma senha.' required>" +

                "</span>" +

            "</div>"

            document.getElementById("form").innerHTML = form_cadastro;

            document.getElementById("botao").innerText = "Cadastrar";

            document.getElementById("botao").ariaLabel = "Criar meu perfil no jogo.";

        break;

        case "edicao":

            document.getElementById("choice").style.width = "550px";

            const form_edicao = 
            
            "<div id='edicao'>" +

                "<span>" +

                    "<label for='usuario'> User Name: </label>" +
                    "<input id='usuario' type='text' name='usuario' placeholder='Insira seu atual nome de jogador(a).' required>" +

                "</span>" +

                "<span>" +

                    "<label for='senha'> Password: </label>" +
                    "<input id='senha' type='password' name='senha' placeholder='Insira sua atual senha.' required>" +

                "</span>" +

                "<span>" +

                    "<label for='usuario_novo'> New User Name: </label>" +
                    "<input id='usuario_novo' type='text' name='usuario_novo' placeholder='Crie um novo nome de jogador(a).' required>" +

                "</span>" +

                "<span>" +

                    "<label for='senha_nova'> New Password: </label>" +
                    "<input id='senha_nova' type='password' name='senha_nova' placeholder='Crie uma nova senha.' required>" +

                "</span>" +

            "</div>"

            document.getElementById("form").innerHTML = form_edicao;

            document.getElementById("botao").innerText = "Editar";

            document.getElementById("botao").ariaLabel = "Editar meu perfil do jogo."

        break;

        case "banimento":

            document.getElementById("choice").style.width = "450px";

            const form_desativacao = 
                
            "<div id='banimento'>" +

                "<span>" +

                    "<label for='jogador'> Player: </label>" +
                    "<input id='jogador' type='text' name='jogador' placeholder='Selecione um jogador(a).' required>" +

                "</span>" +

                "<span>" +

                    "<label for='chave'> Key: </label>" +
                    "<input id='chave' type='password' name='chave' placeholder='Insira a senha mestra.' required>" +

                "</span>" +

            "</div>"

            document.getElementById("form").innerHTML = form_desativacao;

            document.getElementById("botao").innerText = "Desativar";

            document.getElementById("botao").ariaLabel = "Desativar um perfil do jogo.";

        break;

        case "login":

            document.getElementById("choice").style.width = "450px";

            const form_login = 
            
            "<div id='login'>" +

                "<span>" +

                    "<label for='usuario'> User Name: </label>" +
                    "<input id='usuario' type='text' name='usuario' placeholder='Insira seu nome de jogador(a).' required>" +

                "</span>" +

                "<span>" +

                    "<label for='senha'> Password: </label>" +
                    "<input id='senha' type='password' name='senha' placeholder='Insira sua senha.' required>" +

                "</span>" +

            "</div>"

            document.getElementById("form").innerHTML = form_login;

            document.getElementById("botao").innerText = "Entrar";

            document.getElementById("botao").ariaLabel = "Acessar o jogo utilizando meu perfil.";

        break;

    }

}

/*function limpar_campos()
{

    if(document.getElementById("cpf") != null)
    {

        document.getElementById("cpf").value = "";

    }

    document.getElementById("usuario").value = "";

    document.getElementById("senha").value = "";

}*/