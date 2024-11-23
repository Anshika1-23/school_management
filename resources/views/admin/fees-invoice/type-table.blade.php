<table class="table table-bordered type-table">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Fees Type</th>
            <th>Amount</th>
            <th>Waiver</th>
            <th>Total Amount</th>
            <th>Note</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($types as $key => $type)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$type->title}}
                <input type="text" name="types[{{$key}}][type]" hidden value="{{$type->id}}">
            </td>
            <td><input type="number" name="types[{{$key}}][amount]" min="0" class="form-control amount" required></td>
            <td><input type="number" name="types[{{$key}}][waiver]" min="0" class="form-control waiver"></td>
            <td><span class="t-amount"></span></td>
            <td><input type="text" name="types[{{$key}}][note]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-type"><i class="bi bi-trash"></i></button></td>
        </tr>
        @endforeach
    </tbody>
</table>