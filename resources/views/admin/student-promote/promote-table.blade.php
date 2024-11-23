<div class="card">
    <div class="card-body">
        {{-- <form action="" id="promote-form"> --}}
            <input type="text" name="from_year" hidden value="{{$from_year}}"/>
            <input type="text" name="to_year" hidden value="{{$to_year}}"/>
            <input type="text" name="from_class" hidden value="{{$from_class}}"/>
            <input type="text" name="from_section" hidden value="{{$from_section}}"/>
            <button type="button" class="btn btn-primary mb-2 float-end submit-promote-form"><i class="bi bi-check"></i> Promote</button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="form-check-input check-all" name="check-all"/> All</th>
                        <th>Admission No.</th>
                        <th>Name</th>
                        <th>Promote Type</th>
                        <th>Promote Class</th>
                        <th>Promote Section</th>
                        <th>Next Roll Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td><input type="checkbox" class="form-check-input promote-checkbox" data-id="{{$student->id}}"/></td>
                        <td>{{$student->admission_no}}</td>
                        <td>{{$student->full_name}}</td>
                        <td>
                            <select name="type" class="form-select">
                                <option value="class" selected>Next Class</option>
                                <option value="pass_out">Graduate</option>
                            </select>
                        </td>
                        <td>
                            <select name="class" class="form-select promote-class">
                                @if(!empty($classes))
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}" @if($class->id == $from_class) selected @endif>{{$class->title}}</option>
                                        @endforeach
                                    @endif  
                            </select>
                        </td>
                        <td>
                            <select name="section" class="form-select promote-section" required>
                                <option value="" selected disabled>Select Section</option>
                                @foreach($sections as $k => $sec)
                                <option value="{{$sec->id}}" @if($k == '0') selected @endif>{{$sec->title}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="roll_no" class="form-control" />
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" class="btn btn-primary mb-2 float-end submit-promote-form"><i class="bi bi-check"></i> Promote</button>
        {{-- </form> --}}
    </div>
</div>