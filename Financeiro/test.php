<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Meus Dados — Mostrar/Esconder Senha</title>
  <style>
    :root{
      --bg:#f5f7fb;
      --card:#ffffff;
      --accent:#3b82f6;
      --muted:#6b7280;
      --danger:#ef4444;
    }
    *{box-sizing:border-box}
    body{
      font-family:Inter, system-ui, -apple-system, 'Segoe UI', Roboto, "Helvetica Neue", Arial;
      background:linear-gradient(180deg,var(--bg),#eef2f7);
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:24px;
    }
    .card{
      width:100%;
      max-width:480px;
      background:var(--card);
      border-radius:12px;
      box-shadow:0 8px 30px rgba(19,24,40,0.06);
      padding:20px;
    }
    h1{font-size:18px;margin:0 0 12px}
    p{color:var(--muted);margin:0 0 18px}

    .field{
      display:flex;
      align-items:center;
      gap:8px;
      background:#fbfdff;
      border:1px solid #e6eefb;
      padding:10px 12px;
      border-radius:8px;
    }
    label{
      font-size:13px;
      color:var(--muted);
      display:block;
      margin-bottom:6px;
    }
    input[type="password"], input[type="text"]{
      border:0;
      outline:0;
      font-size:16px;
      flex:1;
      background:transparent;
    }
    /* botão do olho */
    .btn-eye{
      -webkit-appearance:none;
      appearance:none;
      border:0;
      background:transparent;
      padding:6px;
      border-radius:6px;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      cursor:pointer;
    }
    .btn-eye:focus{box-shadow:0 0 0 3px rgba(59,130,246,0.15)}
    .btn-eye svg{width:20px;height:20px;display:block}

    .note{font-size:13px;color:var(--muted);margin-top:12px}

    /* pequena animação para trocar ícones */
    .icon-hidden{opacity:1;transform:scale(1);transition:all .12s ease}
    .icon-visible{opacity:0;transform:scale(.9);position:absolute}
    .btn-eye.revealed .icon-hidden{opacity:0;transform:scale(.9)}
    .btn-eye.revealed .icon-visible{opacity:1;transform:scale(1);}

    /* responsividade */
    @media (max-width:420px){.card{padding:16px}}
  </style>
</head>
<body>
  <main class="card" role="main">
    <h1>Meus Dados</h1>
    <p>Edite seus dados abaixo. Clique no ícone do olho para mostrar ou esconder a senha.</p>

    <form id="meus-dados-form" onsubmit="return false;">
      <div style="margin-bottom:10px">
        <label for="nome">Nome</label>
        <input id="nome" name="nome" type="text" placeholder="Seu nome completo" style="width:100%;padding:10px;border-radius:8px;border:1px solid #e6eefb;background:#fbfdff;font-size:15px">
      </div>

      <div style="margin-top:6px">
        <label for="senha">Senha</label>
        <div class="field" style="position:relative">
          <input id="senha" name="senha" type="password" autocomplete="current-password" placeholder="••••••••">

          <!-- botão do olho com dois SVGs (olho aberto / olho fechado) -->
          <button type="button" class="btn-eye" id="toggleSenha" aria-pressed="false" aria-label="Mostrar senha">
            <!-- olho fechado (estado padrão: escondido) -->
            <svg class="icon-hidden" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M2.94 12.94C1.86 11.8 1.86 10.2 2.94 9.06C4.76 7.08 8.01 4.5 12 4.5C14.02 4.5 15.81 5.18 17.19 6.23" stroke="#374151" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M21.06 11.06C21.86 11.86 22.5 12.87 22.5 13.5C22.5 14.13 21.86 15.14 21.06 15.94C19.24 17.92 16 20.5 12 20.5C9.98 20.5 8.19 19.82 6.81 18.77" stroke="#374151" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M9.5 14.5a3.5 3.5 0 0 0 5 0" stroke="#111827" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

            <!-- olho aberto (posição sobreposta, ficará visível quando a senha for mostrada) -->
            <svg class="icon-visible" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" stroke="#111827" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="12" cy="12" r="3" stroke="#111827" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </button>
        </div>
        <div class="note">Dica: sua senha não será compartilhada. Use um gerenciador de senhas para mais segurança.</div>
      </div>

      <div style="margin-top:18px;display:flex;gap:8px;justify-content:flex-end">
        <button type="submit" style="background:var(--accent);color:white;padding:10px 14px;border-radius:8px;border:0;cursor:pointer">Salvar</button>
        <button type="reset" style="background:transparent;border:1px solid #e6eefb;padding:10px 14px;border-radius:8px;cursor:pointer">Cancelar</button>
      </div>
    </form>

  </main>

  <script>
    (function(){
      const senha = document.getElementById('senha');
      const btn = document.getElementById('toggleSenha');

      function setState(revealed){
        if(revealed){
          senha.type = 'text';
          btn.classList.add('revealed');
          btn.setAttribute('aria-pressed','true');
          btn.setAttribute('aria-label','Esconder senha');
        } else {
          senha.type = 'password';
          btn.classList.remove('revealed');
          btn.setAttribute('aria-pressed','false');
          btn.setAttribute('aria-label','Mostrar senha');
        }
      }

      // Inicial: escondido (password)
      setState(false);

      btn.addEventListener('click', function(e){
        const revealed = btn.getAttribute('aria-pressed') === 'true';
        setState(!revealed);
      });

      // Suporte a tecla Enter/Space quando o botão tiver foco
      btn.addEventListener('keydown', function(e){
        if(e.key === ' ' || e.key === 'Enter'){
          e.preventDefault();
          btn.click();
        }
      });

      // Segurança adicional: se o usuário alternar para outro tab, volte a esconder a senha
      document.addEventListener('visibilitychange', function(){
        if(document.visibilityState === 'hidden') setState(false);
      });

    })();
  </script>
</body>
</html>
