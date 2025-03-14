<div
    x-data
    x-init="
        onUploadSuccess = (elForUploadedFiles) =>
          (file, response) => {
            const url = response.uploadURL;
            {{-- const fileName = file.name; --}}
            const fileName = new Date().getTime().toString();
            console.log(fileName)
            const uploadedFileData = JSON.stringify(response.body);
            console.log(uploadedFileData)
            const li = document.createElement('li');
            const a = document.createElement('a');
            a.href = url;
            a.target = '_blank';
            a.appendChild(document.createTextNode(fileName));
            li.appendChild(a);

            document.querySelector(elForUploadedFiles).appendChild(li);

            var inputElementUrlUploadFile = document.getElementById('{{ $hiddenField }}');

            var type = document.getElementById('type').value;
            var name = document.getElementById('name').value;

            var training_id = document.getElementById('training_id').value;


            axios({
                method: 'post',
                url: '{{ route('admin.trainings.media') }}',
                data: {
                    type: type,
                    name: name,
                    training_id: training_id,
                    url: url,
                }
              })
              .then(function(response){
                if(response.status == 200) {window.location.reload()}
              })
              .catch(err => console.warn(err));


            inputElementUrlUploadFile.value = url;
            inputElementUrlUploadFile.dispatchEvent(new Event('input'));

            {{ $extraJSForOnUploadSuccess }}
          };

        uppyUpload{{ $hiddenField }} = new Uppy({
            allowMultipleUploads: false,
            autoProceed: false,
            debug: true,
            restrictions: {
                maxNumberOfFiles: 1,
              }

        });

        uppyUpload{{ $hiddenField }}
          .use(DragDrop, {{ $dragDropOptions }})
          .use(AwsS3Multipart, {
              companionUrl: '/',
              companionHeaders:
              {
                  'X-CSRF-TOKEN': window.csrfToken,
              },
          })
          .use(StatusBar, {{ $statusBarOptions }})
          .on('upload-success', onUploadSuccess('.{{ $uploadElementClass }} .uploaded-files ol'))
          .on('file-added', (file) => {

              let ext = file.extension;

              let type = document.getElementById('type').value;
              let name = document.getElementById('name').value;

              let document_exts = ['pdf', 'docx'];
              let video_exts = ['mp4'];

                if(type == 'document'){
                    if(!document_exts.includes(ext)){
                        uppy.removeFile(file.id);
                        Snackbar.show({
                            text: 'Unknow document format, allowed: pdf, docx',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'bottom-right'
                        });
                    }
                }else if(type == 'video'){
                    if(!video_exts.includes(ext)){
                        uppy.removeFile(file.id);
                        Snackbar.show({
                            text: 'Unknow video format, allowed: mp4',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'bottom-right'
                        });
                    }
                }

          })
    "
>
    <section class="{{ $uploadElementClass }}">
      <div class="for-DragDrop" x-ref="input"></div>

      <div class="for-ProgressBar"></div>

      <div class="uploaded-files">
        <h5 style="margin-top: 10px">{{ __('Uploaded file:') }}</h5>
        <ol></ol>
      </div>
    </section>
</div>
