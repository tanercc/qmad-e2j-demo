var sportsData = [
    {ID: 'Default', Text: 'Default'},
    {ID: 'Grid', Text: 'Grid'},
    {ID: 'Chart', Text: 'Chart'},
];
var theme;
var style;

var gantt = new ej.gantt.Gantt({
    dataSource: getData(),
    resources: getResources(),
    height: '500px',
    width: '100%',
    highlightWeekends: true,
    allowSelection: true,
    allowSorting: true,
    treeColumnIndex: 1,
    viewType: 'ProjectView',
    taskFields: {
        id: 'TaskId',
        name: 'TaskName',
        startDate: 'StartDate',
        endDate: 'EndDate',
        duration: 'TimeLog',
        progress: 'Progress',
        dependency: 'Predecessor',
        parentID: 'ParentId',
        resourceInfo: 'Assignee',
    },
    resourceFields: {
        id: 'resourceId',
        name: 'resourceName',
    },
    columns: [
        {field: 'TaskId', width: 60, visible: false},
        {field: 'TaskName', width: 200, headerText: 'Product Release'},
        {
            field: 'Assignee',
            width: 130,
            allowSorting: false,
            headerText: 'Assignee',
            template: '#columnTemplate',
        },
        {
            field: 'Status',
            minWidth: 100,
            width: 120,
            headerText: 'Status',
            template: '#columnTemplate1',
        },
        {
            field: 'Priority',
            minWidth: 80,
            width: 100,
            headerText: 'Priority',
            template: '#columnTemplate2',
        },
        {field: 'Work', width: 120, headerText: 'Planned Hours'},
        {field: 'TimeLog', width: 120, headerText: 'Work Log'},
    ],
    toolbar: [
        {
            type: 'Input',
            align: 'Right',
            template: new ej.dropdowns.DropDownList({
                dataSource: sportsData,
                placeholder: 'View',
                width: '90px',
                fields: {value: 'ID', text: 'Text'},
                change: function (args) {
                    if (args.value == 'Grid') {
                        gantt.setSplitterPosition('100%', 'position');
                    } else if (args.value == 'Chart') {
                        gantt.setSplitterPosition('0%', 'position');
                    } else {
                        gantt.setSplitterPosition('50%', 'position');
                    }
                },
            }),
        },
        'ExpandAll',
        'CollapseAll',
    ],
    load: function (args) {
        var cls = document.body.className.split(' ');
        theme = 'bootstrap4';
    },
    splitterSettings: {
        position: '50%',
    },
    selectionSettings: {
        mode: 'Row',
        type: 'Single',
        enableToggle: true,
    },
    tooltipSettings: {
        showTooltip: true,
    },
    filterSettings: {
        type: 'Menu',
    },
    allowFiltering: true,
    gridLines: 'Vertical',
    showColumnMenu: true,
    timelineSettings: {
        showTooltip: true,
        topTier: {
            unit: 'Month',
            format: 'MMM yyyy',
        },
        bottomTier: {
            unit: 'Day',
            count: 4,
            format: 'dd',
        },
    },
    eventMarkers: [
        {
            day: '04/04/2022',
            cssClass: 'e-custom-event-marker',
            label: 'Q-1 Release',
        },
        {
            day: '06/30/2022',
            cssClass: 'e-custom-event-marker',
            label: 'Q-2 Release',
        },
        {
            day: '09/29/2022',
            cssClass: 'e-custom-event-marker',
            label: 'Q-3 Release',
        },
    ],
    holidays: [
        {
            from: '01/01/2022',
            to: '01/01/2022',
            label: 'New Year holiday',
            cssClass: 'e-custom-holiday',
        },
        {
            from: '12/25/2021',
            to: '12/26/2021',
            label: 'Christmas holidays',
            cssClass: 'e-custom-holiday',
        },
    ],
    labelSettings: {
        rightLabel: 'Assignee',
        taskLabel: '${Progress}%',
    },
    allowResizing: true,
    taskbarHeight: 24,
    rowHeight: 36,
    projectStartDate: new Date('12/17/2021'),
    projectEndDate: new Date('10/26/2022'),
});
gantt.appendTo('#overviewSample');

async function getData() {
    const response = await fetch("/api/projects/1/tasks");
    const tasks = await response.json();
    console.log(tasks.data);
    return tasks.data;
}

async function getResources() {
    const response = await fetch("/api/resources");
    const resources = await response.json();
    console.log(resources);
    return resources.data;
}
