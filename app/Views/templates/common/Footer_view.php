  <!-- Footer -->
  <footer class="bg-white iq-footer">
     <div class="container-fluid">
        <div class="row">
           <div class="col-lg-6">
              <ul class="list-inline mb-0">
                 <!-- <li class="list-inline-item"><a href="<?=PATH_ASSETS?>privacy-policy.html">Privacy Policy</a></li> -->
                 <!-- <li class="list-inline-item"><a href="<?=PATH_ASSETS?>terms-of-service.html">Terms of Use</a></li> -->
              </ul>
           </div>
           <div class="col-lg-6 text-right">
              Copyright <?= date('Y'); ?> <a href="<?= base_url().'/Employees/profile_view/'.$_SESSION['user_id'].'/'.$_SESSION['position_id'] ?>">Accele-rate</a> <?= lang('Home.Todos Los Derechos Reservados.');?>
           </div>
        </div>
     </div>
  </footer>
  <!-- Footer END -->