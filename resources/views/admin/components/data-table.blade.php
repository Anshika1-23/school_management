    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table" id="{{$table_id}}">
                    <thead>
                        <tr>
                            @foreach($thead as $th)
                                <th>{{$th}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>