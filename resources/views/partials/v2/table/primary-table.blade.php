<div class="mt-{{ $mt ?? 0 }} mb-{{ $mb ?? 0 }}">
    <table class="table-auto w-full">
        <thead>
            <tr>
                @foreach($table_headers as $header)
                    <th>{{ $header['col_name'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($table_rows as $row)
                <tr>
                    @foreach($table_headers as $header)
                        <td>{{ $row[$header['col_data']] }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    