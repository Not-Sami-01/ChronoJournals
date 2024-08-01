<header>
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
      <a wire:navigate class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a wire:navigate class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          @if (Request::url() === url('/') )
          <li class="nav-item">
            <button wire:click='addJournal' class="nav-link active" aria-current="page" href="#">New Journal</button>
          </li>
          </li>
          @endif
        </ul>

        @if (checkLogin() || Request::url() === url('/admin'))
          <button id="logoutBtn" wire:click='logout' class="btn btn-danger mx-1 btn-sm" type="button">Logout</button>
          <button class="btn btn-primary btn-sm" wire:click='refreshComponent(@json(Request::url()))'>
            Refresh
          </button>
          <a href="/settings" wire:navigate class="btn btn-primary mx-1 btn-sm" type="button">Settings</a>
          <a href="/recyclebin" wire:navigate class="btn btn-outline-primary btn-sm" type="button">Recycle Bin</a>
          <p class=" text-light m-1 fw-bold" title="username">| {{ capFirstLetter(session()->get('username')) }}</p>
        @else
          <a href="/login" wire:navigate class="btn btn-primary mx-1 btn-sm" type="button">Login</a>
          <a href="/signup" wire:navigate class="btn btn-primary mx-1 btn-sm" type="button">Signup</a>
        @endif
      </div>
    </div>
  </nav>
</header>
