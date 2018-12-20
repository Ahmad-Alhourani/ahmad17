<div class="row mt-4 mb-4">
    <div class="col">
         
        <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.persons.name'))->class('col-md-2 form-control-label')->for('name') }}
            <div class="col-md-10">
                
                        {{ html()->text('name')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.backend.persons.name'))
                        
                        
                      
                         }}
                

            </div><!--col-->
        </div><!--form-group-->
        
        <div class="form-group row">
            {{ html()->label(__('validation.attributes.backend.persons.description'))->class('col-md-2 form-control-label')->for('description') }}
            <div class="col-md-10">
                
                        {{ html()->text('description')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.backend.persons.description'))
                        
                        
                      
                         }}
                

            </div><!--col-->
        </div><!--form-group-->
        

        <!--end-columns-->
             
                    <div class="form-group row">
                        {{html()->label(__('Jobs'))->class('col-md-2 form-control-label')->for('jobs') }}
                        <div class="col-md-10">
                            <select class="form-control m-bot15" name="jobs[]" multiple="multiple">
                                <option    value=""   >None</option>
                                @if  ($jobs->count())
                                @foreach($jobs as $temp)
                                        <option value="{{ $temp->id }}" {{in_array($temp->id,$selectedJob) ? 'selected="selected"' : '' }}>{{ $temp->name }}</option>

                                @endforeach
                                @endif
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->
                



    </div><!--col-->
</div><!--row-->