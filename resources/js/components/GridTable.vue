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
                            </div>
                        </div>
                    </div>
    </div>
</template>
<script>


export default {
    name: "GridTable",
    props:{
        path:String,
        columns:Array
    },
	data() {
		return {
            list_row: [],
		}
	},
	created() {
        this.list();
	},
	methods: {
		async list() {
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .get(this.path)
                    .then((response) => {
                        this.list_row = response.data.row;
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


