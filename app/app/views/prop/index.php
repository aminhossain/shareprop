<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <div class="card bg-light mt-5 mb-5">
        <div class="card-header card-text text-center">
            <h2 class="card-text">All Property List</h2>
        </div>

        <div class="card-body">
            <table class="table mb-4">
                <thead>
                    <tr class="filters">
                        <th>
                            Date From
                            <input type="date" id="date_from" class="form-control col">
                        </th>
                        <th>
                            Date To
                            <input type="date" id="date_to" class="form-control">
                        </th>
                        <th>
                            Filter by User ID
                            <select id="by_userid" class="form-control">
                                <option value="1">By DESC</option>
                                <option value="2">By ASC</option>
                            </select>
                        </th>
                        <th>
                            <button class="btn btn-primary" id="filter_btn" data-url="<?php echo URLROOT ;?>/props/filter">Filter</button>
                        </th>
                    </tr>
                </thead>
            </table>
            <table class="table table-bordered table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Buyer</th>
                        <th scope="col">Buyer Email</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Receipt ID</th>
                        <th scope="col">Items</th>
                        <th scope="col">Buyer IP</th>
                        <th scope="col">Note</th>
                        <th scope="col">City</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Entry At</th>
                        <th scope="col">Entry By</th>
                    </tr>
                </thead>
                <tbody id="props-data">
                    <?php 
                        if(count($data['props']) > 0) {
                            foreach($data['props'] as $prop) {
                                echo "<tr>
                                        <td>{$prop->buyer}</td>
                                        <td>{$prop->buyer_email}</td>
                                        <td>{$prop->amount}</td>
                                        <td>{$prop->receipt_id}</td>
                                        <td>{$prop->items}</td>
                                        <td>{$prop->buyer_ip}</td>
                                        <td>{$prop->note}</td>
                                        <td>{$prop->city}</td>
                                        <td>{$prop->phone}</td>
                                        <td>{$prop->entry_at}</td>
                                        <td>{$prop->entry_by}</td>
                                    </tr>";
                            }
                        } else {
                            echo "<h1>No Record Found!</h1>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>