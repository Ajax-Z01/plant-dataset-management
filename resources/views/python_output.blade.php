@extends('layouts.user_type.auth')

@section('content')
<div class="container row justify-content-center">
    <div class="row justify-content-center my-4 result">
        <div class="col-12 text-start">
            <h2>Hasil Training Data</h2> <!-- Judul halaman dalam PDF -->
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">{{ __('Accuracy Plot') }}</div>
                <div class="card-body">
                    <img class="img-fluid" src="{{ asset('assets/plot1.png') }}" alt="My Plot">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">{{ __('Loss Plot') }}</div>
                <div class="card-body">
                    <img class="img-fluid" src="{{ asset('assets/plot2.png') }}" alt="My Plot">
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary mx-4 col-3" onclick="downloadPageAsPDF()">Download Full Page PDF</button>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    function downloadPageAsPDF() {
    const filename = 'Hasil Training Data.pdf';

    const element = document.querySelector('.result');
    // Mengambil konten dari elemen .result dan mengkonversi ke dalam PDF
    html2pdf()
        .from(element)
        .save(filename);
    }
</script>
@endsection
