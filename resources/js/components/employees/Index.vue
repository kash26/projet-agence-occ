<template>
  <div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employees</h1>
    </div>

    <div class="row">
        <div v-if="showMessage" class="mx-auto w-100 mb-3">
            <div class="alert alert-success">
                {{ message }}
            </div>
        </div>

        <div class="card mx-auto table-responsive">

            <div class="card-header">
                <div class="row d-flex justify-content-between">
                    <div class="col-6">
                        <form>
                            <div class="form-row align-center">
                                <div class="col">
                                    <input
                                        type="text"
                                        v-model.lazy="search"
                                        class="form-control mb-2"
                                        placeholder="Mr. Nelson Wells">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                                <div class="col-md-6">
                                    <select
                                        v-model="selectedDepartment"
                                        id="department_id"
                                        name="department_id"
                                        class="custom-select"
                                        value=""
                                        required
                                        autocomplete=""
                                        autofocus>
                                        <option selected>Select a department</option>
                                        <option v-for="department in departments" :key="department.id" :value="department.id">{{ department.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="float-right">
                        <router-link :to="{name: 'EmployeesCreate'}" class="btn btn-primary">Create</router-link>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#Id</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Department</th>
                        <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="employee in employees" :key="employee.id">
                            <th scope="row">#{{ employee.id }}</th>
                            <td>{{ employee.first_name }}</td>
                            <td>{{ employee.last_name }}</td>
                            <td>{{ employee.address }}</td>
                            <td>{{ employee.department.name }}</td>
                            <td>
                                <router-link class="btn btn-success" :to="{ name: 'EmployeesEdit', params: { id: employee.id } }">Edit</router-link>
                                <button class="btn btn-danger" @click="deleteEmployee(employee.id)">Delete</button>
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
    data() {
        return {
            employees: [],
            showMessage: false,
            message: '',
            search: null,
            selectedDepartment: null,
            departments: []
        }
    },
    watch: {
        search() {
            this.getEmployees();
        },
        selectedDepartment() {
            this.getEmployees();
        }
    },
    created() {
        this.getEmployees();
        this.getDepartments();
    },
    methods: {
        getEmployees() {
            axios.get('/api/employees', {
                params: {
                    search: this.search,
                    department_id: this.selectedDepartment
                }
            })
                .then(res => {
                    this.employees = res.data.data
                }).catch(error => {
                    console.log(error);
                })
        },
        getDepartments() {
            axios.get("/api/employees/departments")
                .then(res => {
                    this.departments = res.data;
                }).catch(error => {
                    console.log(error);
                });
        },
        deleteEmployee(id) {
            axios.delete("api/employees/" + id)
                .then(res => {
                    this.showMessage = true;
                    this.message = res.data;
                    this.getEmployees();
                }).catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>

<style>

</style>
