<!-- Modal -->
<div class="modal modal-right fade " id="filter">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="side-modal-wrapper">
                <form action="{{route('agency.customers.index')}}" method="post">
                    @csrf @method("GET")
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Filter Category</h5>
                    
                </div>

                <div class="modal-body">
                    
                        <div class="form-group">
                          <label for="">Search With Name</label>
                          <input type="text"
                            class="form-control" name="name" id="name" value="{{request()->get('name','')}}" aria-describedby="helpId" placeholder="">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Search with Phone</label>
                            <input type="text"
                              class="form-control" name="phone" id="phone" value="{{request()->get('phone','')}}" aria-describedby="helpId" placeholder="">
                        </div>
                        
                        
                    
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default mr-3" href="{{route('agency.customers.index')}}">Reset</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
            </div>
        </div>
    </div>
</div>