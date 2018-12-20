@extends ('backend.layouts.app')

@section ('title', __('labels.backend.jobs.management') . ' | ' . __('labels.backend.jobs.view'))

@section('breadcrumb-links')
@include('backend.jobs.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.jobs.management') }}
                        <small class="text-muted">{{ __('labels.backend.jobs.view') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4 mb-4">
                <div class="col">
                    @include('backend.jobs.view')
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <small class="float-right text-muted">
                {{--       <strong>{{ __('labels.backend.jobs.content.created_at') }}:</strong> {{ $job->updated_at->timezone(get_user_timezone()) }} ({{ $job->created_at->diffForHumans() }}),--}}
                {{--       <strong>{{__('labels.backend.jobs.content.last_updated') }}:</strong> {{ $job->created_at->timezone(get_user_timezone()) }} ({{$job->updated_at->diffForHumans() }})--}}
                        @if ($job->trashed())
                            <strong>{{ __('labels.backend.jobs.content.deleted_at') }}:</strong> $job->deleted_at->timezone(get_user_timezone())  ($job->deleted_at->diffForHumans() )
                        @endif
                    </small>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
@endsection