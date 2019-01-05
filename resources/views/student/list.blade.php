@extends($layout)
@if($menu)
@section('sidebar')
    @include($menu)
@endsection
@endif

@section('content')
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">Registered Students</div>
            <div class="panel-body">
                @if (!$students->isEmpty())
                    <table class="registered-students table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th class="name">Name</th>
                                <th class="dob">DOB</th>
                                <th class="mentor_contact">Mentor May Contact</th>
                                <th class="email">Email</th>
                                <th class="actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($students as $student)
                            <tr id="student-{{ $student->id }}">
                                <td class="name">{{ $student->name }}</td>
                                <td class="dob">{{ $student->dob }}</td>
                                <td class="mentor_contact" data-value="{{ $student->mentor_contact }}">{{ ($student->mentor_contact ? 'Yes' : 'No') }}</td>
                                <td class="email">{{ $student->email }}</td>
                                <td class="actions"><a class="edit" data-studentid="student-{{ $student->id }}" data-toggle="modal" data-target="#edit-student" href="#">Edit</a> <a class="delete" data-studentid="student-{{ $student->id }}" href="#">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>There are no students registered with this account.</p>
                    <p><a href="/student/register" title="Register a student">Register a student now!</a></p>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Edit Student</h4>
                </div>
                <form method="post" action="#">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    <div class="modal-body">

                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            @if ($errors->has('id'))
                                <span class="help-block">
                                <strong>{{ $errors->first('id') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Student Date of Birth</label>

                            <div class="col-md-6">
                                <input type="text" id="dob" class="form-control" name="dob" value="{{ old('dob') }}" required/>

                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mentor_contact') ? ' has-error' : '' }}">
                            <label for="mentor_contact" class="col-md-4 control-label">Mentor can contact Student</label>

                            <div class="col-md-6">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary active">
                                        <input type="radio" name="mentor_contact" id="mentor_contact_1" value="1">Yes
                                    </label>
                                    <label class="btn btn-primary">
                                        <input type="radio" name="mentor_contact" id="mentor_contact_0" value="0">No
                                    </label>
                                </div>

                                @if ($errors->has('mentor_contact'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('mentor_contact') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() { //
            if((modal = $('#edit-student')).length) {
                modal.on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget),
                        studentid = '#' + button.data('studentid'),
                        id = studentid.replace("#student-",''),
                        studentName = $(studentid + ' .name').text(),
                        studentDob = $(studentid + ' .dob').text(),
                        studentMentorContact = $(studentid + ' .mentor_contact').data('value'),
                        studentEmail = $(studentid + ' .email').text();
                    modal.find('form').attr('action','/student/edit/' + id);
                    modal.find('.modal-body input#name').val(studentName);
                    modal.find('.modal-body input#dob').val(studentDob);
                    modal.find('.modal-body input#mentor_contact_' + studentMentorContact).attr('checked',true);
                    modal.find('.modal-body input[name=mentor_contact]').parent('label').removeClass('active'); // reset active label
                    modal.find('.modal-body input#mentor_contact_' + studentMentorContact).parent('label').addClass('active');
                    modal.find('.modal-body input#email').val(studentEmail);
                });
                modal.on('hidden.bs.modal', function (event) {
                    modal.find('form').attr('action','#');
                    modal.find('.modal-body input#name').val('');
                    modal.find('.modal-body input#dob').val('');
                    modal.find('.modal-body input[name=mentor_contact]').attr('checked',false);
                    modal.find('.modal-body input#email').val('');
                });
            }
        });
    </script>
@endsection
