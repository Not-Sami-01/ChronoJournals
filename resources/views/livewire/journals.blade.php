<div class="container">
  @if ($asc === true)
  <button class="my-2 btn btn-primary btn-sm" wire:click='toggleAsc'>
    Sort by Date (Descending)
  </button>
  @else
  <button class="my-2 btn btn-primary btn-sm" wire:click='toggleAsc'>
    Sort by Date (Ascending)
  </button>
  @endif
  @if (Request::url() !== url('/recyclebin'))
  <input type="text" wire:model.live='search'>
  @endif
  @foreach ($journals as $journal)
    <div class="">
      <div class="card my-1">
        <div class="card-header d-flex justify-content-between">
          <div class="d-inline">
            <div class="journal-index">#{{ $loop->index + 1 }}</div> {{ formatDate($journal->journal_date_time) }}
          </div>
          @if (Request::url() == url('/recyclebin'))
            <div class="d-inline">
              <div class="d-inline mx-2" wire:click='restoreDelete(@json($journal->_id))'>
                <svg xmlns="http://www.w3.org/2000/svg" width='17px'
                  viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                  <path
                    d="M142.9 142.9c-17.5 17.5-30.1 38-37.8 59.8c-5.9 16.7-24.2 25.4-40.8 19.5s-25.4-24.2-19.5-40.8C55.6 150.7 73.2 122 97.6 97.6c87.2-87.2 228.3-87.5 315.8-1L455 55c6.9-6.9 17.2-8.9 26.2-5.2s14.8 12.5 14.8 22.2l0 128c0 13.3-10.7 24-24 24l-8.4 0c0 0 0 0 0 0L344 224c-9.7 0-18.5-5.8-22.2-14.8s-1.7-19.3 5.2-26.2l41.1-41.1c-62.6-61.5-163.1-61.2-225.3 1zM16 312c0-13.3 10.7-24 24-24l7.6 0 .7 0L168 288c9.7 0 18.5 5.8 22.2 14.8s1.7 19.3-5.2 26.2l-41.1 41.1c62.6 61.5 163.1 61.2 225.3-1c17.5-17.5 30.1-38 37.8-59.8c5.9-16.7 24.2-25.4 40.8-19.5s25.4 24.2 19.5 40.8c-10.8 30.6-28.4 59.3-52.9 83.8c-87.2 87.2-228.3 87.5-315.8 1L57 457c-6.9 6.9-17.2 8.9-26.2 5.2S16 449.7 16 440l0-119.6 0-.7 0-7.6z" />
                </svg>
              </div>
              <div class="d-inline mx-2" wire:click='forceDelete(@json($journal->_id))'>
                <svg xmlns="http://www.w3.org/2000/svg" width='15px'
                  viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                  <path
                    d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                </svg>
              </div>
            </div>
          @else
            <div class="d-inline" wire:click='deleteEntry(@json($journal->_id))'>

              <svg xmlns="http://www.w3.org/2000/svg" width='15px'
                viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                  d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
              </svg>
            </div>
          @endif
        </div>
        @if(Request::url() == url('/recyclebin'))
            
        <div class="card-body" >
          {{-- <h5 class="card-title">Special title treatment</h5> --}}
          <p class="card-text fs-6">{!! filterString(substr($journal->content, 0, 300)) !!}</p>
          @else
          <div class="card-body" wire:click='editJournal(@json($journal->_id))'>
            {{-- <h5 class="card-title">Special title treatment</h5> --}}
            <p class="card-text fs-6">{!! filterString(substr($journal->content, 0, 300)) !!}</p>
            
        @endif
        </div>
      </div>
    </div>
  @endforeach

  <script src="{{ asset('/js/activityDetector.js') }}" ></script>

</div>
