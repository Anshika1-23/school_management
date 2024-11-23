<div class="card">
    <div class="card-header">
        <h5 class="card-title">Students List</h5>
        <button class="btn btn-success btn-sm mb-1 setAll_studentsLoginPermssion" data-class="{{$class}}" data-section="{{$section}}" data-status="1"><i class="bi bi-check-circle"></i> Mark Permssion to All Students</button>
        <button class="btn btn-danger btn-sm mb-1 setAll_studentsLoginPermssion" data-class="{{$class}}" data-section="{{$section}}" data-status="0"><i class="bi bi-x-circle"></i> Remove Permssion From All Students</button>
        <button class="btn btn-warning btn-sm mb-1 resetAll_studentsPassword" data-class="{{$class}}" data-section="{{$section}}"><i class="bi bi-arrow-clockwise"></i> Reset All Student Password</button>
        <button class="btn btn-info btn-sm mb-1 resetAll_parentsPassword" data-class="{{$class}}" data-section="{{$section}}"><i class="bi bi-arrow-clockwise"></i> Reset All Parents Password</button>
        <button class="btn btn-dark btn-sm mb-1 setAll_parentsLoginPermssion" data-class="{{$class}}" data-section="{{$section}}" data-status="1"><i class="bi bi-check-circle"></i> Mark Permssion to All Parents</button>
        <button class="btn btn-light btn-sm mb-1 setAll_parentsLoginPermssion" data-class="{{$class}}" data-section="{{$section}}" data-status="0"><i class="bi bi-x-circle"></i> Remove Permssion From All Parents</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Admission No.</th>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Student Permission</th>
                    <th>Student Password</th>
                    <th>Parent Permission</th>
                    <th>Parent Password</th>
                </tr>
            </thead>
            <tbody>
                @if($students->isNotEmpty())
                @foreach($students as $student)
                <tr>
                    <td>{{$student->admission_no}}</td>
                    <td>{{$student->roll_no}}</td>
                    <td>{{$student->full_name}}</td>
                    <td>{{$student->class_name->title}} ({{$student->section_name->title}})</td>
                    <td>
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input permission-checkbox" data-id="{{$student->id}}" data-type="student" @if($student->login_permission == '1') checked @endif>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input type="text" class="form-control me-1" name="password" />
                            <button type="button" class="btn btn-success btn-sm me-1  save-login-password" data-id="{{$student->id}}" data-type="student" title="Save"><i class="bi bi-floppy"></i></button>
                            <button type="button" class="btn btn-primary btn-sm reset-login-password" data-id="{{$student->id}}" data-type="student" title="Reset"><i class="bi bi-arrow-clockwise"></i></button>
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input permission-checkbox" data-id="{{$student->parent_id}}" data-type="parent" @if($student->parent_name->login_permission == '1') checked @endif>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input type="text" class="form-control me-1" name="password" />
                            <button type="button" class="btn btn-success btn-sm me-1  save-login-password" data-id="{{$student->parent_id}}" data-type="parent"  title="Save"><i class="bi bi-floppy"></i></button>
                            <button type="button" class="btn btn-primary btn-sm reset-login-password" data-id="{{$student->parent_id}}" data-type="parent" title="Reset"><i class="bi bi-arrow-clockwise"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7">No Record Found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>