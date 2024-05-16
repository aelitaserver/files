<x-app-layout>
    @foreach($files as $file)
        {{ $file->original }}
        <form method="POST" action="{{ route('files.download', $file->id) }}">
            @csrf
            <button type="submit">Download</button>
        </form>
    @endforeach
</x-app-layout>
