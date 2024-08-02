<div class="container">
  @if ($asc === true)
    <button wire:loading.attr='disabled' class="my-2 btn btn-primary btn-sm" wire:click='toggleAsc'>
      Sort by Date (Descending)
    </button>
  @else
    <button wire:loading.attr='disabled' class="my-2 btn btn-primary btn-sm" wire:click='toggleAsc'>
      Sort by Date (Ascending)
    </button>
  @endif
  @if (!$all)
    @if ($pagination === 10)
      <button class="btn btn-primary btn-sm" wire:loading.attr='disabled' wire:click='setPagination(30)'>30 journals per
        page</button>
    @else
      <button class="btn btn-primary btn-sm" wire:loading.attr='disabled' wire:click='setPagination(10)'>10 journals per
        page</button>
    @endif
  @endif
  @if (Request::url() !== url('/recyclebin'))
    <label>Search</label>
    <input type="text" wire:model.live='search'>
  @endif
  <div wire:loading class="m-2" style="float: right">
    <div class="spinner-border text-warning mx-auto m-0 p-0" role="status"></div>
  </div>
  <div class="container-fluid">
    @foreach ($journals as $journal)
      <div class="">
        <div class="card my-1">
          <div class="card-header d-flex justify-content-between">
            <div class="d-inline">
              <div class="journal-index">#{{ formatDate($journal->journal_date_time) }}</div>
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
          @if (Request::url() == url('/recyclebin'))
            <div class="card-body">
              {{-- <h5 class="card-title">Special title treatment</h5> --}}
              <p class="card-text fs-6">{!! filterString(substr($journal->content, 0, 300)) !!}...</p>
            @else
              <div class="card-body" wire:click='editJournal(@json($journal->_id))'>
                {{-- <h5 class="card-title">Special title treatment</h5> --}}
                <p class="card-text fs-6">{!! filterString(substr($journal->content, 0, 300)) !!}...</p>
          @endif
        </div>
      </div>
  </div>
  @endforeach
</div>
<div>
  @if ($search === '' && !$all)
    @if ($journals->hasPages())
      <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        <span>
          {{-- Previous Page Link --}}
          @if ($journals->onFirstPage())
            <span
              class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
              {!! __('pagination.previous') !!}
            </span>
          @else
            <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
              class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
              {!! __('pagination.previous') !!}
            </button>
          @endif
        </span>
        <span class="container">
          @for ($i = 1; $i <= $journals->lastPage(); $i++)
            <a class="mx-1" href="{{ url("/?page=$i") }}">{{ $i }}</a>
          @endfor
        </span>
        <span>
          {{-- Next Page Link --}}
          @if ($journals->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
              class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
              {!! __('pagination.next') !!}
            </button>
          @else
            <span
              class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
              {!! __('pagination.next') !!}
            </span>
          @endif
        </span>
      </nav>
    @endif
  @endif

</div>
<script src="{{ asset('/js/activityDetector.js') }}"></script>

</div>
