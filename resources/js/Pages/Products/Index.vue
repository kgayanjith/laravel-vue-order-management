<template>
    <AppLayout>
        <Link class="btn btn-primary py-1 px-5" :href="route('products.create')">Create</Link>
        <div class="table-responsive mt-3">
        <table class="table" id="productsTable">
            <thead class="">
                <tr class="text-center">
                    <th class="fw-bold" scope="col">ID</th>
                    <th class="fw-bold" scope="col">Product Name</th>
                    <th class="fw-bold" scope="col">Product Description</th>
                    <th class="fw-bold" scope="col">Price</th>
                    <th class="fw-bold" scope="col">Status</th>
                    <th class="fw-bold" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.code }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.price }}</td>
                    <td class="text-center">
                        <span :class="product.status == 1 ? 'badge text-bg-success' : 'badge text-bg-danger'">
                                {{ product.status == 1 ? 'Activated' : 'Deactivated' }}
                            </span>
                    </td>
                    <td>

                    </td>
                </tr>
            </tbody>
        </table>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';


export default {
    components: {
        AppLayout,
        Link
    },
    props: {
        products: Array
    },
    mounted() {
        $(document).ready(function () {
            $('#productsTable').DataTable();
        });
    }
    
}
</script>

<style></style>