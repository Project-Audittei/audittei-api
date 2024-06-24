<!-- resources/views/emails/email-validacao-conta.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Email de Teste</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<style>
    html {
        background-color: #F5F7FF;
        font-family: "Work Sans", sans-serif;
    }

    .content {
        width: 40%;
        margin: 0 auto;
        text-align: center;
    }

    .content img {
        margin: 20px 0px;
    }

    .content h1 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 28px;
    }

    .content p {
        color: #969696;
        font-size: 16px;
    }

    .content .grupo p {
        margin-bottom: 30px;
    }

    .content .grupo-link p {
        margin-bottom: 16px;
    }
    
    .content .grupo-link b {
        font-weight: 600;
        color: #000;
        text-transform: uppercase;
    }

    .content a.botao {
        padding: 12px 24px;
        background-color: #265EF5;
        color: #ffffff;
        text-decoration: none;
        border-radius: 8px;
    }

    .content a {
        color: #000;
    }

    .content .btn {
        padding: 14px 0px;
        padding-top: 28px;
    }

    .content .rodape {
        font-size: 12px;
    }

    .card {
        width: 100%;
        padding: 40px;
        background-color: #ffffff;
        text-align: left
    }
</style>
</head>
<body>
    <div class="content">
        <img src="https://rodrigoveiga.com.br/audittei/assets/images/logo.svg" alt="">
        <div class="card">
            <h1>Confirmação de Cadastro - Bem-vindo ao Audittei</h1>
            <div class="grupo">
                <p>Olá, {{ $details['nome'] }}</p>
                <p>Seja bem-vindo ao Audittei! Estamos muito felizes em tê-lo(a) conosco.</p>
                <p>Para concluir o seu cadastro e começar a desfrutar de todos os recursos
                    incríveis que oferecemos, por favor, clique no link abaixo para
                    confirmar o seu e-mail:</p>
            </div>
            <div class="btn"><a class="botao" href="{{ $config['base_url'] }}/confirmar-conta/{{ $details['codigo_confirmacao'] }}">Clique aqui e confirme o seu cadastro</a></div>
            <div class="grupo grupo-link">
                <p>Chave de segurança: <b>{{ $details['codigo_confirmacao'] }}</b></p>
                <p>Botão não está funcionando? Clique ou copie e cole essa URL:</p>
                <a href="{{ $config['base_url'] }}/confirmar-conta">{{ $config['base_url'] }}/confirmar-conta</a>
            </div>
            <br>
            <div class="grupo">
                <p>Lembre-se, este é apenas o primeiro passo para uma jornada incrível
                    com o Audittei. Após a confirmação, você terá acesso total à nossa
                    plataforma e poderá começar a explorar todas as funcionalidades.</p>
                <p>Se tiver alguma dúvida ou precisar de ajuda durante o processo, não
                    hesite em nos contatar através do WhatsApp 310000-0000 ou pelo e-mail
                    suporte@audittei.com.</p>
            </div>
        </div>
        <p class="rodape">Este é um e-mail automático, por favor, não responda.</p>
    </div>
</body>
</html>