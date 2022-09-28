  <?php if (isset($user)) : ?>
      <div class="card-header d-flex justify-content-between">
          <div class="d-flex align-items-center">
              <i class="fa fa-user-circle fa-3x" aria-hidden="true"></i>
              &nbsp;&nbsp;
              <h4 class="text-primary"><?= $user->first_name . ' ' . $user->last_name ?></h4>
          </div>
          <div>
              <div class="btn-group">
                  <div class="dropdown">
                      <button class="btn btn-sm btn-rounded btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-cog"></i> VIEW OPTIONS
                      </button>
                      <div class="dropdown-menu bg-gradient-light" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item d-flex justify-content-between mb-2" href="<?= base_url("admin/dashboard/user/profile/$user->unique_id") ?>"> View Profile </a>
                          <a class="dropdown-item d-flex justify-content-between mb-2" href="<?= base_url("admin/transactions/view/$user->unique_id") ?>"> Transactions</a>
                          <a class="dropdown-item d-flex justify-content-between mb-2" href="<?= base_url("admin/withdrawals/view/all/$user->unique_id") ?>"> Withdrawals</a>
                          <a class="dropdown-item d-flex justify-content-between mb-2" href="<?= base_url("admin/deposits/view/$user->unique_id") ?>"> Deposits</a>
                          <a class="dropdown-item d-flex justify-content-between" href="<?= base_url("admin/notifications/view/$user->unique_id") ?>"> View Notifications </a>
                      </div>
                  </div>
              </div>
              <div class="btn-group">
                  <div class="dropdown">
                      <button class="btn btn-sm btn-rounded btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-cog"></i> ACCOUNT STATUS
                      </button>
                      <div class="dropdown-menu bg-gradient-light" aria-labelledby="dropdownMenuButton">
                          <?php if ($user->account_verified == 0) : ?>
                              <a class="dropdown-item mb-2" href="<?= base_url("admin/dashboard/options/profile/$user->unique_id/verify_account") ?>">Activate verification</a>
                          <?php elseif ($user->account_disabled == 1) : ?>
                              <a class="dropdown-item mb-2" href="<?= base_url("admin/dashboard/options/profile/$user->unique_id/unverify_account") ?>">Deactivate verification</a>
                          <?php endif; ?>
                          <?php if ($user->account_frozen == 1) : ?>
                              <a class="dropdown-item mb-2" href="<?= base_url("admin/dashboard/options/profile/$user->unique_id/unfreeze") ?>">Unfreeze account</a>
                          <?php endif; ?>
                          <a class="dropdown-item mb-2" href="<?= base_url("admin/dashboard/profile/$user->unique_id") ?>">Account settings</a>
                          <a class="dropdown-item mb-2" href="<?= base_url("admin/dashboard/user/login_activity/$user->unique_id") ?>">Login Activity</a>
                          <a class="dropdown-item mb-2" href="<?= base_url("admin/dashboard/options/profile/$user->unique_id/delete") ?>">Delete account</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  <?php endif; ?>