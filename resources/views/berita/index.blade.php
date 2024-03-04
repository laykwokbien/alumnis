@extends('template.master')

@section('dashboard')
    @if (!Auth::guard('web')->check() || !Auth::guard('alumni')->check())
        <div class="position-absolute messages d-flex w-100 justify-content-center pe-none">
            @if (session()->has('fail'))
                @foreach (session('fail') as $col)
                    @foreach ($col as $messages)
                        <div class="alert alert-danger">
                            {{ $messages }}
                        </div>
                    @endforeach
                @endforeach
            @else
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            @endif
            @if ($page['delete'])
                <form class="d-flex flex-column delete p-4" method="POST">
                    @csrf
                    <div class="mb-3">Are you wanna delete this record?</div>
                    <div class="selectionbtn d-flex justify-content-around">
                        <button class="btn btn-danger" type="submit">Yes</button>
                        <a href="{{ url('/berita') }}" class="btn btn-primary">No</a>
                    </div>
                </form>
            @endif
        </div>
    @endif
    <div class="container mt-5">
        @if (Auth::guard('admin')->check() || Auth::guard('guru')->check())
            <a href="{{ url('/create/berita') }}" class="btn btn-primary  mb-5">Create</a>
        @endif
        <br>
        @foreach ($page['data'] as $item)
            @if (Auth::guard('admin')->Check() || Auth::guard('guru')->Check())
                <div class="d-flex flex-column">
                    <p>Action</p>
                    <div class="mt-2">
                        <a href="{{ url("update/berita/$item->id") }}" class="btn btn-warning">Edit</a>
                        <a href="{{ url("delete/berita/$item->id") }}" class="btn btn-danger">Remove</a>
                    </div>
                </div>
            @endif
            <div class="beritas d-flex flex-column flex-lg-row gap-3 mb-3">
                <img src="{{ asset("./storage/$item->foto") }}" alt="">
                <div class="berita-content d-flex flex-column">
                    <p>{{ $item->judul }}</p>
                    @php echo $item->desc; @endphp
                    <a href="{{ url("/berita/view/$item->id") }}">Selengkapnya <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
