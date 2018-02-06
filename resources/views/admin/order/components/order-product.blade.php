<div class="col-sm-12 row products">
    <div class="col-md-2 col-sm-12">
        <label class="control-label hidden-sms-up">Product Name</label>
        <input type="hidden" name="product[{{ $index }}][product_id]" />
        <input type="text" class="product-search form-control" placeholder="Product Name" />
    </div>
    <div class="col-md-2 col-sm-12">
        <label class="control-label hidden-sms-up">Quantity</label>
        <input type="number" class="form-control" placeholder="Quantity" name="product[{{ $index }}][quantity]">
    </div>
    <div class="col-md-3 col-sm-12">
        <label class="control-label hidden-sms-up col-sm-12">Buying Price</label>
        <div class="col-sm-12 row p-0">
            <div class="col-sm-6 p-0">
                <select class="form-control" name="product[{{ $index }}][buying_currency]">
                    <option value="SGD">SGD</option>
                    <option value="RMB">RMB</option>
                </select>
            </div>
            <div class="col-sm-6 p-0">
                <input class="form-control" placeholder="Buying Price" name="product[{{ $index }}][buying_price]" />
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <label class="control-label hidden-sms-up col-sm-12">Selling Price</label>
        <div class="col-sm-12 row p-0">
            <div class="col-sm-6 p-0">
                <select class="form-control" name="product[{{ $index }}][selling_currency]">
                    <option value="SGD">SGD</option>
                    <option value="RMB">RMB</option>
                </select>
            </div>
            <div class="col-sm-6 p-0">
                <input class="form-control" placeholder="Selling Price" name="product[{{ $index }}][selling_price]" />
            </div>
        </div>
    </div>
    <div class="col-md-2 col-sm-12">
        <label class="control-label hidden-sms-up">Remarks</label>
        <div class="row">
            <div class="col-sm-8 pr-0">
                <input name="product[{{ $index }}][remarks]" placeholder="Remarks" class="form-control" type="text" />
            </div>
            <div class="col-sm-2">
                <a class="btn btn-sm btn-danger delete-product" title="Delete"><i class="fa fa-trash-o"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12 hrline">
    <hr>
</div>