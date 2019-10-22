<template>
    <div class="row">
        <div class="col-md-6">
            <h1>User Role</h1>
            <div class="input-group mb-3">
                <input type="text" v-model="role" class="form-control" placeholder="Add new user role"
                       aria-label="Add new user role" aria-describedby="add-user-role">
                <div class="input-group-append">
                    <button @click="addNewRole" class="btn btn-outline-secondary" type="button" id="add-user-role">ADD
                    </button>
                </div>
            </div>
            <ul class="list-group wrapper-60 mt-2">
                <li class="list-group-item" v-for="role in user_roles">{{role.rolename}}</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h1>Users</h1>
            <div class="form-group">
                <input type="text" v-model="user" class="form-control mb-2" placeholder="Add new user">
                <select class="custom-select mb-2" v-model="selected_role" required>
                    <option value="">Select user role</option>
                    <option :value="role.id" v-for="role in user_roles">{{role.rolename}}</option>
                </select>
                <button class="btn btn-primary" @click="addNewUser">Add</button>
                <ul class="list-group mt-3 wrapper-50">
                    <li class="list-group-item mb-1" v-for="user in users">
                        <p>User: <i>{{user.username}}</i></p>
                        <p>User role: <i>{{user.role.rolename}}</i></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import * as axios from "axios";

    export default {
        name: "App",
        data() {
            return {
                role: '',
                user_roles: [],
                users: [],
                selected_role: '',
                user: ''
            }
        },
        methods: {
            getAllRoles() {
                axios.get('/api/user-role', {}).then((response) => {
                    this.user_roles = response.data;
                })
            },
            addNewRole() {
                let data = new FormData();
                data.append('rolename', this.role);
                axios.post('/api/user-role', data, {}).then((response) => {
                    this.role = '';
                    this.getAllRoles();
                })
            },
            getAllUsers() {
                axios.get('/api/user', {}).then((response) => {
                    this.users = response.data;
                });
            },
            addNewUser() {
                let data = new FormData();
                data.append('username', this.user);
                data.append('role_id', this.selected_role);
                axios.post('/api/user', data, {}).then((response) => {
                    this.user = '';
                    this.selected_role = '';
                    this.getAllUsers();
                })
            }
        },
        created() {
            this.getAllRoles();
            this.getAllUsers();
        }
    }
</script>

<style scoped>

</style>
