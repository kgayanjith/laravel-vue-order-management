<template>
  <AppLayout>
    <HeaderComponent title="Sales" subtitle="Manage Sales" />
    <Link class="btn btn-primary py-1 px-5" :href="route('sales.create')">Add New</Link>
    <div class="table-responsive mt-3 ">
      <table class="table table-hover" id="salesTable">
        <thead class="">
          <tr class="">
            <th class="fw-bold" scope="col">Sale ID</th>
            <th class="fw-bold" scope="col">Sale Date</th>
            <th class="fw-bold" scope="col">Customer</th>
            <th class="fw-bold" scope="col">Product Name</th>
            <th class="fw-bold" scope="col">Quantity</th>
            <th class="fw-bold" scope="col">Gross Price</th>
            <th class="fw-bold" scope="col">Tax</th>
            <th class="fw-bold" scope="col">Tax Amount</th>
            <th class="fw-bold" scope="col">Net Price</th>
            <th class="fw-bold" scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="sale in sales" :key="sale.id" @dblclick="openSale(sale.id)" class="table-row-style">
            <td>{{ sale.id }}</td>
            <td>{{ sale.invoiceDate }}</td>
            <td>{{ sale.customer.name }}</td>
            <td>{{ sale.items[0].product.name }}</td>
            <td>{{ sale.items[0].quantity }}</td>
            <td>{{ Number(sale.items[0].excl_amount).toFixed(2) }}</td>
            <td>{{ sale.items[0].tax_rate }}%</td>
            <td>{{ Number(sale.items[0].tax_amount).toFixed(2) }}</td>
            <td>{{ Number(sale.items[0].incl_amount).toFixed(2) }}</td>
            <td>
              <Link @click="openModel(sale.id)" class="btn btn-dark rounded-pill py-0 "><i
                class="fa-solid fa-trash"></i></Link>
            </td>
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
import Swal from 'sweetalert2';


export default {
  components: {
    AppLayout,
    Link,
    HeaderComponent
  },
  props: {
    sales: Array
  },
  mounted() {
    $(document).ready(function () {
      $('#salesTable').DataTable();
    });
  },
  methods: {
    openSale(id) {
      // console.log(id);
      this.$inertia.visit(route('sales.edit', id));
    },
    openModel(id) {
      // this.$inertia.de(route('sales.destroy', id))
      console.log(id);
      this.$inertia.visit(route('sales.destroy', id))
      
    }
  }
}
</script>

<style></style>