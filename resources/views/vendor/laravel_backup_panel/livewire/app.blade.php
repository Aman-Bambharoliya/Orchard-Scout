<div id="kt_content_container" class="container-xxl">
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
            </h3>
            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                title="Refresh list">
                <a href="#" class="btn btn-sm btn-light-primary me-2" id="create-backup-only-db" wire:click.prevent="">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                        </svg>
                    </span>
                    Create Backup</a>
                <button class="btn btn-primary btn-sm btn-refresh ml-auto" wire:loading.class="loading"
                    wire:loading.attr="disabled" wire:click="updateBackupStatuses">
                    <svg xmlns="http://www.w3.org/2000/svg" width="0.7875rem" height="0.7875rem" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path class="heroicon-ui"
                            d="M6 18.7V21a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2H7.1A7 7 0 0 0 19 12a1 1 0 1 1 2 0 9 9 0 0 1-15 6.7zM18 5.3V3a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1h-5a1 1 0 0 1 0-2h2.9A7 7 0 0 0 5 12a1 1 0 1 1-2 0 9 9 0 0 1 15-6.7z" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="card-body py-3">
            <div class="table-responsive">
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bolder text-muted">
                            <th class="min-w-200px">Disk</th>
                            <th class="min-w-150px">Amount of backups</th>
                            <th class="min-w-150px">Newest backup</th>
                            <th class="min-w-100px">Used storage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($backupStatuses as $backupStatus)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        {{ $backupStatus['disk'] }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        {{ $backupStatus['amount'] }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        {{ $backupStatus['newest'] }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        {{ $backupStatus['usedStorage'] }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            {{-- @if(count($disks))
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                @foreach($disks as $disk)
                <label class="btn btn-outline-secondary {{ $activeDisk === $disk ? 'active' : '' }}"
                    wire:click="getFiles('{{ $disk }}')">
                    <input type="radio" name="options" {{ $activeDisk===$disk ? 'checked' : '' }}>
                    {{ $disk }}
                </label>
                @endforeach
            </div>
            @endif --}}
            <h3 class="card-title align-items-start flex-column">
            </h3>
            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                title="">
                <button class="btn btn-primary btn-sm btn-refresh ml-auto" wire:loading.class="loading"
                    wire:loading.attr="disabled" wire:click="getFiles" {{ $activeDisk ? '' : 'disabled' }}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="0.7875rem" height="0.7875rem" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path class="heroicon-ui"
                            d="M6 18.7V21a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2H7.1A7 7 0 0 0 19 12a1 1 0 1 1 2 0 9 9 0 0 1-15 6.7zM18 5.3V3a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1h-5a1 1 0 0 1 0-2h2.9A7 7 0 0 0 5 12a1 1 0 1 1-2 0 9 9 0 0 1 15-6.7z" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="card-body py-3">
            <div class="table-responsive">
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bolder text-muted">
                            <th class="min-w-200px">Path</th>
                            <th class="min-w-150px">Created at</th>
                            <th class="min-w-150px">Size</th>
                            <th class="min-w-100px text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        {{ $file['path'] }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        {{ $file['date'] }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        {{ $file['size'] }}
                                    </div>
                                </div>
                            </td>
                            <td class="text-right pr-3">
                                <div class="d-flex justify-content-end flex-shrink-0">
                                    <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1   me-1"
                                        href="#" target="_blank"
                                        wire:click.prevent="downloadFile('{{ $file['path'] }}')">
                                        <span class="svg-icon svg-icon-3"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M19 15C20.7 15 22 13.7 22 12C22 10.3 20.7 9 19 9C18.9 9 18.9 9 18.8 9C18.9 8.7 19 8.3 19 8C19 6.3 17.7 5 16 5C15.4 5 14.8 5.2 14.3 5.5C13.4 4 11.8 3 10 3C7.2 3 5 5.2 5 8C5 8.3 5 8.7 5.1 9H5C3.3 9 2 10.3 2 12C2 13.7 3.3 15 5 15H19Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M13 17.4V12C13 11.4 12.6 11 12 11C11.4 11 11 11.4 11 12V17.4H13Z"
                                                    fill="currentColor" />
                                                <path opacity="0.3"
                                                    d="M8 17.4H16L12.7 20.7C12.3 21.1 11.7 21.1 11.3 20.7L8 17.4Z"
                                                    fill="currentColor" />
                                            </svg></span>
                                    </a>
                                    <a href="#"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm "
                                        target="_blank" wire:click.prevent="showDeleteModal({{ $loop->index }})">
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                    fill="currentColor" />
                                                <path opacity="0.5"
                                                    d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                    fill="currentColor" />
                                                <path opacity="0.5"
                                                    d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if(!count($files))
                        <tr>
                            <td class="text-center" colspan="4">
                                {{ 'No backups present' }}
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title mb-3">Delete backup</h5>
                @if($deletingFile)
                <span class="text-muted">
                    Are you sure you want to delete the backup created at {{ $deletingFile['date']
                    }} ?
                </span>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-2 mb-2"
                    data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger delete-button btn-refresh"
                    wire:click="deleteFile" wire:loading.class="loading"
                    wire:loading.attr="disabled">Delete  <span class="svg-icon svg-icon-3 load-svg"><svg xmlns="http://www.w3.org/2000/svg" width="0.7875rem" height="0.7875rem" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path class="heroicon-ui"
                        d="M6 18.7V21a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2H7.1A7 7 0 0 0 19 12a1 1 0 1 1 2 0 9 9 0 0 1-15 6.7zM18 5.3V3a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1h-5a1 1 0 0 1 0-2h2.9A7 7 0 0 0 5 12a1 1 0 1 1-2 0 9 9 0 0 1 15-6.7z" />
                </svg></span></button>
            </div>
        </div>
    </div>
</div>
    <script>
        document.addEventListener('livewire:load', function () {
        @this.updateBackupStatuses()

        @this.on('backupStatusesUpdated', function () {
            @this.getFiles()
        })

        @this.on('showErrorToast', function (message) {
            Toastify({
                text: message,
                duration: 10000,
                gravity: 'bottom',
                position: 'right',
                backgroundColor: 'red',
                className: 'toastify-custom',
            }).showToast()
        })

        const backupFun = function (option = '') {
            Toastify({
                text: 'Creating a new backup in the background...' + (option ? ' (' + option + ')' : ''),
                duration: 5000,
                gravity: 'bottom',
                position: 'right',
                backgroundColor: '#1fb16e',
                className: 'toastify-custom',
            }).showToast()

           var a = @this.createBackup(option)
        }

        $('#create-backup').on('click', function () {
            backupFun()
        })
        $('#create-backup-only-db').on('click', function () {
            backupFun('only-db')
        })
        $('#create-backup-only-files').on('click', function () {
            backupFun('only-files')
        })

        const deleteModal = $('#deleteModal')
        @this.on('showDeleteModal', function () {
            deleteModal.modal('show')
        })
        @this.on('hideDeleteModal', function () {
            deleteModal.modal('hide')
        })

        deleteModal.on('hidden.bs.modal', function () {
            @this.deletingFile = null
        })
    })
    </script>
    <style>
        .delete-button svg {
    display: none;
}
.delete-button.loading svg {
    display: inline-block;
}
    </style>
</div>
@section('pagespecificscripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@livewireScripts
@endsection