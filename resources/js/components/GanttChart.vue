<template>
    <div>
        <div class="control-section">
            <div class="content-wrapper">
                <ejs-gantt ref='gantt' id="GanttContainer"
                           :dataSource="dataSource"
                           :dateFormat="dateFormat"
                           :taskFields="taskFields"
                           :editSettings="editSettings"
                           :toolbar="toolbar"
                           :allowSelection="true"
                           :gridLines="gridLines"
                           :height="height"
                           :treeColumnIndex="1"
                           :resourceFields="resourceFields"
                           :resources="resources"
                           :highlightWeekends="true"
                           :timelineSettings="timelineSettings"
                           :columns="columns"
                           :eventMarkers="eventMarkers"
                           :labelSettings="labelSettings"
                           :editDialogFields="editDialogFields"
                           :projectStartDate="projectStartDate"
                           :projectEndDate="projectEndDate"
                           :splitterSettings="splitterSettings"
                           :created="created"
                >
                </ejs-gantt>
                <div style="float: right; margin: 10px;">Source:
                    <a href="https://en.wikipedia.org/wiki/Construction" target='_blank'>https://en.wikipedia.org/</a>
                </div>
            </div>
        </div>


    </div>
</template>
<script>
import {GanttComponent, Edit, Selection, Toolbar, DayMarkers} from "@syncfusion/ej2-vue-gantt";
import {DataManager, WebApiAdaptor} from '@syncfusion/ej2-data';


export default {
    components: {
        'ejs-gantt': GanttComponent
    },
    data: function () {
        return {
            dataSource: new DataManager({
                url: '/api/projects/1/tasks',
                adaptor: new WebApiAdaptor(),
                crossDomain: true,
            }),
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
                showDeleteConfirmDialog: true
            },
            toolbar: ['Add', 'Edit', 'Update', 'Delete', 'Cancel', 'ExpandAll', 'CollapseAll', 'Indent', 'Outdent'],
            gridLines: 'Both',
            height: '450px',
            resourceFields: {
                id: 'id',
                name: 'name',
            },
            resources: [],
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
                rightLabel: 'resources'
            },
            editDialogFields: [
                {type: 'General', headerText: 'General'},
                {type: 'Dependency'},
                {type: 'Resources'},
                {type: 'Notes'},
            ],
            projectStartDate: new Date('03/25/2019'),
            projectEndDate: new Date('07/28/2019'),
            splitterSettings: {
                position: "35%"
            }
        };
    },
    provide: {
        gantt: [Edit, Selection, Toolbar, DayMarkers]
    },
    methods: {
        created() {
            const fetchData = async () => {
                const {data: resources} = await axios.get('/api/resources');
                this.resources = resources;
            };
            fetchData();
        },
    },
}
</script>
