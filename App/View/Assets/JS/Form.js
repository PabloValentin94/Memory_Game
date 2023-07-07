function escolher_opcao(valor)
{

    switch(valor)
    {

        case 0:

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

        case 1:

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

function limpar_campos()
{

    if(document.getElementById("cpf") != null)
    {

        document.getElementById("cpf").value = "";

    }

    document.getElementById("usuario").value = "";

    document.getElementById("senha").value = "";

}