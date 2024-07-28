<div>
  {{-- <div class="container">
    <form wire:submit='addEntry'>
      <div wire:ignore>
        <textarea x-data="ckeditor()" name="myIdentifierHere" id="myIdentifierHere" x-init="init($dispatch)" wire:key="ckEditor"
          x-ref="ckEditor" id="contentArea" wire:model.debounce.9999999ms="content">{{Session::get('content')}}</textarea>
      </div>
      <button type="submit" class="btn btn-primary container-fluid">Submit</button>
    </form>
    
    <script>
      function ckeditor() {
        return {
          /**
          * The function creates the editor and returns its instance
          * @param $dispatch Alpine's magic property
          */
          create: function($dispatch) {
            // Create the editor with the x-ref
            const editor = CKEDITOR.replace('myIdentifierHere');
            if (!editor) {
              console.error("Failed to create CKEditor instance.");
              return null;
              }
              // Handle data updates
              editor.on('change', function() {
                // Trigger input event on the textarea to update Livewire
                editor.updateElement();
                // Dispatch the 'input' event manually
                const textarea = document.getElementById('myIdentifierHere');
                if (textarea) {
                  textarea.dispatchEvent(new Event('input'));
                  } else {
                    console.error("Textarea element not found.");
                    }
                    // Log editor data to the console
                    $('#contentArea').val(editor.getData());
                    });
            // return the editor
            return editor;
          },
          /**
          * Initializes the editor and creates a listener to recreate it after a rerender
          * @param $dispatch Alpine's magic property
          */
          init: function($dispatch) {
            // Get an editor instance
            const editor = this.create($dispatch);
            console.log(editor)
            // Set the initial data
            // editor.setData('{{ old('description') }}')
            // Pass Alpine context to Livewire's
            const $this = this;
            // On reinit, destroy the old instance and create a new one
            Livewire.on('reinit', function(e) {
              editor.setData('');
              editor.destroy()
              .catch(error => {
                  console.log(error);
                });
              $this.create($dispatch);
            });
          }
        }
      }

      document.addEventListener("DOMContentLoaded", function() {
        const ckeditorInstance = ckeditor();
        ckeditorInstance.init();
        });
      </script> --}}
      <form wire:submit.prevent="addEntry">
        <script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
        
    <div wire:ignore>
      <label>Blog</label>
      <textarea x-data="ckeditor()" id="content" class="ckeditor form-control" wire:model="content" required autofocus>{{ $content}}</textarea>
      <button type="submit" class="btn btn-primary container-fluid">Submit</button>
    </div>

    <script>
      var editor = CKEDITOR.replace('content');

      // Listens when textarea is changing.
      editor.on('change', function(event) {
        // console.log(event.editor.getData());

        // Update wire:model value.
        @this.set('content', event.editor.getData());
      });
      function ckeditor() {
        return {
          /**
          * The function creates the editor and returns its instance
          * @param $dispatch Alpine's magic property
          */
          create: function($dispatch) {
            // Create the editor with the x-ref
            var editor = CKEDITOR.replace('myIdentifierHere');
}}}
    </script>
  </form>
{{-- </div> --}}
</div>
