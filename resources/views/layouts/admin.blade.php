<!DOCTYPE html>

<html @if(app()->getLocale() == 'ar') dir="rtl" @endif> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>كوادرنا</title>
    <link name="favicon" type="image/x-icon" href="##" rel="shortcut icon" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@3.2/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" /> 
    <link href="{{ asset('admin/custom.css') }}" rel="stylesheet" />
    @if(app()->getLocale() == 'ar')
      <style>
        .c-sidebar-nav .c-sidebar-nav-dropdown-items{
          padding-right: 8%; 
        }
      </style>
    @else
      <style>
        .c-sidebar-nav .c-sidebar-nav-dropdown-items{
          padding-left: 8%; 
        }
      </style>
    @endif
    @yield('styles')
</head>

<body class="c-app">

    @include('inc.admin_side_nav')

    <div class="c-wrapper">
      
      @include('inc.admin_nav')
      <div class="c-body">
          <main class="c-main"> 
              <div class="container-fluid">  
                
                  @if($errors->count() > 0)
                      <div class="alert alert-warning">
                          {{trans('global.flash.fix_errors')}}
                      </div>
                        <div class="alert alert-danger">
                          @foreach ($errors->all() as $error)
                            {{$error}} <br>
                          @endforeach
                        </div>
                  @endif
                  
                  @yield('content')
              </div> 

          </main>
          <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
      </div>
    </div>

    
    @include('sweetalert::alert')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@3.2/dist/js/coreui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script> 

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

    <script src="{{ asset('admin/main.js') }}"></script>
    <script>
      
      function showFrontendAlert(type, title, message){
          swal({ 
            title: title,
            text: message,
            type: type, 
            showConfirmButton: 'Okay',
            timer: 3000
        });
      }

      
    function deleteConfirmation(route) {
      console.log(route);
        swal({
            title: "{{trans('global.flash.delete_')}}",
            text: "{{trans('global.flash.sure_')}}",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "{{trans('global.flash.yes_')}}",
            cancelButtonText: "{{trans('global.flash.no_')}}",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) { 

                $.ajax({
                    type: 'DELETE',
                    url: route,
                    data: { _token: '{{ csrf_token() }}' }, 
                    success: function (results) { 
                      location.reload(); 
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }

      $("document").ready(function(){   
          //perevent submittig multiple times
          $("body").on("submit", "form", function() {
              $(this).submit(function() {
                  return false;
              });
              return true;
          }); 

      }); 

      function notificationRead(id){ 
        $.post('{{ route('admin.alert.read') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
          
        });
      }

      function goBack() {
          window.history.back();
      } 

        $(function() {
          let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
          let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
          let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
          let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
          let printButtonTrans = '{{ trans('global.datatables.print') }}'
          let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
          let selectAllButtonTrans = '{{ trans('global.select_all') }}'
          let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

          let languages = {
            'ar': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
            'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
          };

          $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
          $.extend(true, $.fn.dataTable.defaults, {
            language: {
              url: languages['{{ app()->getLocale() }}']
            },
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                orderable: false,
                searchable: false,
                targets: -1
            }],
            select: {
              style:    'multi+shift',
              selector: 'td:first-child'
            },
            order: [],
            scrollX: true,
            pageLength: 10,
            // stateSave: true, 
            // "stateSaveParams": function(settings, data){
            //     for (var i = 0;i < data.columns.length; i++){
            //         delete data.columns[i].search; // remove column search from statesave 
            //     }
            //     delete data.search; // remove global search from statesave
            // },
            dom: 'lBfrtip<"actions">',
            buttons: [
              {
                extend: 'copy',
                className: 'btn-default',
                text: copyButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              },
              {
                extend: 'csv',
                className: 'btn-default',
                text: csvButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              },
              {
                extend: 'excel',
                className: 'btn-default',
                text: excelButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              },
              {
                extend: 'pdf',
                className: 'btn-default',
                text: pdfButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              },
              {
                extend: 'print',
                className: 'btn-default',
                text: printButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              },
              {
                extend: 'colvis',
                className: 'btn-default',
                text: colvisButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              }
            ]
          });

          $.fn.dataTable.ext.classes.sPageButton = '';
        });
        
    </script> 
    @yield('scripts')
</body>

</html>