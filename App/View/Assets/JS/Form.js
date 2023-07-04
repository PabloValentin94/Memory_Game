function escolher_opcao(valor)
{

    switch(valor)
    {

        case 0:
            document.getElementById("login").style.display = "none";
            document.getElementById("cadastro").style.display = "flex";
            document.getElementById("botao").innerText = "CADASTRAR";
        break;

        case 1:
            document.getElementById("cadastro").style.display = "none";
            document.getElementById("login").style.display = "flex";
            document.getElementById("botao").innerText = "ENTRAR";
        break;

    }

}