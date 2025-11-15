@extends('Frontend.layouts.main')

@section('content')
<section class="rooms-showcase section">
    <div class="container section-title" data-aos="fade-up">
        <span class="description-title">Akreditasi</span>
        <h2>Akreditasi</h2>
    </div>

    <div class="container mt-4">
        <table class="table table-bordered">
            <tbody>
                @foreach ($rows as $row)
                    <tr>
                        @foreach ($row as $col)
                            <td>{{ $col }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
