<template>
	<div class="panel-wrapper collapse in">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                    <input type="text" class="form-control" id="exampleInputuname_1" placeholder="Buscar">
                                </div>
                            </div>
                        </div>
                    </div>    
                    
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-hover display  pb-30">
                                    <thead>
                                        <tr >
                                            <th  v-for="(item, index) in columns" :key="index">{{ item.text}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in list_row" :key="index">
                                            <template v-for="(row, key) in columns" :key="key">
                                                <td v-if="row.text=='#'">
                                                    {{ index + 1 }}
                                                </td>
                                                <td v-else>
                                                    {{ item[row.value]  }}
                                                </td>

                                            </template>
                                           
                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                                </nav> -->
                                <pagination
                                v-if="pagination.last_page > 1"
                                :pagination="pagination"
                                :offset="5"
                                @paginate="list()"
                            ></pagination>
                            </div>
                        </div>
                    </div>
    </div>
   
</template>
<script>
import Pagination from "./PaginationComponent";

export default {
    name: "GridTable",
    props:{
        path:String,
        columns:Array
    },
    components: {
        Pagination,
    },
	data() {
		return {
            list_row: [],
            pagination:{
                current_page:1,
            },
		}
	},
	created() {
        this.list();
	},
	methods: {
		async list() {
            
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .get(this.path+'?page='+this.pagination.current_page)
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
	},

}
</script>



<style scoped>

</style>


