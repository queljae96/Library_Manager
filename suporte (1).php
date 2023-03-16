

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formulario.css">
    <title>Suporte</title>
    <link rel="icon" type="image/png" href="img/Library (1).png">

</head>
<body>
    <header>
        <a href="pagprinc(1).php">
            <img src="img/2 (1).png" alt="" class="logo">
        </a>
    </header>
    
    <main>
        <section>
            <h2>Suporte</h2>
           

            <form action="https://api.staticforms.xyz/submit" method="POST">


                <input type="text" name="name" placeholder="Digite seu nome" autocomplete="off" required>
                <input type="email" name="email" placeholder="Digite seu email" autocomplete="off" required>
                <textarea name="message"  placeholder="Escreva em detalhes sobre o problema que tem de ser solucionado" required></textarea>
                <button type="submit" class="btn">Enviar</button>
                <input type="hidden" name="accessKey" value="f4093e4d-aa25-433b-9832-55b299bfd40b">
                <input type="hidden" name="redirectTo" value="http://localhost/bibliotech(1)/suporteMensagem%20(1).html">
            </form>
            <a class="recuperar" href="pagprinc(1).php"><b>Home</b></a>

        </section>
    </main>

</body>
</html>