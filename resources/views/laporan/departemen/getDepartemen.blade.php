<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Departemen</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($departemen as $c)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $c->nama }}</td>


            </tr>
        @endforeach
    </tbody>

</table>
