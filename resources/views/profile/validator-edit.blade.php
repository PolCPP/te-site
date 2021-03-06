@extends('../layouts.app')

@section('page-title') {!! trans('reg-profile.my_profile') !!} @endsection
@section('page-class') my-profile @endsection

@section('content')

@section('meta')
  <meta id="token" content="{{ $token }}" />
@endsection

<div class="container v-container edit-profile">
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <h1 class="col-sm-8 col-md-8 col-xs-12 col-sm-offset-2 page-title">{!! trans('reg-profile.my_profile') !!}</h1>
      <div class="col-sm-8 col-md-8 col-xs-12 col-sm-offset-2">
        <!-- Content -->
        <ul id="profile-tabs" class="nav nav-tabs" data-hashtab="true">
          <li class="active"><a data-target="#_profile" data-toggle="tab">{!! trans('reg-profile.profile') !!}</a></li>
          @if ($validator->institution)
          <li><a data-target="#_leave-institution" data-toggle="tab">{!! trans('reg-profile.leave_institution') !!}</a></li>
          @endif
          <li><a data-target="#_change-password" data-toggle="tab">{!! trans('reg-profile.change_your_password') !!}</a></li>
        </ul>

        <div id="profileTab" class="tab-content well">
          <div class="tab-pane active in" id="_profile">
            <form enctype='multipart/form-data'  class="form-vertical" role="form" method="POST" action="{{ route('update_profile'). '#profile' }}" >
              {{ csrf_field() }}

              <h4>{!! trans('reg-profile.about') !!}</h4>
              <text-box-form code="name" label="{!! trans('reg-profile.name') !!}" placeholder="{!! trans('reg-profile.name') !!}" value="{{ old('name', $user->name) }}"
                  required errors='{!! json_encode($errors->toArray(), JSON_HEX_APOS) !!}'></text-box-form>

              <text-box-form code="surname" label="{!! trans('reg-profile.surname') !!}" placeholder="{!! trans('reg-profile.surname') !!}" value="{{ old('surname', $user->surname) }}"
                  required errors='{!! json_encode($errors->toArray(), JSON_HEX_APOS) !!}'></text-box-form>

              <text-box-form code="email" label="{!! trans('reg-profile.email') !!}" placeholder="{!! trans('reg-profile.email') !!}" readonly
                    value="{{ old('email', $user->email) }}"
                    errors='{!! json_encode($errors->toArray(), JSON_HEX_APOS) !!}'></text-box-form>

              <hr>

              @if ($validator->institution)
              <h4>{!! trans('global.status') !!}</h4>
              <div class="radio">
                <label><input type="radio" @if ($validator->enabled == true) checked @endif name="enabled" value="1">{!! trans('reg-profile.notifications_enabled') !!}</label>
              </div>
              <div class="radio">
                <label><input @if ($validator->enabled != true) checked @endif type="radio" name="enabled" value="0">{!! trans('reg-profile.notifications_disabled') !!}</label>
              </div>
              <hr>
              @endif

              <h4>{!! trans('reg-profile.my_institution') !!}</h4>
              @if ($validator->institution && $validator->institution->name)
              <text-box-form code="institution_name" label="{!! trans('reg-profile.institution') !!}" placeholder="{!! trans('reg-profile.institution') !!}" readonly
                    value="{{ old('institution', $validator->institution->user->name) }}"
                    errors='{!! json_encode($errors->toArray(), JSON_HEX_APOS) !!}'></text-box-form>
              @endif
              <text-box-form code="department" label="{!! trans('reg-profile.validator_department') !!}" placeholder="{!! trans('reg-profile.validator_department') !!}" value="{{ old('department', $validator->department) }}"
                  required errors='{!! json_encode($errors->toArray(), JSON_HEX_APOS) !!}'></text-box-form>

              <text-box-form code="position" label="{!! trans('reg-profile.position') !!}" placeholder="{!! trans('reg-profile.position') !!}" value="{{ old('position', $validator->position) }}"
                  required errors='{!! json_encode($errors->toArray(), JSON_HEX_APOS) !!}'></text-box-form>

              <hr>
              <div>
                <button type="submit" class="btn btn-primary">{!! trans('reg-profile.update_settings') !!}</button>
                <remove-account></remove-account>
              </div>
            </form>
          </div>

          @if ($validator->institution)
          <div class="tab-pane fade" id="_leave-institution">
            <p><span class="h4">{!! trans('reg-profile.leave_institution') !!}</span></p>
            <form class="form-vertical" role="form" method="POST" action="{{ route('update_profile'). '#leave-institution' }}">
              {{ csrf_field() }}
              <p>{!! trans('reg-profile.do_you_want_to_leave_institution') !!}</p>
              <input type="hidden" name="leave" value="1">
              <button type="submit" class="btn btn-primary">{!! trans('reg-profile.leave_institution_button') !!}</button>
            </form>
          </div>
          @endif

          <div class="tab-pane fade" id="_change-password">
            <p><span class="h4">{!! trans('reg-profile.change_your_password') !!}</span></p>
            <form class="form-vertical" role="form" method="POST" action="{{ route('update_profile'). '#change-password' }}">
              {{ csrf_field() }}
              <text-box-form type="password" code="password" label="{!! trans('reg-profile.new_password') !!}"
                  required placeholder="{!! trans('reg-profile.new_password') !!}" value="" no-validate
                  errors='{!! json_encode($errors->toArray(), JSON_HEX_APOS) !!}'></text-box-form>
              <text-box-form type="password" code="password_confirm" label="{!! trans('reg-profile.repeat_new_password') !!}"
                  required placeholder="{!! trans('reg-profile.repeat_new_password') !!}" value="" no-validate
                  errors='{!! json_encode($errors->toArray(), JSON_HEX_APOS) !!}'></text-box-form>
              <hr>
              <button type="submit" class="btn btn-primary">{!! trans('reg-profile.save_new_password') !!}</button>
            </form>
          </div>
          <!-- End of content -->
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
