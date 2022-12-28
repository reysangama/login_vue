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
                                        <tr>
                                            <th>#</th>
                                            <th>Perfil</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in list_profile" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ item.description }}</td>
                                            <td class="text-nowrap">
                                                <a href="#" @click="editProfile(item.id)" class="mr-25"
                                                    data-toggle="tooltip" data-original-title="Edit">
                                                    <i class="fa fa-pencil text-inverse m-r-10"></i>
                                                </a>
                                                <a href="#" data-toggle="tooltip" data-original-title="Close">
                                                    <i class="fa fa-close text-danger"></i>
                                                </a>
                                            </td>
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
    },
	data() {
		return {
            list_profile: [],
		}
	},
	created() {
        this.listProfile();
	},
	methods: {
		async listProfile() {
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .get(this.path)
                    .then((response) => {
                        this.list_profile = response.data.profiles;
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


