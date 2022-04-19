<x-layouts.app>

    <form action="/create-payment" method="POST" class="mt-3 {{session("payment") ? "d-none" : ""}}">
        <h2>Infaq Digital Menggunakan Flip</h2>
        <br><br><br>
        <h4>Form Infaq</h4>
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
        <div class="form-group mt-4">
            <label for="bank_type">Pilih Tipe Bank</label>
            <select onchange="bankType(this)" class="form-input" name="bank_type" id="bank_type">
                <option value="bank_account">Akun Bank</option>
                <option value="virtual_account">Virtual Akun Bank</option>
            </select>
        </div>
        <div class="form-group mt-4">
            <label for="bank">Pilih Bank apa yang akan digunakan</label>
            <select name="bank" id="bank" class="form-input">
                <option class="bank" value="bni">BNI</option>
                <option class="bank" value="bri">BRI</option>
                <option class="bank" value="bca">BCA</option>
                <option class="bank" value="mandiri">MANDIRI</option>
                <option class="bank" value="cimb">CIMB NIAGA</option>
                <option class="bank" value="permata">PERMATA</option>
                <option class="bank" value="gopay">GOPAY</option>
{{--                    Bisa ditambahkan bank lagi sesuai list dari flip nya--}}
            </select>
        </div>
        <br>
        <button class="btn btn-outline-primary" type="submit">Submit</button>
    </form>
    <br><br>
    <x-partials.alert />
    <x-partials.info-pembayaran />
    <br><br>


    <script>
        const bankType = (e) => {
            const value = e.value;
            const option = [...document.getElementsByClassName("bank")]
            const vitrualAccountAvaible = ["bni", "bri", "permata"]

            if(value === "virtual_account")
            {
                option.forEach(e => {
                    const optionValue = e.value
                    if(optionValue != "bni" && optionValue != "bri" && optionValue != "permata")
                    {
                        e.classList.add("d-none")
                    }
                })
            }
            else
            {
                option.forEach(e => {
                    e.classList.remove("d-none")
                })
            }

        }
    </script>
</x-layouts.app>
