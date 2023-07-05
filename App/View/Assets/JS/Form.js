function escolher_opcao(valor)
{

    switch(valor)
    {

        case 0:

            limpar_campos();

            document.getElementById("login").style.display = "none";

            document.getElementById("cadastro").style.display = "flex";

            document.getElementById("botao").innerText = "CADASTRAR";

        break;

        case 1:

            limpar_campos();

            document.getElementById("cadastro").style.display = "none";
            
            document.getElementById("login").style.display = "flex";

            document.getElementById("botao").innerText = "ENTRAR";

        break;

    }

}

function limpar_campos()
{

    document.getElementById("jogador_cadastro").value = "";

    document.getElementById("usuario_cadastro").value = "";

    document.getElementById("senha_cadastro").value = "";

    document.getElementById("usuario_login").value = "";

    document.getElementById("senha_login").value = "";
    
}