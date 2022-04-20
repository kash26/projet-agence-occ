<template>
  <div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employees</h1>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Employee
                        <router-link :to="{name: 'EmployeesIndex'}" class="float-right">Back</router-link>
                    </div>

                    <div class="card-body">
                        <form v-on:submit.prevent="storeEmployee">

                            <div class="row mb-3">
                                <label
                                    for="first_name"
                                    class="col-md-4 col-form-label text-md-end">First Name</label>

                                <div class="col-md-6">
                                    <input
                                        id="first_name"
                                        v-model="form.first_name"
                                        type="text"
                                        class="form-control"
                                        name="first_name"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label
                                    for="middle_name"
                                    class="col-md-4 col-form-label text-md-end">Middle Name</label>

                                <div class="col-md-6">
                                    <input
                                        id="middle_name"
                                        v-model="form.middle_name"
                                        type="text"
                                        class="form-control"
                                        name="middle_name"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label
                                    for="last_name"
                                    class="col-md-4 col-form-label text-md-end">Last Name</label>

                                <div class="col-md-6">
                                    <input
                                        id="last_name"
                                        v-model="form.last_name"
                                        type="text"
                                        class="form-control"
                                        name="last_name"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="city_id" class="col-md-4 col-form-label text-md-end">City</label>

                                <div class="col-md-6">

                                    <select
                                        v-model="form.city_id"
                                        id="city_id" name="city_id" class="custom-select" value="" required autocomplete="" autofocus>
                                        <option selected>Select a city</option>
                                        <option v-for="city in cities" :key="city.id" :value="city.id">{{ city.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="department_id" class="col-md-4 col-form-label text-md-end">Department</label>

                                <div class="col-md-6">

                                    <select v-model="form.department_id" id="department_id" name="department_id" class="custom-select" value="" required autocomplete="" autofocus>
                                        <option selected>Select a Dept.</option>
                                        <option v-for="department in departments" :key="department.id" :value="department.id">{{ department.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label
                                    for="address"
                                    class="col-md-4 col-form-label text-md-end">Address</label>

                                <div class="col-md-6">
                                    <input
                                        id="address"
                                        v-model="form.address"
                                        type="text"
                                        class="form-control"
                                        name="address"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label
                                    for="zip_code"
                                    class="col-md-4 col-form-label text-md-end">Zip Code</label>

                                <div class="col-md-6">
                                    <input
                                        id="zip_code"
                                        v-model="form.zip_code"
                                        type="text"
                                        class="form-control"
                                        name="zip_code"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label
                                    for="birthdate"
                                    class="col-md-4 col-form-label text-md-end">Birthdate</label>
                                <div class="col-md-6">
                                    <datepicker
                                        v-model="form.birthdate"
                                        id="birthdate" input-class="form-control"></datepicker>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label
                                    for="date_hired"
                                    class="col-md-4 col-form-label text-md-end">Date Hired</label>
                                <div class="col-md-6">
                                    <datepicker
                                        v-model="form.date_hired"
                                        id="date_hired" input-class="form-control"></datepicker>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Store
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import moment from "moment";

export default {
    components: {
        Datepicker
    },
    data() {
        return {
            cities: [],
            departments: [],
            form: {
                first_name: '',
                last_name: '',
                middle_name: '',
                address: '',
                city_id: '',
                department_id: '',
                zip_code: '',
                birthdate: null,
                date_hired: null,
            }
        }
    },

    created() {
        this.getCities();
        this.getDepartments();
    },

    methods: {
        getCities() {
            axios.get('/api/employees/cities')
                .then(res => {
                    this.cities = res.data;
                }).catch(error => {
                    console.log(error);
                });
        },
         getDepartments() {
            axios.get('/api/employees/departments')
                .then(res => {
                    this.departments = res.data;
                }).catch(error => {
                    console.log(error);
                });
        },
        storeEmployee() {
            axios.post("/api/employees", {
                'first_name': this.form.first_name,
                'middle_name': this.form.middle_name,
                'last_name': this.form.last_name,
                'address': this.form.address,
                'city_id': this.form.city_id,
                'department_id': this.form.department_id,
                'zip_code': this.form.zip_code,
                'birthdate': this.format_date(this.form.birthdate),
                'date_hired': this.format_date(this.form.date_hired),
            }).then(res => {
                this.$router.push({ name: 'EmployeesIndex' });
            }).catch(error => {
                console.log(error);
            });
        },
        format_date(value) {
            if (value) {
                return moment(String(value)).format('YYYYMMDD')
            }
        }
    }
}
</script>

<style>

</style>
