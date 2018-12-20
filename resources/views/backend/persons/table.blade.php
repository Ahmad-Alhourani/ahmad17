<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
                <th>{{ __('labels.backend.persons.table.name') }}</th>
                   
                <th>{{ __('Jobs') }}</th>
            <th>{{ __('labels.general.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($persons as $person)
        <tr>
             
                <td>{{  $person->name }}</td>   
                
                <td>@foreach ($jobs[$person->id] as $item){{$item['name']}}@endforeach</td>

               <td>{!! $person->action_buttons !!}</td>
        </tr>

        @endforeach
        </tbody>
    </table>
</div>