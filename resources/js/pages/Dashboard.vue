<template>
	<loading v-model:active="isLoading" :can-cancel="false" :is-full-page="true" speed="2" color1="#ffffff" />

	<div class="wrapper">
		<div id="loader"></div>

		<header class="main-header">
			<div class="d-flex align-items-center logo-box justify-content-start" :class="{
				' slide-nav-toggle': state_navbar,
				'': !state_navbar,
				'sidebar-hover': state_hover_navbar,
				'': !state_hover_navbar,
				'mobile-nav-open': state_mobile_nav,
				'': !state_mobile_nav,
			}">
				<a href="#"
					class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn bg-transparent text-white"
					@click="clickNagbar" data-toggle="push-menu" role="button">
					<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span
							class="path3"></span></span>
				</a>
				<!-- Logo -->
				<a href="#" class="logo">
					<!-- logo-->
					<div class="logo-lg">
						<span class="light-logo"><img src="images/logo-light-text.png" alt="logo"></span>
						<span class="dark-logo"><img src="images/logo-dark-text.png" alt="logo"></span>
					</div>
				</a>
			</div>
			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<div class="app-menu">
					<ul class="header-megamenu nav">
						<li class="btn-group nav-item d-md-none">
							<a href="#" class="waves-effect waves-light nav-link push-btn" data-toggle="push-menu"
								role="button">
								<span class="icon-Align-left"><span class="path1"></span><span
										class="path2"></span><span class="path3"></span></span>
							</a>
						</li>
						<li class="btn-group nav-item d-none d-xl-inline-block">
							<a href="contact_app_chat.html" class="waves-effect waves-light nav-link svg-bt-icon"
								title="Chat">
								<i class="icon-Chat"><span class="path1"></span><span class="path2"></span></i>
							</a>
						</li>
						<li class="btn-group nav-item d-none d-xl-inline-block">
							<a href="mailbox.html" class="waves-effect waves-light nav-link svg-bt-icon"
								title="Mailbox">
								<i class="icon-Mailbox"><span class="path1"></span><span class="path2"></span></i>
							</a>
						</li>
						<li class="btn-group nav-item d-none d-xl-inline-block">
							<a href="extra_taskboard.html" class="waves-effect waves-light nav-link svg-bt-icon"
								title="Taskboard">
								<i class="icon-Clipboard-check"><span class="path1"></span><span
										class="path2"></span><span class="path3"></span></i>
							</a>
						</li>
					</ul>
				</div>

				<div class="navbar-custom-menu r-side">
					<ul class="nav navbar-nav">
						<li class="btn-group nav-item d-lg-inline-flex d-none">
							<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link full-screen"
								title="Full Screen">
								<i class="icon-Expand-arrows"><span class="path1"></span><span class="path2"></span></i>
							</a>
						</li>
						<li class="btn-group d-lg-inline-flex d-none">
							<div class="app-menu">
								<div class="search-bx mx-5">
									<form>
										<div class="input-group">
											<input type="search" class="form-control" placeholder="Search"
												aria-label="Search" aria-describedby="button-addon2">
											<div class="input-group-append">
												<button class="btn" type="submit" id="button-addon3"><i
														class="ti-search"></i></button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</li>
						<!-- Notifications -->
						<li class="dropdown notifications-menu">
							<a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown"
								title="Notifications">
								<i class="icon-Notifications"><span class="path1"></span><span class="path2"></span></i>
							</a>
							<ul class="dropdown-menu animated bounceIn">

								<li class="header">
									<div class="p-20">
										<div class="flexbox">
											<div>
												<h4 class="mb-0 mt-0">Notifications</h4>
											</div>
											<div>
												<a href="#" class="text-danger">Clear All</a>
											</div>
										</div>
									</div>
								</li>

								<li>
									<!-- inner menu: contains the actual data -->
									<ul class="menu sm-scrol">
									</ul>
								</li>
							</ul>
						</li>

						<!-- User Account-->
						<li class="dropdown user user-menu">
							<a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown"
								title="User">
								<i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
							</a>
							<ul class="dropdown-menu animated flipInX">
								<li class="user-body">
									<a class="dropdown-item" href="#"><i class="ti-user text-muted mr-2"></i>
										Profile</a>
									<div class="dropdown-divider"></div>
									<a @click="logout" class="dropdown-item" href="#"><i class="ti-lock text-muted mr-2"></i> Logout</a>
								</li>
							</ul>
						</li>

						<!-- Control Sidebar Toggle Button -->
						<li>
							<a href="#" data-toggle="control-sidebar" title="Setting" class="waves-effect waves-light">
								<i class="icon-Settings"><span class="path1"></span><span class="path2"></span></i>
							</a>
						</li>

					</ul>
				</div>
			</nav>
		</header>

		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar-->
			<section class="sidebar position-relative">
				<div class="multinav">
					<div class="multinav-scroll" style="height: 100%;">
						<!-- sidebar menu-->
						<ul class="sidebar-menu" data-widget="tree"  @mouseover="hoverNav" @mouseleave="leaveNav">
							<li class="header">Components & UI </li>

							<template v-for="(module, index) in modules" :key="module.module_id">
								<li class="treeview">
									<a href="javascript:void(0);" :data-target="'#' + index">
										<i class="icon-Write" ><span class="path1"></span><span class="path2"></span></i>
										<span>{{ index }}</span>
										<span class="pull-right-container">
											<i class="fa fa-angle-right pull-right"></i>
										</span>
									</a>
									<ul :id=index class="treeview-menu">

										<li v-for="(sub_module, index) in module" :key="sub_module.sub_module_id">
											<router-link
												:to="sub_module.url">{{ sub_module.description_sub_module }}</router-link>
										</li>
									</ul>
								</li>
							</template>

						</ul>
					</div>
				</div>
			</section>
			<div class="sidebar-footer">
				<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
					aria-describedby="tooltip92529"><span class="icon-Settings-2"></span></a>
				<a href="mailbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><span
						class="icon-Mail"></span></a>
				<a @click="logout" href="#" class="link" data-toggle="tooltip" title=""
					data-original-title="Logout"><span class="icon-Lock-overturning"><span class="path1"></span><span
							class="path2"></span></span></a>
			</div>
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<div class="container-full">
				<!-- Content Header (Page header) -->
				<div class="content-header">
					<div class="d-flex align-items-center">
						<div class="mr-auto">
							<h3 class="page-title">Blank page</h3>
							<div class="d-inline-block align-items-center">
								<nav>
									<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a>
											</li>
										<li class="breadcrumb-item" aria-current="page">Sample Page</li>
										<li class="breadcrumb-item active" aria-current="page">Blank page</li>
									</ol>
								</nav>
							</div>
						</div>

					</div>
				</div>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-12">
							<div class="box">
								<div class="box-header with-border">
									<h4 class="box-title">Title</h4>
								</div>
								<div class="box-body">
									This is some text within a card block.
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									Footer
								</div>
								<!-- /.box-footer-->
							</div>
						</div>
					</div>
				</section>
				<!-- /.content -->

			</div>
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<div class="pull-right d-none d-sm-inline-block">
				<ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
					<li class="nav-item">
						<a class="nav-link" href="javascript:void(0)">FAQ</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Purchase Now</a>
					</li>
				</ul>
			</div>
			&copy; 2020 <a href="https://www.multipurposethemes.com/">Multipurpose Themes</a>. All Rights Reserved.
		</footer>
		<!-- Control Sidebar -->
		<aside class="control-sidebar">

			<div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger"><i
						class="ion ion-close text-white" data-toggle="control-sidebar"></i></span> </div>
			<!-- Create the tabs -->
			<ul class="nav nav-tabs control-sidebar-tabs">
				<li class="nav-item"><a href="#control-sidebar-home-tab" data-toggle="tab" class="active"><i
							class="mdi mdi-message-text"></i></a></li>
				<li class="nav-item"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i
							class="mdi mdi-playlist-check"></i></a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Home tab content -->
				<div class="tab-pane active" id="control-sidebar-home-tab">
					<div class="flexbox">
						<a href="javascript:void(0)" class="text-grey">
							<i class="ti-more"></i>
						</a>
						<p>Users</p>
						<a href="javascript:void(0)" class="text-right text-grey"><i class="ti-plus"></i></a>
					</div>
					<div class="lookup lookup-sm lookup-right d-none d-lg-block">
						<input type="text" name="s" placeholder="Search" class="w-p100">
					</div>
					<div class="media-list media-list-hover mt-20">
					</div>

				</div>
				<!-- /.tab-pane -->
				<!-- Settings tab content -->
				<div class="tab-pane" id="control-sidebar-settings-tab">
					<div class="flexbox">
						<a href="javascript:void(0)" class="text-grey">
							<i class="ti-more"></i>
						</a>
						<p>Todo List</p>
						<a href="javascript:void(0)" class="text-right text-grey"><i class="ti-plus"></i></a>
					</div>
					<ul class="todo-list mt-20">
	
					</ul>
				</div>
				<!-- /.tab-pane -->
			</div>
		</aside>
		<!-- /.control-sidebar -->

		<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->
	<!-- Sidebar -->

	<div id="chat-box-body">
		<div id="chat-circle" class="waves-effect waves-circle btn btn-circle btn-lg btn-warning l-h-70">
			<div id="chat-overlay"></div>
			<span class="icon-Group-chat font-size-30"><span class="path1"></span><span class="path2"></span></span>
		</div>
	</div>
</template>

<script>

import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';


// -------------
console.log("dashc");
export default {
	components: {
		Loading
	},
	name: "Dashboard",
	data() {
		return {
			isLoading: true,
			fullPage: true,
			// 
			state_navbar: false,

			state_mobile_nav: true,
			state_hover_navbar: false,
			profile_id: false,
			name: null,
			modules: [],
			style_height: {
				"display": "block",
			},
		};
	},


	created() {
		this.clickNagbar();
		this.clickNav();
		this.checkSession();
		this.getModules();
		this.addStyleWrapper();
		this.activeMenu();
		// this.checkSession2();
	},

	// created() {
	//     if (window.Laravel.user) {
	//         this.name = window.Laravel.user.name
	//     }
	// },
	// beforeRouteEnter(to, from, next) {
	//     if (!window.Laravel.isLoggedin) {
	// 		this.$router.push({name: 'login'})
	//     }
	//     next();
	// },
	methods: {
		activeMenu() {
			if (!this.state_navbar) {
				this.state_navbar = true;
			} else {
				this.state_navbar = false;
			}
		},
		clickMovileNav() {
			if (!this.state_mobile_nav) {
				this.state_mobile_nav = true;
			} else {
				this.state_mobile_nav = false;
			}
		},
		leaveNav() {
			this.state_hover_navbar = false;
		},
		hoverNav() {
			this.state_hover_navbar = true;
		},
		addStyleWrapper() {
		},
		//  checkSession() {
		// 	let logueo=window.localStorage.getItem("logueo");
		//     if (logueo) {
		//     	this.$router.push({name: 'dashboard'})
		// 	 }else{

		// 		this.$router.push("/")
		// 	 }
		// },
		async checkSession() {
			this.$axios.get("/sanctum/csrf-cookie").then((response) => {
				this.$axios
					.get(`/api/getSession/`)
					.then((response) => {
						let logueo = response.data.success;
						if (response.data.success) {

						} else {
							this.$router.push("/")
						}
					})
					.catch(function (error) {
						console.error(error);
					});
			});
		},

		async getModules() {

			this.$axios.get("/sanctum/csrf-cookie").then((response) => {
				this.$axios
					.get(`/api/getModules/`)
					.then((response) => {
						this.modules = response.data.modules;
						this.isLoading = false
					})
					.catch(function (error) {
						console.error(error);
					});
			});
		},


		clickNagbar() {
			if (!this.state_navbar) {
				this.state_navbar = true;
			} else {
				this.state_navbar = false;
			}
		},
		clickNav() {
			if (!this.state_nav) {
				this.state_nav = true;
			} else {
				this.state_nav = false;
			}
		},
		logout(e) {
			e.preventDefault();
			this.$axios.get("/sanctum/csrf-cookie").then((response) => {
				this.$axios
					.post("/api/logout")
					.then((response) => {
						if (response.data.success) {
							window.localStorage.removeItem("logueo");
							this.checkSession();
						} else {
							console.log(response);
						}
					})
					.catch(function (error) {
						console.error(error);
					});
			});
		},
	},
};
</script>

<style scoped>
.nicescroll-bar {
	overflow-x: hidden;
}
</style>
