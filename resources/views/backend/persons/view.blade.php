<div class="row mt-4 mb-4">
    <div class="col">

       
            <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.persons.id'))->class('col-md-2 form-control-label')->for('id') }}
            <div class="col-md-10">
       

                {{ $person->id }}

            </div><!--col-->
         </div><!--form-group-->
         
            <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.persons.name'))->class('col-md-2 form-control-label')->for('name') }}
            <div class="col-md-10">
       

                {{ $person->name }}

            </div><!--col-->
         </div><!--form-group-->
         
            <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.persons.description'))->class('col-md-2 form-control-label')->for('description') }}
            <div class="col-md-10">
       

                {{ $person->description }}

            </div><!--col-->
         </div><!--form-group-->
         

        <!--end-columns-->
      
        <div class="form-group row">
           {{html()->label(__('Jobs'))->class('col-md-2 form-control-label')->for('jobs') }}
            <div class="col-md-10">
                @if  ( isset($jobs)&&$jobs->count())
                    @foreach($jobs as $temp)
                        {{$temp->name }},
                    @endforeach
                @endif
            </div><!--col-->
        </div><!--form-group-->
        


    </div><!--col-->
</div><!--row-->