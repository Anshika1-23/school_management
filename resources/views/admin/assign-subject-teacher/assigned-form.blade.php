<input type="text" name="class" hidden value="{{$class}}">
<input type="text" name="section" hidden value="{{$section}}">
<div class="card">
    <div class="card-header d-flex">
        <h5 class="card-title mb-0 me-2 align-self-center">Assigned Subjects</h5>
        
    </div>
    <div class="card-body pt-4">
        <div class="subject-list">
            @if($assigned->isNotEmpty())
            @foreach($assigned as $row)
            <div class="row mb-4 subject-row">
                <div class="col-3">
                    <h6>{{$row->subject_name->title}}</h6>
                    <input type="text" name="subject[]" hidden value="{{$row->subject_id}}">
                </div>
                <div class="col-4">
                    <select name="teacher[]" class="form-select teacher" required>
                        <option value="" disabled>Select Teacher</option>
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}" @if($teacher->id == $row->staff_id) selected @endif>{{$teacher->f_name}} {{$teacher->l_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach
            @else
            @foreach($subjects as $subject)
            <div class="row mb-4 subject-row">
                <div class="col-3">
                    <h6>{{$subject->title}}</h6>
                    <input type="text" name="subject[]" hidden value="{{$subject->id}}">
                    
                </div>
                <div class="col-4">
                    <select name="teacher[]" class="form-select teacher" required>
                        <option value="" disabled selected>Select Teacher</option>
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->f_name}} {{$teacher->l_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <div>
            <button type="submit" class="btn btn-primary"> Save</button>
        </div>
    </div>
</div>