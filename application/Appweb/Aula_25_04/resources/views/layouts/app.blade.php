<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tipos de Criptomoedas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <style>
      html, body {
        height: 100%;
        margin: 0;
      }

      body {
        display: flex;
        flex-direction: column;
      }

      .container {
        flex: 1;
      }

      footer {
        padding: 20px 0;
      }
    </style>
  </head>
  <body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand fw-bold" href="#">💰 CriptoETEC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#">Início</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Cadastrar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Sobre</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    {{-- Conteúdo principal --}}
    <div class="container mt-4">
      @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="bg-dark text-light text-center py-4 mt-5">
      <div class="container">
        <p class="mb-1 fw-light">© {{ date('Y') }} <strong>ETEC</strong> — Todos os direitos reservados.</p>
        <p class="mb-0 small text-secondary">Desenvolvido como parte do projeto educacional de Criptomoedas.</p>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

    {{-- Scripts específicos por página --}}
    @stack('scripts')
  </body>
</html>
