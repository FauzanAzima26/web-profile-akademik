@extends('Frontend.layouts.main')

@section('content')
    <section class="rooms-showcase section">
        <div class="container section-title" data-aos="fade-up">
            <span class="description-title">Akreditasi</span>
            <h2>Akreditasi</h2>
        </div>

        <div class="container mt-4">

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-center shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            @foreach ($rows[0] as $header)
                                <th>{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($rows as $key => $row)
                            @if ($key === 0)
                                @continue
                            @endif
                            <tr>

                                @php
                                    $link = $row[7] ?? null; // kolom terakhir
                                @endphp

                                @foreach ($row as $i => $col)
                                    @if ($i == 7)
                                        <td>
                                            <a href="{{ $col }}" target="_blank" class="btn btn-primary btn-sm">
                                                Download
                                            </a>
                                        </td>
                                    @elseif ($i < 7)
                                        <td>{{ $col }}</td>
                                    @endif
                                @endforeach

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
@endsection
