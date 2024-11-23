<div class="card">
    <div class="card-header">
        <h5 class="card-title">Staff List</h5>
        <button type="button" class="btn btn-success btn-sm set-all-permission" data-role="{{$role}}" data-status="1"><i class="bi bi-check-circle"></i> Mark Permssion to All</button>
        <button type="button" class="btn btn-danger btn-sm set-all-permission" data-role="{{$role}}" data-status="0"><i class="bi bi-x-circle"></i> Remove Permssion From All</button>
        <button type="button" class="btn btn-warning btn-sm reset-allStaff-password"  data-role="{{$role}}"><i class="bi bi-arrow-clockwise" ></i> Reset All Password</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Staff No.</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Login Permission</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                @if($staff->isNotEmpty())
                @foreach($staff as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->full_name}}</td>
                    <td>{{$row->role_name->title}}</td>
                    <td>{{$row->email}}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input permission-checkbox" data-id="{{$row->id}}" data-type="staff" @if($row->login_permission == '1') checked @endif>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input type="text" class="form-control w-auto me-1" name="password" />
                            <button type="button" class="btn btn-success btn-sm me-1  save-login-password" data-id="{{$row->id}}" data-type="staff" title="Save"><i class="bi bi-floppy"></i></button>
                            <button type="button" class="btn btn-primary btn-sm reset-login-password" data-id="{{$row->id}}" data-type="staff" title="Reset"><i class="bi bi-arrow-clockwise"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td>No Records Found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>