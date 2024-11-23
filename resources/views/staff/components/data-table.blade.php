<!-- Minimal jQuery Datatable start -->
<section class="section">
    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <!-- <div class="card-header">
                <h5 class="card-title">
                    jQuery Datatable
                </h5>
            </div> -->
            <div class="card-body">
                <!-- <div class="table-responsive"> -->
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
                <!-- </div> -->
            </div>
        </div>
    </section>
    <!-- Basic Tables end -->