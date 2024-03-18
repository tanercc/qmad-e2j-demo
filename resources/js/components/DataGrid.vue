<template>
    <div class="control-section">
        <div class="col-lg-9 control-section" v-if="!loading">
            <ejs-grid ref='grid' id='grid'
                      :dataSource="data"
                      :allowPaging='true'
                      :pageSettings='pageSettings'
                      :allowSorting='true'
                      :editSettings='editSettings'
                      :toolbar='toolbar'
                      :created="created">
                <e-columns>
                    <e-column field='orderID' headerText='Order ID' width='120' textAlign='Right' :isPrimaryKey='true'
                              :validationRules='orderidrules'></e-column>
                    <e-column field='customerID' headerText='Customer ID' width='150'
                              foreignKeyValue='contactName' foreignKeyField='customerID'
                              :dataSource='customers'
                              :validationRules='customeridrules'></e-column>
                    <e-column field='freight' headerText='Freight' width='90' format='C2' textAlign='Right'
                              editType='numericedit' :validationRules='freightrules'></e-column>
                    <e-column field='orderDate' headerText='Order Date' width='130' editType='datetimepickeredit'
                              :format='formatoptions' textAlign='Right'></e-column>
                    <e-column field='shipCountry' headerText='Ship Country' width='150' editType='dropdownedit'
                              :edit='editparams'></e-column>
                    <e-column field='shipAddress' headerText='Ship Address' width='150'></e-column>
                    <e-column field='shipCity' headerText='Ship City' width='150' editType='dropdownedit'
                              :edit='editparams'></e-column>
                    <e-column field='shipName' headerText='Ship Name' width='150'></e-column>
                    <e-column field='status_id' headerText='Shipping Status' width='120'
                              :validationRules='statusrules'
                              foreignKeyValue='status' foreignKeyField='id'
                              :dataSource='statuses'></e-column>
                </e-columns>
            </ejs-grid>
        </div>
    </div>
</template>
<!-- custom code start-->
<style scoped>
#typeddl {
    min-width: 100px;
}
</style>
<!-- custom code end -->
<script lang="ts">
import {
    GridComponent,
    ColumnDirective,
    ColumnsDirective,
    ForeignKey,
    Edit,
    Page,
    Toolbar,
    Sort
} from "@syncfusion/ej2-vue-grids";
import {DataManager, WebApiAdaptor} from "@syncfusion/ej2-data";
import axios from "axios";

export default {
    components: {
        'ejs-grid': GridComponent,
        'e-column': ColumnDirective,
        'e-columns': ColumnsDirective,
    },
    data: () => {
        return {
            newRowPositionDataSource: [{value: 'Top', text: 'Top'}, {value: 'Bottom', text: 'Bottom'}],
            fields: {text: 'text', value: 'value'},
            data: new DataManager({
                url: "/api/orders",
                adaptor: new WebApiAdaptor()
            }),
            statuses: [],
            customers: [],
            editSettings: {allowEditing: true, allowAdding: true, allowDeleting: true, showAddNewRow: true,},
            toolbar: ['Add', 'Edit', 'Delete', 'Update', 'Cancel'],
            orderidrules: {required: true, number: true},
            customeridrules: {required: true, minLength: 5},
            statusrules: {required: true},
            formatoptions: {type: 'dateTime', format: 'M/d/y hh:mm a'},
            freightrules: {required: true, min: 0},
            editparams: {params: {popupHeight: '300px'}},
            pageSettings: {pageCount: 5},
            loading: false,
        };
    },
    provide: {
        grid: [ForeignKey, Edit, Page, Toolbar, Sort]
    },
    methods: {
        created() {
            const fetchData = async () => {
                const {data: statuses} = await axios.get('/api/statuses');
                this.statuses = statuses;

                const {data: customers} = await axios.get('/api/customers');
                this.customers = customers;
            };
            fetchData();
        },
    },
};
</script>
