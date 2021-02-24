@extends('layouts.app')
@section('content')
    <div class="container mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            <div class="md:w-full pr-4 pl-4">
                <div class="panel panel-default">
                    @if ($can_edit)
                    {{ Form::model($member, array('route' => array('member.update', $member_id), 'id' => 'member_update')) }}
                    {{ Form::hidden('user_id', $user_id)}}
                    {{ Form::hidden('MemberID', $member_id)}}
                    {{ Form::hidden('Primary_Phone', $member->Primary_Phone )}}
                    @endif
                    <div class="panel-heading">
                        <h4>{{ $member->First_Name }} {{ $member->Last_Name }}</h4>
                        Member ID: {{ $member->MemberID }}
                    </div>
                        <div class="panel-body">
                        <main class="main-column col-md-{{ $main_col }}">
                            @if ($can_edit)
                            <div class="mb-4">
                                <label for="active" class="control-label">{{ Form::checkbox('Active', $member->Active, $is_active) }} Active</label>
                                <span class="saved hidden">SAVED</span>
                            </div>
                            <div class="mb-4">
                                <label for="name" class="md:w-1/6 pr-4 pl-4 control-label">Name</label>
                                <div class="md:w-5/6 pr-4 pl-4">
                                    {{ Form::select('Title', $prefix, null, ['class' => 'col-md-1'])}}
                                    {{ Form::text('First_Name', $member->First_Name, ['class' => 'col-md-3 required', 'placeholder' => 'First Name *']) }}
                                    {{ Form::text('Middle_Name', $member->Middle_Name, ['class' => 'col-md-2', 'placeholder' => 'Middle Name']) }}
                                    {{ Form::text('Last_Name', $member->Last_Name, ['class' => 'col-md-3 required', 'placeholder' => 'Last Name *']) }}
                                    {{ Form::select('Suffix', $suffix, null, ['class' => 'col-md-2']) }}
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="address" class="md:w-1/6 pr-4 pl-4 control-label">Address</label>
                                <div class="md:w-5/6 pr-4 pl-4">
                                    {{ Form::text('Address1', $member->Address1, ['class' => 'col-md-10 required', 'placeholder' => 'Address 1 *']) }}
                                </div>
                                <div class="md:w-5/6 pr-4 pl-4 col-md-offset-1">
                                    {{ Form::text('Address2', $member->Address2, ['class' => 'col-md-10', 'placeholder' => 'Address 2']) }}
                                </div>
                                <div class="md:w-5/6 pr-4 pl-4 col-md-offset-1">
                                    {{ Form::text('City', $member->City, ['class' => 'col-md-4 required', 'placeholder' => 'City *']) }}
                                    {{ Form::select('State', $state, null, ['class' => 'col-md-3 required']) }}
                                    {{ Form::text('Zip', $member->Zip, ['class' => 'col-md-2 required', 'placeholder' => 'Zip *']) }}
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="md:w-1/6 pr-4 pl-4 control-label">Email</label>
                                <div class="md:w-5/6 pr-4 pl-4">
                                    {{ Form::text('Email_Address', $member->Email_Address, ['class' => 'col-md-10', 'placeholder' => 'Email']) }}
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="magickal_name" class="control-label md:w-1/6 pr-4 pl-4">Magickal</label>
                                <div class="md:w-5/6 pr-4 pl-4">
                                    {{ Form::text('Magickal_Name', $member->Magickal_Name, ['class' => 'col-md-4', 'placeholder' => 'Magickal name']) }}
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="birth_time" class="control-label md:w-1/6 pr-4 pl-4">Birth Info</label>
                                <div class="md:w-5/6 pr-4 pl-4">
                                    {{ Form::text('Birth_Date', Utility::formatMjY($member->Birth_Date), ['class' => 'col-md-2 date-pick', 'placeholder' => 'Date']) }}
                                    {{ Form::text('Birth_Time', $member->Birth_Time, ['class' => 'col-md-2', 'placeholder' => 'Time']) }}
                                    {{ Form::text('Birth_Place', $member->Birth_Place, ['class' => 'col-md-3', 'placeholder' => 'Place']) }}
                                </div>
                            </div>
                            <div class="mb-4 primary-phone">
                                <label for="birth_time" class="control-label md:w-1/6 pr-4 pl-4">Primary Phone</label>
                                <div class="md:w-1/3 pr-4 pl-4 outlined">
                                    <label class="" for="home_phone">
                                        {{ Form::radio('phone_button', 1, $member->Primary_Phone == 1, ['id' => 'home_phone']) }}
                                        <div class="phone-label"> Home:</div>
                                        {{ Form::text('Home_Phone', Utility::formatPhone($member->Home_Phone), ['placeholder' => 'Home Phone']) }}
                                    </label>
                                    <label class="" for="cell_phone">
                                        {{ Form::radio('phone_button', 3, ($member->Primary_Phone == 0 || $member->Primary_Phone == 3), ['id' => 'cell_phone']) }}
                                        <div class="phone-label"> Cell:</div>
                                        {{ Form::text('Cell_Phone', Utility::formatPhone($member->Cell_Phone), ['placeholder' => 'Cell Phone']) }}
                                    </label>
                                    <label class="" for="work_phone">
                                        {{ Form::radio('phone_button', 2, $member->Primary_Phone == 2, ['id' => 'work_phone']) }}
                                        <div class="phone-label"> Work:</div>
                                        {{ Form::text('Work_Phone', Utility::formatPhone($member->Work_Phone), ['placeholder' => 'Work Phone']) }}
                                    </label>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="comments" class="control-label md:w-1/6 pr-4 pl-4">Comments</label>
                                <div class="md:w-5/6 pr-4 pl-4">
                                    {{ Form::textarea('Comments', $member->Comments, ['class' => 'col-md-8']) }}
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="md:w-5/6 pr-4 pl-4 col-md-offset-1">
                                    {{ Form::submit(($member->MemberID == 0) ? 'Submit' : 'Update', ['id' => 'submit_update', 'class' => 'btn btn-primary', 'disabled' => 'disabled']) }}
                                    <i id="member_saving" class="member-saving fa fa-spinner fa-spin hidden"></i>
                                    <span class="saved hidden">SAVED</span>
                                </div>
                            </div>
                            @else
                                @include('partials.member_static_main')
                            @endif
                        </main>
                        <aside class="sidebar-column col-md-{{ $sidebar_col }}">
                            @if ($can_edit || $is_my_profile)
                            <div class="mb-4">
                                <label for="coven" class="control-label md:w-full pr-4 pl-4">Coven or Order</label>
                                @if ($is_admin)
                                {{ Form::select('Coven', $coven, $selected_coven, ['class' => 'col-md-11']) }}
                                @else
                                    {{ $coven_name }}
                                    {{ Form::hidden('Coven', $selected_coven) }}
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="member_since" class="control-label md:w-full pr-4 pl-4">Member Since</label>
                                {{ Form::text('Member_Since_Date', Utility::formatMjY($member->Member_Since_Date), ['class' => 'col-md-6 date-pick']) }}
                            </div>
                            <div class="mb-4">
                                <label for="leadership" class="control-label md:w-full pr-4 pl-4">Leadership Role</label>
                                {{ Form::select('LeadershipRole', $leadership, null, ['class' => 'col-md-11', 'id' => 'leadership-role']) }}
                            </div>
                            <div class="mb-4 leadership-date {{ (!empty($member->LeadershipRole)) ? 'opacity-100 block' : 'hide' }}">
                                <label for="leadership-date" class="control-label md:w-full pr-4 pl-4">Leadership Date</label>
                                {{ Form::text('Leadership_Date', Utility::formatMjY($member->Leadership_Date), ['class' => 'col-md-6 date-pick']) }}
                            </div>
                            <div class="mb-4">
                                <label for="bonded" class="control-label md:w-full pr-4 pl-4">{{ Form::checkbox('Bonded', $member->Bonded, null, ['id' => 'bonded_check']) }} Bonded</label>
                            </div>
                            <div class="mb-4 bonded-date {{ ($member->Bonded) ? 'opacity-100 block' : 'hide' }}">
                                <label for="bonded-date" class="control-label md:w-full pr-4 pl-4">Bonded Date</label>
                                {{ Form::text('Bonded_Date', Utility::formatMjY($member->Bonded_Date), ['class' => 'col-md-6 date-pick']) }}
                            </div>
                            <div class="mb-4">
                                <label for="Scribe" class="control-label md:w-full pr-4 pl-4">{{ Form::checkbox('Scribe', null, $is_scribe, ['id' => 'scribe_check']) }} Scribe</label>
                            </div>
                            <div class="mb-4">
                                <label for="PurseWarden" class="control-label md:w-full pr-4 pl-4">{{ Form::checkbox('PurseWarden', null, $is_pw, ['id' => 'pw_check']) }} Purse Warden</label>
                            </div>
                            <div class="mb-4">
                                <label for="degree" class="control-label md:w-full pr-4 pl-4">Degree</label>
                                {{ Form::select('Degree', $degree, null, ['id' => 'member_degree', 'class' => 'col-md-6']) }}
                            </div>
                            <div class="mb-4 degree-date {{ ($member->Degree >= 1) ? 'opacity-100 block' : 'hide' }}" data-degree-date="1">
                                <label for="first_degree" class="control-label md:w-full pr-4 pl-4">1st Degree Date</label>
                                {{ Form::text('First_Degree_Date', Utility::formatMjY($member->First_Degree_Date), ['class' => 'col-md-6 date-pick']) }}
                            </div>
                            <div class="mb-4 degree-date {{ ($member->Degree >= 2) ? 'opacity-100 block' : 'hide' }}" data-degree-date="2">
                                <label for="second_degree" class="control-label md:w-full pr-4 pl-4">2nd Degree Date</label>
                                {{ Form::text('Second_Degree_Date', Utility::formatMjY($member->Second_Degree_Date), ['class' => 'col-md-6 date-pick']) }}
                            </div>
                            <div class="mb-4 degree-date {{ ($member->Degree >= 3) ? 'opacity-100 block' : 'hide' }}" data-degree-date="3">
                                <label for="third_degree" class="control-label md:w-full pr-4 pl-4">3rd Degree Date</label>
                                {{ Form::text('Third_Degree_Date', Utility::formatMjY($member->Third_Degree_Date), ['class' => 'col-md-6 date-pick']) }}
                            </div>
                            <div class="mb-4 degree-date {{ ($member->Degree >= 4) ? 'opacity-100 block' : 'hide' }}" data-degree-date="4">
                                <label for="fourth_degree" class="control-label md:w-full pr-4 pl-4">4th Degree Date</label>
                                {{ Form::text('Fourth_Degree_Date', Utility::formatMjY($member->Fourth_Degree_Date), ['class' => 'col-md-6 date-pick']) }}
                            </div>
                            <div class="mb-4 degree-date {{ ($member->Degree >= 5) ? 'opacity-100 block' : 'hide' }}" data-degree-date="5">
                                <label for="fifth_degree" class="control-label md:w-full pr-4 pl-4">5th Degree Date</label>
                                {{ Form::text('Fifth_Degree_Date', Utility::formatMjY($member->Fifth_Degree_Date), ['class' => 'col-md-6 date-pick']) }}
                            </div>
                            <div class="mb-4">
                                <label for="solitary" class="control-label md:w-full pr-4 pl-4">{{ Form::checkbox('Solitary', $member->Solitary, null, ['id' => 'solitary_check']) }} Solitary</label>
                            </div>
                            <div class="mb-4 solitary-date {{ ($member->Solitary) ? 'opacity-100 block' : 'hide' }}">
                                <label for="solitary-date" class="control-label md:w-full pr-4 pl-4">Solitary Date</label>
                                {{ Form::text('Solitary_Date', Utility::formatMjY($member->Solitary_Date), ['class' => 'col-md-6 date-pick']) }}
                            </div>
                            <div class="mb-4">
                                <label for="board" class="control-label md:w-full pr-4 pl-4">Board Role</label>
                                {{ Form::select('BoardRole', $board, null, ['class' => 'col-md-11', 'id' => 'board-role']) }}
                            </div>
                            <div class="mb-4 expiry-date {{ Membership::isCurrentBoardMember() ? 'opacity-100 block' : 'hide' }}">
                                <label for="board-date" class="control-label md:w-full pr-4 pl-4">Expiry Date</label>
                                {{ Form::text('BoardRole_Expiry_Date', Utility::formatMjY($member->BoardRole_Expiry_Date), ['class' => 'col-md-6 date-pick required', 'placeholder' => 'Expiry Date *']) }}
                            </div>
                            @else
                                @include('partials.member_static_sidebar')
                            @endif
                        </aside>
                        {{ Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="error_dialog" class="modal opacity-0">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Validation Error</h4>
                </div>
                <div class="modal-body">
                    <p>One or more fields report errors:</p>
                    <ul id="error_messages"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-default" data-dismiss="modal">OK</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
<!-- Push any scripts needed for this page onto the stack -->
@push('scripts')
    <script src="{{ URL::to('/js/lib') }}/jquery.dirtyforms.js"></script>
    <script>appSpace.authTimeout = '{!! trans('auth.timeout') !!}';</script>
@endpush