@extends('../layouts.app')

@section('page-title') My Profile @endsection
@section('page-class') my-profile @endsection

@section('meta')
  <meta id="token" content="{{ $token }}" />
@endsection

@section ('profile_warning')
@endsection

@section('content')
<div class="container v-container edit-profile">
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <h1 class="page-title">My profile</h1>
      <div class="col-sm-4 col-md-4 col-xs-12">
        <img src="{{ asset($user->getPhoto()) }}" alt="" class="img-responsive" />
      </div>
      <div class="col-sm-8 col-md-8 col-xs-12">
        <!-- Content -->
        <ul id="profile-tabs" class="nav nav-tabs" data-hashtab="true">
          <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
          <li><a href="#career" data-toggle="tab">Career and Skills</a></li>
          <li><a href="#refer" data-toggle="tab">Get your profile refereed</a></li>
          <li><a href="#password" data-toggle="tab">Change your password</a></li>
        </ul>
        <div id="profileTab" class="tab-content well">
          <div class="tab-pane active in" id="profile">
            <form enctype="multipart/form-data" class="form-vertical" role="form" method="POST" action="{{ route('update_profile'). '#profile' }}">
              {{ csrf_field() }}

              <h4>Profile Visibility</h4>
              <div class="radio">
                <label><input type="radio" @if ($user->visible == true) checked @endif name="visible" value="1">Visible. Can be searched, viewed</label>
              </div>
              <div class="radio">
                <label><input @if ($user->visible != true) checked @endif type="radio" name="visible" value="0">Hidden. Cannot be searched or viewed</label>
              </div>
              <hr>
              <h4>Notifications</h4>
              <div class="radio">
                <label><input type="radio" @if ($user->notify_me == true) checked @endif name="notify_me" value="1">Enabled. You'll receive emails once a day if a student wants to get in contact with you</label>
              </div>
              <div class="radio">
                <label><input @if ($user->notify_me != true) checked @endif type="radio" name="notify_me" value="0">Disabled. You won't receive any emails, except for announcements about the service</label>
              </div>

              <hr class="separator">
              <h4>About me</h4>
              <text-box-form code="name" label="Name" placeholder="Name" value="{{ old('name', $user->name) }}" has-error="{{ $errors->has('name') }}" error="{{ $errors->first('name') }}"></text-box-form>
              <text-box-form code="surname" label="Surname" placeholder="Surname" value="{{ old('surname', $user->surname) }}" has-error="{{ $errors->has('surname') }}" error="{{ $errors->first('surname') }}"></text-box-form>

              <div class="row">
                <text-box-form class="col-sm-6" type="email" readonly="true" code="email" label="Email" placeholder="Email" value="{{ old('email', $user->email) }}" has-error="{{ $errors->has('email') }}" error="{{ $errors->first('email') }}"></text-box-form>
                <text-box-form class="col-sm-6" code="phone" label="Phone" placeholder="Phone" value="{{ old('phone', $user->phone) }}" has-error="{{ $errors->has('phone') }}" error="{{ $errors->first('phone') }}"></text-box-form>
              </div>

              {{-- COUNTRIES OR NATIONALITIES? --}}
              <select-form code="nationality" label="Nationality" placeholder=" - Nationality - " values='{!! json_encode($nationalities, JSON_HEX_APOS) !!}' value="{{ old('nationality', $student->nationality) }}" has-error="{{ $errors->has('nationality') }}" error="{{ $errors->first('nationality') }}"></select-form>

              <date-form code="birthdate" label="Birthdate" placeholder="Birthdate" value="{{ old('birthdate', $student->birthdate) }}" has-error="{{ $errors->has('birthdate') }}" error="{{ $errors->first('birthdate') }}"></date-form>

              <file-form code="image" label="My Photo"></file-form>

              <hr class="separator">

              <h4>Social networks</h4>
              <text-box-form code="facebook" label="Facebook page url" placeholder="Facebook page url" value="{{ old('facebook', $user->facebook) }}" has-error="{{ $errors->has('facebook') }}" error="{{ $errors->first('facebook') }}"></text-box-form>
              <text-box-form code="twitter" label="Twitter page url" placeholder="Twitter page url" value="{{ old('twitter', $user->twitter) }}" has-error="{{ $errors->has('twitter') }}" error="{{ $errors->first('twitter') }}"></text-box-form>
              <text-box-form code="linkedin" label="Linkedin page url" placeholder="Linkedin page url" value="{{ old('linkedin', $user->linkedin) }}" has-error="{{ $errors->has('linkedin') }}" error="{{ $errors->first('linkedin') }}"></text-box-form>

              <h4>Address</h4>
              <text-box-form code="address" label="Address" placeholder="Address" value="{{ old('address', $user->address) }}" has-error="{{ $errors->has('address') }}" error="{{ $errors->first('address') }}"></text-box-form>

              <div class="row">
                <text-box-form class="col-sm-4" code="postal_code" label="Postal Code" placeholder="Postal Code" value="{{ old('postal_code', $user->postal_code) }}" has-error="{{ $errors->has('postal_code') }}" error="{{ $errors->first('postal_code') }}"></text-box-form>
                <text-box-form class="col-sm-8" code="city" label="City" placeholder="City" value="{{ old('city', $user->city) }}" has-error="{{ $errors->has('city') }}" error="{{ $errors->first('city') }}"></text-box-form>
              </div>

              <select-form code="country" label="Country" placeholder=" - Country - " values='{!! json_encode($countries, JSON_HEX_APOS) !!}' value="{{ old('country', $user->country) }}" has-error="{{ $errors->has('country') }}" error="{{ $errors->first('country') }}"></select-form>

              <hr class="separator">

              <button type="submit" class="btn btn-primary">Update settings</button>
            </form>
          </div>

          <div class="tab-pane fade" id="career">
            <form class="form-vertical" enctype="multipart/form-data" role="form" method="POST" action="{{ route('update_profile'). '#contact' }}">
              {{ csrf_field() }}
              <h4>Academic information</h4>
              <hr>

              <file-form code="curriculum" label="Europass curriculum" download-text="Download curriculum" file-url="{{ URL::to('/profile/curriculum/' . $user->id) }}"></file-form>

              <hr class="separator">

              <studies studies='{!! json_encode($student->studies, JSON_HEX_APOS) !!}'
                      study-levels='{!! json_encode($studyLevels, JSON_HEX_APOS) !!}'
                      study-fields='{!! json_encode($studyFields, JSON_HEX_APOS) !!}'
                      errors='{!! json_encode($errors, JSON_HEX_APOS) !!}'></studies>

              <trainings trainings='{!! json_encode($student->training, JSON_HEX_APOS) !!}'
                      errors='{!! json_encode($errors, JSON_HEX_APOS) !!}'></trainings>


              <languages languages='{!! json_encode($student->languages, JSON_HEX_APOS) !!}'
                      language-names='{!! json_encode($languages, JSON_HEX_APOS) !!}'
                      language-levels='{!! json_encode($languageLevels, JSON_HEX_APOS) !!}'
                      errors='{!! json_encode($errors, JSON_HEX_APOS) !!}'></languages>


              <hr class="separator">

              {{-- <experiences experiences='{!! json_encode($student->experiences, JSON_HEX_APOS) !!}' errors='{!! json_encode($errors, JSON_HEX_APOS) !!}'></experiencies> --}}

              <div class="form-group{{ $errors->has('profesional_skills') ? ' has-error' : '' }}">
                <label for="profesional_skills">Professional skills</label>
                <ul class="selected-skills list-unstyled">
                  @foreach ($student->professionalSkills as $skill)
                    <li class="btn btn-default"><input type="hidden" name="profesional_skills" value="{{ $skill->id }}" > {{ $skill->name }}
                      <a title="remove" href="javascript:void(0)"><i class="fa fa-close" aria-hidden="true"></i></a>
                    </li>
                  @endforeach
                </ul>
                <input type="text" class="form-control" id="profesional_skills" placeholder="Add a professional skill" value="">
                @if ($errors->has('profesional_skills'))
                  <span class="help-block">
                  <strong>{{ $errors->first('profesional_skills') }}</strong>
                  </span>
                @endif
              </div>

              <personal-skills-form max-personal-skills="6" values='{!! json_encode($personalSkills, JSON_HEX_APOS) !!}' value='{!! json_encode($student->personalSkills, JSON_HEX_APOS) !!}' has-error="{{ $errors->has('personal_skills') }}" error="{{ $errors->first('personal_skills') }}"></personal-skills-form>

              <text-area-form code="talent" label="My talent (max 300 characters)" placeholder="Describe briefly your talent."
                    value="{{ old('talent', $student->talent) }}" has-error="{{ $errors->has('talent') }}" error="{{ $errors->first('talent') }}"></text-area-form>

              <hr>
              <button type="submit" class="btn btn-primary">Update settings</button>
            </form>
          </div>

          <div class="tab-pane fade" id="refer">
            <h4>Get your profile refereed</h4>
            <div class="alert alert-danger">
              Profile refereeing will be available soon
            </div>

            <form class="form-vertical" role="form" style="display:none" method="POST" action="{{ route('update_profile'). '#refer' }}">
              {{ csrf_field() }}

              <text-box-form code="validator_name" label="New validator name" placeholder="Referee name" value="" has-error="{{ $errors->has('validator_name') }}" error="{{ $errors->first('validator_name') }}"></text-box-form>
              <text-box-form type="email" code="validator_email" label="New validator email" placeholder="Referee email" value="" has-error="{{ $errors->has('validator_email') }}" error="{{ $errors->first('validator_email') }}"></text-box-form>

              <hr>
              <button type="submit" class="btn btn-primary">Get your profile refereed</button>
            </form>
          </div>

          <div class="tab-pane fade" id="password">
            <h4>Change your password</h4>
            <form class="form-vertical" role="form" method="POST" action="{{ route('update_profile'). '#password' }}">
              {{ csrf_field() }}
              <text-box-form type="password" code="password" label="New Password" placeholder="New Password" value="" has-error="{{ $errors->has('password') }}" error="{{ $errors->first('password') }}"></text-box-form>
              <text-box-form type="password" code="password_confirm" label="Repeat new Password" placeholder="Repeat new Password" value="" has-error="{{ $errors->has('password_confirm') }}" error="{{ $errors->first('password_confirm') }}"></text-box-form>

              <hr>
              <button type="submit" class="btn btn-primary">Save new password</button>
            </form>
          </div>
          <!-- End of content -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
