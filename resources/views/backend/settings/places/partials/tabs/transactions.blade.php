<div class="tab-pane fade" id="transactions">
    <div class="row">
        <!-- Transaction Charges -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Transaction Charges</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-4">
                            <label class="form-label">Percentage Fee</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="e.g. 2.5" step="0.1">
                                <span class="input-group-text">%</span>
                            </div>
                            <small class="form-text text-muted">Charged on transaction amount</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Fixed Fee</label>
                            <div class="input-group">
                                <span class="input-group-text">₦</span>
                                <input type="number" class="form-control" placeholder="e.g. 100">
                            </div>
                            <small class="form-text text-muted">Added to percentage fee</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Cap Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₦</span>
                                <input type="number" class="form-control" placeholder="e.g. 2000">
                            </div>
                            <small class="form-text text-muted">Maximum total fee charged</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Transaction Limits -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Transaction Limits</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-4">
                            <label class="form-label">Minimum Transaction</label>
                            <div class="input-group">
                                <span class="input-group-text">₦</span>
                                <input type="number" class="form-control" placeholder="e.g. 100">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Maximum Transaction</label>
                            <div class="input-group">
                                <span class="input-group-text">₦</span>
                                <input type="number" class="form-control" placeholder="e.g. 1000000">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Daily Limit</label>
                            <div class="input-group">
                                <span class="input-group-text">₦</span>
                                <input type="number" class="form-control" placeholder="e.g. 5000000">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Payout Settings -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-header-title">Payout Settings</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-4">
                            <label class="form-label">Payout Type</label>
                            <select class="form-select">
                                <option>Automatic (No Approval)</option>
                                <option>Automatic (With Approval)</option>
                                <option>Manual Processing</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Processing Time</label>
                            <select class="form-select">
                                <option>Instant (0-5 minutes)</option>
                                <option>Quick (1-3 hours)</option>
                                <option>Same Day (within 24 hours)</option>
                                <option>Next Day (24-48 hours)</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="weekendProcessing">
                                <label class="form-check-label">Process on Weekends</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="holidayProcessing">
                                <label class="form-check-label">Process on Holidays</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 