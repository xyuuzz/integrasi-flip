<x-layouts.app>
    <h2>Infaq Digital Menggunakan Flip</h2>
    <br><br><br>
    <h4>Form Infaq</h4>
    <form action="/create-payment" method="POST" class="mt-3">
        @csrf
        <div class="form-group mt-4">
            <label for="amount">Masukan Nominal Infaq</label>
            <input type="number" class="form-input" name="amount">
        </div>
        <div class="form-group mt-4">
            <label for="name">Masukan Nama Anda</label>
            <input type="text" class="form-input" name="name">
        </div>
        <div class="form-group mt-4">
            <label for="nominal">Masukan Email Anda</label>
            <input type="email" class="form-input" name="email">
        </div>
        <div class="form-group mt-4">
            <label for="nominal">Masukan No. Handphone Anda</label>
            <input type="number" class="form-input" name="phone_number">
        </div>
        <div class="form-group mt-4">
            <label for="nominal">Masukan Alamat Rumah Anda</label>
            <input type="text" class="form-input" name="address">
        </div>
{{--            <div class="form-group mt-4">--}}
{{--                <label for="bank">Pilih Bank apa yang akan digunakan</label>--}}
{{--                <select name="bank" id="bank" class="form-input">--}}
{{--                    <option value="bni">BNI</option>--}}
{{--                    <option value="bri">BRI</option>--}}
{{--                    <option value="bca">BCA</option>--}}
{{--                    <option value="mandiri">MANDIRI</option>--}}
{{--                    <option value="cimb">CIMB NIAGA</option>--}}
{{--                    <option value="gopay">GOPAY</option>--}}
{{--                </select>--}}
{{--            </div>--}}
        <br>
        <button class="btn btn-outline-primary" type="submit">Submit</button>
    </form>
    <br>
    <x-partials.alert />
    <br><br>
</x-layouts.app>
