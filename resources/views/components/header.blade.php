{{-- 
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="shortcut icon" href="https://img.icons8.com/?size=100&id=7LhMaNDFgoYK&format=png&color=000000"
    type="image/x-icon">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChronoJournal - Write journals and keep them safe and secure - We use end to end encryption</title>
  @livewireStyles
</head> --}}
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
            <li class="nav-item">
              <a wire:navigate class="nav-link active" href="/new" aria-current="page" href="#">New Journal</a>
            </li>
          </ul>
          @if (session()->get('auth_token'))
            <button wire:click='logout' class="btn btn-danger mx-1 btn-sm" type="button">Logout</button>
            <a href="/settings" wire:navigate class="btn btn-primary mx-1 btn-sm" type="button">Settings</a>
          @endif
        </div>
      </div>
    </nav>
    
  </header>
