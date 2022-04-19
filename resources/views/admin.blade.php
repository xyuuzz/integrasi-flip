<x-layouts.app>
    <h2>Daftar infaq yang masuk</h2>
    <table class="table">
        <thead>
        <tr>
{{--            <th scope="col">No</th>--}}
            <th scope="col">Project</th>
            <th scope="col">Nominal Infaq</th>
            <th scope="col">Status</th>
            <th>Tenggat Waktu</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dataInfaq as $infaq)
            <tr>
{{--                <th scope="row">3</th>--}}
                <td>{{$infaq->project}}</td>
                <td>{{$infaq->nominal}}</td>
                <td>{{$infaq->status}}</td>
                <td>{{$infaq->time_limit}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layouts.app>
