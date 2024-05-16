<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload a file') }}
        </h2>
    </x-slot>
    <div class="mt-8 w-full flex justify-center">
        <div class="w-full md:w-3/4 lg:w-1/2 mx-4 p-4 py-8 bg-white border border-gray-200 shadow-md rounded-md">
            <h1 class="mb-2 font-bold text-xl text-center">Upload your file here</h1>
            <form id="fileUploadForm" class="flex flex-col items-center justify-center" method="POST" enctype="multipart/form-data" action="{{ route('files.store') }}">
                @csrf
                <input class="border-2 border-red-300 p-2 cursor-pointer hover:bg-rose-300 transition-all rounded" type="file" name="file" required />
                <div class="flex gap-2 w-full justify-center items-center">
                    <div  class="p-2 mt-2 cursor-pointer bg-white hover:bg-red-300 transition-all border-2 border-red-300 rounded" aria-label="Cancel button" id="cancelUpload">Cancel</div>
                    <button class="w-full md:w-3/4 lg:w-1/2 p-2 border-2 border-red-300 mt-2 bg-white hover:bg-lime-100 transition-all rounded" type="submit">Upload</button>
                </div>
            </form>
            <div class="w-full bg-gray-200 rounded-full h-2.5  mt-4">
                <div class="bg-rose-400 h-2.5 rounded-full progress" style="width: 0%" role="progress" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script>
        $(function () {
            $(document).ready(function () {
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function () {
                        var percentage = '0';
                    },
                    uploadProgress: function (event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.progress').css("width", percentage+'%', function() {
                          return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function (xhr) {
                        alert('File has uploaded successfully!');
                    }
                });
                $('#cancelUpload').click(function() {
                    if(xhr) {
                        xhr.abort();
                        xhr = null;
                        alert('Upload cancelled.');
                    }
                });
            });
        });
    </script>
</x-app-layout>
