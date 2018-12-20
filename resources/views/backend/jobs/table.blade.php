<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
                <th>{{ __('labels.backend.jobs.table.name') }}</th>
                
            <th>{{ __('labels.general.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($jobs as $job)
        <tr>
             
                <td>{{  $job->name }}</td>  
                

               <td>{!! $job->action_buttons !!}</td>
        </tr>

        @endforeach
        </tbody>
    </table>
</div>