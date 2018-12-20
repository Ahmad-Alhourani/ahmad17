@extends ('backend.layouts.app')

@section ('title', __('labels.backend.persons.management') . ' | ' . __('labels.backend.persons.view'))

@section('breadcrumb-links')
@include('backend.persons.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.persons.management') }}
                        <small class="text-muted">{{ __('labels.backend.persons.view') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    @include('backend.persons.view')
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                {{--       <strong>{{ __('labels.backend.persons.content.created_at') }}:</strong> {{ $person->updated_at->timezone(get_user_timezone()) }} ({{ $person->created_at->diffForHumans() }}),--}}
                {{--       <strong>{{__('labels.backend.persons.content.last_updated') }}:</strong> {{ $person->created_at->timezone(get_user_timezone()) }} ({{$person->updated_at->diffForHumans() }})--}}
                        @if ($person->trashed())
                            <strong>{{ __('labels.backend.persons.content.deleted_at') }}:</strong> $person->deleted_at->timezone(get_user_timezone())  ($person->deleted_at->diffForHumans() )
                        @endif
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection