@props([
    "payment" => session("payment") ?? ''
])
<div>
    @if($payment)
        <h2>Info Pembayaran</h2>
        <p>Nomor Akun : {{$payment->bill_payment->receiver_bank_account->account_number}}</p>
        <p>Tipe Akun :
            @if($payment->bill_payment->sender_bank_type === "virtual_account")
                Akun Virtual Bank
            @else
                Akun Bank
            @endif
        </p>
        <p>Kode Bank : {{$payment->bill_payment->receiver_bank_account->bank_code}}</p>
        <p>Pemilik Akun : {{$payment->bill_payment->receiver_bank_account->account_holder}}</p>
        <p>Atau Bisa langsung klik link berikut : <a href="{{$payment->payment_url}}">Klik</a> </p>
    @endif
</div>
