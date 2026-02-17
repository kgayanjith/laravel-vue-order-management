<template>
    <AppLayout>
        <HeaderComponent title="Customers" subtitle="Manage Customers" />
        <Link class="btn btn-primary py-1 px-5" :href="route('customers.create')">Create</Link>
        <div class="table-responsive mt-3">
            <table class="table" id="customersTable">
                <thead class="">
                    <tr class="text-center">
                        <th class="fw-bold" scope="col">ID</th>
                        <th class="fw-bold" scope="col">Customer Name</th>
                        <th class="fw-bold text-center" scope="col">Address</th>
                        <th class="fw-bold" scope="col">Phone No</th>
                        <th class="fw-bold" scope="col">Status</th>
                        <th class="fw-bold" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="customer in customers" :key="customer.id">
                        <td>{{ customer.id }}</td>
                        <td>{{ customer.name }}</td>
                        <td>{{ customer.address }}</td>
                        <td>{{ customer.phone }}</td>
                        <td class="text-center">
                            <span :class="customer.status == 1 ? 'badge text-bg-success' : 'badge text-bg-danger'">
                                {{ customer.status == 1 ? 'Activated' : 'Deactivated' }}
                            </span>
                        </td>
                        <td>action</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>

<script>
import HeaderComponent from '@/Components/HeaderComponent.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';


export default {
    components: {
        AppLayout,
        Link,
        HeaderComponent
    },
    props: {
        customers: Array
    },
    mounted() {
        $(document).ready(function () {
            $('#customersTable').DataTable();
        });
    }

}
</script>

<style></style>