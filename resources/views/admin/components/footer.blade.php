        <footer>
          <div class="footer clearfix mb-0 text-muted">
              <div class="float-start">
                  <p>{{date('Y')}} &copy; School Management</p>
              </div>
              <div class="float-end">
                  <p>Developed with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                      by Anshika</p>
              </div>
          </div>
        </footer>
      </div>
  </div>
    <script src="{{asset('assets/js/components/dark.js')}}"></script>
    <script src="{{asset('assets/js/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables.js')}}"></script>
     <!-- jquery-validation Js-->
     <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
    <!-- Main_ajax.js -->
    <script src="{{asset('assets/js/main_ajax.js')}}"></script>
    
    <input type="hidden" class="demo" value="{{url('/')}}"></input>
    @yield('pageJsScripts')
  </body>
</html>