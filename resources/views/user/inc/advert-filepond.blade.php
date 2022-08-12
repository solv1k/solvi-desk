<div class="d-flex flex-wrap align-items-center gap-3">
    <div class="advert--images-container">
        @isset($advert)
            <img 
                src="{{ $advert->main_image_url }}" 
                alt="#{{ $advert->id }}"
                class="advert--image-current">
        @else
            <img 
                src="{{ advert_image_placeholder() }}" 
                alt="{{ __('Placeholder') }}"
                class="advert--image-current">
        @endisset
        <div class="advert--image-preview"></div>
    </div>
    <div id="uploader"></div>
</div>

<input 
    type="file"
    id="image"
    name="image"
    class="d-none">

<script type="module" defer>
    @isset($advert)
        const $imageCurrent = document.querySelector('.advert--image-current');
    @endisset
    const $imagePreview = document.querySelector('.advert--image-preview');
    const $imageInput = document.getElementById('image');
    // Create a multi file upload component
    const pond = FilePond.create(document.getElementById('uploader'), {
        multiple: false,
        name: 'image',
        maxFileSize: '4MB',
        acceptedFileTypes: ['image/png', 'image/jpeg'],
        labelFileTypeNotAllowed: '{{ __("Allowed only PNG/JPG images") }}',
        labelMaxFileSizeExceeded: '{{ __("File is too large") }}',
        labelMaxFileSize: '{{ __("Maximum file size is") }} {filesize}',
        labelIdle: `
            {{ __("Drag & Drop your files or") }}
            <span class="filepond--label-action">{{ __("Browse image") }}</span>
            <br>
            <span class="small">{{ __("We recommend 4:3 ratio") }}</span>`,
        imageResizeTargetWidth: 600,
        imageCropAspectRatio: 1,
        onpreparefile: (uploaded, output) => {
            const src = URL.createObjectURL(output);
            if (!src) return;

            @isset($advert)
                $imageCurrent.classList.add('d-none');
            @endisset

            const img = new Image();
            img.src = src;

            $imagePreview.innerHTML = '';
            $imagePreview.appendChild(img);

            const fileContainer = new DataTransfer();
            fileContainer.items.add(uploaded.file);
            $imageInput.files = fileContainer.files;
        },
        onremovefile: (error, file) => {
            $imagePreview.innerHTML = '';
            @isset($advert)
                $imageCurrent.classList.remove('d-none');
            @endisset
            $imageInput.files = null;
        }
    });
</script>