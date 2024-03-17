// Registering Syncfusion license key
ej.base.registerLicense('Ngo9BigBOggjHTQxAR8/V1NBaF5cXmZCekx3QHxbf1x0ZFdMYFpbQHdPMyBoS35RckVgWHlfdnZQRGRYUUJ/');
ej.base.enableRipple(true);

function beforeAjaxRequest(xhr) {
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
}

var remoteData = new ej.data.DataManager({
    url: '/api/projects/1/tasks',
    beforeAjaxRequest: "beforeAjaxRequest",
    adaptor: new ej.data.WebApiAdaptor(),
    crossDomain: true
});
var editingResources;

async function getRes() {
    return fetch('/api/resources')
        .then(response => response.json())
        .then(responseJson => editingResources = responseJson);
}

var ganttChart;

async function drawChart() {
    const editingResources = await this.getRes();

    ganttChart = new ej.gantt.Gantt({
        dataSource: remoteData,
        dateFormat: 'MMM dd, y',
        taskFields: {
            id: 'taskId',
            name: 'taskName',
            startDate: 'startDate',
            endDate: 'endDate',
            duration: 'duration',
            progress: 'progress',
            dependency: 'dependency',
            parentID: 'parentID',
            notes: 'notes',
            resourceInfo: 'resources',
        },
        editSettings: {
            allowAdding: true,
            allowEditing: true,
            allowDeleting: true,
            allowTaskbarEditing: true,
            showDeleteConfirmDialog: true,
        },
        toolbar: [
            'Add',
            'Edit',
            'Update',
            'Delete',
            'Cancel',
            'ExpandAll',
            'CollapseAll',
            'Indent',
            'Outdent',
        ],
        allowSelection: true,
        gridLines: 'Both',
        height: '450px',
        treeColumnIndex: 1,
        resourceFields: {
            id: 'id',
            name: 'name',
        },
        resources: editingResources,
        highlightWeekends: true,
        timelineSettings: {
            topTier: {
                unit: 'Week',
                format: 'MMM dd, y',
            },
            bottomTier: {
                unit: 'Day',
            },
        },
        columns: [
            {field: 'taskId', width: 80},
            {
                field: 'taskName',
                headerText: 'Job Name',
                width: '250',
                clipMode: 'EllipsisWithTooltip',
            },
            {field: 'StartDate'},
            {field: 'Duration'},
            {field: 'Progress'},
            {field: 'Predecessor'},
        ],
        eventMarkers: [
            {day: '4/17/2019', label: 'Project approval and kick-off'},
            {day: '5/3/2019', label: 'Foundation inspection'},
            {day: '6/7/2019', label: 'Site manager inspection'},
            {day: '7/16/2019', label: 'Property handover and sign-off'},
        ],
        labelSettings: {
            leftLabel: 'taskName',
            rightLabel: 'resources',
        },
        splitterSettings: {
            position: '35%',
        },
        editDialogFields: [
            {type: 'General', headerText: 'General'},
            {type: 'Dependency'},
            {type: 'Resources'},
            {type: 'Notes'},
        ],
        projectStartDate: new Date('03/25/2019'),
        projectEndDate: new Date('07/28/2019'),
    });
    ganttChart.appendTo('#Gantt');
}

drawChart();
