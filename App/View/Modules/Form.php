<!DOCTYPE html>

<html lang="pt-br">

    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" type="image/png" href="/View/Assets/Images/Favicon.png">
        <link rel="stylesheet" type="text/css" href="/View/Assets/CSS/Form.css">

        <script defer type="text/javascript" src="/View/Assets/JS/Form.js"></script>

        <title> Dados do(a) Jogador(a) </title>

    </head>

    <body>

        <div id="container">

            <form id="choice" method="post" action="/form/save">

                <div id="options">

                    <span> <input type="radio" name="opcao" value="cadastro" onclick="escolher_opcao(0)"> Cadastrar </input> </span>

                    <span> <input type="radio" name="opcao" value="login" onclick="escolher_opcao(1)" checked> Entrar </input> </span>

                </div>

                <div id="form">

                    <div id="cadastro">

                        <span>

                            <label for="jogador_cadastro"> Real Name: </label>
                            <input type="text" name="jogador_cadastro" placeholder="Insira seu nome real">

                        </span>

                        <span>

                            <label for="usuario_cadastro"> User Name: </label>
                            <input type="text" name="usuario_cadastro" placeholder="Crie um nome de jogador(a)">

                        </span>

                        <span>

                            <label for="senha_cadastro"> Password: </label>
                            <input type="text" name="senha_cadastro" placeholder="Crie uma senha">

                        </span>

                    </div>

                    <div id="login">

                        <span>

                            <label for="usuario_login"> User Name: </label>
                            <input type="text" name="usuario_login" placeholder="Seu nome de jogador(a)">

                        </span>

                        <span>

                            <label for="senha_login"> Password: </label>
                            <input type="text" name="senha_login" placeholder="Sua senha">

                        </span>

                    </div>

                </div>

                <button id="botao" type="submit"> ENTRAR </button>

            </form>

        </div>
        
    </body>

</html>