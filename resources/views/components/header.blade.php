<header>
  <nav class="navbar navbar-expand-lg bg-secondary navbar-dark">
    <div class="container-fluid">
      <a wire:navigate class="navbar-brand" href="#">ChronoJournal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a wire:navigate class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          @if (Request::url() !== url('/all'))
            <li class="nav-item">
              <a wire:navigate class="nav-link active" aria-current="page" href="/all">All Journals</a>
            </li>
          @endif
          @if (Request::url() === url('/'))
            <li class="nav-item">
              <button wire:click='addJournal' class="nav-link active" aria-current="page" href="#">New
                Journal</button>
            </li>
            </li>
          @endif
        </ul>
        @if (checkLogin())
        <button class="btn btn-primary mx-1 btn-sm" id="export-data" wire:click='downloadDataModalToggle'>Export data</button>
        @endif
        @if (checkLogin() || Request::url() === url('/admin'))
          <button wire:loading.attr='disabled' id="logoutBtn" wire:click='logout' class="btn btn-danger mx-1 btn-sm"
            type="button">Logout</button>
          <button wire:loading.attr='disabled' class="btn btn-primary btn-sm"
            wire:click='refreshComponent(@json(Request::url()))'>
            Refresh
          </button>
          {{-- <button class="btn btn-warning text-muted mx-1 btn-sm" wire:click='prevPage' type="button">Back</button> --}}
          <a href="{{ url()->previous() }}" wire:navigate class="btn btn-warning text-muted mx-1 btn-sm">Back</a>
          <a href="/recyclebin" wire:navigate class="btn btn-primary btn-sm" wire:loading.class='disabled'>Recycle
            Bin</a>
          <p class=" text-light m-1 fw-bold" title="username">| {{ capFirstLetter(session()->get('username')) }}</p>
        @else
          <a href="/login" wire:navigate class="btn btn-primary mx-1 btn-sm" wire:loading.attr='disabled'
            type="button">Login</a>
          <a href="/signup" wire:navigate class="btn btn-primary mx-1 btn-sm" wire:loading.attr='disabled'
            type="button">Signup</a>
        @endif
      </div>
    </div>
  </nav>
  <script>
    $('#export-data').on('click', () => {

    })
  </script>
  @if ($downloadModal)
    <div class="my-modal-overlay">
      <form class="my-modal-body" wire:submit='exportData'>
        {{-- <div class="my-modal-content"> --}}
        <h4>Export Data</h2>
          <hr>
          <p class="mb-0">Choose your data format:</p>
          <div class="px-1">
            <div class="form-check">
              <input class="form-check-input" wire:model='downloadMethod'  type="radio" name="exampleRadios" id="exampleRadios1" value="1"
                checked>
              <label class="form-check-label" for="exampleRadios1">
                Json File
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" wire:model='downloadMethod' type="radio" name="exampleRadios" id="exampleRadios2" value="2">
              <label class="form-check-label" for="exampleRadios2">
                Html File
              </label>
            </div>
          </div>
          <hr>
          <div class="buttons d-flex justify-content-end">
            <button class="btn-outline-danger mx-1 btn btn-sm" wire:click='downloadDataModalToggle' wire:loading.class='disabled'>Cancel</button>
            <button class="btn-success mx-1 btn btn-sm" type="submit" wire:loading.class='disabled'>Export</button>
          </div>
      </div>
    </div>
  @endif
</header>
