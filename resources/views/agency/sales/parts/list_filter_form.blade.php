<!-- Modal -->
<div class="modal modal-right fade " id="filter">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="side-modal-wrapper">
                <form action="{{route('agency.sales.list')}}" method="get">
                    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Filter Sale</h5>
                    
                </div>

                <div class="modal-body">
                    
                        <div class="form-group">
                          <label for="">Search With Number</label>
                          <input type="text"
                            class="form-control" name="name" id="name" value="{{request()->get('name','')}}" aria-describedby="helpId" placeholder="">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Search with Status</label>
                            <select class="form-control" name="status" id="status" style="text-transform:capitalize;">
                                @if (request()->get('status'))
                                    <option value="{{request()->get('status','')}}">{{request()->get('status','')}}</option>
                                @else
                                <option value="">Select Status</option>
                                @endif

                                <option value="Delivery Ongoing">Delivery Ongoing</option>
                                <option value="Completed">Completed</option>
                                <option value="Payment Pending">Payment Pending</option>
                                <option value="On Hold">On Hold</option>
                                <option value="Cancelled">Cancelled</option>
                              </select>
                        </div>
                        
                        
                    
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default mr-3" href="{{route('agency.sales.list')}}">Reset</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
            </div>
        </div>
    </div>
</div>