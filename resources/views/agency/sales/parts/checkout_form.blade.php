<!-- Modal -->
<div class="modal fade" id="checkout_form">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkout_form">Order Detail</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <form action="{{route('agency.sales.store')}}" method="post">
            @csrf @method('POST')
            <div class="modal-body">
                <table class="table">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <input type="number" name="discount" id="discount" class="form-control" placeholder="Discount Price" value="">
                            </div>
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="btn btn-success btn-tone m-r-5" onclick="discount_price()"><i class="anticon anticon-plus"></i> Add</a>
                        </div>
                    </div>
                    <tbody>
                        <tr>
                            <td scope="row" style="padding: 7px;"><h5>Subtotal : </h5></td>
                            <td style="padding: 7px;"><h5><span class="total-cart"></span> {{auth()->user()->agency->currency}}</h5></td>
                        </tr>
                        <tr>
                            <td scope="row" style="padding: 7px;"><h5>Total : </h5></td>
                            <td style="padding: 7px;"><h5><span id="total_checkout_price" class="total-cart"></span> {{auth()->user()->agency->currency}}</h5></td>
                        </tr>
                    </tbody>
                </table>
                
                
                
                <div class="accordion" id="accordion-default">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <a data-toggle="collapse" href="#payment_tag">
                                    <span>Payment Detail</span>
                                </a>
                            </h5>
                        </div>
                        <div id="payment_tag" class="collapse show" data-parent="#accordion-default">
                            <div class="card-body">
                               <textarea name="data_cart" class="data-cart" cols="30" rows="10" style="display: none;"></textarea>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment_type">Payment Type</label>
                                            <select class="form-control" name="payment_type" id="payment_type">
                                              <option value="Cash on Delivery">Cash on Delivery</option>
                                              <option value="KBZ Pay">KBZ Pay</option>
                                              <option value="Wave Pay">Wave Pay</option>
                                              <option value="Other Online Payment">Other Online Payment</option>
                                            </select>
                                          </div>
                                    </div>
                                    <div class="col-md-">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                              <option value="Delivery Ongoing">Delivery Ongoing</option>
                                              <option value="Completed">Completed</option>
                                              <option value="Payment Pending">Payment Pending</option>
                                              <option value="On Hold">On Hold</option>
                                              <option value="Cancelled">Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <a class="collapsed" data-toggle="collapse" href="#collapseTwoDefault">
                                    <span>Customer Detail</span>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTwoDefault" class="collapse" data-parent="#accordion-default">
                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-control" name="customer_id" id="customer_id">
                                      <option value="" checked>Select Customer</option>
                                      @foreach ($customers as $data)
                                      <option value="{{$data->id}}">{{$data->name}}</option>
                                      @endforeach
                                      
                                    </select>
                                </div>
                                <div class="form-group">
                                  <label for="delivery_note">Delivery Note</label>
                                  <textarea class="form-control" name="delivery_note" id="delivery_note" rows="2">

                                  </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success"> <i class="anticon anticon-save"></i> Save</button>
            </div>
            </form>
            

        </div>
    </div>
</div>