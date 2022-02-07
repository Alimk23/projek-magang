@component('mail::message')
<h2 style="text-align: center;color:black">
    {{ $data['title'] }}
</h2>
<table>
    <tr>
        <td><b>Order ID</b></td> 
        <td>: {{ $data['order_id'] }}</td>
    </tr>
    <tr>
        <td><b>Nama</b></td>
        <td>: {{ $data['name'] }}</td>
    </tr>
    <tr>
        <td><b>No. Telepon/HP</b></td>
        <td>: +{{ $data['phone'] }}</td>
    </tr>
    <tr>
        <td><b>Tanggal Donasi</b></td>
        <td>: {{ $data['created_at'] }}</td>
    </tr>
    <tr>
        <td><b>Nominal</b></td>
        <td>: Rp {{ $data['nominal'] }}</td>
    </tr>
</table>
<hr>
<a href="https://api.whatsapp.com/send/?phone={{ $data['phone'] }}" target="_blank" style="text-decoration: none;">
    <button type="button" style="
        background-color: #48bb78;
        border-bottom: 8px solid #48bb78;
        border-left: 18px solid #48bb78;
        border-right: 18px solid #48bb78;
        border-top: 8px solid #48bb78;
        border-radius:10px;
        display: block; 
        margin-left:auto; 
        margin-right:auto;
        color:white !important;
    ">
        Follow Up Via WhatsApp
    </button>
</a>
Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent