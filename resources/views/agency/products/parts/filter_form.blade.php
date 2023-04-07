<!-- Modal -->
<div class="modal modal-right fade " id="filter">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="side-modal-wrapper">
                <form action="{{route('agency.products.index')}}" method="get">
                    
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Filter Product</h5>
                    
                </div>

                <div class="modal-body">
                    
                        <div class="form-group">
                          <label for="">Search With Name</label>
                          <input type="text"
                            class="form-control" name="name" id="name" value="{{request()->get('name','')}}" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Search With Brand</label>
                            <select name="brand_id" id="" class="form-control">
                                <option value="">Select Brand</option>
                                @foreach ($brands as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Search With Category</label>
                            <select name="category_id" id="" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Search With Supplier</label>
                            <select name="supplier_id" id="" class="form-control">
                                <option value="">Select Supplier</option>
                                @foreach ($suppliers as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Search With Status</label>
                            <select name="status" id="" class="form-control">
                                @if (request()->get('status') == '0')
                                <option value="0">Inactive</option>
                                @else
                                <option value="1">Active</option>
                                @endif
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                                
                            </select>
                        </div>

                        
                    
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default mr-3" href="{{route('agency.products.index')}}">Reset</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
            </div>
        </div>
    </div>
</div>