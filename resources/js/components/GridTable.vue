<template>
    <div class="panel-wrapper collapse in">
        <div class="row d-flex flex-content-between mb-15 mt-10 pb-0">
            <div class="col-md-8 mb-0 pb-0 mt-0">

                <button class="btn btn-default btn-icon-anim btn-square ml-15" @click="reload"><i class="fa  fa-history"></i></button>

                <button class="btn btn-success btn-icon-anim btn-square ml-15"><i
                        class="fa fa-file-excel-o"></i></button>

                <button class="btn btn-primary btn-icon-anim btn-square ml-15"><i class="fa fa-file-pdf-o"></i></button>

            </div>

            <div class="col-md-4 mb-0 pb-0">
                <div class="form-group mb-0 pb-0">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" v-model="query" class="form-control" id="exampleInputuname_1"
                            placeholder="Buscar">
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body mt-0 pt-0 mb-0 pb-0">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table id="datable_1" class="table  display pb-0 mb-0">
                        <thead>
                            <tr style="height: 1px;" class="header-table mb-0 mt-0 pb-0 pt-0">
                                <th class=" pb-10 pt-10" v-for="(item, index) in columns" :key="index">{{ item.text }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr @dblclick="edit" v-for="(item, index) in list_row" :key="index"
                                @click="selectedRow(index)" :style="index == selected && theStyle">
                                <template v-for="(row, key) in columns" :key="key">
                                    <td class=" pb-5 pt-5" v-if="row.text == '#'">
                                        {{ index + 1 }}
                                    </td>
                                    <td class=" pb-5 pt-5" v-else>
                                        {{ item[row.value] }}
                                    </td>

                                </template>


                            </tr>
                        </tbody>
                    </table>
                    <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5"
                        @paginate="query === '' ? list() : searchData()">
                    </pagination>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
import Pagination from "./PaginationComponent";

export default {
    name: "GridTable",
    props: {
        path: String,
        columns: Array
    },
    components: {
        Pagination,
    },
    data() {
        return {
            selected: null,
            query: "",
            theStyle: { backgroundColor: "", },
            list_row: [],
            pagination: {
                current_page: 1,
            },
        }
    },
    watch: {
        query: function (newQ, old) {
            if (newQ === "") {
                this.list();
            } else {
                this.searchData();
            }
        }
    },
    created() {
        this.list();
    },
    methods: {
        selectedRow(item) {
            this.selected = item;
            this.theStyle.backgroundColor = "#d2e1ff";
        },
        getSelectedRow() {
            return this.selected;
        },
        edit() {
            this.$emit('edit')
        },
        async list() {

            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .get("/api/" + this.path + '?page=' + this.pagination.current_page)
                    .then((response) => {
                        this.list_row = response.data.data;
                        this.pagination = response.data.meta
                            ;
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            });
        },
        reload() {
            this.list();
            this.query = "";
          
        },
        async searchData() {
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .get(
                        "/api/search/" + this.path + "/" +
                        this.query +
                        "?page=" +
                        this.pagination.current_page
                    )
                    .then(response => {
                        this.list_row = response.data.data;
                        this.pagination = response.data.meta
                            ;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            });
        },
    },

}
</script>



<style scoped>
.header-table {
    background-color: #e3e3e3;
}

.selected {
    background-color: #d2e1ff !important;
}
</style>


