/*=========================================================================================
    File Name: app-user.js
    Description: User page JS
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
$(document).ready(function () {

  var isRtl;
  if ( $('html').attr('data-textdirection') == 'rtl' ) {
    isRtl = true;
  } else {
    isRtl = false;
  }

  //  Rendering badge in status column
  var customBadgeHTML = function (params) {
    var color = "";
    if (params.value == "active") {
      color = "success"
      return "<div class='badge badge-pill badge-light-" + color + "' >" + params.value + "</div>"
    } else if (params.value == "blocked") {
      color = "danger";
      return "<div class='badge badge-pill badge-light-" + color + "' >" + params.value + "</div>"
    } else if (params.value == "deactivated") {
      color = "warning";
      return "<div class='badge badge-pill badge-light-" + color + "' >" + params.value + "</div>"
    }
  }

  //  Rendering bullet in verified column
  var customBulletHTML = function (params) {
    var color = "";
    if (params.value == true) {
      color = "success"
      return "<div class='bullet bullet-sm bullet-" + color + "' >" + "</div>"
    } else if (params.value == false) {
      color = "secondary";
      return "<div class='bullet bullet-sm bullet-" + color + "' >" + "</div>"
    }
  }

  // Renering Icons in Actions column
  function getColumnData(params) {
    console.log(params.data)
  }
  var customIconsHTML = function (params) {
    var usersIcons = document.createElement("span");
   // var editIconHTML = "<a  id='edit' data-toggle='modal' data-target='#inlineForm' ><i class='users-edit-icon feather icon-edit-1 mr-50'></i></a>"

    //console.log($.parseHTML(editIconHTML)[0].id)
    var editIconHTML = document.createElement('a');

    var attrs = document.createAttribute("class")
    var  id = document.createAttribute('id')
    id.value ='editusers'
    attrs.value = "users-edit-icon feather icon-edit-1 mr-50"
    editIconHTML.setAttributeNode(attrs);
    editIconHTML.setAttributeNode(id);
    $("#editusers").attr('data-toggle','modal')
    $("#editusers").attr('data-target','#inlineForm')
    // selected row delete functionality
    editIconHTML.addEventListener("click",function () {
      $("#editusers").attr('data-toggle','modal')
      $("#editusers").attr('data-target','#inlineForm')
      $("#edit_user_id").val(params.data.user_id);
      $("#edit_first_name").val(params.data.first_name)
      $("#edit_last_name").val(params.data.last_name)
      $("#edit_email").val(params.data.email)
      $("#edit_telephone").val(params.data.telephone)
      $("#edit_role").val(params.data.type)

      //getColumnData(params)
    });



    var deleteIconHTML = document.createElement('i');
    var attr = document.createAttribute("class")
    attr.value = "users-delete-icon feather icon-trash-2"
    deleteIconHTML.setAttributeNode(attr);
    // selected row delete functionality
    deleteIconHTML.addEventListener("click", function () {
      deleteArr = [
        params.data
      ];
      getColumnData(params)
      // var selectedData = gridOptions.api.getSelectedRows();
      gridOptions.api.updateRowData({
        remove: deleteArr
      });
    });
    //usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
    usersIcons.appendChild(editIconHTML);
    usersIcons.appendChild(deleteIconHTML);
    return usersIcons
  }

  //  Rendering avatar in username column
  var customAvatarHTML = function (params) {

   // return "<span class='avatar'><img src='" + params.data.avatar + "' height='32' width='32'></span>" + params.value

    return "<span class='avatar'><img src='../../../images/portrait/small/avatar-s-20.jpg' height='32' width='32'></span>" + params.value
  }

  // ag-grid
  /*** COLUMN DEFINE ***/

  var columnDefs = [{
      headerName: 'ID',
      field: 'user_id',
      width: 125,
      filter: true,
      checkboxSelection: true,
      headerCheckboxSelectionFilteredOnly: true,
      headerCheckboxSelection: true,
    },
    {
      headerName: 'FistName',
      field: 'first_name',
      filter: true,
      width: 175,
      cellRenderer: customAvatarHTML,
    },
    {
      headerName: 'LastName',
      field: 'last_name',
      filter: true,
      width: 175,
    },
    {
      headerName: 'Email',
      field: 'email',
      filter: true,
      width: 225,
    },
    {
      headerName: 'Téléphone',
      field: 'telephone',
      filter: true,
      width: 225,
    },
    {
      headerName: 'Name',
      field: 'first_name',
      filter: true,
      width: 200,
    },
    {
      headerName: 'Role',
      field: 'type',
      filter: true,
      width: 150,
    },
    {
      headerName: 'Status',
      field: 'status',
      filter: true,
      width: 150,
      cellRenderer: customBadgeHTML,
      cellStyle: {
        "text-align": "center"
      }
    },
    {
      headerName: 'Verified',
      field: "is_verified",
      filter: true,
      width: 125,
      cellRenderer: customBulletHTML,
      cellStyle: {
        "text-align": "center"
      }
    },
    {
      headerName: 'Department',
      field: 'department',
      filter: true,
      width: 150,
    },
    {
      headerName: 'Actions',
      field: 'transactions',
      width: 150,
      cellRenderer: customIconsHTML,
    }
  ];

  /*** GRID OPTIONS ***/
  var gridOptions = {
    defaultColDef: {
      sortable: true
    },
    enableRtl: isRtl,
    columnDefs: columnDefs,
    rowSelection: "multiple",
    floatingFilter: true,
    filter: true,
    pagination: true,
    paginationPageSize: 20,
    pivotPanelShow: "always",
    colResizeDefault: "shift",
    animateRows: true,
    resizable: true
  };


  if (document.getElementById("myGrid")) {

    /*** DEFINED TABLE VARIABLE ***/
    var gridTable = document.getElementById("myGrid");
    /*var d={};
    var userData  = $.getJSON("/getUsers",function(data){
      d=data["data"];
      console.log(d[0])
        //gridOptions.api.setRowData(d)
      //return userData = data

    }).done(function (result) {
        return result;
      })

    console.log(userData);
    console.log(JSON.stringify(userData,undefined,2));
    */
    /*** GET TABLE DATA FROM URL ***/
    agGrid
      .simpleHttpRequest({
        url: "data/user-data/user-list.json"
      })
      .then(function (data) {
        gridOptions.api.setRowData(data);
      });

    /*** FILTER TABLE ***/
    function updateSearchQuery(val) {
      gridOptions.api.setQuickFilter(val);
    }

    $(".ag-grid-filter").on("keyup", function () {
      updateSearchQuery($(this).val());
    });

    /*** CHANGE DATA PER PAGE ***/
    function changePageSize(value) {
      gridOptions.api.paginationSetPageSize(Number(value));
    }

    $(".sort-dropdown .dropdown-item").on("click", function () {
      var $this = $(this);
      changePageSize($this.text());
      $(".filter-btn").text("1 - " + $this.text() + " of 50");
    });

    /*** EXPORT AS CSV BTN ***/
    $(".ag-grid-export-btn").on("click", function (params) {
      gridOptions.api.exportDataAsCsv();
    });

    //  filter data function
    var filterData = function agSetColumnFilter(column, val) {
      var filter = gridOptions.api.getFilterInstance(column)
      var modelObj = null
      if (val !== "all") {
        modelObj = {
          type: "equals",
          filter: val
        }
      }
      filter.setModel(modelObj)
      gridOptions.api.onFilterChanged()
    }
    //  filter inside role
    $("#users-list-role").on("change", function () {
      var usersListRole = $("#users-list-role").val();
      filterData("type", usersListRole)
    });
    //  filter inside verified
    $("#users-list-verified").on("change", function () {
      var usersListVerified = $("#users-list-verified").val();
      filterData("is_verified", usersListVerified)
    });
    //  filter inside status
    $("#users-list-status").on("change", function () {
      var usersListStatus = $("#users-list-status").val();
      filterData("status", usersListStatus)
    });
    //  filter inside department
    $("#users-list-department").on("change", function () {
      var usersListDepartment = $("#users-list-department").val();
      filterData("department", usersListDepartment)
    });
    // filter reset
    $(".users-data-filter").click(function () {
      $('#users-list-role').prop('selectedIndex', 0);
      $('#users-list-role').change();
      $('#users-list-status').prop('selectedIndex', 0);
      $('#users-list-status').change();
      $('#users-list-verified').prop('selectedIndex', 0);
      $('#users-list-verified').change();
      $('#users-list-department').prop('selectedIndex', 0);
      $('#users-list-department').change();
    });

    /*** INIT TABLE ***/
    new agGrid.Grid(gridTable, gridOptions);
  }


  // users language select
  if ($("#users-language-select2").length > 0) {
    $("#users-language-select2").select2({
      dropdownAutoWidth: true,
      width: '100%'
    });
  }
  // users music select
  if ($("#users-music-select2").length > 0) {
    $("#users-music-select2").select2({
      dropdownAutoWidth: true,
      width: '100%'
    });
  }
  // users movies select
  if ($("#users-movies-select2").length > 0) {
    $("#users-movies-select2").select2({
      dropdownAutoWidth: true,
      width: '100%'
    });
  }
  // users birthdate date
  if ($(".birthdate-picker").length > 0) {
    $('.birthdate-picker').pickadate({
      format: 'mmmm, d, yyyy'
    });
  }
  // Input, Select, Textarea validations except submit button validation initialization
  if ($(".users-edit").length > 0) {
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
  }
});
