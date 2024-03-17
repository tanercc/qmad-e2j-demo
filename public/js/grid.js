// Registering Syncfusion license key
ej.base.registerLicense('Ngo9BigBOggjHTQxAR8/V1NBaF5cXmZCekx3QHxbf1x0ZFdMYFpbQHdPMyBoS35RckVgWHlfdnZQRGRYUUJ/');
ej.base.enableRipple(true);

function beforeAjaxRequest(xhr) {
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
}

var remoteData = new ej.data.DataManager({
    url: '/api/orders',
    beforeAjaxRequest: "beforeAjaxRequest",
    adaptor: new ej.data.WebApiAdaptor(),
    crossDomain: true
});
var editingResources;

async function getStatus() {
    return fetch('/api/statuses')
        .then(response => response.json())
        .then(responseJson => editingResources = responseJson);
}

var grid;

async function drawGrid() {
    const shippingStatuses = await this.getStatus();

    grid = new ej.grids.Grid({
        dataSource: remoteData,
        editSettings: {
            allowEditing: true,
            allowAdding: true,
            allowDeleting: true,
            mode: 'Normal',
            showAddNewRow: true,
            newRowPosition: 'Top',
        },
        allowPaging: true,
        pageSettings: {pageCount: 5},
        allowSorting: true,
        toolbar: ['Add', 'Edit', 'Delete', 'Update', 'Cancel'],
        columns: [
            {
                field: 'orderID',
                isPrimaryKey: true,
                headerText: 'Order ID',
                textAlign: 'Right',
                validationRules: {required: true, number: true},
                width: 140,
            },
            {
                field: 'customerID',
                headerText: 'Customer ID',
                validationRules: {required: true, minLength: 5},
                width: 140,
            },
            {
                field: 'freight',
                headerText: 'Freight',
                textAlign: 'Right',
                editType: 'numericedit',
                width: 90,
                format: 'C2',
                validationRules: {required: true, min: 0},
            },
            {
                field: 'orderDate',
                headerText: 'Order Date',
                editType: 'datetimepickeredit',
                format: {type: 'dateTime', format: 'M/d/y hh:mm a'},
                width: 160,
            },
            {
                field: 'shipAddress',
                headerText: 'Ship Address',
                width: 150,
            },
            {
                field: 'shipCity',
                headerText: 'Ship City',
                editType: 'dropdownedit',
                width: 150,
                edit: {params: {popupHeight: '300px'}},
            },
            {
                field: 'shipCountry',
                headerText: 'Ship Country',
                editType: 'dropdownedit',
                width: 150,
                edit: {params: {popupHeight: '300px'}},
            },
            {
                field: 'shipName',
                headerText: 'Ship Name',
                width: 150,
            },
            {
                field: 'shippedDate',
                headerText: 'Shipped Date',
                editType: 'datetimepickeredit',
                format: {type: 'dateTime', format: 'M/d/y hh:mm a'},
                width: 160,
            },
            {
                field: 'status_id',
                headerText: 'Shipping Status',
                validationRules: {required: true},
                width: 120,
                editType: 'dropdownedit',
                foreignKeyField: "id",
                foreignKeyValue: "status",
                dataSource: shippingStatuses,
                edit: {
                    params: {
                        query: new ej.data.Query(),
                        dataSource: shippingStatuses,
                        fields: {value: 'id', text: 'status'},
                    }
                },
            }
        ],
    });
    grid.appendTo('#Grid');
}

drawGrid();
