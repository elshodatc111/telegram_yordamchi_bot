@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Yangi targ'ibot rejasi</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('card_create_story') }}" method="POST">
                        @csrf 

                        <!-- Targ'ibot nomi -->
                        <div class="mb-3">
                            <label for="card_name" class="form-label">Targ'ibot nomi <span class="text-danger">*</span></label>
                            <input type="text" name="card_name" id="card_name" class="form-control" required>
                        </div>

                        <!-- Targ'ibot materiali -->
                        <div class="mb-3">
                            <label for="post_id" class="form-label">Targ'ibot materiali <span class="text-danger">*</span></label>
                            <select name="post_id" id="post_id" class="form-select" required>
                                <option value="">Tanlang</option>
                                @foreach($Post as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['description'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Targ'ibot turi -->
                        <div class="mb-3">
                            <label for="card_type" class="form-label">Targ'ibot turi <span class="text-danger">*</span></label>
                            <select name="card_type" id="card_type" class="form-select" onchange="showUser(this.value)" required>
                                <option value="">Tanlang</option>
                                <option value="one_data">Bir martalik</option>
                                <option value="all_data">Belgilangan muddat</option>
                                <option value="week_data">Hafta kunlari</option>
                            </select>
                        </div>
                        <div id="txtHint" class="mb-3"></div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary w-50">Saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showUser(cardType) {
        const hintElement = document.getElementById("txtHint");

        if (!cardType) {
            hintElement.innerHTML = "Bu yerda ma'lumotlar paydo bo'ladi...";
            return;
        }

        // AJAX so'rovi
        fetch(`/card_create_typing?q=${cardType}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Serverdan noto'g'ri javob keldi.");
                }
                return response.json();
            })
            .then(data => {
                hintElement.innerHTML = data.message || "Ma'lumotlar mavjud emas.";
            })
            .catch(error => {
                console.error("Xatolik:", error);
                hintElement.innerHTML = "<div class='text-danger'>Ma'lumotlarni yuklashda xatolik yuz berdi.</div>";
            });
    }
</script>

@endsection
