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
     <script src="{{asset('assets/js/staff.js')}}"></script>
    <input type="hidden" class="demo" value="{{url('/')}}"></input>
    @yield('pageJsScripts')
  </body>
</html>